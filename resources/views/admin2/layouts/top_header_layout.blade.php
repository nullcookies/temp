<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{PROJECT_NAME}} @yield('title')</title>

  @include('admin/common/headScript')

  @yield('additional_head_links')

  @yield('meta')
</head>

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  @include('admin/common/header')
  <!-- Full Width Column -->
  <div class="content-wrapper">
    @yield('breadcrumb')

    @yield('content')
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  @include('admin/common/footer')
</div>

@include('admin/common/footerScript')

@yield('additional_footer_scripts')
</body>
</html>
