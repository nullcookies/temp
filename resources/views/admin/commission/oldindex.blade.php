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
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">

@endsection

@section('pageScripts')

<script>

	$(document).ready(function(){

		$('#statndard_commission_price').on('focus',function(){
			$('#standard_commission').prop('checked',true);
			fetchCategoryCommission();
			show_calculations();
		});

		$('input:radio[name=commission_type]').on('change',function(){
			fetchCategoryCommission();
			show_calculations();
		});

		if($('#category_commission').is(':checked')){
			fetchCategoryCommission();
			show_calculations();
		}
	});

	function show_calculations(){

		if($('#category_commission').is(':checked')){
			$('#show_calculations').css('display','none');
		}else{
			$('#show_calculations').css('display','block');
		}
	}

	function saveStandardCommission(){
		$('#standard_commission').prop('checked',true);
		saveCommission();
	}

	function saveCommission(){
			//fetchCategoryCommission();
			var formData 		=	$('#standard_commission_form').serialize();
			console.log(formData);
			$.ajax({
				url: "{{url('admin/commission/saveCommission')}}",
				type: 'POST',
				data: formData,
				dataType: 'json',
				beforeSend: function(){
					NProgress.start();
				},
				success: function(json){
					console.log(json);
					if(json['type'] && json['success']){
						$('#totalPriceVal').html(json['calcval']);
						$('#afterCommissionEarn').html(json['afterComm']);
					}

					$('#result_message').html(json['message']);
					NProgress.done();
				},
			});
		}

		function fetchCategoryCommission(){
			var value  = $('input:radio[name=commission_type]:checked').val();
			$.ajax({
				url: "{{url('admin/commission/getCategories')}}",
				type: 'POST',
				dataType: 'html',
				data: {value: value},
				beforeSend: function(){
					NProgress.start();
				},
				success: function(result){
					NProgress.done();
					$('#showCategoryTable').html(result);
				},
			});
		}
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
	<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Commission Type - 2</li>
		</ol>
		<div class="box box-block bg-white">
			<div class="row" style="border-bottom:2px solid #000; padding-bottom:10px;">
				<h3>Commission Type - 2</h3>
			</div>

			<div id="result_message"></div>

			{!! Form::open(array('id' => 'standard_commission_form','action' => ['Admin\Commission\CommissionController@index'] ,'mathod'=>'post')) !!}	
			<div class="row" style="margin-top:30px">
				<div class="col-sm-12 col-lg-12">
					<ul class="nav nav-inline l-h-2 text-sm-left text-xs-left">
						<li class="nav-item"><a class="nav-link text-black" href="javascript:;"><input type="radio" value="standard_commission" id="standard_commission" class="js-switch" name="commission_type" data-size="small" data-color="#43b968" @if($standard_commission['is_selected'] == 'yes') checked @endif > </a></li>
						<li class="nav-item"><a class="nav-link text-black" href="javascript:;"><span style="font-weight:bold">Standard Commission<span></a></li>
						<li class="nav-item"><input type="text" name="standard_commission_price" value="{{$standard_commission['price']}}" id="statndard_commission_price" /> %</li>
						<li class="nav-item nav-item-pencil"><a class="nav-link text-black" href="javascript:;" onclick="saveStandardCommission()" ><i class="fa fa-pencil"></i></a></li>
					</ul>

				</div>
			</div>
			<div class="row commission-type">
				<div class="col-sm-12">
					<ul class="nav nav-inline l-h-2 text-sm-left text-xs-left">
						<li class="nav-item"><a class="nav-link text-black" href="javascript:;"><input type="radio" value="category_commission" id="category_commission" class="js-switch" data-size="small" name="commission_type" data-color="#f44236" @if($category_commission['is_selected'] == 'yes') checked @endif ></a></li>
						<li class="nav-item"><a class="nav-link text-black" href="javascript:;"><span style="font-weight:bold">Category Commission<span></a></li>
						<!-- <li class="nav-item nav-item-pencil"><a class="nav-link text-black" href="#"><i class="fa fa-pencil"></i></a></li> -->
					</ul>
				</div>		
			</div>
			<div class="row commission-type" id="showCategoryTable">
			</div>
			{!! Form::close() !!} 

			<div class="container text-container" id="show_calculations">
				<h4 class="product-text">for every product sold at rs. <span style="color:#000" id="totalPriceVal"> 300</span> you will get rs. <span style="color:#000" id="afterCommissionEarn"> {{($standard_commission['price']*300)/100}}</span></h4>
				<p>*Shipping and other charges may create difference</p>
			</div>
		</div>
	</div>
	@endsection