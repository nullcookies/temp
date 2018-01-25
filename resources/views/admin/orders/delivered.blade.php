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
<script type="text/javascript">
	$().ready(function(){
		 
	});
	function changeStatus (id,status) {
		$.ajax({
			url: "{{url('admin/orders/ajaxUpdate')}}",
			type: 'POST',
			dataType: 'json',
			data: {id: id,status:status},
			beforeSend: function(){
				NProgress.start();
			},
			success: function(result){	
				console.log(result);			
				if (result != '') {
					$("#action" + id).parents("tr").hide();
					$("#totalCount").html(parseInt($("#totalCount").html()) - 1);
					if(result['success'].length > 0)
					{
						swal("Success !", result['success'], "success");
					}					
				}
				NProgress.done();
			},
		});
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
			<li class="breadcrumb-item active">Orders</li>
		</ol>
		@if ($message = Session::get('success'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>{{ $message }}</strong>
		</div>				
		@endif
		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3 class="head-position">{!! $title !!}</h3>
				<div class="pull-right">	 
					<form action="" method="get" id="fromSearch" class="form-inline">
						<div class="form-group">
							<label for="inputPassword2" class="sr-only">Search Category</label>
							<input type="text" class="form-control" name="search" id="search" placeholder="Search for Order ID" title="Search for Order ID">
						</div>
						<button type="submit" class="btn btn-primary"><i class="ti-search"></i></button>
					</form>
				</div>

			</div>	
			@if(count($orders) > 0)
			<div class="row shipping-label table-mobile">
				<table class="table table-striped">
					<thead>						
						<th>Order Id</th>						
						<th>Payment Type</th>
						<th>Invoice Value</th>						
						<th>Ship To</th>						
						<th style="width:8%">Product ID</th>
						<th style="width:30%">Product</th>
						<th>Price</th>
						<th>Varients</th>
						<th class="br-3">&nbsp; Action</th>
					</thead>
					<tbody id="ressult">	
					<tr>
						@foreach($orders as $order)						
						<td>{{ $order->id }}</td>						
						<td>{{ strToUpper($order->paymentType) }}</td>
						<td>{{ $order->orderAmount }}</td>
						<td><strong>{{ $order->customerName }}<br>{{ $order->customerEmail }}</strong><br>{!! $order->shippingCompleteAddress() !!}</td>						
						<td colspan="4">
							<table class="table mb-0">
							@foreach($order->products as $product)
								<tr>
									<td style="width:15%">{{ $product->product_id }}</td>
									<td style="width:60%">{{ $product->product_name }}</td>
									<td style="width:11%">{{ $product->selling_price }}</td>
									<td>{{ $product->varients }}</td>
								</tr>
							@endforeach
							</table>
						</td>
						<td id="action{!! $order->id !!}">											
							<a href="javascript:" onclick="changeStatus({!! $order->id !!},'completed')" class="btn btn-success btn-rounded mb-0-25 waves-effect waves-light" title="Mark Completed">Mark Completed</a>						
							
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			
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
@endsection
