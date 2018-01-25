@extends('admin/layouts/layout')

@section('title')
	| {{'Coupons'}}
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
		
		.auto_scroll_div_class{
		    max-height: 200px;
            overflow-y: auto;
		}
	</style>
@endsection

@section('pageScripts')
	<script>

		$(document).ready(function(){
			$('.agdteuhdbs').submit(function(event){
				event.preventDefault();
			});
		});

		function saveVarientValue(varientTypeId, productid){

			console.log($('#form_'+varientTypeId).serialize());
			var formVal 		=  $('#form_'+varientTypeId).serialize();
			$.ajax({
				url: "{{url('admin/assign_varients/insertValueToVarient')}}",
				type: 'post',
				data: formVal,
				dataType: 'json',
				beforeSend: function(){
				},
				success: function(result){
					console.log(result);
					if(result['success']){
						$('#allVarientesSizes_'+varientTypeId).append('<tr class="table-row-design"><td class="width-30"></td><td class="width-190">'+result['data']['value']+'</td><td class="width-25"><a href="javascript:;" onclick=selectTheVarientValue('+varientTypeId+','+result['data']['id']+','+productid+')>+</a></td></tr>');
					}

					$('#textBox_'+varientTypeId).val('');
					$('#textBox_'+varientTypeId).focus();
				}
			});
		}

		function selectTheVarientValue(varientId, varientValueId, product_id){
			console.log(varientId, varientValueId, product_id);

			$.ajax({
				url: "{{url('admin/assign_varients/selectProductVarientValue')}}",
				type: 'POST',
				data: {varientId: varientId, varientValueId: varientValueId, product_id:product_id},
				dataType: 'html',
				beforeSend: function(){},
				success: function(result){
					console.log(result);
					$('#selected_varient_values_'+varientId).html(result);					
					getAllAvailableVarientValues(product_id, varientId);
					getProductVarient(product_id, varientId);
				},
			});
		}

		function getAllAvailableVarientValues(productid, varientTypeId){

			$.ajax({
				url: "{{url('admin/assign_varients/getAllAvailableVarientValue')}}",
				type: 'POST',
				dataType: 'html',
				data: {varientTypeId:varientTypeId, productid: productid},
				beforeSend: function(){},
				success: function(result){
					console.log(result);
					$('#allVarientesSizes_'+varientTypeId).html(result);
					getProductVarient(productid, varientTypeId);
				}
			});
		}

		function getAllSelectedVarientValues(productid, varientTypeId){
			$.ajax({
				url: "{{url('admin/assign_varients/getAllSelectedVarients')}}",
				type: 'POST',
				dataType: 'html',
				data: {productid:productid, varientTypeId:varientTypeId},
				beforeSend: function(){},
				success: function(result){
					$('#selected_varient_values_'+varientTypeId).html(result);
				},
			});
		}

		function removeSelectedVarientValue(selectedVarientId, productid, varientTypeId){

			$.ajax({
				url: "{{url('admin/assign_varients/removeSelectedVarientValue')}}",
				type: 'POST',
				dataType: 'json',
				data: {selectedVarientId:selectedVarientId},
				beforeSend: function(){},
				success: function(result){
					if(result['success']){
						getAllAvailableVarientValues(productid, varientTypeId);
						getAllSelectedVarientValues(productid, varientTypeId);						
					}
				},
			});
		}
		function getProductVarient(productid, varientTypeId){
			$.ajax({
				url: "{{url('admin/assign_varients/getProductVarient')}}",
				type: 'POST',
				dataType: 'html',
				data: {varientTypeId:varientTypeId, productid: productid},
				beforeSend: function(){},
				success: function(result){
					console.log(result);
					$('#resultProductVarient').html(result);
				}
			});
		}
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
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Varients</li>
		</ol>
		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3 style="position:absolute">Varient Select</h3>
				<ul class="demo-header-actions"><li class="demo-tabs">&nbsp;</li><!-- 
					<li class="demo-tabs"><button type="button" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Edit</button></li>
					<li class="demo-tabs"><button type="button" class="btn btn-custom w-min-sm mb-0-25 waves-effect waves-light">Cancel</button></li>
					<li class="demo-tabs demo_tabs"><button type="button" class="btn btn-danger w-min-sm mb-0-25 waves-effect waves-light">Delete</button></li>
				 --></ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 mb-1 mb-md-0">
			@if(Session::has('success'))
				<div class="alert alert-success alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					<strong>{!! Session::get('success') !!}. </strong>
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
		<div class="row">			
			<h5 class="category-row">Varient Type</h5>
			@foreach($availableVarients as $availableCategory)
			<div class="container">
				<div class="col-md-3 auto_scroll_div_class">
					<h5 class="all-sizes">{!! $availableCategory->varient_type !!}</h5>
						<table>
							<thead></thead>
							<tbody id="allVarientesSizes_{{$availableCategory->id}}">
								@foreach($varientValues[$availableCategory->id] as $varientValue)
								<tr class="table-row-design">
									<td class="width-30"></td>
									<td class="width-190">{{$varientValue->value}}</td>
									<td class="width-25"><a href="javascript:;" onclick="selectTheVarientValue({{$availableCategory->id}},{{$varientValue->id}}, {{$_GET['c']}})">+</a></td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								{!! Form::open(array('id' => 'form_'.$availableCategory->id, 'class' => 'agdteuhdbs')) !!}
									<tr class="table-row-design">
										<input type="hidden" name="varient_type_id" value="{{$availableCategory->id}}">
										<td class="width-30"><a href="#"><i class="fa fa-times"></i></a></td>
										<td class="width-190"><input name="varient_value" id="textBox_{{$availableCategory->id}}" type="text"></input></td>
										<td class="width-25"></td>
									</tr>
								<tr>
									<td colspan="3">
										<button type="button" onclick="saveVarientValue({{$availableCategory->id}},{{$_GET['c']}})" class="btn btn-danger btn-custom2">ADD MORE CUSTOM <span style="text-transform: uppercase;;">{!! $availableCategory->varient_type !!}</span> </button>
									</td>
								</tr>
								{!! Form::close() !!}
							</tfoot>
						</table>
				</div>
				<div class="col-md-3">
				</div>
				<div class="col-md-3 auto_scroll_div_class">
					<h5 class="all-sizes">Selected {!! $availableCategory->varient_type !!}</h5>
						<table>
							<thead></thead>
							<tbody id="selected_varient_values_{{$availableCategory->id}}">
							@foreach($selectValues[$availableCategory->id] as $selectedVal)
								<tr class="table-row-selected">
									<td class="width-30"></td>
									<td class="width-190">{{$selectedVal->value}}</td>
									<td class="width-25"><a href="javascript:;" onclick="removeSelectedVarientValue({{$selectedVal->id}}, {{$_GET['c']}}, {{$availableCategory->id}} )">-</a></td>
								</tr>
							@endforeach
							</tbody>
						</table>
				</div>
				<div class="col-md-3">
				</div>
			</div>
			<br/>
			@endforeach
		</div>
		<br/>
		<!-- <div class="container">
			<button type="submit" class="btn btn-success btn-success2">Submit</button>
		</div> -->
		<hr/>
		<div class="row box-block">
		{!! Form::open(['method'=>'post', 'action' => ['Admin\Varients\AssignVarientsController@postProductVarient', ]]) !!}
			<table class="table varient-table">
				<thead>
					<tr>
						<th>Set Product according Varients</th>
					</tr>
					
				</thead>
				<tbody id="resultProductVarient">
					<tr>
					@foreach($availableVarients as $varients)
						<td><input type="hidden" name="productid" value="{{$productid}}">
							<select class="form-control" name="varient_type[]">
							@foreach($selectValues[$varients->id] as $selectedVar)
								<option value="{{$selectedVar->varient_type_value_id}}">{{$selectedVar->value}}</option>
							@endforeach
							</select>
						</td>
						<td>
							+
						</td>
					@endforeach
						<td><input type="number" name="productPrice" class="set_price form-control" id="fromInput" placeholder="Set Price"/></td>
						<td><input type="submit" name="btnSave" value="Save" class="btn btn-success save-button24"/></td>
					</tr>
					
				</tbody>
			</table>
			{!! Form::close() !!}
		</div>
	</div>	
		<div class="box-block">
			<table class="table table-striped varient-table">
				<tbody> 
				@foreach($productVarient as $value)
					<tr>
						<td>{{$value['varients']}}</td>
						<td><span>{{$value['price']}}</span></td>
						<td>
						{!! Form::open(array('method' => 'delete', 'action' => ['Admin\Varients\AssignVarientsController@deleteProductVarient'])) !!}
						<input type="hidden" name="product_varient_id" value="{{$value['id']}}">
							<a href="javascript:;" title="Delete" style="color:#ff0000" data-toggle="modal" data-target="#delete_product_varient_{{$value['id']}}"><i class="fa fa-times"></i></a>
							<div class="modal fade small-modal" id="delete_product_varient_{{$value['id']}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
												<h4 class="modal-title" id="mySmallModalLabel">Category Delete Confirmation</h4>
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
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>	
@endsection