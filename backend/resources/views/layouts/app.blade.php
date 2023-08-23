<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Proelean</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.ico') }}">

    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet"
    type="text/css" />


    <!-- third party css -->
    <link href="{{ asset('assets/admin/css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- third party css end -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <!-- App css -->
    <link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/app-modern.min.css') }}" rel="stylesheet" type="text/css"
        id="light-style" />

    <!-- third party css -->
         <link href="{{ asset('assets/admin/css/vendor/dataTables.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
         <link href="{{ asset('assets/admin/css/vendor/responsive.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
    @livewireStyles
</head>

<body class="loading" data-layout="detached" data-layout-config='{"leftSidebarCondensed":false,"darkMode":false, "showRightSidebarOnStart": true}'>

    @include('layouts.navbar')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- Begin page -->
        <div class="wrapper">
            @include('layouts.sidebar')
            @yield('main')
        </div>
    </div>
    @include('layouts.right-sidebar')
    <div class="rightbar-overlay"></div>
    @include('layouts.footer')



    <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- bundle -->
    <script src="{{ asset('assets/admin/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/app.min.js') }}"></script>

    <!-- third party js -->
    <script src="{{ asset('assets/admin/js/vendor/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- third party js ends -->

     <!-- third party js -->
     <script src="{{asset('assets/admin/js/vendor/jquery.dataTables.min.js')}}"></script>
     <script src="{{ asset('assets/admin/js/vendor/dataTables.bootstrap5.js')}}"></script>
     <script src="{{ asset('assets/admin/js/vendor/dataTables.responsive.min.js')}}"></script>
     <script src="{{ asset('assets/admin/js/vendor/responsive.bootstrap5.min.js')}}"></script>
     <script src="{{ asset('assets/admin/js/vendor/dataTables.checkboxes.min.js')}}"></script>

    <!-- demo app -->
    <script src="{{asset('assets/admin/js/pages/demo.dashboard.js')}}"></script>
    <script src="{{asset('assets/admin/js/pages/demo.sellers.js')}}"></script>
    @livewireScripts
</body>
@include('admin.changepassword')
<script>
@if (count($errors) > 0 and Route::currentRouteName()=="changeAdminPassword")
$(document).ready(function(){
 $('#updatepassword').modal('show');

});
@endif
</script>
</html>
