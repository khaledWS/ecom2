@extends('layouts.admin.admin')

@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        {{-- HEADER AND BREADCRUMBS --}}
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.categories')}}"> main Categories </a>
                            </li>
                            <li class="breadcrumb-item active">add a new Main Category
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        {{-- START OF CARD --}}
                        <div class="card">

                            {{-- CARD HEADER --}}
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form"> add a category </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            {{-- ALERTS --}}
                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')


                            <div class="card-content collapse show">
                                <div class="card-body">
                                    {{-- START OF FORM --}}
                                    <form class="form" action="{{route('admin.categories.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i> Main Category Info </h4>
                                            @foreach ($languages as $index => $language)
                                            @if ($index == 0)
                                            <div>
                                                {{-- ROW ONE --}}
                                                <div class="row">
                                                    {{-- FIELD ONE --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="mc_name"> main Category Name </label>
                                                            <input type="text" value="" id="name" class="form-control" name="category[{{$index}}][mc_name]" placeholder="name of the category">
                                                            @error('category[{{$index}}][mc_name]')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{-- FIELD TWO --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="mc_language"> Language </label>
                                                            <select onselect="dode" class="form-control" name="category[{{$index}}][mc_language]" id="">
                                                                @foreach ($languages as $languaged)
                                                                @if ($languaged->mc_name == $language->mc_name)
                                                                <option selected class="text-muted" value="{{$languaged->id}}">
                                                                    {{$languaged->lang_name}}
                                                                </option>

                                                                @if (!$languaged->lang_active)
                                                                <option class="text-muted" value="{{$languaged->id}}">
                                                                    {{$languaged->lang_name}} - Disabled
                                                                </option>
                                                                @else
                                                                <option class="text-primary" value="{{$language->id}}">
                                                                    {{$languaged->lang_name}}
                                                                </option>
                                                                @endif
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                            {{-- <input type="text" value="" id="abbr"
                                                                class="form-control" name="category[0] [mc_language]"
                                                                placeholder="Language of the Category"> --}}
                                                            @error('mc_language')
                                                            <span class="text-danger">{{$message}} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- FIELD TWO --}}


                                                    {{-- END OF ROW ONE --}}
                                                </div>
                                                {{-- ROW TWO --}}
                                                <div class="row">
                                                    {{-- FIELD 3 --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="mc_Description"> Description </label>
                                                            <textarea cols="30" rows="3" type="text" value="" id="native" class="form-control " placeholder="description of the category  " name="category[{{$index}}][mc_Description] "></textarea>
                                                            @error('mc_Description')
                                                            <span class="text-danger">{{$message}} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- FIELD 4 --}}
                                                    <div class="col-md-6 mt-4">
                                                        <div class="form-group">
                                                            <label> صوره القسم </label>
                                                            <label id="projectinput7" class="file center-block">
                                                                <input type="file" id="file" name="category[{{$index}}][mc_photo]">
                                                                <span class="file-custom"></span>
                                                            </label>
                                                            @error("category.$index.mc_photo")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- END OF ROW TWO --}}
                                                </div>

                                                {{-- ROW THREE --}}
                                                <div class="row">
                                                    {{-- Field 5 --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1" name="category[{{$index}}][mc_active]" id="switcheryColor4" class="switchery" data-color="success" checked />
                                                            <label for="mc_active" class="card-title ml-1">الحالة
                                                            </label>

                                                            @error('mc_active')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- end of row three --}}
                                                </div>
                                            </div>

                                            @elseif ($index == 1)
                                            <div>
                                                {{-- ROW ONE --}}
                                                <div class="row">
                                                    {{-- FIELD ONE --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="mc_name"> main Category Name </label>
                                                            <input type="text" value="" id="name" class="form-control" name="category[{{$index}}][mc_name]" placeholder="name of the category">
                                                            @error('mc_name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{-- FIELD TWO --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="mc_language"> Language </label>
                                                            <select onselect="dode" class="form-control" name="category[{{$index}}][mc_language]" id="">
                                                                @foreach ($languages as $languaged)
                                                                @if ($languaged->mc_name == $language->mc_name)
                                                                <option selected class="text-muted" value="{{$languaged->id}}">
                                                                    {{$languaged->lang_name}}
                                                                </option>

                                                                @if (!$languaged->lang_active)
                                                                <option class="text-muted" value="{{$languaged->id}}">
                                                                    {{$languaged->lang_name}} - Disabled
                                                                </option>
                                                                @else
                                                                <option class="text-primary" value="{{$language->id}}">
                                                                    {{$languaged->lang_name}}
                                                                </option>
                                                                @endif
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                            {{-- <input type="text" value="" id="abbr"
                                                                class="form-control" name="category[0] [mc_language]"
                                                                placeholder="Language of the Category"> --}}
                                                            @error('mc_language')
                                                            <span class="text-danger">{{$message}} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- FIELD TWO --}}


                                                    {{-- END OF ROW ONE --}}
                                                </div>
                                                {{-- ROW TWO --}}
                                                <div class="row">
                                                    {{-- FIELD 3 --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="mc_Description"> Description </label>
                                                            <textarea cols="30" rows="3" type="text" value="" id="native" class="form-control " placeholder="description of the category  " name="category[{{$index}}][mc_Description] "></textarea>
                                                            @error('mc_Description')
                                                            <span class="text-danger">{{$message}} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- FIELD 4 --}}
                                                    <div class="col-md-6 mt-4">
                                                        <div class="form-group">
                                                            <label> صوره القسم </label>
                                                            <label id="projectinput7" class="file center-block">
                                                                <input type="file" id="file" name="category[{{$index}}][mc_photo]">
                                                                <span class="file-custom"></span>
                                                            </label>
                                                            @error('mc_photo')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- END OF ROW TWO --}}
                                                </div>

                                                {{-- ROW THREE --}}
                                                <div class="row">
                                                    {{-- Field 5 --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1" name="category[{{$index}}][mc_active]" id="switcheryColor4" class="switchery" data-color="success" checked />
                                                            <label for="mc_active" class="card-title ml-1">الحالة
                                                            </label>

                                                            @error('mc_active')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- end of row three --}}
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach


                                            <div class="col">
                                                <div class="rtl">Note: ID is assigned Automatically</div>
                                                <div class="rtl">Note: Slug is assigned Automatically</div>
                                            </div>

                                        </div>

                                        {{-- form actions --}}
                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                <i class="ft-x"></i> تراجع
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> حفظ
                                            </button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>



@endsection
<section id="form-repeater">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- <div class="card-header">
                    <h4 class="card-title" id="repeat-form">Repeating Forms</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div> -->

                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="repeater-default">
                            <div data-repeater-list="car">
                                <form class="form">
                                    <div data-repeater-item>
                                        <div class="row">
                                            {{-- ITEM 1 --}}
                                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                                <label for="email-addr">Email address</label>
                                                <br>
                                                <input type="email" class="form-control" id="email-addr" placeholder="Enter email">
                                            </div>
                                            {{-- item 2 --}}
                                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                                <label for="pass">Password</label>
                                                <br>
                                                <input type="password" class="form-control" id="pass" placeholder="Password">
                                            </div>
                                            {{-- item 3 --}}
                                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                                <label for="bio" class="cursor-pointer">Bio</label>
                                                <br>
                                                <textarea class="form-control" id="bio" rows="2"></textarea>
                                            </div>
                                            {{-- ITEM 4 --}}
                                            <div class="skin skin-flat form-group mb-1 col-sm-12 col-md-2">
                                                <label for="tel-input">Gender</label>
                                                <br>
                                                <input class="form-control" type="tel" value="1-(555)-555-5555" id="tel-input">
                                            </div>
                                            {{-- item 5 --}}
                                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                                <label for="profession">Profession</label>
                                                <br>
                                                <select class="form-control" id="profession">
                                                    <option>Select Option</option>
                                                    <option>Option 1</option>
                                                    <option>Option 2</option>
                                                    <option>Option 3</option>
                                                    <option>Option 4</option>
                                                    <option>Option 5</option>
                                                </select>
                                            </div>
                                            {{-- DELETE --}}
                                            <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                                <button type="button" class="btn btn-danger" data-repeater-delete> <i class="ft-x"></i>
                                                    Delete</button>
                                            </div>
                                            <hr>
                                            {{-- END OF ROW --}}
                                        </div>
                                        {{-- END OF THE REPEATED ITEM --}}
                                    </div>
                                    {{-- END OF FORM --}}
                                </form>


                            </div>

                            <div class="form-group overflow-hidden">
                                <div class="col-12">
                                    <button data-repeater-create class="btn btn-primary">
                                        <i class="ft-plus"></i> Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>



{{-- <div class="tab-content px-1 pt-1">
                                            @isset($mainCategories->otherLanguages)
                                                @foreach ($mainCategories as $key => $mainCategory)
                                                    @if ($key == 0)
                                                        <div role="tabpanel" class="tab-pane active"
                                                            id="tab{{ $key }}" aria-expanded="true"
                                                            aria-labelledby="base-tab{{ $key }}">
                                                            <div class="card">
                                                                <!-- Card Header -->
                                                                <div class="card-header">
                                                                    <h4 class="card-title primary.lighten-1"
                                                                        id="basic-layout-form"> تعديل القسم </h4>
                                                                    <a class="heading-elements-toggle"><i
                                                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                                                    <div class="heading-elements">
                                                                        <ul class="list-inline mb-0">
                                                                            <li><a data-action="collapse"><i
                                                                                        class="ft-minus"></i></a></li>
                                                                            <li><a data-action="reload"><i
                                                                                        class="ft-rotate-cw"></i></a></li>
                                                                            <li><a data-action="expand"><i
                                                                                        class="ft-maximize"></i></a></li>
                                                                            {{-- <li><a data-action="close"><i class="ft-x"></i></a></li> --}}
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <!-- Alerts -->
                                                                @include('admin.includes.alerts.success')
                                                                @include('admin.includes.alerts.errors')

                                                                <div class="card-content collapse show">
                                                                    <div class="card-body">
                                                                        <form class="form"
                                                                            action="{{ route('admin.categories.update', 1) }}"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="form-body">
                                                                                <h5 class="form-section"><i
                                                                                        class="ft-home"></i> بيانات
                                                                                    القسم </h5>

                                                                                <input type="hidden" name="id"
                                                                                    value="">

                                                                                {{-- First Row --}}
                                                                                <div class="row">
                                                                                    {{-- First Col --}}
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="mc_name"> اسم القسم
                                                                                            </label>
                                                                                            <input type="text" id="name"
                                                                                                class="form-control"
                                                                                                value="{{ $mainCategory->mc_name }}"
                                                                                                placeholder="ادخل اسم القسم"
                                                                                                name="category[0][mc_name]">
                                                                                            @error('category.0.mc_name')
                                                                                                <span
                                                                                                    class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                    {{-- 2nd Col --}}
                                                                                    {{-- <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label for="projectinput1"> وصف القسم </label>
                                                                                                <input type="text" value="{{ $language->lang_abbr }}" id="name"
                                                                                                    class="form-control" placeholder="ادخل أختصار اللغة  "
                                                                                                    name="lang_abbr">
                                                                                                @error('lang_abbr')
                                                                                                    <span class="text-danger">{{ $message }} </span>
                                                                                                @enderror
                                                                                            </div>
                                                                                        </div> --}}
                                                                                </div>

                                                                                {{-- 2ND rOW --}}
                                                                                <div class="row">
                                                                                    {{-- 2-1 --}}
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="mc_description">الوصف</label>
                                                                                            <textarea
                                                                                                class=" form-control-sm. form-control"
                                                                                                name="category[0][mc_Description]"
                                                                                                id="mc_description" cols="10"
                                                                                                rows="5">{{ $mainCategory->mc_Description }}</textarea>
                                                                                            @error('category.0.mc_Description')
                                                                                                <span
                                                                                                    class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>

                                                                                    {{-- 2-2 --}}
                                                                                    <div class="col-md-12">

                                                                                        <div class="form-group">
                                                                                            <label for="mc_photo">صوره
                                                                                                القسم*</label>
                                                                                            <input class="form-control-file"
                                                                                                type="file" id="file"
                                                                                                name="category[0][mc_photo]">
                                                                                            <span class="file-custom"></span>
                                                                                            @error('category.0.mc_photo')
                                                                                                <span
                                                                                                    class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <img src="{{ $mainCategory->getPhoto() }}"
                                                                                            alt="category-photo"
                                                                                            class="img-fluid rounded-circle width-150 height-150">
                                                                                    </div>

                                                                                </div>

                                                                                {{-- 3RD ROW --}}
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group mt-1">
                                                                                            <input type="checkbox"
                                                                                                value="{{ $mainCategory->mc_active }}"
                                                                                                name="category[0][mc_active]"
                                                                                                id="switcheryColor4"
                                                                                                class="switchery"
                                                                                                data-color="success"
                                                                                                @if ($mainCategory->mc_active == 1) checked @endif />
                                                                                            <label for="switcheryColor4"
                                                                                                class="ml-1">الحالة
                                                                                            </label>
                                                                                            @error('category.0.mc_active')
                                                                                                <span
                                                                                                    class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            {{-- FORM ACTIONS --}}
                                                                            <div class="form-actions">
                                                                                <button type="button"
                                                                                    class="btn btn-warning mr-1"
                                                                                    onclick="history.back();">
                                                                                    <i class="ft-x"></i> تراجع
                                                                                </button>
                                                                                <button type="submit" class="btn btn-primary">
                                                                                    <i class="la la-check-square-o"></i>
                                                                                    تحديث
                                                                                </button>
                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="tab-pane" id="tab{{ $key }}"
                                                            aria-labelledby="base-tab{{ $key }}">
                                                            <div class="card">
                                                                <!-- Card Header -->
                                                                <div class="card-header">
                                                                    <h4 class="card-title primary.lighten-1"
                                                                        id="basic-layout-form"> تعديل القسم </h4>
                                                                    <a class="heading-elements-toggle"><i
                                                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                                                    <div class="heading-elements">
                                                                        <ul class="list-inline mb-0">
                                                                            <li><a data-action="collapse"><i
                                                                                        class="ft-minus"></i></a>
                                                                            </li>
                                                                            <li><a data-action="reload"><i
                                                                                        class="ft-rotate-cw"></i></a>
                                                                            </li>
                                                                            <li><a data-action="expand"><i
                                                                                        class="ft-maximize"></i></a>
                                                                            </li>
                                                                            {{-- <li><a data-action="close"><i class="ft-x"></i></a></li> --}}
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <!-- Alerts -->
                                                                @include('admin.includes.alerts.success')
                                                                @include('admin.includes.alerts.errors')

                                                                <div class="card-content collapse show">
                                                                    <div class="card-body">
                                                                        <form class="form"
                                                                            action="{{ route('admin.categories.update', 1) }}"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="form-body">
                                                                                <h5 class="form-section"><i
                                                                                        class="ft-home"></i> بيانات
                                                                                    القسم </h5>

                                                                                <input type="hidden" name="id"
                                                                                    value="">

                                                                                {{-- First Row --}}
                                                                                <div class="row">
                                                                                    {{-- First Col --}}
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="mc_name"> اسم القسم
                                                                                            </label>
                                                                                            <input type="text" id="name"
                                                                                                class="form-control"
                                                                                                value="{{ $mainCategory->mc_name }}"
                                                                                                placeholder="ادخل اسم القسم"
                                                                                                name="category[0][mc_name]">
                                                                                            @error('category.0.mc_name')
                                                                                                <span
                                                                                                    class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                    {{-- 2nd Col --}}
                                                                                    {{-- <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <label for="projectinput1"> وصف القسم </label>
                                                                                                <input type="text" value="{{ $language->lang_abbr }}" id="name"
                                                                                                    class="form-control" placeholder="ادخل أختصار اللغة  "
                                                                                                    name="lang_abbr">
                                                                                                @error('lang_abbr')
                                                                                                    <span class="text-danger">{{ $message }} </span>
                                                                                                @enderror
                                                                                            </div>
                                                                                        </div> --}}
                                                                                </div>

                                                                                {{-- 2ND rOW --}}
                                                                                <div class="row">
                                                                                    {{-- 2-1 --}}
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="mc_description">الوصف</label>
                                                                                            <textarea
                                                                                                class=" form-control-sm. form-control"
                                                                                                name="category[0][mc_Description]"
                                                                                                id="mc_description" cols="10"
                                                                                                rows="5">{{ $mainCategory->mc_Description }}</textarea>
                                                                                            @error('category.0.mc_Description')
                                                                                                <span
                                                                                                    class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>

                                                                                    {{-- 2-2 --}}
                                                                                    <div class="col-md-12">

                                                                                        <div class="form-group">
                                                                                            <label for="mc_photo">صوره
                                                                                                القسم*</label>
                                                                                            <input class="form-control-file"
                                                                                                type="file" id="file"
                                                                                                name="category[0][mc_photo]">
                                                                                            <span
                                                                                                class="file-custom"></span>
                                                                                            @error('category.0.mc_photo')
                                                                                                <span
                                                                                                    class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <img src="{{ $mainCategory->getPhoto() }}"
                                                                                            alt="category-photo"
                                                                                            class="img-fluid rounded-circle width-150 height-150">
                                                                                    </div>

                                                                                </div>

                                                                                {{-- 3RD ROW --}}
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group mt-1">
                                                                                            <input type="checkbox"
                                                                                                value="{{ $mainCategory->mc_active }}"
                                                                                                name="category[0][mc_active]"
                                                                                                id="switcheryColor4"
                                                                                                class="switchery"
                                                                                                data-color="success"
                                                                                                @if ($mainCategory->mc_active == 1) checked @endif />
                                                                                            <label for="switcheryColor4"
                                                                                                class="ml-1">الحالة
                                                                                            </label>
                                                                                            @error('category.0.mc_active')
                                                                                                <span
                                                                                                    class="text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            {{-- FORM ACTIONS --}}
                                                                            <div class="form-actions">
                                                                                <button type="button"
                                                                                    class="btn btn-warning mr-1"
                                                                                    onclick="history.back();">
                                                                                    <i class="ft-x"></i> تراجع
                                                                                </button>
                                                                                <button type="submit" class="btn btn-primary">
                                                                                    <i class="la la-check-square-o"></i>
                                                                                    تحديث
                                                                                </button>
                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endisset

                                        </div>
