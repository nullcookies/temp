@extends('admin/layouts/layout')

@section('title')
| Home Page Tag Product
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
<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Home Page Tag Product</li>
		</ol>
		<div class="box box-block bg-white">	
		
			<div class="row cc-row header-row">	
			<h3>{{ $item->tag}} </h3>			
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
					<li class="demo-tabs"><a href="{{url('admin/product/homepagetag/'.$item->id)}}" class="btn btn-black w-min-sm mb-0-25 waves-effect waves-light">Back</a></li>
					
				</ul>
			</div>
		</div>
		{{Form::open(['class'=>'form-horizontal company', 'files' =>'true','method'=>'post', 'action'=>['Admin\Product\HomepageTagController@postTagProducts', $item->id]])}}
		 
		<div class="col-lg-6 col-md-10">			
			<input type="hidden" name="tagid" value="{{$item->id}}">
				
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product Name </label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="name" value="{{Old('name')}}">
						@if($errors->has('name')) <span class="text-danger">{{$errors->first('name')}} </span> @endif

					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product Image</label>
					<div class="col-xs-8">
						<input class="form-control" type="file" name="image" accept=".png, .jpg, .jpeg, .gif">
						@if($errors->has('image')) <span class="text-danger">{{$errors->first('image')}} </span> @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product Rating</label>
					<div class="col-xs-8">
						<input class="form-control" type="number" min="1" max="5" name="rating" value="{{Old('rating')}}">
						@if($errors->has('rating')) <span class="text-danger">{{$errors->first('rating')}} </span> @endif
					</div>
				</div>	
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product Old Price</label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="old_price" value="{{Old('old_price')}}">
						@if($errors->has('old_price')) <span class="text-danger">{{$errors->first('old_price')}} </span> @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product New Price</label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="new_price" value="{{Old('new_price')}}">
						@if($errors->has('new_price')) <span class="text-danger">{{$errors->first('new_price')}} </span> @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product Link</label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="link" value="{{Old('link')}}">
						@if($errors->has('link')) <span class="text-danger">{{$errors->first('link')}} </span> @endif
					</div>
				</div>
				<div class="form-group row">
				<label for="setbillingaddress" class="col-xs-4 col-form-label"> 	</label>					
					<div class="col-xs-8">
						<button class="btn btn-success" type="submit" name="btnSubmit">Submit</button>
						 
					</div>
				</div>
				 
		</div>
		
		<!-- </form> -->
		{{Form::close()}}
					
	</div>
@endsection
