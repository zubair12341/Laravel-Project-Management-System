<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"> <!-- Favicon-->
    <title>{{ config('app.name') }} - @yield('title')</title>
    <meta name="description" content="@yield('meta_description', config('app.name'))">
    <meta name="author" content="@yield('meta_author', config('app.name'))">
    @yield('meta')
    @stack('before-styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    @if (trim($__env->yieldContent('page-style')))
        @yield('page-style')
    @endif
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    <!-- DataTables JS -->


    @stack('after-styles')


    @livewireStyles
</head>
<style>
    #dash-background {}
</style>

<body class="theme-orange" style="font-family: 'Montserrat', sans-serif;">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="{{ asset('assets/images/datech-logo.png') }}" width="70" height="70"
                    alt="Metro Web"></div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    @include('layouts.navbarright')
    @include('layouts.sidebar')
    @include('layouts.rightsidebar')
    <section class="content">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">

                <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                        class="zmdi zmdi-sort-amount-desc"></i></button>
            </div>

        </div>

        <div class="container-fluid" id="dash-background">
            @include('layouts.alert_message')
            @yield('content')
        </div>
    </section>

    @yield('modal')

    <!-- Scripts -->
    @stack('before-scripts')
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>

    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    @if (trim($__env->yieldContent('page-script')))
        @yield('page-script')
    @endif

    @stack('after-scripts')
    
    @livewireScripts


</body>

</html>
