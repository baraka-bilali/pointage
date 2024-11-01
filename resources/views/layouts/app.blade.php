<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Attendance App</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="  {{asset ('adminProvidence/vendors/images/logo.png')}} ">
	<link rel="icon" type="image/png" sizes="16x16" href=  " {{asset ('adminProvidence/src/images/logo.png')}}">
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href=" {{ asset( 'adminProvidence/vendors/styles/core.css') }}">
	<link rel="stylesheet" type="text/css" href=" {{ asset( 'adminProvidence/src/plugins/sweetalert2/sweetalert2.css') }}">
	<link rel="stylesheet" type="text/css" href=" {{asset ('adminProvidence/vendors/styles/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href=" {{asset ('adminProvidence/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}} ">
	<link rel="stylesheet" type="text/css" href=" {{asset('adminProvidence/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href=" {{asset('adminProvidence/src/plugins/jquery-steps/jquery.steps.css')}}">
	<link rel="stylesheet" type="text/css" href=" {{asset ('adminProvidence/vendors/styles/core.css')}}">
	<link rel="stylesheet" type="text/css" href=" {{asset ('adminProvidence/vendors/styles/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href=" {{asset ('adminProvidence/vendors/styles/style.css')}}">
	<link rel="stylesheet" type="text/css" href="	{{asset ('adminProvidence/src/plugins/switchery/switchery.min.css')}}">
	<!-- bootstrap-tagsinput css -->
	<link rel="stylesheet" type="text/css" href=" {{asset('adminProvidence/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}} ">
	<!-- bootstrap-touchspin css -->
	<link rel="stylesheet" type="text/css" href=" {{asset('adminProvidence/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css')}} ">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body>

    {{-- @include('partials.loader') --}}

    @include('partials.header')

    @include('partials.sidebar')

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
            @yield('content')

            @include('partials.footer')
		</div>
	</div>
	<!-- js -->

	<script src={{asset('adminProvidence/vendors/scripts/core.js')}}></script>
	<script src={{asset('adminProvidence/vendors/scripts/script.min.js')}}></script>
	<script src={{asset('adminProvidence/vendors/scripts/process.js')}}></script>
	<script src={{asset ('adminProvidence/vendors/scripts/layout-settings.js')}}></script>
	<script src={{asset('adminProvidence/src/plugins/apexcharts/apexcharts.min.js')}}></script>
	<script src={{asset('adminProvidence/src/plugins/datatables/js/jquery.dataTables.min.js')}}></script>
	<script src={{asset('adminProvidence/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}></script>
	<script src={{asset('adminProvidence/src/plugins/datatables/js/dataTables.responsive.min.js')}}></script>
	<script src={{asset('adminProvidence/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}></script>
	<script src={{asset ('adminProvidence/vendors/scripts/dashboard.js')}}></script>

		<!-- switchery js -->
	<script src={{asset ('adminProvidence/src/plugins/switchery/switchery.min.js')}}></script>
		<!-- bootstrap-tagsinput js -->
	<script src={{asset ('adminProvidence/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}></script>
		<!-- bootstrap-touchspin js -->
	<script src={{asset ('adminProvidence/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js')}}></script>
	<script src={{asset ('adminProvidence/vendors/scripts/advanced-components.js')}}></script>


		<!-- add sweet alert js & css in footer -->
		<script src={{asset ('adminProvidence/src/plugins/sweetalert2/sweetalert2.all.js')}}></script>
		<script src={{asset ('adminProvidence/src/plugins/sweetalert2/sweet-alert.init.js')}}></script>
	@yield('scripts')
</body>
</html>
