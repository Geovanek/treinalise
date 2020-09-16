<!doctype html>
<html amp lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- The AMP runtime must be loaded as the second child of the `<head>` tag.-->
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Admin .:. Treinalise') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">

    @yield('before-css')

    {{-- theme css --}}
    <link id="gull-theme" rel="stylesheet" href="{{ asset('gull/assets/fonts/iconsmind/iconsmind.css') }}">
    <link id="gull-theme" rel="stylesheet" href="{{ asset('gull/assets/styles/css/themes/lite-custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('gull/assets/styles/vendor/perfect-scrollbar.css') }}">

    {{-- page specific css --}}
    @yield('page-css')
</head>

<body class="text-left">
    <!-- Pre Loader Strat  -->
    <div class='loadscreen' id="preloader">
        <div class="loader spinner-bubble spinner-bubble-primary"></div>
    </div>
    <!-- Pre Loader end  -->

    <!-- ============ Large SIdebar Layout start ============= -->
    <div class="app-admin-wrap layout-sidebar-large clearfix">

        @include('admin.layouts.header')
        <!-- ============ end of header menu ============= -->

        @include('admin.layouts.sidebar')
        <!-- ============ end of left sidebar ============= -->

        <!-- ============ Body content start ============= -->
        <div class="main-content-wrap sidenav-open d-flex flex-column">
                <div class="main-content">
                    @yield('content')
                </div>
            <div class="flex-grow-1"></div>

            @include('admin.layouts.footer')
            <!-- ============ end of footer ============= -->
        </div>
        <!-- ============ Body content End ============= -->
    </div>
    <!--=============== End app-admin-wrap ================-->

    <!-- ============ Search UI Start ============= -->
    {{-- @include('layouts.common.search') --}}
    <!-- ============ Search UI End ============= -->
    <!-- ============ Large Sidebar Layout End ============= -->

    {{-- common js --}}
    <script src="{{mix('gull/assets/js/common-bundle-script.js')}}"></script>

    {{-- page specific javascript --}}
    @yield('page-js')

    {{-- theme javascript --}}
    {{-- <script src="{{mix('assets/js/es5/script.js')}}"></script> --}}
    <script src="{{asset('gull/assets/js/script.js')}}"></script>
    <script src="{{asset('gull/assets/js/sidebar.large.script.js')}}"></script>
    <script src="{{asset('gull/assets/js/tooltip.script.js')}}"></script>

    {{-- laravel js --}}
    {{-- <script src="{{mix('assets/js/laravel/app.js')}}"></script> --}}

    @yield('bottom-js')
</body>
</html>
