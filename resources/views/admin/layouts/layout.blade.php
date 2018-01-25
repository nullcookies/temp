<!DOCTYPE html>
<html lang="en" ng-app="@yield('ng_app')">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta name="robots" content="nofollow, noindex">
		<title>{{PROJECT_NAME}}-Admin @yield('title')</title>
		<style>
			.btn-logout {width: 60px !important;}
			.put_text_center{
				text-align: center;
			}
		</style>
		<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/jquery/jquery-1.12.3.min.js')}}"></script>
		@include('admin/common/headerScripts')
		@yield('pageTopScripts')
		
		<style>	
			.chart-easy-sm{
				width:60px;
				height:60px;
				position:absolute;
				margin-left:-60px;
			}
			.chart-easy-sm span {
				display: block;
				line-height: 60px;
				z-index: 2;
				font-size: 10px;
				color: #2b2b2b;
				font-weight:bold;
			}
			.chart-easy-sm canvas{
				top:10px;
				left:10px;
			}
			.daysleft{
				text-align:center;
				margin-bottom:5px;
				margin-top:5px;
				text-transform:uppercase;
				font-weight:bold;
			}
			.subnow-btn{
				background-color:#f44236;
				color:#fff;
				border:none;
			}
		</style>
	</head>
	<body class="@yield('bodyclass')">
		<div class="wrapper">
			<div class="preloader"></div>
			<!-- Sidebar -->
			<div class="site-overlay"></div>
			
			@include('admin/common/left')

			@include('admin/common/header')

			<div class="site-content">
				<!-- Content -->
				<div class="content-area py-1">
					@yield('content')
				</div>
				@include('admin/common/footer')
			</div>

		</div>
		@include('admin/common/footerScripts')
		@yield('pageScripts')
		<script type="text/javascript">
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		</script>
	</body>
</html>