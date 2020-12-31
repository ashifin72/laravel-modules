<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! MetaTag::tag('title') !!}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">
</head>
<body class="sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
@yield('header')

<!-- Main Sidebar Container -->
@yield('main-sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <div class="content">
            @include("admin.components.result_messages")
            <div class="container-fluid">
                @yield('content')
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
@yield('control-sidebar')

<!-- /.control-sidebar -->

    <!-- Main Footer -->
    @yield('footer')

</div>
<!-- ./wrapper -->
<!-- Scripts -->

<!-- jQuery -->
<script src="{{ asset('assets/admin/js/admin.js') }}"></script>

</body>
</html>
