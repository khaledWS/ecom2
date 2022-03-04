<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainCategoriesController extends Controller
{
        /**
     * Returns the Index main Categories Page
     * @return \Illuminate\Contracts\View\View  Index View
     */
    public function index()
    {

        //TODO: BE ABLE TO CHANGE THE LANGUAGE
        $default_lang = Config::Get('app.locale');
        $mainCategories  = mainCategory::ofLanguage($default_lang)->selection()->paginate(PAGINATION_COUNT);
        return view('admin.maincategories.index', compact('mainCategories', 'default_lang'));
    }


    /**
     * Returns the Create main categories View
     * @return \Illuminate\Contracts\View\View create categories View
     */
    public function createCategory()
    {
        $languages = language::all();
        return view('admin.maincategories.create', compact('languages'));
    }


    /**
     * Stores the Category which is first passed to the MainCategoryRequest To Validate
     * @param MainCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse redirects to Index with Success or failure messages
     */
    public function storeCategory(MainCategoryRequest $request)
    {
        //Validation of the form is Done Through the MainCategoryRequest Class Container sends it validates the input then returns here
        try {

            $main_categories = collect($request->category);
            $defaultLanguageId = getDefaultLanguageId();

            //filters entires with a null mc_name
            $nullFilter = $main_categories->filter(function ($value, $key) {
                return $value['mc_name'] !== null;
            });
            // gets the default lang array
            $defaultLang = array_values($nullFilter->filter(function ($value, $key) use ($defaultLanguageId) {
                return $value['mc_language'] == $defaultLanguageId;
            })->all())[0];
            // gets other languages
            $otherLang = array_values($nullFilter->filter(function ($value, $key) use ($defaultLanguageId) {
                return $value['mc_language'] !== $defaultLanguageId;
            })->all());

            //BEGIN DATABASE TRANSACTION
            DB::beginTransaction();

            $defaultCategoryId = mainCategory::insertGetId([
                'mc_Description' => $defaultLang['mc_description'],
                'mc_language' => $defaultLang['mc_language'],
                'mc_translation-of' => 0,
                'mc_name' => $defaultLang['mc_name'],
                'mc_slug' => Str::slug($defaultLang['mc_name']),
                'mc_photo' => uploadImage('maincategories', $defaultLang['mc_photo'])
            ]);


            if ($otherLang) {
                $otherCategories_arr = [];
                foreach ($otherLang as $category) {
                    $otherCategories_arr[] = [
                        'mc_Description' => $category['mc_description'],
                        'mc_language' => $category['mc_language'],
                        'mc_translation-of' => $defaultCategoryId,
                        'mc_name' => $category['mc_name'],
                        'mc_slug' => Str::slug($category['mc_name']),
                        'mc_photo' => uploadImage('maincategories', $category['mc_photo'])
                    ];
                }
                mainCategory::insert($otherCategories_arr);
            }

            //COMMIT DATABASE
            DB::commit();


            return redirect()->route('admin.categories')->with(['success' => 'new category saved']);
        } catch (\Exception $e) {
            //ROLLBACK DATABASE
            DB::rollback();
            //TODO:REMOVE THE DDD
            ddd("ERROR CATEGORIES" . $e);
            return redirect()->route('admin.categories')->with(['error' => 'there is an error']);
        }
    }

    /**
     * Returns Edit Category Page
     * @param string $id the ID of the Category to Edit
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse returns the edit view or redirects to index on failure
     */
    public function editCategory($id)
    {
        // Categories and its translations
        $mainCategories = mainCategory::with('otherLanguages')->selection()->find($id);

        if ($mainCategories) {
            return view('admin.maincategories.edit', compact('mainCategories'));
        } else
            return redirect()->route('admin.categories')->with(['error' => 'this Category does not exist']);
    }

    /**
     * Update Category which is first sent to validate to MainCategoryRequests
     * @param string $id the ID of the Category to Edit
     * @param MainCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse redirects to Index with Success or failure messages
     */
    public function updateCategory($id, MainCategoryRequest $request)
    {
        //Validation is Done Through the MainCategoryRequest Class Container sends it validates the input then returns here
        try {
            $category = mainCategory::find($request->id);
            if ($category) {
                $data = collect(array_values($request->category)[0]);

                if ($data->has('mc_active')) {
                    $data['mc_active'] = 1;
                } else {
                    $data['mc_active'] = 0;
                }
                if ($data->has('mc_photo')) {
                    $data['mc_photo'] = uploadImage('maincategories', $data['mc_photo']);
                    $imageUrl = $data['mc_photo'];
                }
                $category->update($data->toArray());

                return redirect()->route('admin.categories')->with(['success' => 'تم الحفظ بنجاح']);
            } else
                return redirect()->route('admin.categories')->with(['error' => 'القسم غير موجود']);
        } catch (\Exception $e) {
            if (isset($imageUrl)) {
                Storage::disk('maincategories')->delete(substr($imageUrl, 22));
            }
            return redirect()->route('admin.categories')->with(['error' => 'حدث خطأ']);
        }
    }


    /**
     * Delete's the Main Category with the passed ID
     * @param string $id the Id of the Main Category to Delete
     * @return \Illuminate\Http\RedirectResponse redirects to Index with Success or failure messages
     */
    public function deleteCategory($id)
    {
        try {
            $category = MainCategory::find($id);
            if ($category) {
                $vendors = $category->vendors();
                if (isset($vendors) && $vendors->count() > 0) {
                    return redirect()->route('admin.categories')->with(['error' => 'cant delete this Category']);
                } else {
                    $category->delete();
                }
                return redirect()->route('admin.categories')->with(['success' => 'Main Category Deleted']);
            } else
                return redirect()->route('admin.categories')->with(['error' => 'Main Category Not Found']);
        } catch (\Exception $e) {
            return redirect()->route('admin.categories')->with(['error' => 'there is an error']);
        }

}
