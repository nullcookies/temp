@extends('admin/layouts/layout')

@section('title')
| Homepage Hot Deal
@endsection

@section('pageTopScripts')

<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.css')}}">
<style>
img{width: 100%;}

	/*.dropify{height: 80px;width: 80px;}*/

</style>
@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>	
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/moment/moment.js')}}"></script>	
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>	
<script type="text/javascript">
$('input[name="daterange"]').daterangepicker({	
		locale: {
			format: 'YYYY-MM-DD'
		},	
		buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-success',
        cancelClass: 'btn-inverse',
        startDate: '{!! $item->start_date !!}',
        endDate: '{!! $item->end_date !!}'
	});
</script>
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
	
		<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Update Homepage Hot Deal</li>
		</ol>
		<div class="box box-block bg-white">	
		
			<div class="row cc-row header-row">	
			<h3>Update Homepage Hot Deal</h3>			
				<ul class="demo-header-actions">
				@if(Session::has('success'))
				<li class="demo-tabs alert alert-success alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>{!! Session::get('success') !!}.</strong>
				@endif

				@if(Session::has('danger'))
				<li class="demo-tabs alert alert-danger alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						<strong>{!! Session::get('danger') !!}.</strong>
				</li>
				@endif
				</li>
					<li class="demo-tabs"><a href="{{url('admin/product/product-hot-deal')}}" class="btn btn-black w-min-sm mb-0-25 waves-effect waves-light">Back</a></li>
					
				</ul>
			</div>
		</div>
		{{Form::open(['class'=>'form-horizontal', 'files' =>'true','method'=>'post', 'action'=>['Admin\Product\HomepageTagController@producthotdealupdate', $item->id]])}}
		 
		<div class="col-lg-6 col-md-6">			
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Deal Date Range</label>
					<div class="col-xs-8">
						<input class="form-control" name="daterange" value="@if(!empty($item->start_date) && !empty($item->ends_date)) {{$item->start_date}} - {{$item->end_date}} @endif" type="text" readonly="true">
						@if($errors->has('daterange')) <span class="text-danger">{{$errors->first('daterange')}} </span> @endif

					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product Name </label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="name" value="{{ $item->name }}">
						@if($errors->has('name')) <span class="text-danger">{{$errors->first('name')}} </span> @endif

					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product Image</label>
					<div class="col-xs-8">
						<input type="hidden" name="imageSrc" value="{{ $item->image }}">
						<input class="form-control" type="file" name="image" accept=".png, .jpg, .jpeg, .gif">
						@if($errors->has('image')) <span class="text-danger">{{$errors->first('image')}} </span> @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product Rating</label>
					<div class="col-xs-8">
						<input class="form-control" type="number" min="1" max="5" name="rating" value="{{ $item->rating }}">
						@if($errors->has('rating')) <span class="text-danger">{{$errors->first('rating')}} </span> @endif
					</div>
				</div>	
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product Old Price</label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="old_price" value="{{ $item->old_price }}">
						@if($errors->has('old_price')) <span class="text-danger">{{$errors->first('old_price')}} </span> @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product New Price</label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="new_price" value="{{ $item->new_price }}">
						@if($errors->has('new_price')) <span class="text-danger">{{$errors->first('new_price')}} </span> @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product Link</label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="link" value="{{ $item->link }}">
						@if($errors->has('link')) <span class="text-danger">{{$errors->first('link')}} </span> @endif
					</div>
				</div>
				<div class="form-group row">
				<label for="setbillingaddress" class="col-xs-4 col-form-label"></label>					
					<div class="col-xs-8">
						<button class="btn btn-success" type="submit" name="btnSubmit">Submit</button>
						 
					</div>
				</div>
				 
		</div>
		<div class="col-lg-6 col-md-6">
		@if(!empty($item->image))
			<div class="col-xs-8 col-xs-offset-2">
				<img src="{{url('products-images/'.$item->image)}}" class="dropify">
			</div>
		@endif
		</div>
		<!-- </form> -->
		{{Form::close()}}

		
					
	</div>
@endsection