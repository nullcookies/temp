@extends('admin/layouts/layout')

@section('title')
| {{$title}}
@endsection

@section('pageTopScripts')
<style>
</style>

<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">

@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	

<script>
$("#selectall").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});
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
			<div class="row" style="border-bottom:1px solid #ccc; padding-bottom:10px;">
				<h3>{!! $title !!}</h3>
			</div>
			<div class="row shipping-label table-mobile">
				<table class="table table-striped table-center">
					<thead>
						<tr>
							<th class="br-3">Order ID</th>
							<th class="br-1">Quantity</th>
							<th class="br-1">Payment Type</th>
							<th class="br-1">Product</th>
							<th class="br-1">Varient</th>
							<th class="br-1">Ship To</th>
							<th class="br-1">Invoice Value</th>
							<th class="br-3"><input type="checkbox" id="selectall"/>&nbsp; Mark All</th>
						</tr>
					</thead>
					<tbody>
					@foreach($orders as $order)
						<tr>
							<td>{{ $order->id }}</td>													
							<td>{{ $order->quantity }} Items</td>
							<td>{{ strToUpper($order->paymentType) }}</td>
							<td>{{ $order->product }}</td>
							<td>{{ $order->varient }}</td>
							<td>{{ $order->varient }} </td>
							<td>{{ $order->orderAmount }} </td>
							<td style="text-align:center"><input type="checkbox" style="margin-top:6px"/></td>
						</tr>
					@endforeach
						
					</tbody>
				</table>
				<div class="row pagination">
					@include('admin.pagination.limit_links', ['paginator' => $orders])
				</div>
			</div>
			
			<div class="col-md-12">
				<div class="setup-submit">
					<input type="button" value="Generate Shipping Label" class="btn btn-success btn-setup-submit">
				</div>
			</div>	
		</div>
	</div>
</div>

@endsection
