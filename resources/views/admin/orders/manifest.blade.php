@extends('admin/layouts/layout')

@section('title')
| {{$title}}
@endsection

@section('pageTopScripts')
<style>
</style>

<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/sweetalert2/sweetalert2.min.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/switchery/dist/switchery.min.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/nprogress/nprogress.css')}}">
@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/switchery/dist/switchery.min.js')}}"></script>	
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/sweetalert2/sweetalert2.min.js')}}"></script>	
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/nprogress/nprogress.js')}}"></script>
<script>	
	$(document).ready(function(){

		$('input[name="orderid[]"]').on('change', function(event){
			if($('input[name="orderid[]"]:checked').length){
				$('#saveMultipleManifest').removeAttr('disabled');
			}else{
				$('#saveMultipleManifest').attr('disabled','disabled');
			}
		});

		$('#saveMultipleManifest').on('click', function(event){
			$('#bulkMenifestForm').submit();
		});
		

		$('input:radio[name=filter]').on('change',function(e){
			getData(1);
		});		
	});
	function getData(page) {
		var filter = $('input[name="filter"]:checked').val(); 
		var url = '<?php echo url("/admin/orders/manifest"); ?>';
		var str = '?s='+filter;
		window.location.href = url+str;		
	}

	function enableManifiest(thisPass, orderid) {
		var thisObj = $(thisPass);
		$(".bulkmanifest"+orderid).removeAttr('disabled');
		$(thisObj).parent().find(".manifest").show();
		$(thisObj).parent().find(".oldManifest").hide();
		$(thisObj).parent().find(".mani").hide();
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
			<li class="breadcrumb-item active">Manifest</li>
		</ol>
		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3>{!! $title !!}</h3>
				<div class="pull-left">
					<span>Filter :</span>
					<span>
						<input type="radio" name="filter" id="fulfill" value="today" @if(isset($_GET['s']) && ($_GET['s'] == 'today')) checked="" @endif onclick="getData(<?php echo isset($_GET['page']) ?$_GET['page']:1 ?> )" ><label for="fulfill">Fullfilled Today</label>
					</span>
					<span>
						<input type="radio" name="filter" id="delayed" value="delayed" @if(isset($_GET['s']) && ($_GET['s'] == 'delayed')) checked="" @endif onclick="getData(<?php echo isset($_GET['page']) ?$_GET['page']:1 ?> )" ><label for="delayed">Delayed</label>
					</span>
					<span>
						<input type="radio" name="filter" id="manifest" value="manifested" @if(isset($_GET['s']) && ($_GET['s'] == 'manifested')) checked="" @endif onclick="getData(<?php echo isset($_GET['page']) ?$_GET['page']:1 ?> )" ><label for="manifest">Manifested</label>
					</span>
				</div>
				<div class="pull-right">	 
				<form action="" method="get" id="fromSearch" class="form-inline">
						<div class="form-group">
							<label for="inputPassword2" class="sr-only">Search Category</label>
							<input type="text" class="form-control" name="search" id="appendedInputButton" placeholder="Search for...ID/Customer Phone" title="Search..ID/Customer Phone">
						</div>
						<button type="submit" class="btn btn-primary"><i class="ti-search"></i></button>
					</form>
				</div>
			</div>	
			@if(count($orders) > 0)
			<div class="row shipping-label table-mobile">
			<span>
				<button id="saveMultipleManifest" disabled class="btn btn-primary pull-right mb-10">Generate Manifest</button>
			</span>
			{!! Form::open(array('id' => 'bulkMenifestForm', 'method' => 'post', 'action' => ['Admin\Orders\OrdersController@saveBulkMenifest'])) !!}
				<table class="table table-striped">
					<thead>
						<tr>
						<th>Check</th>
						<th>Order Id</th>						
						<th>Payment Type</th>
						<th>Invoice Value</th>						
						<th>Ship To</th>						
						<th style="width:8%">Product ID</th>
						<th style="width:25%">Product</th>
						<th>Price</th>
						<th>Varients</th>
						<th class="br-3">&nbsp; Action</th>
						</tr>
					</thead>
					<tbody>			
						@foreach($orders as $order)

						<tr class="mani">
						@if($order->status == 'manifest')
							<input type="hidden" name="alreadyManifested" value="1">
						@endif
						<td><input type="checkbox" class="bulkmanifest{{$order->id}}" name="orderid[]" value="{{$order->id}}" @if($order->shipping_label_printed == 'no') disabled  @endif ></td>
							<td>{{ $order->id }}</td>						
						<td>{{ strToUpper($order->paymentType) }}</td>
						<td>{{ $order->orderAmount }}</td>
						<td><strong>{{ $order->customerName }}<br>{{ $order->customerEmail }}</strong><br>{!! $order->shippingCompleteAddress() !!}</td>						
						<td colspan="4">
							<table class="table">
							<?php $productTypeArr = array(); ?>
							@foreach($order->products as $product)
							    <?php $productTypeArr[] = $product->product_type; ?>
								<tr>
									<td style="width:15%">{{ $product->product_id }}</td>
									<td style="width:55%">{{ $product->product_name }}</td>
									<td style="width:13%">{{ $product->selling_price }}</td>
									<td>{{ $product->varients }}</td>
								</tr>
							@endforeach
							</table>
						</td> 	
							<td>
								@if(!in_array('api',$productTypeArr))<a target='_blank' href="{{url('admin/orders/shippinglabel/'.$order->id)}}" class='btn btn-primary btn-rounded btn-sm mb-0-25 waves-effect waves-light' onclick='enableManifiest(this, {{$order->id}})' >Shipping Label</a>@endif
								<!-- @if($order->shipping_label_printed == 'no')
								<a target='_blank' href="{{url('admin/orders/manifestlabel/'.$order->id)}}" class='btn btn-info btn-rounded btn-sm mb-0-25 waves-effect waves-light manifest' onclick='enableManifiest(this, {{$order->id}})' style='display:none;' >Genrate Manifest</a>
								<a class='btn btn-outline-black btn-rounded disabled oldManifest btn-sm mb-0-25 waves-effect waves-light'>Genrate Manifest</a>							
								@else
								<a target='_blank' href="{{url('admin/orders/manifestlabel/'.$order->id)}}" class='btn btn-info btn-rounded btn-sm mb-0-25 waves-effect waves-light manifest' >Genrate Manifest</a>
								@endif -->
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			{!! Form::close() !!}
			</div>	

			@else
			<div class="row shipping-label table-mobile">
				<div class="panel panel-default">
					<div class="panel-body">
						<p>No record found</p>
					</div>
				</div>
			</div>
			@endif
            
		</div>
	</div>
</div>

@endsection
