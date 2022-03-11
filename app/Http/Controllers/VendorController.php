<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use App\Models\Category;
use App\Models\Files;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::paginate(10);
        return view('app.admin.vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $featuredList = Vendor::getFeaturedList();
        $statusList = Vendor::getStatusList();
        $mainCategories = Category::main()->get();
        $vendors = User::vendors()->get();
        return view('app.admin.vendors.create', compact('featuredList', 'statusList', 'mainCategories', 'vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVendorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorRequest $request)
    {
        try {
            //put the request into a collection to make working with it easier
            $collection = collect($request);

            //BEGIN DB TRANSACTION
            DB::beginTransaction();

            // Storing The Images in the style System and in the DB
            if ($collection->has('profile')) {
                $profile = $this->saveFile($collection['profile'], 'profile', $collection['name']);
            }
            if ($collection->has('banner')) {
                $banner = $this->saveFile($collection['banner'], 'banner', $collection['name']);
            }

            //CREATE A NEW MODEL/DB
            $newCategory = Vendor::create([
                'name' => $collection['name'],
                'slug' => $collection->has('slug') ?  $collection['slug'] : Str::slug($collection['name']),
                'category_id' => $collection['category'],
                // 'categories' => $collection['category'] JSON ENCODE,
                'user_id' => $collection['user'],
                //'staff' => $collection['user'] TO JSON,
                'description' => $collection->has('description') ?  $collection['description'] : null,
                'active' => $collection->has('active') ? true : false,
                'profile' => $collection->has('profile') ? $profile : null,
                'banner' =>  $collection->has('banner') ? $banner : null,
                'status' => $collection->has('status') ? $collection['status'] : 'new',
                'featured' => $collection->has('featured') ? $collection['featured'] : 'new',
            ]);
            //COMMIT TRANSACTIONS
            DB::commit();
            return redirect()->route('admin.vendors')->with(['success' => 'new Vendor Created']);
        } catch (\Exception $ex) {
            //ROLLBACK TRANSACTIONS AND DELETE FILES
            DB::rollback();
            if (isset($image)) {
                Storage::disk('categories')->delete($image);
                $this->deleteFile($image);
            } elseif (isset($banner)) {
                Storage::disk('categories')->delete($banner);
                $this->deleteFile($banner);
            }
            dd($ex);
            return redirect()->route('admin.vendors')->with(['error' => 'There was an Error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(vendor $vendor)
    {
        return view('app.admin.vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        $featuredList = Vendor::getFeaturedList();
        $statusList = Vendor::getStatusList();
        $mainCategories = Category::main()->get();
        $vendors = User::vendors()->get();
        $subCategories = $vendor->Category->childCategories()->get();
        // dd(($vendor->categories->has(2) ? $vendor->categories[2]: 'no') == 'no');
        return view('app.admin.vendors.edit', compact('vendor', 'featuredList', 'statusList', 'mainCategories', 'vendors', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVendorRequest  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        try {
            //If the Vendor Id doesn't match the id in the hidden field in the form throw an exception
            if ($vendor->id != $request->id) {
                throw new Exception;
            }
            //put the request inputs into a collection
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
            if ($collection->has('profile')) {
                $profile = $this->saveFile($collection['profile'], 'profile', $collection['name']);
                $collection['image'] = $profile;
                $this->deleteFile($vendor->image);
            } elseif ($collection->has('banner')) {
                $banner = $this->saveFile($collection['banner'], 'banner', $collection['name']);
                $collection['banner'] = $banner;
                $this->deleteFile($vendor->banner);
            }

            //Update the fields in the record
            $vendor->update($collection->toArray());

            // //COMMIT DATABASE
            DB::commit();

            return redirect()->route('admin.vendors')->with(['success' => 'vendor updated']);
        } catch (Exception $ex) {
            //Roll back the database transactions
            DB::rollback();
            //if there was a profile or banner inputted  remove them
            if (isset($profile)) {
                Storage::disk('vendors')->delete($profile);
            } elseif (isset($banner)) {
                Storage::disk('vendors')->delete($banner);
            }
            return redirect()->route('admin.vendors')->with(['error' => 'There was an Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        try {
            $this->deleteFile($vendor->image);
            $vendor->delete();
            return redirect()->route('admin.vendors')->with(['success' => 'vendor Deleted']);
        } catch (Exception $e) {
            return redirect()->route('admin.vendors')->with(['error' => 'there was an error']);
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
        $image = uploadImage('vendors', $file);
        Files::create([
            'name' => $name . 'image',
            'original_name' => $file->getClientOriginalName(),
            'type' => $file->getClientMimeType(),
            'file_name' => $image,
            'disk' => 'vendors',
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

    /**
     * the api for getting Ajax requests for Staff and Sub category lists
     *TODO: BACK END IS DONE BUT NOT FROUND END
     * @param  Request $request
     * @param  mixed $value
     * @return string|redirect
     */
    public function api(Request $request, $value)
    {
        if ($value == 'staff') {
            $vendors = User::vendors()->get()->whereNotIn('id', $request['boss']);
            return $vendors->toJson();
        } elseif ($value == "cate") {
            $cats = Category::find($request['cate'])->childCategories()->get();
            return $cats->toJson();
        } else {
            return redirect()->route('admin.vendors');
        }
    }
}
