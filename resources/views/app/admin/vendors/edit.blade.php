@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!--------------------------- Navigagion breadcrumps header -------------------------->
        @include('app.admin.components.breadcrumps-header',[
        'section' => "vendors",
        'current' =>"Edit",
        'sectionRoute' => "admin.vendors"
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
                            ['cardHeader' =>"Edit vendor"])
                            <!--------------------------- END Card Header -------------------------->

                            <!-------------------- Alerts -------------------->
                            @include('layouts.includes.alerts.success')
                            @include('layouts.includes.alerts.errors')
                            <!-------------------- END Alerts -------------------->

                            <!-------------------- Card Content -------------------->
                            @include('app.admin.vendors.components.card-content',[
                            'formPostRouteName' => 'admin.vendors.update',
                            'formPostRoutePara' => $vendor->id,
                            'mainCategories' => $mainCategories,
                            'mainCategories' => $mainCategories,
                            'statusList' => $featuredList,
                            'featuredList' => $statusList,
                            'vendors' => $vendors,
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
