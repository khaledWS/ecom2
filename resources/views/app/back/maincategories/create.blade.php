@extends('layouts.admin.admin')

@section('content')


    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.categories') }}"> الاقسام الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item active">إضافة قسم رئيسي
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
                        <div class="card">
                            <div class="card-header">
                                <h2 class="" id="basic-layout-form"> إضافة قسم رئيسي </h2>
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
                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" action="{{ route('admin.categories.store') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        {{-- <div class="form-group">
                                                <label> صوره القسم </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="mc_photo">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('mc_photo')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> --}}

                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>

                                            @if ($languages->count() > 0)
                                                @foreach ($languages as $index => $lang)
                                                    <div>
                                                        <h2>اللغة: {{ $lang->lang_name . '(' . $lang->lang_abbr . ')' }}
                                                        </h2>

                                                    </div>
                                                    {{-- First Row --}}
                                                    <div class="row">
                                                        {{-- First Field --}}
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="card-title" for="projectinput1">اسم
                                                                    القسم*</label>
                                                                <input type="text"
                                                                    value='{{ old("category[$index][mc_name]") }}'
                                                                    id="name" class="form-control"
                                                                    placeholder="ادخل اسم القسم"
                                                                    name="category[{{ $index }}][mc_name]">
                                                                @error("category.$index.mc_name")
                                                                    <span class="text-danger"> {{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        {{-- 2nd Field --}}
                                                        <div class="col-md-6 hidden">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> أختصار اللغة
                                                                    {{ __('messages.' . $lang->lang_abbr) }} </label>
                                                                <input type="text" id="abbr" class="form-control"
                                                                    placeholder="  " value="{{ $lang->lang_abbr }}"
                                                                    name="category[{{ $index }}][mc_language]">

                                                                @error("category.$index.mc_language")
                                                                    <span class="text-danger">{{ $messeage }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                    </div>
                                                    {{-- 2nd row --}}
                                                    <div class="row">
                                                        {{-- 3rd Field --}}
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="card-title"
                                                                    for="description">الوصف</label>
                                                                <textarea class=" form-control-sm. form-control"
                                                                    name="category[{{ $index }}][mc_description]"
                                                                    id="mc_description" cols="10" rows="5"></textarea>
                                                                @error("category.$index.mc_description")
                                                                    <span class="text-danger">
                                                                        {{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        {{-- 4th Field --}}
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="card-title"> صوره القسم*</label>
                                                                <input class="form-control-file" type="file" id="file"
                                                                    name="category[{{ $index }}][mc_photo]">
                                                                <span class="file-custom"></span>
                                                                @error("category.$index.mc_photo")
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>



                                                    {{-- 3rd Row --}}
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mt-1">
                                                                <label for="switcheryColor4"
                                                                    class="card-title mr-1">الحالة</label>
                                                                <input type="checkbox" value="1"
                                                                    name="category[{{ $index }}][mc_active]"
                                                                    id="switcheryColor4" class="switchery"
                                                                    data-color="success" checked />
                                                                @error("category.$index.mc_active")
                                                                    <span class="text-danger"> {{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border-top mb-3"></div>
                                                @endforeach
                                            @endif
                                        </div>


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
        </div>
    </div>
    <!-- // Basic form layout section end -->
@endsection
