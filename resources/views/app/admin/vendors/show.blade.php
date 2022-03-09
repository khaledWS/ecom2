@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!--------------------------- Navigagion breadcrumps header -------------------------->
        @include('app.admin.components.breadcrumps-header', [
            'section' => 'Categories',
            'current' => $category->name,
            'sectionRoute' => 'admin.categories',
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
                                'cardHeader' => $category->name,
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
                                        <!-------------------- iMAGE -------------------->
                                        <div class="span4 col-2">
                                            <img class="rounded-circle img-border height-100 img-thumbnail"
                                                src="{{ $category->getImage() }}" alt="{{ $category->name }} image">
                                        </div>
                                        <div class=""></div>
                                    </div>
                                    <!--------------------END row 1 -------------------->

                                    <!-------------------- row 2 -------------------->
                                    <div class="row">
                                        <!-------------------- 2-1 -------------------->
                                        <div class="col-md-6">
                                            <label for="name">name</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>{{ $category->name }}
                                                    &nbsp</p>
                                            </div>
                                        </div>

                                        <!-------------------- 2-2 -------------------->
                                        <div class="col-md-6">
                                            <label for="slug">Slug</label>
                                            <div class="text-center">
                                                <p class='Hover:bg-primary bg-accent-1 bg-accent-1 bg-primary form-control'>
                                                    <a href="{{ $category->slug }}">{{ $category->slug }}</a> &nbsp
                                                </p>
                                            </div>
                                        </div>


                                    </div>
                                    <!--------------------END row 2 -------------------->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="description">description</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    {{ $category->description }} &nbsp</p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="parent">parent</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>
                                                    @if (!$category->parent_category_id == null)
                                                        <a
                                                            href="{{ route('admin.categories.show', $category->parent_category_id) }}">{{ $parent }}</a>
                                                    @endif
                                                    &nbsp
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <label for="info">info</label>
                                            <div class="text-center">
                                                <p class='form-control  bg-primary bg-accent-1'>{{ $category->info }}
                                                    &nbsp</p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="active">Actice</label>
                                            <div class="text-center">
                                                <p class='form-control @if ($category->active) bg-success bg-accent-2
                                                @else
                                                bg-red bg-accent-2 @endif  bg-primary bg-accent-1 alert-green'
                                                    id='slug'>
                                                    @if ($category->active)
                                                        Yes
                                                    @else
                                                        No
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>


                                    <!--------------------------- Actions -------------------------->
                                    <form>
                                        <div class=" form-actions right">
                                            <a href="{{route('admin.categories.edit', $category->id)}}"><button type="button" class="btn btn-info mr-1 left" >
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
