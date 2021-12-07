<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>@yield('title') - ISCUBE</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/assets/dist/img/favicon.ico') }}">
    <link rel="icon" href="{{ asset('/assets/dist/img/favicon.ico') }}" type="image/x-icon">

	<!-- Toastr CSS -->
    <link href="{{ asset('/assets/vendors/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Page CSS -->

    <!-- Custom CSS -->
    <link href="{{ asset('/assets/dist/css/style.css') }}" rel="stylesheet" type="text/css">
    @yield('styles')
</head>
<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->

	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-vertical-nav">

        <!-- Top Navbar -->
        @include('layouts.app.navbar')
        <!-- /Top Navbar -->

        <!-- Vertical Nav -->
        @include('layouts.app.sidebar')

        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->
        <!-- Main Content -->
        @yield('content')
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('/assets/vendors/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('/assets/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('/assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Slimscroll JavaScript -->
    <script src="{{ asset('/assets/dist/js/jquery.slimscroll.js') }}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{ asset('/assets/dist/js/dropdown-bootstrap-extended.js') }}"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="{{ asset('/assets/dist/js/feather.min.js') }}"></script>

	<!-- Counter Animation JavaScript -->
	<script src="{{ asset('/assets/vendors/waypoints/lib/jquery.waypoints.min.js') }}"></script>
	<script src="{{ asset('/assets/vendors/jquery.counterup/jquery.counterup.min.js') }}"></script>

    {{-- Display Please Wait on form submission --}}
    <script>

        $( "form" ).submit(function() {
            showPleaseWait();
        });

        function showPleaseWait() {
            if (document.querySelector("#pleaseWaitDialog") == null) {
                var modalLoading = '<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false" role="dialog">\
                    <div class="modal-dialog">\
                        <div class="modal-content">\
                            <div class="modal-header">\
                                <h4 class="modal-title">Please wait...</h4>\
                            </div>\
                            <div class="modal-body">\
                                <div class="progress">\
                                <div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated active" role="progressbar"\
                                aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px">\
                                </div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                </div>';
                $(document.body).append(modalLoading);
            }

            $("#pleaseWaitDialog").modal("show");
        }

        /**
        * Hides "Please wait" overlay. See function showPleaseWait().
        */
        function hidePleaseWait() {
            $("#pleaseWaitDialog").modal("hide");
        }
    </script>

	<!-- Toastr JS -->
    <script src="{{ asset('/assets/vendors/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>

    <!-- Page JS -->

    <!-- Init JavaScript -->
    <script src="{{ asset('/assets/dist/js/init.js') }}"></script>


    {{-- Load scripts from other blade files --}}
    @yield('scripts')


</body>

</html>
