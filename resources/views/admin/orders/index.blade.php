@extends('admin/layouts/layout')

@section('title')
| {{$title}}
@endsection

@section('pageTopScripts')
<style>
</style>

<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.css')}}">

@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>	
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>	
<script type="text/javascript">
$('input[name=all]').on('change', function() {
	if($(this).is(':checked')){
		window.location.href= '{{url("/admin/orders")}}';
	}    
});
$('.mydatepicker').datepicker();
</script>
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
<div class="container-fluid">
	<ol class="breadcrumb no-bg mb-1">
		<li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
		<li class="breadcrumb-item active">{!! $title !!}</li>
	</ol>
	<div class="row">
		<div class="col-md-6 mb-1 mb-md-0">
			@if(Session::has('success'))
			<div class="alert alert-success alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<strong>{!! Session::get('success') !!}.</strong>
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
		</div>
	</div>
	<div class="box box-block bg-white">
		<div class="row view-products">
			<h3>View Orders</h3>
			{{Form::open(['method'=>'get','action'=>['Admin\Orders\OrdersController@index']])}}
			<ul class="pull-left">
				<li class="demo-tabs"><a href="{{url('admin/orders/admin-order')}}" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Add Order</a></li>
			</ul>
			<ul class="demo-header-actions">					
			<li class="demo-tabs">						
				<select class="filter-order" name="status">
					@foreach($status as $keys => $value)
					<option value="{{$keys}}" <?php echo (isset($_GET['status']) && $keys == $_GET['status']) ? "selected" : '' ?> >{{$value}}</option>
					@endforeach
				</select>
			</li>
			<li class="demo-tabs"><button class="btn btn-success search-btn" type="submit">Filter</button></li>
			

		</ul>
		{{Form::close()}}
	</div>
	<div class="row view-products-heading table-mobile">
		{{Form::open(['method'=>'get','action'=>['Admin\Orders\OrdersController@index']])}}
		<div class="col-lg-12">
			<label for="search"><span style="font-weight:bold">Search :&nbsp;&nbsp;</span></label> 
			<input type="text" style="padding:4px;" name="key" value="<?php echo isset($_GET['key']) ? $_GET['key'] : ''?>" />
			<div class="btn-group float-right" role="group">
				<select class="select-order" name="opt">
					<option value="">Select</option>
					<option value="id" @if($opt == 'id') selected @endif>Order ID</option>
					<option value="customerName" @if($opt == 'customerName') selected @endif>Customer Name</option>
					<option value="customerPhone" @if($opt == 'customerPhone') selected @endif>Customer Phone Number</option>
					<option value="customerEmail" @if($opt == 'customerEmail') selected @endif>Customer Email</option>
					<option value="paymentType" @if($opt == 'paymentType') selected @endif>Payment Mode</option>
					<!-- <option value="courier" @if($opt == 'courier') selected @endif>Courier Company</option> 
					<option value="tracking_number" @if($opt == 'tracking_number') selected @endif>Tracking Number</option>-->
				</select>
			</div>
			<label for="category" class="ml-50"><span style="font-weight:bold">Order Date :&nbsp;&nbsp;</span></label>
			<div class="btn-group float-right pr-20">
				<input type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy" name="start_date" value="">
				<!-- <input type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy" name="end_date" value="03/01/2017"> -->
			</div>				
			<button class="btn btn-success search-btn" type="submit">Search</button>
		</div>
		{{Form::close()}}
	</div>
	
	<div class="row table-mobile">

		<table class="table table-striped ">
			<thead>
				<tr>
					<!-- <th></th> -->						
					<th>Order Id</th>						
					<th>Payment Type</th>
					<th>Invoice Value</th>						
					<th>Ship To</th>						
					<th style="width:10%">Product ID</th>
					<th style="width:25%">Product</th>
					<th>Price</th>
					<th>Varients</th>
					<th>Order Status</th>
				</tr>
			</thead>
			<tbody>


				@if(!count($orders))
				<tr>
					<td colspan="9" align="center">No record found.</td>
				</tr>
				@endif

				@foreach($orders as $order)
				<tr>
					<!-- <td>
						{!! Form::open(array('method' => 'delete', 'action' => ['Admin\Orders\OrdersController@deleteorder'])) !!}
						<input type="hidden" name="id" value="{{$order->id}}">
						<a href="javascript:;" title="Delete" style="color:#ff0000" data-toggle="modal" data-target="#delete_{{$order->id}}"><i class="fa fa-times"></i></a>
						<div class="modal fade small-modal in" id="delete_{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<h4 class="modal-title" id="mySmallModalLabel">Orders Delete Confirmation</h4>
									</div>
									<div class="modal-body">
										Are you sure to delete this record ?
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary">yes</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">no</button>
									</div>
								</div>
							</div>
						</div>
						{!! Form::close() !!}							  	
					</td> -->
					<td>{{ $order->id }}</td>						
					<td>{{ strToUpper($order->paymentType) }}</td>
					<td>{{ $order->orderAmount }}</td>
					<td><strong>{{ $order->customerName }}<br>{{ $order->customerEmail }}</strong><br>{!! $order->shippingCompleteAddress() !!}</td>						
					<td colspan="4">
						<table class="table mb-0">
						@foreach($order->products as $product)
							<tr>
								<td style="width:15%">{{ $product->product_id }}</td>
								<td style="width:50%">{{ $product->product_name }}</td>
								<td style="width:15%">{{ $product->selling_price }}</td>
								<td>{{ $product->varients }}</td>
							</tr>
						@endforeach
						</table>
					</td>
					<td><a href="{{url('admin/orders/trackOrder/'.$order->id)}}" class="btn btn-sm btn-info btn-rounded mb-0 w-min-xs waves-effect waves-light">More info</a></td> 							
					</tr>
					@endforeach
				</tbody>
			</table>
			
			@if(count($orders) > 0)		 
			<div class="table-footer">
				<div class="col-md-3"><div class="dataTables_info" id="table-3_info" role="status" aria-live="polite">Total {{$orders->total()}} records</div></div>
				<div class="col-md-9">
				@include('admin.pagination.limit_links', ['paginator' => $orders->appends(['status' => isset($_GET['status']) ? $_GET['status'] : 'all' ])])
				</div>
			</div>
			@endif
			
			
		</div>	

	</div>

</div>
@endsection
