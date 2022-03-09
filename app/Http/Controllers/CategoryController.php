<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Files;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        //VALIDATE AUTHORIZATION
    }
    /**
     * Display a listing of the Categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('app.admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mainCategories = Category::Main()->get();
        return view('app.admin.categories.create', compact('mainCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {

        //Validation of the form is Done Through the MainCategoryRequest Class Container sends it validates the input then returns here
        try {
            $newCategory = collect($request);
            if ($newCategory->has('parent_category_id') && $newCategory->has('parent_category_id')) {
                $newCategory->forget('is_main');
            }
            //BEGIN DATABASE TRANSACTION
            DB::beginTransaction();

            if ($newCategory->has('image')) {
                $image = $this->saveFile($newCategory['image'], 'image', $newCategory['name']);
            } elseif ($newCategory->has('banner')) {
                $banner = $this->saveFile($newCategory['banner'], 'banner', $newCategory['name']);
            }
            $newCategory = Category::create([
                'name' => $newCategory['name'],
                'description' => $newCategory['description'],
                'parent_category_id	' =>  $newCategory->has('parent_category_id') ? $newCategory['parent_category_id'] : null,
                'is_main' => $newCategory->has('is_main') ? true : false,
                'active' => $newCategory->has('active') ? true : false,
                'slug' => $newCategory->has('slug') ?  $newCategory['slug'] : Str::slug($newCategory['name']),
                'banner' =>  $newCategory->has('banner') ? $banner : null,
                'image' => $newCategory->has('image') ? $image : null,
            ]);

            //COMMIT DATABASE
            DB::commit();

            return redirect()->route('admin.categories')->with(['success' => 'new category Created']);
        } catch (\Exception $e) {
            //ROLLBACK DATABASE
            DB::rollback();
            if (isset($image)) {
                Storage::disk('categories')->delete($image);
            } elseif (isset($banner)) {
                Storage::disk('categories')->delete($banner);
            }
            dd($e);
            return redirect()->route('admin.categories')->with(['error' => 'there was an error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $parent = $category->parentCategory ? $category->parentCategory->name : "doesn't have a parent";
        return view('app.admin.categories.show', compact('category', 'parent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $mainCategories = Category::Main()->get();
        // dd($mainCategories[0]->id == $category->parent_category_id);
        return view('app.admin.categories.edit', compact('category', 'mainCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        //Validation of the form is Done Through the MainCategoryRequest Class Container sends it validates the input then returns here
        try {
            if ($category->id != $request->id) {
                throw new Exception;
            }

            $newCategory = collect($request);

            if ($newCategory->has('parent_category_id') && $newCategory->has('is_main')) {
                $newCategory->forget('is_main');
            }
            if ($newCategory->has('is_main')) {
                $newCategory['is_main'] = 1;
            }
            if (!$newCategory->has('slug')) {
                $newCategory['slug'] = Str::slug($newCategory['name']);
            }
            if ($newCategory->has('active')) {
                $newCategory['active'] = 1;
            }
            // BEGIN DATABASE TRANSACTION
            DB::beginTransaction();

            if ($newCategory->has('image')) {
                $image = $this->saveFile($newCategory['image'], 'image', $newCategory['name']);
                $newCategory['image'] = $image;
                $this->deleteFile($category->image);
            } elseif ($newCategory->has('banner')) {
                $banner = $this->saveFile($newCategory['banner'], 'banner', $newCategory['name']);
                $newCategory['banner'] = $banner;
                $this->deleteFile($category->banner);
            }

            $category->update($newCategory->toArray());

            // //COMMIT DATABASE
            DB::commit();

            return redirect()->route('admin.categories')->with(['success' => 'Category Updated']);
        } catch (\Exception $e) {
            //ROLLBACK DATABASE
            DB::rollback();
            if (isset($image)) {
                Storage::disk('categories')->delete($image);
            } elseif (isset($banner)) {
                Storage::disk('categories')->delete($banner);
            }
            return redirect()->route('admin.categories')->with(['error' => 'there was an error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $this->deleteFile($category->image);
            $category->delete();
            return redirect()->route('admin.categories')->with(['success' => 'Category Deleted']);
        } catch (Exception $e) {
            return redirect()->route('admin.categories')->with(['error' => 'there was an error']);
        }
    }

    /**
     * Saves the File to Storage and puts an entry for it in the DB
     *
     * @param \Illuminate\Http\UploadedFile $file the File
     * @param  string $usage the use of this file
     * @param  string $name the name to give this file in the DB
     * @return string Image hash
     */
    public function saveFile($file, $usage, $name)
    {
        $image = uploadImage('categories', $file);
        Files::create([
            'name' => $name . 'image',
            'original_name' => $file->getClientOriginalName(),
            'type' => $file->getClientMimeType(),
            'file_name' => $image,
            'disk' => 'categories',
            'usage' => $usage,
        ]);
        return $image;
    }

    /**
     * softs delete a File
     *
     * @param  string  $fileName
     * @return void
     */
    public function deleteFile($fileName)
    {
        Files::where('file_name', '=', $fileName)->delete();
    }
}
