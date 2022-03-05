@extends('layouts.admin.admin')

@section('content')
    <div class="content-wrapper">
        <!--------------------------- Navigagion breadcrumps header -------------------------->
        @include('admin.maincategories.components.breadcrumps-header',
        ['section' => 'الأقسام الرئسية', 'current' => "تعديل - $mainCategories->mc_name"])
        <!--------------------------- END Navigagion breadcrumps header -------------------------->

        <div class="content-body">
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <!--------------------------- Card -------------------------->
                        <div class="card">
                            <!--------------------------- Card Header -------------------------->
                            @include('admin.maincategories.components.card-header',
                            ['cardHeader' =>"تعديل القسم"])
                            <!--------------------------- END Card Header -------------------------->

                            <!-------------------- Alerts -------------------->
                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')
                            <!-------------------- END Alerts -------------------->

                            <!-------------------- Card Content -------------------->
                            @include('admin.maincategories.components.card-content',[
                            'formPostRouteName' => 'admin.categories.update',
                            'formPostRoutePara' => $mainCategories->id,
                            'mainCategory' => $mainCategories,
                            ])
                            <!-------------------- END Card Content -------------------->
                        </div>
                        <!--------------------------- END Card -------------------------->




                        {{-- OTHER LANGUAGES TABS --}}
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">اللغات الأخرى</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    {{-- NAV --}}
                                    <ul class="nav nav-tabs nav-underline no-hover-bg">
                                        @if($mainCategories->otherLanguages->count() > 0)
                                            @foreach ($mainCategories->otherLanguages as $key => $mainCategory)
                                                @if ($key == 0)
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="base-tab{{ $key }}"
                                                            data-toggle="tab" aria-controls="tab" href="#tab{{ $key }}"
                                                            >{{ $mainCategory->mc_language }}</a>
                                                    </li>
                                                @else
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="base-tab{{ $key }}"
                                                            data-toggle="tab" aria-controls="tab{{ $key }}"
                                                            href="#tab{{ $key }}"
                                                            aria-expanded="false">{{ $mainCategory->mc_language }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                    <div class="tab-content px-1 pt-1">
                                        @if($mainCategories->otherLanguages->count() > 0)
                                            @foreach ($mainCategories->otherLanguages as $key => $mainCategory)
                                                @if ($key == 0)
                                                    <div role="tabpanel" class="tab-pane" id="tab{{ $key }}"
                                                        " aria-labelledby="base-tab{{ $key }}">
                                                        @include('admin.maincategories.components.card-content',[
                                                        'formPostRouteName' => 'admin.categories.update',
                                                        'formPostRoutePara' => $mainCategory->id,
                                                        'mainCategory' => $mainCategory,
                                                        ])
                                                    </div>
                                                @else
                                                    <div class="tab-pane" id="tab{{ $key }}"
                                                        aria-labelledby="base-tab{{ $key }}">
                                                        @include('admin.maincategories.components.card-content',[
                                                        'formPostRouteName' => 'admin.categories.update',
                                                        'formPostRoutePara' => $mainCategory->id,
                                                        'mainCategory' => $mainCategory,
                                                        ])
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                        <h4 class="card-title text-center">لا يوجد</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>







    </div>
@endsection
