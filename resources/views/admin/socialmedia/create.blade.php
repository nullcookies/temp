@extends('admin/layouts/layout')

@section('title')
| Homepage Social Media
@endsection

@section('pageTopScripts')

<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	
<script>
function makeslug(name)
{	
	$('input [name=slug').val("{{ str_slug('"+name+"', '_') }}")
}
</script>
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
	
		<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Add Social Media</li>
		</ol>
		<div class="box box-block bg-white">
			
		</div>
		{!! Form::open(array('action' => 'Admin\WebsiteSetting\WebsiteSettingController@postsocial','method'=>'POST')) !!}
		 
		<div class="col-lg-6 col-md-10">				
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label"> Name </label>
					<div class="col-xs-8">			
						{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'onblur' => 'makeslug(this.value)')) !!}
						@if($errors->has('name')) <span class="text-danger">{{ $errors->first('name') }} </span> @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label"> Alias </label>
					<div class="col-xs-8">					
						{!! Form::text('slug', null, array('placeholder' => 'Alias (use for Font Awesome Icon)','class' => 'form-control')) !!}
						@if($errors->has('slug')) <span class="text-danger">{{ $errors->first('slug') }} </span> @endif
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label"> Link </label>
					<div class="col-xs-8">
						{!! Form::text('link', null, array('placeholder' => 'Link','class' => 'form-control')) !!}
						@if($errors->has('link')) <span class="text-danger">{{ $errors->first('link') }} </span> @endif
					</div>
				</div>
				<div class="form-group row">
				<label for="example-text-input" class="col-xs-4 col-form-label">&nbsp;</label>
				<div class="col-xs-8">
				<button class="btn btn-success" type="submit" name="btnSubmit">Submit</button>
				</div>
				</div>
		</div>
		
		<!-- </form> -->
		{{Form::close()}}
					
	</div>
@endsection
