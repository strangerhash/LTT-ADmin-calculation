<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>@yield('title') - ISCUBE</title>
        <meta name="keyword" content="network marketing in nigeria, best mlm in nigeria, iscube networks register, Best Network Marketing Plan,  network marketing, revolving matrix, super network marketing business, network marketing company with best incentives">
		<meta name="description" content="Sign in to your account and enjoy unlimited perks - ISCUBE International" />

		<!-- Favicon -->
		{{-- <link rel="shortcut icon" href="https://office.iscubenetworks.com/assets/dist/img/favicon.ico"> --}}
		{{-- <link rel="icon" href="https://office.iscubenetworks.com/assets/dist/img/favicon.ico" type="image/x-icon"> --}}

		<!-- Toggles CSS -->
		<link href="{{ asset('/assets/vendors/jquery-toggles/css/toggles.css')}}" rel="stylesheet" type="text/css">
		<link href="{{ asset('/assets/vendors/jquery-toggles/css/themes/toggles-light.css')}}" rel="stylesheet" type="text/css">

		<!-- Custom CSS -->
		<link href="{{ asset('/assets/dist/css/style.css')}}" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!-- Preloader -->
		<div class="preloader-it">
			<div class="loader-pendulums"></div>
		</div>
		<!-- /Preloader -->

		<!-- HK Wrapper -->

        @yield('content')
		<!-- /HK Wrapper -->

		<!-- JavaScript -->

		<!-- jQuery -->
		<script src="{{ asset('/assets/vendors/jquery/dist/jquery.min.js')}}"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="{{ asset('/assets/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
		<script src="{{ asset('/assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>

		<!-- Slimscroll JavaScript -->
		<script src="{{ asset('/assets/dist/js/jquery.slimscroll.js')}}"></script>

		<!-- Fancy Dropdown JS -->
		<script src="{{ asset('/assets/dist/js/dropdown-bootstrap-extended.js')}}"></script>

		<!-- FeatherIcons JavaScript -->
		<script src="{{ asset('/assets/dist/js/feather.min.js')}}"></script>

		<!-- Init JavaScript -->
		<script src="{{ asset('/assets/dist/js/init.js')}}"></script>
		<!-- Recaptcha -->
		{{-- <script src="../../www.google.com/recaptcha/api.js" async defer></script> --}}
		{{-- <script>
           function onSubmit(token) {
                document.getElementById("login-form").submit();
           }
        </script> --}}
        @yield('scripts')

	</body>
</html>
