<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Files;
use App\Models\Vendor;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataset = Product::paginate(10);
        dd(Product::all());
        return view('app.admin.products.index', compact('dataset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mainCategories = Category::main()->Get();
        $vendors = Vendor::all();
        $mainProducts = [];
        $featuredList = Product::getFeaturedList();
        $tagList = Product::getTagsList();
        $discountList = [];

        return view('app.admin.products.create', compact('mainCategories', 'vendors', 'mainProducts', 'featuredList', 'tagList', 'discountList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $collection = collect($request);
            if ($collection->has('active')) {
                $collection['active'] = true;
            }
            if ($collection->has('in_stock')) {
                $collection['in_stock'] = true;
            }
            DB::beginTransaction();
            if ($collection->has('image')) {
                $image = $this->saveFile($collection['image'], 'image', $collection['name'], 'products');
            }
            //  elseif ($collection->('banner')) {
            //     $banner = $this->saveFile($collection['banner'], 'banner', $collection['name']);
            // }

            $newProduct = Product::create([
                'name' => $collection['name'],
                'slug' => $collection->has('slug') ?  $collection['slug'] : Str::slug($collection['name']),
                'category_id' => $collection->has('category' )? $collection['category']: null,
                'vendor_id' => $collection->has('vendor' )? $collection['vendor']: null,
                'product_id' => $collection->has('product_id') ?  $collection['product_id'] : null,
                'tag' => $collection->has('tag') ?  $collection['tag'] : null,
                // 'tags' => $collection['product_id'],
                'info' => $collection->has('info') ?  $collection['info'] : null,
                'description' => $collection->has('description') ?  $collection['description'] : null,
                'details' => $collection->has('details') ?  $collection['details'] : null,
                'base_price' => $collection['base_price'],
                'base_tax' => $collection->has('base_tax') ? $collection['base_tax'] : null,
                'active' => $collection->has('active') ? true : false,
                'in_stock' => $collection->has('in_stock') ? true : false,
                'quantity' => $collection->has('quantity') ? $collection['quantity'] : null,
                'image' => $collection->has('image') ? $image : null,
                'discount_id' => $collection->has('discount_id') ?  $collection['discount_id'] : null,
                'status' => $collection->has('status') ? $collection['status'] : 'new',
                'featured' => $collection->has('featured') ? $collection['featured'] : null,
            ]);
            DB::commit();
            return redirect()->route('admin.products')->with(['success' => 'new Product Created']);
        } catch (\Exception $ex) {
            DB::rollback();
            if (isset($image)) {
                Storage::disk('products')->delete($image);
                $this->deleteFile($image);
            }
            dd($ex);
            return redirect()->route('admin.products')->with(['error' => 'There was an Error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $parentProduct = $product->parentProduct();
        return view('app.admin.products.show', compact('product', 'parentProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $mainCategories = Category::main()->Get();
        $vendors = Vendor::all();
        $mainProducts = [];
        $featuredList = Product::getFeaturedList();
        $tagList = Product::getTagsList();
        $discountList = [];

        return view('app.admin.products.edit', compact('mainCategories', 'vendors', 'mainProducts', 'featuredList', 'tagList', 'discountList', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {

        try {
            if ($product->id != $request->id) {
                throw new Exception;
            }
            $collection = collect($request);
            //if the collection is Yes put it as 1
            if ($collection->has('active')) {
                $collection['active'] = 1;
            } else {
                $collection['active'] = 0;
            }
            //if a slug isn't present the new Slug is going to be generated from the name
            if (!$collection->has('slug')) {
                $collection['slug'] = Str::slug($collection['name']);
            }
            // BEGIN DATABASE TRANSACTION
            DB::beginTransaction();

            //if the request has a profile or a banner Save the file into the DB and file system soft delete the old files
            //from the file DB and put the hashname into the collection
            if ($collection->has('image')) {
                $image = $this->saveFile($collection['image'], 'image', $collection['name'],'products');
                $collection['image'] = $image;
                $this->deleteFile($product->image);
            }

            //Update the fields in the record
            $product->update($collection->toArray());

            // //COMMIT DATABASE
            DB::commit();

            return redirect()->route('admin.products')->with(['success' => 'product updated']);
        } catch (\Exception $ex) {
             //Roll back the database transactions
             DB::rollback();
             //if there was a profile or banner inputted  remove them
             if (isset($image)) {
                 Storage::disk('vendors')->delete($image);
             }
             return redirect()->route('admin.products')->with(['error' => 'There was an Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $this->deleteFile($product->image);
            $product->delete();
            return redirect()->route('admin.products')->with(['success' => 'product Deleted']);
        } catch (\Exception $e) {
            return redirect()->route('admin.products')->with(['error' => 'there was an error']);
        }
    }

    /**
     * Saves the File to Storage and puts an entry for it in the DB
     *
     * @param \Illuminate\Http\UploadedFile $file the File
     * @param  string $usage the use of this file
     * @param  string $name the name to give this file in the DB
     * @param  string $disk disk name
     * @return string Image hash
     */
    public function saveFile($file, $usage, $name, $disk)
    {
        $image = uploadImage($disk, $file);
        Files::create([
            'name' => $name . 'image',
            'original_name' => $file->getClientOriginalName(),
            'type' => $file->getClientMimeType(),
            'file_name' => $image,
            'disk' => $disk,
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
