@extends('admin/layouts/layout')

@section('title')
|Import - Export in Excel and CSV
@endsection

@section('pageTopScripts')

<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">

@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	
 
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')

	<div class="container">
	<duv class="pull-right">
		<a class="btn btn-info" href="{{url('admin/product/inventory')}}">Back</a>
	</duv>
		<!-- <a href="{{ URL::to('admin/product/downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>

		<a href="{{ URL::to('admin/product/downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
 -->
		<a href="{{ URL::to('admin/product/downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a>

		<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('admin/product/importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="file" name="import_file" />			
			<button class="btn btn-primary">Import File</button>
		@if(Session::has('incorrect_mime')) <span class="text-danger">{{Session::get('incorrect_mime')}} </span>@endif
		</form>

	</div>
@endsection
