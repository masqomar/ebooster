<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/favicon.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css">
    <!-- file upload -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/file-upload.css">
    <!-- file upload -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/plyr.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

    <!-- jquery Ui -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/jquery-ui.css">
    <!-- editor quill Ui -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/editor-quill.css">
    <!-- apex charts Css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/apexcharts.css">

    <!-- jvector map Css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/jquery-jvectormap-2.0.5.css">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/main.css">
    @stack('css')
</head>

<body>

    <!--==================== Preloader Start ====================-->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!--==================== Preloader End ====================-->

    <!--==================== Sidebar Overlay End ====================-->
    <div class="side-overlay"></div>
    <!--==================== Sidebar Overlay End ====================-->

    @include('layouts.partials.sidebar')

    <div class="dashboard-main-wrapper">
        
    @include('layouts.partials.header')


        <div class="dashboard-body">
            @yield('content')
        </div>
        <div class="dashboard-footer">
            <div class="flex-between flex-wrap gap-16">
                <p class="text-gray-300 text-13 fw-normal"> &copy; Copyright English Booster 2024, All Right Reserverd</p>
                <div class="flex-align flex-wrap gap-16">
                    <a href="#" class="text-gray-300 text-13 fw-normal hover-text-main-600 hover-text-decoration-underline">License</a>
                    <a href="#" class="text-gray-300 text-13 fw-normal hover-text-main-600 hover-text-decoration-underline">Documentation</a>
                    <a href="#" class="text-gray-300 text-13 fw-normal hover-text-main-600 hover-text-decoration-underline">Support</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery js -->
    <script src="{{ asset('assets') }}/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="{{ asset('assets') }}/js/boostrap.bundle.min.js"></script>
    <!-- Phosphor Js -->
    <script src="{{ asset('assets') }}/js/phosphor-icon.js"></script>
    <!-- file upload -->
    <script src="{{ asset('assets') }}/js/file-upload.js"></script>
    <!-- file upload -->
    <script src="{{ asset('assets') }}/js/plyr.js"></script>
    <!-- dataTables -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>


    <!-- jQuery UI -->
    <script src="{{ asset('assets') }}/js/jquery-ui.js"></script>
    <!-- jQuery UI -->
    <script src="{{ asset('assets') }}/js/editor-quill.js"></script>
    <!-- apex charts -->
    <script src="{{ asset('assets') }}/js/apexcharts.min.js"></script>
    <!-- jvectormap Js -->
    <script src="{{ asset('assets') }}/js/jquery-jvectormap-2.0.5.min.js"></script>
    <!-- jvectormap world Js -->
    <script src="{{ asset('assets') }}/js/jquery-jvectormap-world-mill-en.js"></script>

    <!-- main js -->
    <script src="{{ asset('assets') }}/js/main.js"></script>


@stack('js')

</body>

</html>