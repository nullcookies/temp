@extends('admin/layouts/layout')

@section('title')
| {{$title}}
@endsection

@section('pageTopScripts')
<style>
legend {font-size: 1.2rem;width: 21.6%;}
fieldset{border:1px solid #ccc;}
</style>

<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/select2/dist/css/select2.min.css')}}">

@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	
	
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/select2/dist/js/select2.min.js')}}"></script>	

<script type="text/javascript">
	function getCity (stateid) {
		$.ajax({
			url:'{{url("/admin/orders/showcity")}}',
			type:'post',
			dataType: 'html',
			data:{stateid:stateid},
			success: function(result){
				console.log(result);
				$('#cityies').html(result);
			}
		});
	}
	function setProduct (id) {
		//setPrice(id);
		$.ajax({
			url:'{{url("/admin/orders/setProductData")}}',
			type:'post',
			dataType:'json',
			data:{id:id},
			success: function(productResult){				
				result = productResult['product'];
				varientTypes = productResult['varientTypes'];
				varients = productResult['varients'];
				$('input[name=productCode]').val(result['id']);
				$('input[name=productName]').val(result['product_name']);
				$('input[name=productAmount]').val(result['product_selling_price']);
				$('input[name=price]').val(result['product_selling_price']);

				$('input[name=quantity]').val(result['quantity']);				
				$('input[name=mrp]').val(result['product_mrp']);
				$('input[name=weight]').val(result['weight']);
				
				var varCount = varients.length;
				for(i=0; i<varCount; i++){
					$('#varientTypeValue_'+varients[i]['varient_type_id']).html('');
				}				

				for(i=0; i<varCount; i++){
					//console.log('#varientTypeValue_'+varients[i]['varient_type_id']);
					$('#varientTypeValue_'+varients[i]['varient_type_id']).append('<option value="'+varients[i]['id']+'">'+varients[i]['value']+'</option>')
				}				
			}
		});
	}
	/*function setPrice(id){
		$.ajax({
			type: 'POST',
			url: '{{url("admin/orders/productVarientPrice")}}',
			dataType:'json',
			data: {id:id},
			success: function(result){
				console.log(result);
			},
		});
	}*/
	$().ready(function(){
		/*var selectedState = $("input[name=CustomerState] option:selected").val();
		getCity(selectedState);*/
		/*$('input[name=CustomerPostCode').click(function(){
			alert(this.lenght);
		});*/
		$('select [name=varientTypeValue]').on('change', function(){
			var varientType = $(this).val(); alert(varientType);
		});
	});
	$('[data-plugin="select2"]').select2($(this).attr('data-options'));
</script>
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
	<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">{{$title}}</li>
		</ol>
		<div class="box box-block bg-white">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
		
			<div class="row cc-row header-row">
				<h3 class="head-position">{{$title}}</h3>
				<ul class="demo-header-actions">
				@if(Session::has('success'))
				<li class="demo-tabs alert alert-success alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong>{!! Session::get('success') !!}.</strong>				
				</li>
				@endif
				@if(Session::has('danger'))
				<li class="demo-tabs alert alert-danger alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						<strong>{!! Session::get('danger') !!}.</strong>
				</li>
				@endif
				
				<li class="demo-tabs"><a href="{{url('/admin/orders/view')}}" class="btn btn-black w-min-sm mb-0-25 waves-effect waves-light">Back</a></li>
					
				</ul>
			</div>
		</div>
		{{Form::open(['class'=>'form-horizontal company', 'method'=>'post', 'action'=>['Admin\Orders\OrdersController@postOrder']])}}
		 
		<div class="col-lg-6 col-md-10">			
			
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Search Product</label>
					<div class="col-xs-8">
						<select class="search-product" name="productSearch" onchange="setProduct(this.value)" data-plugin="select2">
							<option>Select Product</option>
							@foreach($products as $product)
							<option value="{{ $product->id }}">{{ $product->id }}: {{ $product->product_name }}</option>
							@endforeach
						</select>	
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Select Varient</label>
					@foreach($varientTypes as $varientType)
					<div class="col-xs-4">						
						<select class="select-varient" name="varientTypeValue[]" id="varientTypeValue_{{ $varientType->id }}"  data-plugin="select2">
							 
							<option value=""></option>
							 
						</select>
					</div>
					@endforeach
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Price </label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="price" value="{{Old('price')}}">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Quantity </label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="quantity" value="{{Old('quantity')}}">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Customer Name</label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="customerName" value="{{Old('customerName')}}">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Customer Email</label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="customerEmail" value="{{Old('customerEmail')}}">
					</div>
				</div>	
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Customer Phone	</label>
					<div class="col-xs-8">
						<input class="form-control" type="text" maxlength="10" name="customerPhone" value="{{Old('customerPhone')}}">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Address	</label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="customerAddress" value="{{Old('customerAddress')}}">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">State</label>
					<div class="col-xs-8">
						<select class="select-state form-control" onchange="getCity(this.value)"  name="customerState" value="{{Old('customerState')}}">
							@foreach($states as $state)
								<option value="{{$state->id}}" {{ (old("customerState") == $state->id ? "selected":"") }}>{{$state->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">City</label>
					<div class="col-xs-8">
						<select class="select-state form-control" id="cityies" name="customerCity" value="{{Old('customerCity')}}">							
								<option value="">Select City</option>							
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Pincode	</label>
					<div class="col-xs-8">
						<input class="form-control" type="text" maxlength="6" name="customerPostCode" value="{{Old('customerPostCode')}}">
					</div>
				</div>
				<div class="form-group row">
				<label for="setbillingaddress" class="col-xs-4 col-form-label">Same as billing address	</label>					
					<div class="col-xs-8">
						<input type="checkbox" class="form-control" id="setbillingaddress" checked="" name="setbillingaddress" onclick="setbillingaddress()">						
						 
					</div>
				</div>
				<center><button class="btn btn-success" type="submit" name="btnSubmit">Submit</button></center>
		</div>
		<fieldset>
  			<legend>Product Detail:</legend>
		<div class="col-lg-12 col-md-10">
		
			<div class="form-group row">
					<label for="example-text-input" class="col-xs-3 col-form-label">Product</label>
					<div class="col-xs-2">
						<input class="form-control" type="text" name="productCode" value="{{Old('productCode')}}" readonly="true">
					</div>
					<div class="col-xs-7">
						<input class="form-control" type="text" name="productName" value="{{Old('productName')}}" readonly="true">						 
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-3 col-form-label">Product Price</label>
					<div class="col-xs-9">
						<input class="form-control" type="text" name="productAmount" value="{{Old('productAmount')}}" readonly="true">
					</div>
					
				</div>
				<div class="form-group row">					
					<input type="hidden" name="mrp">
					<input type="hidden" name="weight">
					<input type="hidden" name="paymentType" value="cod">
				</div>
				
		</div>
		</fieldset>
		<!-- </form> -->
		{{Form::close()}}
					
	</div>
@endsection
