@extends('admin/layouts/layout')

@section('title')
Mail Me
@endsection

@section('pageTopScripts')
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')}}">
<link rel="stylesheet" href="{{asset('css/sweetalert.css')}}"/>
@endsection

@section('pageScripts')
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.min.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
@if(Session::has('success'))
	<script>
	  $(document).ready(function(){
	    swal("Mail Sent Successfully!", "", "success");
	  });
	</script>
@endif
<script>
	$(document).ready(function(){
		$("#summernote").summernote({
			disableResizeEditor: true,
			minHeight : 200,
		});

		$('#summernote').html('');
		$('#summernote_textarea').attr('name','message_body');
		$('#contactfrm').submit(function(){
			$('textarea[name="message_body"]').val($('#summernote_content').html());
		});
	});

</script>
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
<div class="content-area py-1">
	<div class="container-fluid">
		<h4>Contact Us</h4>
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Mailing</li>
		</ol>
		<div class="row">
			<div class="col-md-6 mb-1 mb-md-0">
			

				@if(Session::has('danger'))
				<div class="alert alert-danger alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong>{!! Session::get('danger') !!}.</strong>
				</div>
				@endif
			</div>
		</div>
		<div class="box-block bg-white">
			<h5>Sending Mail To {{ isset($_GET['n']) ? $_GET['n'] : 'Customer Care'}} </h5>
			<p class="text-muted mb-1">You will receive the reply over here as well as over your mail.</p>
			{!! Form::open(['method' => 'post', 'id' => 'contactfrm', 'action' => ['Admin\Contact\ContactController@postcontact']]) !!}
			<div class="form-group row">
				<label for="sendingto" class="col-sm-2 col-form-label">Sending To</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="sendingto" name="email" placeholder="info@example.com" value="@if(isset($_GET['e']) && !empty($_GET['e'])) {{ $_GET['e'] }} @endif">
					@if($errors->has('email')) <span class="text-danger">{{ $errors->first('email') }} </span>@endif
				</div>
			</div>
			<div class="form-group row">
				<label for="subject" class="col-sm-2 col-form-label">Subject</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
					@if($errors->has('subject')) <span class="text-danger">{{ $errors->first('subject') }} </span>@endif
				</div>
			</div>
			<div class="form-group row">
				<div id="summernote"></div>@if($errors->has('message_body')) <span class="text-danger">{{ $errors->first('message_body') }} </span>@endif
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
					<center><button type="submit" class="btn btn-purple">Send Mail</button></center>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection