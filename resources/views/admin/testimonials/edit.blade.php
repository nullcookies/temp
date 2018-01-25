@extends('admin/layouts/layout')

@section('title')
| Homepage Hot Deal
@endsection

@section('pageTopScripts')

<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')}}">
<link rel="stylesheet" href="{{asset('css/sweetalert.css')}}"/>
<style type="text/css">
	.dropify{}
</style>
@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){		
		$("#summernote").summernote({

			disableResizeEditor: true,
			minHeight : 200,
		});

		$('#summernote_textarea').attr('name','content');

		$('#frmpages').submit(function(){
			$('textarea[name="content"]').val($('#summernote_content').html());
		});

	});
</script>
@if($errors->has('product_desc'))
	<script>
		$(document).ready(function(){
			$('#my_summernote_frame').css('border-color','#ea6b6b');
		});
	</script>
@endif
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
	
		<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Pages</li>
		</ol>
		<div class="box box-block bg-white">	
		
			<div class="row cc-row header-row">	
			<h3>Update Testimonials</h3>			
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
					<li class="demo-tabs"><a href="{{ route('admin.testimonials.index') }}" class="btn btn-black w-min-sm mb-0-25 waves-effect waves-light">Back</a></li>
					
				</ul>
			</div>

		</div>

		{!! Form::open(['id'=>'frmpages', 'files' =>'true','method'=>'PATCH', 'route' => ['admin.testimonials.update', $item->id]]) !!}
		 
		<div class="col-lg-9 col-md-9">			
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Avatar </label>
					<div class="col-xs-8">
						<input type="hidden" name="imageSrc" value="{{ $item->image }}">
						<input class="form-control" type="file" name="image" accept=".png, .jpg, .jpeg">
						@if($errors->has('image')) <span class="text-danger">{{$errors->first('image')}} </span> @endif

					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Name </label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="name" value="{{ $item['name'] }}">
						@if($errors->has('name')) <span class="text-danger">{{$errors->first('name')}} </span> @endif

					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Designation </label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="designation" value="{{ $item['designation'] }}">
						@if($errors->has('designation')) <span class="text-danger">{{$errors->first('designation')}} </span> @endif

					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Content</label>
					<div class="col-xs-8">
						<div id="summernote">{!! urldecode($item['content']) !!}</div>
						@if($errors->has('content')) <span class="text-danger">{{$errors->first('content')}} </span> @endif
					</div>
				</div>					
				
				<input type="hidden" name="status" value="yes">				
				<div class="form-group row">
				<label for="setbillingaddress" class="col-xs-4 col-form-label"> 	</label>					
					<div class="col-xs-8">
						<button class="btn btn-success" type="submit" name="btnSubmit">Submit</button>
						 
					</div>
				</div>
				 
		</div>
		<div class="col-lg-3 col-md-3">
		@if(!empty($item->image))
			<div class="col-xs-8">
				<img src="{{url('testimonials/'.$item->image)}}" class="dropify full-width">
			</div>
		@endif
		</div>
		<!-- </form> -->
		{{Form::close()}}
					
	</div>
@endsection
