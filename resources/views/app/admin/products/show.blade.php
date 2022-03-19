@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!--------------------------- Navigagion breadcrumps header -------------------------->
        @include('app.admin.components.breadcrumps-header', [
            'section' => 'products',
            'current' => $product->name,
            'sectionRoute' => 'admin.products',
        ])
        <!--------------------------- END Navigagion breadcrumps header -------------------------->


        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <!--------------------------- Card -------------------------->
                        <div class="card">
                            <!--------------------------- Card Header -------------------------->
                            @include('app.admin.components.card-header', [
                                'cardHeader' => $product->name,
                            ])
                            <!--------------------------- END Card Header -------------------------->

                            <!-------------------- Alerts -------------------->
                            @include('layouts.includes.alerts.success')
                            @include('layouts.includes.alerts.errors')
                            <!-------------------- END Alerts -------------------->

                            <!-------------------- Card Content -------------------->
                            <div class="card-content collapse show overflow-auto">
                                <div class="card-body card-dashboard ">
                                    <!-------------------- row 1 -------------------->

                                    <!--------------------END row 1 -------------------->

                                    <!-------------------- row 2 -------------------->
                                    <div class="row justify-content-center">
                                        <div class=""></div>
                                        <!-------------------- profile -------------------->
                                        <div class="span4 col-2">
                                            <img class="position-relative rounded-circle img-border img-thumbnail" style="
                                                                                    bottom: 50px;  min-width: 5rem;"
                                                src="{{ $product->getImage() }}" alt="{{ $product->name }} profile">
                                        </div>
                                        <div class=""></div>
                                    </div>

                                    <!--------------------END row 2 -------------------->

                                    <!-------------------- row 3 -------------------->
                                    <div class="row">
                                        <!-------------------- 3-1 -------------------->
                                        <div class="col-md-6">
                                            <label for="name">name</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>{{ $product->name }}
                                                    &nbsp</p>
                                            </div>
                                        </div>

                                        <!-------------------- 3-2 -------------------->
                                        <div class="col-md-6">
                                            <label for="slug">Slug</label>
                                            <div class="text-center">
                                                <p class='Hover:bg-primary bg-accent-1 bg-accent-1 bg-primary form-control'>
                                                    <a href="{{ $product->slug }}">{{ $product->slug }}</a> &nbsp
                                                </p>
                                            </div>
                                        </div>


                                    </div>
                                    <!--------------------END row 3 -------------------->


                                    <!-------------------- row 4 -------------------->
                                    <div class="row">
                                        <!-------------------- 4-1 -------------------->
                                        <div class="col-md-4">
                                            <!-------------------- mainCategory -------------------->
                                            <label for="category">category</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    @if (!$product->category == null)
                                                        <a
                                                            href="{{ route('admin.categories.show', $product->category->id) }}">{{ $product->category->name }}</a>
                                                    @endif
                                                    &nbsp
                                                </p>
                                            </div>
                                        </div>
                                        <!-------------------- 4-2 -------------------->
                                        <div class="col-md-4">
                                            <!-------------------- mainCategory -------------------->
                                            <label for="vendor">vendor</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    @if (!$product->vendor == null)
                                                        <a
                                                            href="{{ route('admin.vendors.show', $product->vendor->id) }}">{{ $product->vendor->name }}</a>
                                                    @endif
                                                    &nbsp
                                                </p>
                                            </div>
                                        </div>
                                        <!-------------------- 4-3 -------------------->
                                        <div class="col-md-4">
                                            <!-------------------- mainCategory -------------------->
                                            <label for="parent">parent product</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    @if (!$parentProduct == null)
                                                        <a
                                                            href="{{ route('admin.products.show', $parentProduct->id) }}">{{ $parentProduct->name }}</a>
                                                    @endif
                                                    &nbsp
                                                </p>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <!-------------------- Sub Category -------------------->
                                            <label for="categories">Sub categories</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    @if (!$vendor->categories == null)
                                                        @foreach ($vendor->getCategories() as $subCategory)
                                                            <a class="block"
                                                                href="{{ route('admin.categories.show', $subCategory->id) }}">{{ $subCategory->name }}</a>
                                                        @endforeach
                                                    @else
                                                        &nbsp
                                                    @endif

                                                </p>
                                            </div>
                                        </div> --}}

                                    </div>
                                    <!--------------------END row 4 -------------------->

                                    <!-------------------- row 5 -------------------->
                                    <div class="row">
                                        <!-------------------- 5-1 -------------------->
                                        <div class="col-md-6">
                                            <!-------------------- main User -------------------->
                                            <label for="tag">Main tag</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    @if (!$product->tag == null)
                                                        {{ $product->tag }}
                                                    @endif
                                                    &nbsp
                                                </p>
                                            </div>
                                        </div>
                                        <!-------------------- 5-2 -------------------->
                                        <div class="col-md-6">
                                            <!-------------------- Staff-------------------->
                                            <label for="tags">tags</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    @if (!$product->tags == null)
                                                        @foreach ($product->tags as $tags)
                                                            {{ $tag }}
                                                        @endforeach
                                                    @else
                                                        &nbsp
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                    <!--------------------END row 5 -------------------->

                                    <!--------------------row 6 -------------------->
                                    <div class="row">
                                        <!-------------------- 6-1 -------------------->
                                        <div class="col-md-4">
                                            <label for="description">description</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    {{ $product->description }} &nbsp</p>
                                            </div>
                                        </div>
                                        <!-------------------- 6-2 -------------------->
                                        <div class="col-md-4">
                                            <label for="status">info</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    {{ $product->info }} &nbsp</p>
                                            </div>
                                        </div>
                                        <!-------------------- 6-3 -------------------->
                                        <div class="col-md-4">
                                            <label for="details">details</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    {{ $product->details }} &nbsp</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--------------------END row 6 -------------------->

                                    <!-------------------- row 5 -------------------->
                                    <div class="row">
                                        <!-------------------- 5-1 -------------------->
                                        <div class="col-md-6">
                                            <!-------------------- main User -------------------->
                                            <label for="featured">featured</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    @if (!$product->featured == null)
                                                        {{ $product->featured }}
                                                    @endif
                                                    &nbsp
                                                </p>
                                            </div>
                                        </div>
                                        <!-------------------- 5-2 -------------------->
                                        <div class="col-md-6">
                                            <!-------------------- Staff-------------------->
                                            <label for="base_price">base price</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    @if (!$product->base_price == null)
                                                        {{ $product->base_price }}
                                                    @else
                                                        &nbsp
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <!-------------------- 5-2 -------------------->
                                        <div class="col-md-6">
                                            <!-------------------- Staff-------------------->
                                            <label for="base_tax">base tax</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    @if (!$product->base_tax == null)
                                                        {{ $product->base_tax }}
                                                    @else
                                                        &nbsp
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                    <!--------------------END row 5 -------------------->

                                    <!--------------------row 7 -------------------->
                                    <div class="row">
                                        <!-------------------- 7-1 -------------------->
                                        <div class="col-md-6">
                                            <label for="active">Actice</label>
                                            <div class="text-center">
                                                <p class='form-control @if ($product->active) bg-success bg-accent-2
                                                @else
                                                bg-red bg-accent-2 @endif  bg-primary bg-accent-1 alert-green'
                                                    id='slug'>
                                                    @if ($product->active)
                                                        Yes
                                                    @else
                                                        No
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <!-------------------- 7-1 -------------------->
                                        <div class="col-md-6">
                                            <label for="in_stock">in stock?</label>
                                            <div class="text-center">
                                                <p class='form-control @if ($product->in_stock) bg-success bg-accent-2
                                                                                        @else
                                                                                        bg-red bg-accent-2 @endif  bg-primary bg-accent-1 alert-green'
                                                    id='slug'>
                                                    @if ($product->in_stock)
                                                        Yes
                                                    @else
                                                        No
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <!-------------------- 7-2 -------------------->
                                        <div class="col-md-6">
                                            <label for="quantity">quantity</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    {{ $product->quantity }} &nbsp</p>
                                            </div>
                                        </div>

                                        <!-------------------- 7-2 -------------------->
                                        <div class="col-md-6">
                                            <label for="discount">discount</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    DISCOUNT &nbsp</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--------------------END row 7 -------------------->

                                    <!--------------------------- Actions -------------------------->
                                    <form>
                                        <div class=" form-actions right">
                                            <a href="{{ route('admin.products.edit', $product->id) }}"><button
                                                    type="button" class="btn btn-info mr-1 left">
                                                    <i class="la la-info"></i> Edit
                                                </button></a>
                                            <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                <i class="ft-x"></i> go back
                                            </button>
                                        </div>
                                    </form>
                                    <!--------------------------- END Actions -------------------------->

                                </div>
                            </div>
                            <!-------------------- END Card Content -------------------->
                        </div>
                        <!--------------------------- END Card -------------------------->
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
