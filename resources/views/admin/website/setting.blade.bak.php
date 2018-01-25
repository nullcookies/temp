@extends('admin/layouts/layout')

@section('title')
| {{' Home Page Images'}}
@endsection

@section('pageTopScripts')
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/dropify/dist/css/dropify.min.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/owl.carousel/assets/owl.carousel.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/toastr/toastr.min.css')}}">
<style type="text/css">
	.dropify-wrapper.has-error .dropify-message .dropify-error, .dropify-wrapper.has-preview .dropify-clear, .dropify-infos-message {
		/*.dropify-wrapper.has-error .dropify-message .dropify-error, .dropify-infos-message {*/
    display: none;
}
.leftalign{left:9%;}
.btnoverimage{ padding: 4px 8px; position: absolute;right: 22px; text-transform: uppercase;top: 30px;z-index: 7;}
</style>
@endsection

@section('pageScripts')
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/dropify/dist/js/dropify.min.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/toastr/toastr.min.js')}}"></script>	

<script type="text/javascript">
	$().ready(function(){
		$('.dropify').dropify();
		toastr.options = {
			positionClass: 'toast-top-right'
		};
	});
	$(document).ready(function(){
		$('#img24 .message').html('Hello I am demo content for image delete.');
		//$('#img24 .message').css('color', 'RED');
		$('.owl-carousel').owlCarousel({
			loop: true,
			margin: 10,
			nav: true,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:3
				},
				1000:{
					items:5
				}
			}
		});		
		
	});

	function deleteimage(id){
		$.ajax({
			url: "{{url('admin/website-setting/imagedelete')}}",
			type: "POST",
			data: {id:id},
			dataType: 'json',
			success: function(result){
				console.log('#img'+result['id']+' .message');
				$('#img'+result['id']).css('display', 'none');				
				toastr.success(result['danger'] + '   ID: '+result['id']);
			}
		});
	}
</script>
@endsection
@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
<div class="content-area py-1">
	<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Website Setting</li>
		</ol>
		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3 class="head-position">{!! $title !!}</h3>
				<ul class="demo-header-actions">
				<li class="demo-tabs"><a class="btn btn-primary" href="{{ URL::to('admin/website-setting/sliders') }}">Add More Slide for Banner Image</a></li>
					
					<li class="demo-tabs"><a href="{{ URL::to('admin/website-setting/add') }}" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light" title="Manage Inventory by CSV"><i class="ti-correct"></i> Add or Update Image </a></li>
				</ul>
			</div>
			@if(Session::has('success'))
				<div class="alert alert-success alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong>{!! Session::get('success') !!}</strong>
				</div>				
				@endif
				@if(Session::has('danger'))
				<div class="alert alert-danger alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong>{!! Session::get('danger') !!}.</strong>
				</div>
				@endif
			<div class="box box-block bg-white">	
			
				@if(!empty($logo->image))
				<div class="col-md-3"> 
					<h5>Upload Image : Logo</h5>     
					<input type="hidden" id="{{$logo->image}}">					   
					<img data-default-file="{{url('product_images/banners/'.$logo->image)}}" class="dropify"> 	
					<!-- Image Crop <<-->
						{{Form::open(['method'=>'post', 'files' =>'true', 'action'=>['Admin\WebsiteSetting\WebsiteSettingController@postjcrop'],'style'=>'display:inline'])}}							
							<input type="hidden" id="w" name="w" value="{{ $logo['dim']['width'] }}" />
							<input type="hidden" id="h" name="h" value="{{ $logo['dim']['height'] }}" />
							<input type="hidden" name="imgpath" value="product_images/banners" />			
							<input type="hidden" name="img" value="{{ $logo->image }}" />	
							<input type="hidden" name="backlink" value="{{ url($_SERVER['REQUEST_URI']) }} " />			
							<button type="submit" class="btn btn-outline-secondary w-min-sm mb-0-25 waves-effect waves-light btnoverimage" name="btnImgSubmit" title="Crop Image">Crop Image</button>							
						{{Form::close()}}
						<!-- Image Crop  >>--> 				               
				</div>
				@endif
				@if(!empty($right1->image))
					<div class="col-md-3 mb-1"> 
						<h5>Image: Right 1</h5>						
						<input type="hidden" name="id" id="{{$right1->image}}">
						<img data-default-file="{{url('product_images/banners/'.$right1->image)}}" class="dropify">
						<!-- Image Crop <<-->
						{{Form::open(['method'=>'post', 'files' =>'true', 'action'=>['Admin\WebsiteSetting\WebsiteSettingController@postjcrop'],'style'=>'display:inline'])}}							
							<input type="hidden" id="w" name="w" value="{{ $right1['dim']['width'] }}" />
							<input type="hidden" id="h" name="h" value="{{ $right1['dim']['height'] }}" />
							<input type="hidden" name="imgpath" value="product_images/banners" />			
							<input type="hidden" name="img" value="{{ $right1->image }}" />	
							<input type="hidden" name="backlink" value="{{ url($_SERVER['REQUEST_URI']) }} " />			
							<button type="submit" class="btn btn-outline-secondary w-min-sm mb-0-25 waves-effect waves-light btnoverimage" name="btnImgSubmit" title="Crop Image">Crop Image</button>							
						{{Form::close()}}
						<!-- Image Crop  >>-->  
					</div>
					@endif
					@if(!empty($right2->image))
					<div class="col-md-3 mb-1"> 
						<h5>Image: Right 2</h5>
						<input type="hidden" name="id" id="{{$right2->image}}">
						<img data-default-file="{{url('product_images/banners/'.$right2->image)}}" class="dropify">
						<!-- Image Crop <<-->
						{{Form::open(['method'=>'post', 'files' =>'true', 'action'=>['Admin\WebsiteSetting\WebsiteSettingController@postjcrop'],'style'=>'display:inline'])}}							
							<input type="hidden" id="w" name="w" value="{{ $right2['dim']['width'] }}" />
							<input type="hidden" id="h" name="h" value="{{ $right2['dim']['height'] }}" />
							<input type="hidden" name="imgpath" value="product_images/banners" />			
							<input type="hidden" name="img" value="{{ $right2->image }}" />	
							<input type="hidden" name="backlink" value="{{ url($_SERVER['REQUEST_URI']) }} " />			
							<button type="submit" class="btn btn-outline-secondary w-min-sm mb-0-25 waves-effect waves-light btnoverimage" name="btnImgSubmit" title="Crop Image">Crop Image</button>							
						{{Form::close()}}
						<!-- Image Crop  >>-->  	
					</div>
					@endif
					@if(!empty($right3->image))
					<div class="col-md-3 mb-1"> 
						<h5>Image: Right 3</h5>
						<input type="hidden" name="id" value="{{$right3->image}}">    						    					               
						<img data-default-file="{{url('product_images/banners/'.$right3->image)}}" class="dropify">
						<!-- Image Crop <<-->
						{{Form::open(['method'=>'post', 'files' =>'true', 'action'=>['Admin\WebsiteSetting\WebsiteSettingController@postjcrop'],'style'=>'display:inline'])}}							
							<input type="hidden" id="w" name="w" value="{{ $right3['dim']['width'] }}" />
							<input type="hidden" id="h" name="h" value="{{ $right3['dim']['height'] }}" />
							<input type="hidden" name="imgpath" value="product_images/banners" />			
							<input type="hidden" name="img" value="{{ $right3->image }}" />	
							<input type="hidden" name="backlink" value="{{ url($_SERVER['REQUEST_URI']) }} " />			
							<button type="submit" class="btn btn-outline-secondary w-min-sm mb-0-25 waves-effect waves-light btnoverimage" name="btnImgSubmit" title="Crop Image">Crop Image</button>							
						{{Form::close()}}
						<!-- Image Crop  >>--> 
					</div>
					@endif
				
				@if(!empty($contentstrip->image))
				<div class="col-md-12 mb-1"> 
					<h5>Image: Content Strip</h5>     
					<input type="hidden" name="oid" value="{{$contentstrip->image}}">    
					<img data-default-file="{{url('product_images/banners/'.$contentstrip->image)}}" class="dropify">   					               
					<!-- Image Crop <<-->
					{{Form::open(['method'=>'post', 'files' =>'true', 'action'=>['Admin\WebsiteSetting\WebsiteSettingController@postjcrop'],'style'=>'display:inline'])}}							
						<input type="hidden" id="w" name="w" value="{{ $contentstrip['dim']['width'] }}" />
						<input type="hidden" id="h" name="h" value="{{ $contentstrip['dim']['height'] }}" />
						<input type="hidden" name="imgpath" value="product_images/banners" />			
						<input type="hidden" name="img" value="{{ $contentstrip->image }}" />	
						<input type="hidden" name="backlink" value="{{ url($_SERVER['REQUEST_URI']) }} " />			
						<button type="submit" class="btn btn-outline-secondary w-min-sm mb-0-25 waves-effect waves-light btnoverimage" name="btnImgSubmit" title="Crop Image">Crop Image</button>							
					{{Form::close()}}
					<!-- Image Crop  >>--> 
				</div>	
				@endif	
				@if(count($mainslider))
				<div class="col-md-6 mb-1">
					<h5>Banner Slider</h5> 	 	
					<div id="carousel-example" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carousel-example" data-slide-to="0" class="active"></li>
							<li data-target="#carousel-example" data-slide-to="1"></li>
							<li data-target="#carousel-example" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner" role="listbox">
						<?php $active = 1; ?>
							@foreach($mainslider as $slider)
							<div class="carousel-item <?php if($active == 1){echo "active";$active = 0;} ?>">
								@if(!empty($slider->image))
								<img src="{{url('product_images/banners/'.$slider->image)}}" alt="{{$slider->image}} slide" @if(!empty($slider->link)) href="{{$slider->link}}" @endif>
								@endif
							</div>
							@endforeach
							
						</div>
						<a class="left carousel-control" href="#carousel-example" role="button" data-slide="prev">
							<span class="icon-prev" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-example" role="button" data-slide="next">
							<span class="icon-next" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
				@endif
				
				<div class="col-md-12 mb-1"> 
				
					@foreach($mainslider as $slider)					
					<div class="col-md-3 mb-1" id="img{{$slider->id}}">	
					<h5>Banner Slider Image</h5>	

						<input type="hidden" name="oldimage" value="{{$slider->image}}">    
						<input type="hidden" name="id" value="{{$slider->id}}">    
						<img data-default-file="{{url('product_images/banners/'.$slider->image)}}" class="dropify">							
					<center><button class="btn btn-small btn-danger btnoverimage run-toast" title="Delete This Image" onclick="deleteimage({!! $slider->id !!})">X</button></center>
					<!-- Image Crop <<-->
					{{Form::open(['method'=>'post', 'files' =>'true', 'action'=>['Admin\WebsiteSetting\WebsiteSettingController@postjcrop'],'style'=>'display:inline'])}}							
						<input type="hidden" id="w" name="w" value="{{ $mainslider_dim['width'] }}" />
						<input type="hidden" id="h" name="h" value="{{ $mainslider_dim['height'] }}" />
						<input type="hidden" name="imgpath" value="product_images/banners" />			
						<input type="hidden" name="img" value="{{ $slider->image }}" />	
						<input type="hidden" name="backlink" value="{{ url($_SERVER['REQUEST_URI']) }} " />			
						<button type="submit" class="btn btn-outline-secondary w-min-sm mb-0-25 waves-effect waves-light btnoverimage leftalign" name="btnImgSubmit" title="Crop Image">Crop Image</button>							
					{{Form::close()}}
					<!-- Image Crop  >>--> 
					</div>
					@endforeach	
					
				</div>
			</div>		
		</div>
	</div>
</div>
@endsection