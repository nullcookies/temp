@extends('admin/layouts/layout')

@section('title')
| {{'Coupons'}}
@endsection

@section('pageTopScripts')
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">

@endsection

@section('pageScripts')
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>


<script type="text/javascript">	
	$(document).ready(function(){	
	});
</script>
@endsection
@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
<div class="content-area py-1">
					<div class="container-fluid">
						<h4>{!! $title !!}</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="{{url('/admin/website-setting')}}">Website Setting</a></li>
							<li class="breadcrumb-item"><a href="#">Slider Image Add</a></li>
							
						</ol>
						<div class="box box-block bg-white">
							<h5>Sliders</h5> 
							@if($errors->has('errors')) <span class="text-danger">{{$errors}}</span>  @endif
							{{Form::open(['method'=>'post', 'files' =>'true', 'action'=>['Admin\WebsiteSetting\WebsiteSettingController@updateImage']])}}
								<div class="form-group">  
									<label for="exampleSelect1">Banner Category</label>
									<select class="form-control" name="category" id="category">																		
										<option value="{{ $category[1]['id'] }}">{{$category[1]['name']}}</option>									
									</select>
									@if($errors->has('category')) <span class="text-danger">{{ $errors->first('category') }}</span> @endif
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Image URL</label>
									<input type="text" class="form-control" id="link" name="link" aria-describedby="link" placeholder="Enter Image Link - URL">
									<!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
									@if($errors->has('link')) <span class="text-danger">{{ $errors->first('link') }}</span> @endif
								</div>								
								
								
								<div class="form-group">
									<label for="image">File input</label>
									<input type="file" accept=".png, .jpg, .jpeg" class="form-control-file" id="image" name="image" aria-describedby="fileHelp">
									<!-- <small id="fileHelp" class="form-text text-muted">Image shoul be upto 60KB Dimention 285 x 500</small> -->
									@if($errors->has('image')) <span class="text-danger">{{ $errors->first('image') }}</span> @endif
								</div>
								
								
								<button type="submit" class="btn btn-primary">Submit</button>
							{{Form::close()}}
						</div>
						
					</div>
				</div>
@endsection