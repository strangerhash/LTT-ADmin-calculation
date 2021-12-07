<!doctype html>

<html lang="en">
<head>

        <meta charset="utf-8" />

        <title>Dashboard | Iscube Admin</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- App favicon -->

        <link rel="shortcut icon" href="{{ asset('admin_assets/images/favicon.ico') }}">



        <link href="{{ asset('admin_assets/libs/chartist/chartist.min.css') }}" rel="stylesheet">



        <!-- Bootstrap Css -->

        <link href="{{ asset('admin_assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />

        <!-- Icons Css -->

        <link href="{{ asset('admin_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- App Css-->

        <link href="{{ asset('admin_assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        <script src="{{ asset('admin_assets/libs/jquery/jquery.min.js') }}"></script>


    </head>



    <body data-sidebar="dark">



        <!-- Begin page -->

        <div id="layout-wrapper">



            {{-- Header --}}

            @include('administrator.layouts.app-top-nav')

            {{-- HeaderEnd  --}}



            <!-- ========== Left Sidebar Start ========== -->

            <div class="vertical-menu">



                <div data-simplebar class="h-100">



                    <!--- Sidemenu -->

                    @include('administrator.layouts.app-right-side-nav')

                    <!-- Sidebar -->

                </div>

            </div>

            <!-- Left Sidebar End -->



            <!-- ============================================================== -->

            <!-- Start right Content here -->

            <!-- ============================================================== -->

            @yield('content')

            <!-- end main content-->



        </div>

        <!-- END layout-wrapper -->



        <!-- JAVASCRIPT -->

        

        <script src="{{ asset('admin_assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ asset('admin_assets/libs/metismenu/metisMenu.min.js') }}"></script>

        <script src="{{ asset('admin_assets/libs/simplebar/simplebar.min.js') }}"></script>

        <script src="{{ asset('admin_assets/libs/node-waves/waves.min.js') }}"></script>



        <!-- Peity chart-->

        <script src="{{ asset('admin_assets/libs/peity/jquery.peity.min.js') }}"></script>



        <!-- Plugin Js-->

        <script src="{{ asset('admin_assets/libs/chartist/chartist.min.js') }}"></script>

        <script src="{{ asset('admin_assets/libs/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js') }}"></script>



        <script src="{{ asset('admin_assets/js/pages/dashboard.init.js') }}"></script>



        <script src="{{ asset('admin_assets/js/app.js') }}"></script>

       <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

        @yield('scripts')

    </body>



</html>

