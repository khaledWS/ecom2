<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<!-- <html lang="en"> -->
<html direction="rtl" dir="rtl" style="direction: rtl">
<!--begin::Head-->

<head>

    <base href="">
    <title>@yield('title','moh')</title>
    <meta charset="utf-8" />
    <meta name="description" content="moh" />
    <meta name="keywords" content="moh, moh" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="ar-SA" />
    <meta property="og:type" content="form" />
    <meta property="og:title" content="moh" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="moh" />
    <link rel="canonical" href="" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    @yield('header-links')
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
    class="page-loading-enabled page-loading header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed bg-light-dark"
    style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">


    <!--begin::loader-->
    @include('project.layout._loader')
    <!--end::loader-->

    <!--begin::Master content-->
    @include('project.layout.master')
    <!--end::Master content-->

    <!-- php include 'layout/engage/_main.php' ?> -->
    {{-- the little sidebar things to the right that open and close --}}
    {{-- @include('project.layout.engage._main') --}}


    <!--begin::scrollto the top-->
    @include('project.layout._scrolltop')
    <!--end::scrollto the top-->

    <!--begin::Modals-->
    {{-- @include('project.partials.modals._upgrade-plan') --}}

    {{-- @include('project.partials.modals.create-app._main') --}}

    {{-- @include('project.partials.modals._invite-friends') --}}

    {{-- @include('project.partials.modals.users-search._main') --}}

    @yield('modals')
    <!--end::Modals-->

    <!--begin::Javascript-->
    <script>
        var hostUrl = "";
    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets/js/custom/intro.js') }}"></script>
    <script src="{{ asset('assets/js/custom/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('assets/js/custom/modals/create-app.js') }}"></script>
    <script src="{{ asset('assets/js/custom/modals/users-search.js') }}"></script>
    <!--end::Page Custom Javascript-->
    @yield('script-files')
    <script>
        $("#kt_daterangepicker_3").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format("YYYY"), 10)
        }, function(start, end, label) {
            var years = moment().diff(start, "years");

        });
        $("#kt_daterangepicker_3_2").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format("YYYY"), 10)
        }, function(start, end, label) {
            var years = moment().diff(start, "years");

        });
        $("#kt_daterangepicker_3_3").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format("YYYY"), 10)
        }, function(start, end, label) {
            var years = moment().diff(start, "years");

        });
        $("#kt_daterangepicker_3_4").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format("YYYY"), 10)
        }, function(start, end, label) {
            var years = moment().diff(start, "years");

        });
        today = new Date();
        x = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
        $("#testt").html('تاريخ اليوم: ' + x);
    </script>
    <!--end::Javascript-->
    @yield('scripts')
</body>
<!--end::Body-->

</html>
