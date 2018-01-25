@extends('admin/layouts/layout')

@section('title')
| {{'Product List'}}
@endsection

@section('pageTopScripts')
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/multi_select/css/multi-select.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/clockpicker/dist/bootstrap-clockpicker.min.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')}}">

<style>

	.radius12{
		border-radius: 12px !important;
	}
	.view-products-row table td:nth-child(7) {width: 1%;}
</style>
@endsection

@section('pageScripts')
<script>
	$("#selectall").change(function () {
		$("input:checkbox").prop('checked', $(this).prop("checked"));
		$("input:checkbox").prop('checked', $(this).prop("checked"));
	});
</script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/index.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/multi_select/js/jquery.multi-select.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/moment/moment.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/forms-pickers.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.min.js')}}"></script>
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')

<div class="container-fluid">
	<h4>Products</h4>
	<ol class="breadcrumb no-bg mb-1">
		<li class="breadcrumb-item"><a href="{{url(ADMIN_URL_PATH)}}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{url(ADMIN_URL_PATH.'/product')}}">Products</a></li>
		</ol>
	<div class="box box-block bg-white">
		<div class="row header-row">
			<h3 class="head-position">View Products</h3>
			<ul class="demo-header-actions">
			<li class="demo-tabs">
					{!! Form::open(array('method' => 'get', 'action' => ['Admin\Product\ProductController@index'])) !!}					
						<div class="col-md-9">
							<div class="form-group">
								<input type="text" class="form-control" name="c" value="{!! isset($_GET['c']) ? $_GET['c'] : '' !!}" placeholder="Search by Product name or category">
							</div>
						</div>
						<div class="col-md-3">
							<input type="submit" class="btn btn-success" value="Search" name="">
						</div>					
					{!! Form::close() !!} 
				</li>
				<li class="demo-tabs"><a href="{{url(ADMIN_URL_PATH.'/product/upload')}}" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Upload Product</a></li>
				
			</ul>
		</div>
		
		<div class="row view-products-row table-mobile">
			<table class="table table-striped">
				<thead>
					<tr>
						<th><!-- <input type="checkbox" id="selectall"/> -->#</th>
						<th>SN</th>												
						<th>Image</th>
						<th>Product Name</th>
						<th>SKU</th>
						<th>UPC</th>
						<th>Categories</th>
						<th>MRP</th>
						<th>Selling Price</th>
						<th>Quantity</th>
						<!-- <th>Status</th> -->
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($products as $product)
					<tr>
						{!! Form::open(array('method' => 'delete', 'action' => 'Admin\Product\ProductController@deleteProduct')) !!}
						<input type="hidden" name="c" value="{{$product->upc}}">
						<td><a href="javascript:;" data-toggle="modal" data-target="#delete_product_{{$product->upc}}" class="radius12"><i class="fa fa-times"></i></a>
							<div class="modal animated tada small-modal" id="delete_product_{{$product->upc}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
											<h4 class="modal-title" id="mySmallModalLabel">Confirmation Popup</h4>
										</div>
										<div class="modal-body">
											Are you sure to delete this product ?
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary">yes</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">no</button>
										</div>
									</div>
								</div>
							</div>
						</td>
						{!! Form::close() !!}
						<td>{{$index_items}}</td>													
						<td>
							<a href="{{url('admin/product/productimages?upc='.$product->upc)}}"><img src="{!! url('product_images/50x50/', [$product->product_image]) !!}" width="50" height="50" title="Product 1"/></a>



						</td>

						<td>{{$product->product_name}}</td>
						<td>{{$product->sku}}</td>
						<td>UPC{{$product->upc}}</td>
						<td>{!! $category[$product->upc] !!}</td>
						<td style="width:6%"><i class="fa fa-inr"></i> {{$product->product_mrp}}</td>
						<td><i class="fa fa-inr"></i> {{$product->product_selling_price}}</td>
						<td>{{$product->quantity}}</td>
						<!-- <td><div class="ss-checkbox"><input type="checkbox" class="js-switch" data-size="small" data-color="#43b968" checked></div></td> -->
						<td>
							{!! Form::open(array('method' => 'get', 'action' => ['Admin\Product\ProductController@editProduct'] )) !!}
							<input type="hidden" name="c" value="{{$product->upc}}" >
							<ul id="menu" style="margin-top:10px;padding-left:5px;">
								<li><button type="submit" class="btn btn-success" title="Edit Product" data-placement="left" data-toggle="tooltip"><i class="fa fa-pencil"></i></button></li>
							</ul>
							{!! Form::close() !!}

							{!! Form::open(array('method' => 'get', 'action' => ['Admin\Varients\AssignVarientsController@index'])) !!}
							<input type="hidden" name="c" value="{{$product->upc}}" >
							<ul id="menu" style="margin-top:10px;padding-left:5px;">
								<li><button type="submit" class="btn btn-primary" data-placement="left" data-toggle="tooltip" title="Add Varients"><i class="fa fa-plus-square"></i></button></li>
							</ul>
							{!! Form::close() !!}
							<ul id="menu" style="margin-top:10px;padding-left:5px;">
								<?php $productLink = url('products/product_detail?product_id='.$product->upc) ?>
								<li><button type="submit" class="btn btn-warning" data-placement="left" data-toggle="tooltip" onclick="window.open('{{$productLink}}','_blank')" title="See product on website"><i class="fa fa-eye" aria-hidden="true"></i></button></li>
							</ul>
						</td>
					</tr>
					<?php $index_items++; ?>
					@endforeach
				</tbody>
			</table>
			<div class="pull-left"><span>Total {!! $products->total() !!} Product</span></div>
			<div class="row pagination">
				@include('admin.pagination.limit_links', ['paginator' => $products])
			</div>
		</div>

	</div>
</div>					
@endsection