@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!--------------------------- Navigagion breadcrumps header -------------------------->
        @include('app.admin.components.breadcrumps-header', [
            'section' => 'Vendors',
            'current' => $vendor->name,
            'sectionRoute' => 'admin.vendors',
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
                                'cardHeader' => $vendor->name,
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
                                    <div class="row justify-content-center">
                                        <div class=""></div>
                                        <!-------------------- banner -------------------->
                                        <div class="span4 col-2">
                                            <img class="rounded-circle img-border height-100 img-thumbnail"
                                                src="{{ $vendor->getBanner() }}" alt="{{ $vendor->name }} banner">
                                        </div>
                                        <div class=""></div>
                                    </div>
                                    <!--------------------END row 1 -------------------->

                                    <!-------------------- row 2 -------------------->
                                    <div class="row justify-content-center">
                                        <div class=""></div>
                                        <!-------------------- profile -------------------->
                                        <div class="span4 col-2">
                                            <img class="rounded-circle img-border height-100 img-thumbnail"
                                                src="{{ $vendor->getProfile() }}" alt="{{ $vendor->name }} profile">
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
                                                <p class='form-control  bg-primary bg-accent-1'>{{ $vendor->name }}
                                                    &nbsp</p>
                                            </div>
                                        </div>

                                        <!-------------------- 3-2 -------------------->
                                        <div class="col-md-6">
                                            <label for="slug">Slug</label>
                                            <div class="text-center">
                                                <p class='Hover:bg-primary bg-accent-1 bg-accent-1 bg-primary form-control'>
                                                    <a href="{{ $vendor->slug }}">{{ $vendor->slug }}</a> &nbsp
                                                </p>
                                            </div>
                                        </div>


                                    </div>
                                    <!--------------------END row 3 -------------------->


                                    <!-------------------- row 4 -------------------->
                                    <div class="row">
                                        <!-------------------- 4-1 -------------------->
                                        <div class="col-md-6">
                                            <!-------------------- mainCategory -------------------->
                                            <label for="category">category</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    @if (!$vendor->category == null)
                                                        <a href="{{route('admin.categories.show',$vendor->category->id)}}">{{ $vendor->category->name }}</a>
                                                    @endif
                                                    &nbsp
                                                </p>
                                            </div>
                                        </div>
                                        <!-------------------- 4-2 -------------------->
                                        <div class="col-md-6">
                                            <!-------------------- Sub Category -------------------->
                                            <label for="categories">Sub categories</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    @if (!$vendor->categories == null)
                                                        @foreach ($vendor->getCategories() as $subCategory)
                                                            <a class="block" href="{{route('admin.categories.show',$subCategory->id)}}">{{ $subCategory->name }}</a>
                                                        @endforeach
                                                    @else
                                                    &nbsp
                                                    @endif

                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                    <!--------------------END row 4 -------------------->

                                    <!-------------------- row 5 -------------------->
                                    <div class="row">
                                        <!-------------------- 5-1 -------------------->
                                        <div class="col-md-6">
                                            <!-------------------- main User -------------------->
                                            <label for="category">Main User</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    @if (!$vendor->user == null)
                                                        <a href="">{{ $vendor->user->name}}</a>
                                                    @endif
                                                    &nbsp
                                                </p>
                                            </div>
                                        </div>
                                        <!-------------------- 5-2 -------------------->
                                        <div class="col-md-6">
                                            <!-------------------- Staff-------------------->
                                            <label for="categories">Staff</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    @if (!$vendor->staff == null)
                                                        @foreach ($vendor->getStaff() as $user)
                                                            <a class="block" href="">{{ $user->name }}</a>
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
                                        <div class="col-md-6">
                                            <label for="description">description</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    {{ $vendor->description }} &nbsp</p>
                                            </div>
                                        </div>
                                        <!-------------------- 6-2 -------------------->
                                        <div class="col-md-6">
                                            <label for="status">status</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    {{ $vendor->status }} &nbsp</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--------------------END row 6 -------------------->

                                    <!--------------------row 7 -------------------->
                                    <div class="row">
                                        <!-------------------- 7-1 -------------------->
                                        <div class="col-md-6">
                                            <label for="active">Actice</label>
                                            <div class="text-center">
                                                <p class='form-control @if ($vendor->active) bg-success bg-accent-2
                                                @else
                                                bg-red bg-accent-2 @endif  bg-primary bg-accent-1 alert-green'
                                                    id='slug'>
                                                    @if ($vendor->active)
                                                        Yes
                                                    @else
                                                        No
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <!-------------------- 7-2 -------------------->
                                        <div class="col-md-6">
                                            <label for="featured">featured</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    {{ $vendor->featured }} &nbsp</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--------------------END row 7 -------------------->

                                    <!--------------------------- Actions -------------------------->
                                    <form>
                                        <div class=" form-actions right">
                                            <a href="{{route('admin.vendors.edit',$vendor->id)}}"><button
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
