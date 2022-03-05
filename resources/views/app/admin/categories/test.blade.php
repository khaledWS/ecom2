@extends('layouts.admin.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">


            <section id="form-repeater">
                <div class="row">
                    <div class="col-12">
                        <div class="card">


                            <div class="card-header">
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
                            </div>

                            <div class="card-content collapse show">
                                <div class="card-body">

                                    <form class="form" action="{{ route('admin.categories.store') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="repeater-default">

                                            <div data-repeater-list="category">
                                                <div data-repeater-item>
                                                    <div class="form-body">

                                                        <h4 class="form-section"><i class="ft-home"></i> بيانات
                                                            القسم
                                                        </h4>
                                                        {{-- First Row --}}
                                                        <div class="row">
                                                            {{-- First Field --}}
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="card-title" for="projectinput1">اسم
                                                                        القسم*</label>
                                                                    <input type="text" value='' id="name"
                                                                        class="form-control" placeholder="ادخل اسم القسم"
                                                                        name="mc_name">
                                                                    @error('category.$index.mc_name')
                                                                        <span class="text-danger"> </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            {{-- 2nd Field --}}
                                                            <div class="col-md-6 ">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> أختصار اللغة
                                                                    </label>
                                                                    <input type="text" id="abbr" class="form-control"
                                                                        placeholder="  " value=""
                                                                        name="category[][mc_language]">

                                                                    @error('category.mc_language')
                                                                        <span class="text-danger"></span>
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
                                                                        name="category[][mc_description]"
                                                                        id="mc_description" cols="10" rows="5"></textarea>
                                                                    @error('category.mc_description')
                                                                        <span class="text-danger">
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            {{-- 4th Field --}}
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="card-title"> صوره القسم*</label>
                                                                    <input class="form-control-file" type="file" id="file"
                                                                        name="category[][mc_photo]">
                                                                    <span class="file-custom"></span>
                                                                    @error('category..mc_photo')
                                                                        <span class="text-danger"></span>
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
                                                                        name="mc_active"
                                                                        class="switchery" data-color="success"
                                                                        checked />
                                                                        <input type="checkbox" value="1"
                                                                        name="mc_active"
                                                                        class="switchery" data-color="success"
                                                                        checked />
                                                                    @error('category.mc_active')
                                                                        <span class="text-danger"> </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                {{-- add extra buton --}}

                                            </div>

                                            {{-- add button --}}
                                            <div class="form-group overflow-hidden">
                                                <div class="col-12">
                                                    <button type="button" data-repeater-create class="btn btn-primary">
                                                        <i class="ft-plus"></i> Add secondary +
                                                    </button>
                                                </div>
                                            </div>

                                        </div>

                                        {{-- FORM ACTION  SUBMIT ECT --}}
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
            </section>





        </div>
    </div>
@endsection


{{-- <input type="checkbox" value="1" name="category[0][mc_active][]" class="switchery" data-color="success" style="display: none;" data-switchery="true">


<span class="switchery switchery-default" style="background-color: rgb(55, 188, 155); border-color: rgb(55, 188, 155); box-shadow: rgb(55, 188, 155) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small style="left: 20px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s; background-color: rgb(255, 255, 255);"></small></span>



<input type="checkbox" value="1" name="category[1][mc_active][]" class="switchery" data-color="success" style="display: none;" data-switchery="true">
<span class="switchery switchery-default" style="background-color: rgb(55, 188, 155); border-color: rgb(55, 188, 155); box-shadow: rgb(55, 188, 155) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small style="left: 20px;             background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>



<div class="form-group mt-1">
    <label for="switcheryColor4" class="card-title mr-1">الحالة</label>
    <input type="checkbox" value="1" name="category[0][mc_active][]" class="switchery" data-color="success" style="display: none;" data-switchery="true"><span class="switchery switchery-default" style="background-color: rgb(55, 188, 155); border-color: rgb(55, 188, 155); box-shadow: rgb(55, 188, 155) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small style="left: 20px; background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>
                                                                    </div>

 --}}
