<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use App\Models\Category;
use App\Models\User;
use Exception;
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
        return view('app.admin.vendors.index',compact('vendors'));
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
        return view('app.admin.vendors.create',compact('featuredList','statusList','mainCategories','vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVendorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorRequest $request)
    {
        // return $request;

        try{
            //put the request into a collection to make working with it easier
            $collection = collect($request);

            //BEGIN DB TRANSACTION
            DB::beginTransaction();

            // Storing The Images in the style System and in the DB
            if ($collection->has('profile')) {
                $profile = $this->saveFile($collection['profile'], 'profile', $collection['name']);
            } elseif ($collection->has('banner')) {
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
                'description' => $collection->has('description')?  $collection['description'] : null,
                'active' => $collection->has('active') ? true : false,
                'profile' => $collection->has('profile') ? $profile : null,
                'banner' =>  $collection->has('banner') ?'test' : null,
                'status' => $collection->has('status') ? $collection['status'] : 'new',
                'featured' => $collection->has('featured') ? $collection['featured'] : 'new',
            ]);
            //COMMIT TRANSACTIONS
            DB::commit();
            return redirect()->route('admin.vendors')->with(['success' => 'new Vendor Created']);
        }catch(\Exception $ex){
            //ROLLBACK TRANSACTIONS
            DB::rollback();
            if (isset($image)) {
                Storage::disk('categories')->delete($image);
            } elseif (isset($banner)) {
                Storage::disk('categories')->delete($banner);
            }
            dd($ex);
            return redirect()->route('admin.vendors')->with(['success' => 'There was an Error']);

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
        return view('app.admin.vendors.show',compact('vendor'));
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
        return view('app.admin.vendors.edit',compact('vendor','featuredList','statusList','mainCategories','vendors'));
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
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }

    protected function saveFile($test,$TEst,$EEST){
        return 'test';
    }
}
