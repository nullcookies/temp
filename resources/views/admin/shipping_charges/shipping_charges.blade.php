@extends('admin/layouts/layout')

@section('title')
	| {{$title}}
@endsection

@section('pageTopScripts')
	<style>
		

		table a .fa-arrow-circle-o-up{
			color: #20b9ae !important;
		}

		table a .fa-arrow-circle-o-down{
			color: #f59345 !important;
		}
	</style>
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/nprogress/nprogress.css')}}">
	
@endsection

@section('pageScripts')
	
	@if($errors->has('zone_name') || $errors->has('pincodes') || Session::has('incorrect_mime'))
		<script type="text/javascript"> 
		    $(document).ready(function(){
		        $("#add_shipping_modal").modal('show',{backdrop: 'static', keyboard: false});
		    });
		</script>
	@endif

	@foreach($weights as $weight)
		@if($errors->has($weight->weight_in_gms.'_gms'))
			<script type="text/javascript">
			    $(document).ready(function(){
			        $("#add_shipping_modal").modal('show',{backdrop: 'static', keyboard: false});
			    });
			</script>
		@endif
	@endforeach
	
	@if($errors->has('pincode_csv') ||  Session::has('incorrect_upload_csv_format'))
		<script type="text/javascript"> 
		    $(document).ready(function(){
		        $("#upload_pincode{!! Old('zone') !!}").modal('show',{backdrop: 'static', keyboard: false});
		    });
		</script>
	@endif

	@if($errors->has('new_zone_name') || $errors->has('new_zone_id') )
		<script type="text/javascript"> 
		    $(document).ready(function(){
		        $("#edit_zone{!! Old('new_zone_id') !!}").modal('show',{backdrop: 'static', keyboard: false});
		    });
		</script>
	@endif

	@foreach($weights as $weight)
		@if($errors->has('new_'.$weight->weight_in_gms))
			<script type="text/javascript">
			    $(document).ready(function(){
			        $("#edit_zone{!! Old('new_zone_id') !!}").modal('show',{backdrop: 'static', keyboard: false});
			    });
			</script>
		@endif
	@endforeach

	<script>
		$(document).ready(function(){

			$('#pincode_search').on('click',function(){
				var pincode 		=	$('#pincode_textbox').val();
				$.ajax({
					url: "{{url('/admin/shipping_charges/fetch_pincode')}}",
					type: 'post',
					dataType: 'html',
					data: {pincode:pincode},
					beforeSend: function(){
						NProgress.start();
					},
					success: function(json){
						NProgress.done();
						$('#pincode_search_result').html(json);
					},
				});
			});
		});
	</script>

	<script>
		$('#add_shipping_modal').on('shown.bs.modal', function () {
		    $.ajax({
		    	url: "{{url('/admin/shipping_charges/get_modal_content')}}",
		    	type: 'POST',
		    	dataType: 'html',
		    	beforeSend: function(){
		    		jQuery('<i/>', {
					    id: 'foo',
					    class: 'fa fa-spin fa-circle-o-notch',
					    style: 'font-size:20px;',
					}).appendTo('#add_shipping_modal_body');
					$('#add_shipping_modal_body').addClass('put_text_center');
		    	},
		    	success: function(result){
		    		$('#add_shipping_modal_body').removeClass('put_text_center');
		    		$('#add_shipping_modal_body').html(result);
		    		console.log(result);
		    	}
		    });
		});
	</script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/index.js')}}"></script>	
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/nprogress/nprogress.js')}}"></script>

@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')

@if($errors)
{{Session::flash('errors',$errors)}}
@endif

<div class="container-fluid">
	<h4>{{$title}}</h4>
	<ol class="breadcrumb no-bg mb-1">
		<li class="breadcrumb-item"><a href="{!! url(ADMIN_URL_PATH) !!}">Home</a></li>
		<li class="breadcrumb-item active">{{$title}}</li>
	</ol>

	<div class="row">
	</div>

	<div class="box box-block bg-white">
	   		<div class="row">
	   			<div class="col-md-3">
	   				<div class="form-group">
						<label class="">Search Pincode</label>
						<input type="text" name="q" placeholder="Type for search.." id="pincode_textbox" class="form-control mb-1">
						<span class="font-90 text-muted">EX: 251001, 201301</span>
					</div>
	   			</div>
	   			<div class="col-md-3">
	   				<div class="form-group">
	   					<label class="">&nbsp;</label>
						<input type="button" id="pincode_search" class="form-control btn btn-primary" value="Search">
					</div>
	   			</div>
	   		</div>
	   		<div id="pincode_search_result">
	   				
	   		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered mb-0">
						<thead>
							<tr>
								<th>#</th>
								<th>Zone Name</th>
								@foreach($weights as $weight)
									<th>{!! $weight->weight !!} charge</th>
								@endforeach
								<th>Pincodes</th>
							</tr>
						</thead>
						<tbody>
							@foreach($zones as $zone)
							<tr>
								<th scope="row">{{$index_items}}</th>
								<th>{{$zone->zone_name}}</th>
								@foreach($weights as $weight)
									<td>{{$charge[$zone->id][$weight->id]}}</td>
								@endforeach
								<th>{{$pincode[$zone->id]}}<span class="pull-right"><a href="{{url('/lteadmin/log_files/pincodes/pincode'.$zone->id.'.csv')}}" download><i data-placement="left" data-toggle="tooltip" title="Download {{$zone->zone_name}} Pincode CSV" class="fa fa-arrow-circle-o-down" aria-hidden="true"></i></a>
							

								<!-- edit zone details popup -->
							
								<!-- /edit zone details popup -->

								<!-- delete zone popup -->											

								

								<!-- /delete zone popup -->

								<!-- Upload Csv file  -->
							
								<!-- /Upload csv file -->
							</tr>
							<?php $index_items++; ?>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection