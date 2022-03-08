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
use Livewire\WithPagination;

class CategoryController extends Controller
{
    use WithPagination;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('app.admin.categories.index', compact('categories'));
        // return view('layouts.admin');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.admin.categories.create');
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
                'active' => $newCategory->has('is_main') ? true : false,
                'mc_slug' => $newCategory->has('slug') ?  $newCategory['slug'] : Str::slug($newCategory['name']),
                'banner' =>  $newCategory->has('banner') ? $banner : null,
                'image' => $image,
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
    public function show($id)
    {
        $category = Category::find(1);
        return view('app.admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Category $category)
    {
        $category = Category::find($id);
        return view('app.admin.categories.edit', compact('category'));
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
        return $category;

        //Validation of the form is Done Through the MainCategoryRequest Class Container sends it validates the input then returns here
        try {
            if($category->id !== $request->id)
            {
                throw new Exception;
            }

            $oldCategory = collect($request);

            if ($oldCategory->has('parent_category_id') && $oldCategory->has('is_main')) {
                $oldCategory->forget('is_main');
            }
            // BEGIN DATABASE TRANSACTION
            DB::beginTransaction();

            if ($oldCategory->has('image')) {
                $image = $this->saveFile($oldCategory['image'], 'image', $oldCategory['name']);
            } elseif ($oldCategory->has('banner')) {
                $banner = $this->saveFile($oldCategory['banner'], 'banner', $oldCategory['name']);
            }
            // oldCategory->update([
            //     'name' => $newCategory['name'],
            //     'description' => $newCategory['description'],
            //     'parent_category_id	' =>  $newCategory->has('parent_category_id') ? $newCategory['parent_category_id'] : '',
            //     'is_main' => $newCategory->has('is_main') ? true : false,
            //     'active' => $newCategory->has('is_main') ? true : false,
            //     'mc_slug' => $newCategory->has('slug') ?  $newCategory['slug'] : Str::slug($newCategory['name']),
            //     'banner' =>  $newCategory->has('banner') ? $banner : null,
            //     'image' => $image,
            // ]);

            // //COMMIT DATABASE
            // DB::commit();

            // return redirect()->route('admin.categories')->with(['success' => 'new category Created']);
        } catch (\Exception $e) {
            //ROLLBACK DATABASE
            // DB::rollback();
            // if (isset($image)) {
            //     Storage::disk('categories')->delete($image);
            // } elseif (isset($banner)) {
            //     Storage::disk('categories')->delete($banner);
            // }
            // dd($e);
            // return redirect()->route('admin.categories')->with(['error' => 'there was an error']);
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
        //
    }

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
}
