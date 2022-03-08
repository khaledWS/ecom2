@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!--------------------------- Navigagion breadcrumps header -------------------------->
        @include('app.admin.components.breadcrumps-header', [
            'section' => 'vendors',
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

                                    <div class="row justify-content-center">
                                        <div class=""></div>
                                        <div class="span4 col-2">
                                            <img class="rounded-circle img-border height-100 img-thumbnail"
                                                src="{{ $category->getImage() }}" alt="{{ $category->name }} image">
                                        </div>
                                        <div class=""></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name">name</label>
                                            <div class="text">
                                                <p class='form-control alert-blue-grey'>{{ $category->name }}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="slug">Slug</label>
                                            <div class="text">
                                                <a href="{{ $category->slug }}"><p class='form-control alert-blue-grey'>{{ $category->slug }}
                                                    </p></a>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="description">description</label>
                                            <div class="text">
                                                <p class='form-control alert-blue-grey'>{{ $category->description }}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="parent">parent</label>
                                            <div class="text">
                                                <p class='form-control alert-blue-grey'>{{ $category->parent }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <label for="info">info</label>
                                            <div class="text">
                                                <p class='form-control alert-blue-grey'>{{ $category->info }}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="active">Actice</label>
                                            <div class="text">
                                                <p class='form-control alert-blue-grey' id='slug'>
                                                    @if ($category->active) Yes
                                                    @else
                                                        No
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>

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
