@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!--------------------------- Navigagion breadcrumps header -------------------------->
        @include('app.admin.components.breadcrumps-header',[
        'section' => "Categories",
        'current' =>"create",
        'sectionRoute' => "admin.categories"
        ])
        <!--------------------------- END Navigagion breadcrumps header -------------------------->

        <div class="content-body">
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <!--------------------------- Card -------------------------->
                        <div class="card">
                            <!--------------------------- Card Header -------------------------->
                            @include('app.admin.components.card-header',
                            ['cardHeader' =>"Add a new Category"])
                            <!--------------------------- END Card Header -------------------------->

                            <!-------------------- Alerts -------------------->
                            @include('layouts.includes.alerts.success')
                            @include('layouts.includes.alerts.errors')
                            <!-------------------- END Alerts -------------------->

                            <!-------------------- Card Content -------------------->
                            @include('app.admin.vendors.components.card-content',[
                            'formPostRouteName' => 'admin.categories.store',
                            'formPostRoutePara' => '',
                            'mainCategories' => $mainCategories,
                            'job' => 'create',
                            ])
                            <!-------------------- END Card Content -------------------->
                        </div>
                        <!--------------------------- END Card -------------------------->
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
