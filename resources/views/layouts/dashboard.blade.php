<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | DeskDesk</title>

    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
</head>
<body>
    <div class="container-scroller">

        @include('layouts.partials.dashboard._navbar')

        <div class="container-fluid page-body-wrapper">

            @include('layouts.partials.dashboard._sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>

                @include('layouts.partials.dashboard._footer')

            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/off-canvas.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/misc.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/PNotify.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/PNotifyButtons.js') }}"></script>

    @include('layouts.partials._notification')

    @yield('script')

</body>
</html>
