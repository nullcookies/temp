@extends('admin/layouts/layout')

@section('title')
| Update Invantory
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
function updateInventory(object){
	var productid = object.getAttribute('productid');
	var oldQty = object.getAttribute('oldqty');
	var rowObj = $('#inventory_'+productid);
	var updateQty = rowObj.find("input[name='qty']").val();
	$.ajax({
		url: "{{url('admin/product/updateInventory')}}",
		type: 'POST',
		dataType: 'json',
		data: {productid:productid, updateQty:updateQty},
		beforeSend: function(){
		},
		success: function(result){
			$('#inventory_'+productid).find(".quantity").removeClass('btn-danger btn-success');
			if(result['success']){
				var btnclass = result['newQty'] < 10 ? 'btn-danger' : 'btn-success';
				rowObj.find("input[name='qty']").val('');
				rowObj.find(".quantity").addClass(btnclass).text(result['newQty']);
				rowObj.find("button[name='updatebtn']").attr('oldqty',result['newQty'])
				swal(result['message'], "", "success");
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
				<h3 class="head-position">Update Invantory</h3>
				<ul class="demo-header-actions">
					<!-- <li class="demo-tabs"><a href="{{ URL::to('admin/product/downloadExcel/csv') }}" class="btn btn-black w-min-sm mb-0-25 waves-effect waves-light"><i class="ti-download"></i> Downkoad</a></li> -->
					<li class="demo-tabs"><a href="{{ URL::to('admin/product/importExport') }}" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light" title="Manage Inventory by CSV"><i class="ti-export"></i> Export</a></li>
				</ul>
			</div>
			<div class="row shipping-label table-mobile">
			{!! Form::open(array('method' => 'get','action' => 'Admin\Product\ProductController@inventory')) !!}
				<div class="col-lg-12">
					<label for="search"><span style="font-weight:bold">Search Upc:&nbsp;&nbsp;</span></label> 
					<input type="text" style="padding:4px;" name="q" value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''?>" />				
					<button class="btn btn-success search-btn" type="submit">Search</button>
					<a class="btn btn-warning search-btn" href="{{url('/admin/product/inventory')}}">Show All</a>
				</div>
			{{Form::close()}}
				<table class="table table-striped table-center">
					<thead>
						<tr>
							<th class="br-3">UPC</th>
							<th class="br-3">Name</th>
							<th class="br-1">Remaining</th>							
							<th class="br-1">New</th>							
							<th class="br-1">Action</th>														
						</tr>
					</thead>
					<tbody>		
						@if(count($products))		

						@foreach($products as $product)
						<?php	$class 	   = ($product->quantity < 10) ? "btn-danger" : "btn-success" ; ?>
						<tr id="inventory_{{$product->id}}">
							<td>UPC{{ $product->id }}</td>																		
							<td>{{ $product->product_name }}</td>
							<td class="quantity {{$class}}">{{ $product->quantity }}</td>
							<td><input type="number" name="qty" min="1" max="1000" value="" class="form-control newQuantity"></div></td>							
							<td style="text-align:center"><button name="updatebtn" type="button" productid="{{ $product->id }}" oldqty="{{$product->quantity}}" class="btn btn-primary btn-sm" onclick="updateInventory(this)">Update</button></td>
						</tr>
						@endforeach
						@else
						<td colspan="12" align="center">No Data Found</td>
						@endif

					</tbody>
				</table>				
				@if(count($products) > 0)		 
					<span>{!! $products->render() !!}</span>
				@endif
			</div>
			
			
		</div>
	</div>
</div>

@endsection
