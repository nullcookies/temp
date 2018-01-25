@extends('admin/layouts/layout')

@section('title')
| {{$title}}
@endsection

@section('pageTopScripts')
<style>
	th {
		text-align: center !important;
	}
	.input-error{
		border: 2px solid #ff0000 !important;
		background: #ffecec !important;
	}
</style>

<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/sweetalert2/sweetalert2.min.css')}}">

@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/sweetalert2/sweetalert2.min.js')}}"></script>	

<script>	
	function updateInventory(thisObj) {  
		var $this = $(thisObj);
		var newQuantity = $this.parents("tr").find('.newQuantity').val(); 
		var id = $this.parent().find("button").attr("data-val");
		var committedQty = $this.parents("tr").find('.committed').html(); 
		var qty = +$this.parent().find("button").attr("old-quantity") + +newQuantity;
		if (!(/^\+?(0|[1-9]\d*)$/.test(newQuantity))) {
			$this.parents("tr").find('.newQuantity').addClass("input-error");
			return false;
		}
		$this.parents("tr").find('.newQuantity').removeClass("input-error");	 
		$.ajax({
			url: "{{url('admin/product/inventory')}}",
			type: 'post',
			dataType: 'json',
			data: {newQuantity: qty, id: id},
			success: function(result){
				console.log(result);
				if (result.status == 1) {
					$this.parents("tr").find('.newQuantity').val('');
					$this.parents("tr").find('.quantity').html(qty);
					$this.parent().find("button").attr("old-quantity",qty);
					if (parseInt(committedQty) > parseInt(qty)) {
						$this.parents("tr").find('.quantity').removeClass('btn-success').addClass('btn-danger');
					} else {
						$this.parents("tr").find('.quantity').removeClass('btn-danger').addClass('btn-success');
					}
				}

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
			<li class="breadcrumb-item active">Manifest</li>
		</ol>
		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3 class="head-position">{!! $title !!}</h3>
				<ul class="demo-header-actions">
					<!-- <li class="demo-tabs"><a href="{{ URL::to('admin/product/downloadExcel/csv') }}" class="btn btn-black w-min-sm mb-0-25 waves-effect waves-light"><i class="ti-download"></i> Downkoad</a></li> -->
					<li class="demo-tabs"><a href="{{ URL::to('admin/product/importExport') }}" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light" title="Manage Inventory by CSV"><i class="ti-export"></i> Export</a></li>
				</ul>
			</div>
			<div class="row shipping-label table-mobile">
				<table class="table table-striped table-center">
					<thead>
						<tr>
							<th class="br-3">UPC</th>							
							<th class="br-3">Name</th>
							<th class="br-1">Varient</th>										

							<!--<th class="br-3">Committed</th>-->
							<th class="br-1">Remaining</th>							
							<th class="br-1">New</th>							
							<th class="br-1">Action</th>														
						</tr>
					</thead>
					<tbody>		
						@if(count($products))		

						@foreach($products as $product)
						<?php 
						$class = ((int)($product->quantity) < (int)($product->committedQuantity)) ? "btn-danger" : "btn-success" ;
						$remaining = $product->quantity - $product->substracted_quantity; 
						?>
						<tr>
							<td>UPC{{ $product->product_id }}</td>																		
							<td>{{ $product->product }}</td>
							<td>{{ $product->varient }}</td>
							<!--<td class="committed">{{ $product->committedQuantity }}</td>-->
							<td class="{!! $class !!} quantity">{{ $remaining }}</td>
							<td><input type="text" class="form-control newQuantity"></div></td>							
							<td style="text-align:center"><button type="button" data-val="{{ $product->id }}" old-quantity="{{ $product->quantity }}" class="btn btn-primary btn-sm" onclick="updateInventory(this)">Update</button></td>
						</tr>
						@endforeach
						@else
						<td colspan="12" align="center">No Data Found</td>
						@endif

					</tbody>
				</table>				
				@if(count($products) > 0)		 
				<div class="table-footer">
					<div class="col-md-3"><div class="dataTables_info" id="table-3_info" role="status" aria-live="polite">Total {{$products->total()}} records</div></div>
					<div class="col-md-9">
						@include('admin.pagination.limit_links', ['paginator' => $products])
					</div>
				</div>
				@endif
			</div>
			
			
		</div>
	</div>
</div>

@endsection
