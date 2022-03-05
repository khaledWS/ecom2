@extends('layouts.admin.admin')

@section('content')
    <div class="content-wrapper">
        <!--------------------------- Navigagion breadcrumps header -------------------------->
        @include('admin.components.breadcrumps-header',[
        'section' => "المتاجر",
        'sectionRoute' => "admin.vendors",
        'current' =>"تعديل $vendor->name"
        ])
        <!--------------------------- END Navigagion breadcrumps header -------------------------->

        <div class="content-body">
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <!--------------------------- Card -------------------------->
                        <div class="card">
                            <!--------------------------- Card Header -------------------------->
                            @include('admin.maincategories.components.card-header',
                            ['cardHeader' =>"تعديل متجر"])
                            <!--------------------------- END Card Header -------------------------->

                            <!-------------------- Alerts -------------------->
                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')
                            <!-------------------- END Alerts -------------------->

                            <!-------------------- Card Content -------------------->
                            @include('admin.vendors.components.card-content',[
                            'formPostRouteName' => 'admin.vendors.update',
                            'formPostRoutePara' => $vendor->id,
                            'mainCategories' => $mainCategories,
                            'job' => 'edit',
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
