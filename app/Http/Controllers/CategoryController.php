<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
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
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
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
        //
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
        $image = uploadImage('categories',$file);
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
