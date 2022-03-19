@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!--------------------------- Navigagion breadcrumps header -------------------------->
        @include('app.admin.components.breadcrumps-header',[
        'section' => "products",
        'current' =>"create",
        'sectionRoute' => "admin.products"
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
                            ['cardHeader' =>"Add a new product"])
                            <!--------------------------- END Card Header -------------------------->

                            <!-------------------- Alerts -------------------->
                            @include('layouts.includes.alerts.success')
                            @include('layouts.includes.alerts.errors')
                            <!-------------------- END Alerts -------------------->

                            <!-------------------- Card Content -------------------->
                            @include('app.admin.products.components.card-content',[
                            'formPostRouteName' => 'admin.products.store',
                            'formPostRoutePara' => '',
                            'mainCategories' => $mainCategories,
                            'vendors' => $vendors,
                            'mainProducts' => $mainProducts,
                            'statusList' => $featuredList,
                            'tagList' => $tagList,
                            'discountList' => $discountList,
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
