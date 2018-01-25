@extends('admin/layouts/layout')

@section('ng_app'){{'ecommAppAdmin'}}@endsection

@section('title')
	| dashboard
@endsection

@section('pageTopScripts')
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/app/animate.css')}}">
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/app/angular.min.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/app/app.js')}}"></script>
	<script type='text/javascript' src="{{asset(ADMIN_FILE_PATH.'/app/ng-infinite-scroll.min.js')}}"></script>
	<script type='text/javascript' src="{{asset(ADMIN_FILE_PATH.'/app/angular-animate.js')}}"></script>
	<style type="text/css">
	.standard_commission_custom{
		width: 15%;
	}
	</style>
@endsection

@section('pageScripts')
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/index.js')}}"></script>

@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
	<div class="container-fluid" ng-controller="commissionController">
		<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">commission</li>
						</ol>
						<div class="box box-block bg-white">
							<div class="row" style="border-bottom:2px solid #000; padding-bottom:10px;">
								<h3>Commission Type - 2</h3>
							</div>
								
							<div class="row" style="margin-top:30px">
								<div class="col-sm-12 col-lg-12">
											<ul class="nav nav-inline l-h-2 text-sm-left text-xs-left">
												<li class="nav-item"><a class="nav-link text-black" href="#"><span style="font-weight:bold">Standard Commission<span></a></li>
												<li class="nav-item nav-item-pencil"><a class="nav-link text-black" href="#"><i class="fa fa-pencil"></i></a></li>
											</ul>
											<ul class="nav nav-inline l-h-2 text-sm-left text-xs-left">
												<li class="nav-item standard_commission_custom"><span><i class="fa fa-inr"></i>500 - <i class="fa fa-inr"></i>1000</span></li>
												<li class="nav-item"><a class="nav-link text-black" href="#"><input type="text"/></a></li>
											</ul>
											<ul class="nav nav-inline l-h-2 text-sm-left text-xs-left">
												<li class="nav-item standard_commission_custom"><span><i class="fa fa-inr"></i>1000 - <i class="fa fa-inr"></i>1500</span></li>
												<li class="nav-item"><a class="nav-link text-black" href="#"><input type="text"/></a></li>
											</ul>
											<ul class="nav nav-inline l-h-2 text-sm-left text-xs-left">
												<li class="nav-item standard_commission_custom"><span><i class="fa fa-inr"></i>1500 - <i class="fa fa-inr"></i>2000</span></li>
												<li class="nav-item"><a class="nav-link text-black" href="#"><input type="text"/></a></li>
											</ul>
											<ul class="nav nav-inline l-h-2 text-sm-left text-xs-left">
												<li class="nav-item standard_commission_custom"><span><i class="fa fa-inr"></i>2000 - <i class="fa fa-inr"></i>5000</span></li>
												<li class="nav-item"><a class="nav-link text-black" href="#"><input type="text"/></a></li>
											</ul>
											<ul class="nav nav-inline l-h-2 text-sm-left text-xs-left">
												<li class="nav-item standard_commission_custom"><span><i class="fa fa-inr"></i>5000 - <i class="fa fa-inr"></i>10000</span></li>
												<li class="nav-item"><a class="nav-link text-black" href="#"><input type="text"/></a></li>
											</ul>
								</div>
							</div>
							<div class="row commission-type">
								<div class="col-sm-12">
											<ul class="nav nav-inline l-h-2 text-sm-left text-xs-left">
												
												<li class="nav-item"><a class="nav-link text-black" href="#"><span style="font-weight:bold">Category Commission<span></a></li>
												<li class="nav-item"><a class="nav-link text-black" href="#"><input type="text"/></a></li>
												<li class="nav-item nav-item-pencil"><a class="nav-link text-black" href="#"><i class="fa fa-pencil"></i></a></li>
											</ul>
								</div>		
							</div>
							<div class="row commission-type table-mobile">
								<table class="table table-striped">
										<thead>
											<tr>
												<th><input type="checkbox" id="selectall"/></th>
												<th>Category</th>
												<th style="float:right">
													<button type="button" class="btn btn-warning btn-sm  label-right b-a-0 waves-effect waves-light">
													<span class="btn-label"><i class="ti-pencil-alt"></i></span>
														Edit
													</button>
													<button type="button" class="btn btn-success btn-sm label-right b-a-0 waves-effect waves-light">
														<span class="btn-label"><i class="ti-check-box"></i></span>
														Confirm
													</button></th>
												
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><input type="checkbox"/></td>
												<td>Electronics</td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td><input type="checkbox"/></td>
												<td>Electronics</td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td><input type="checkbox"/></td>
												<td>Electronics</td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td><input type="checkbox"/></td>
												<td>Electronics</td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td><input type="checkbox"/></td>
												<td>Electronics</td>
												<td></td>
												<td></td>
											</tr>
										</tbody>
								</table>	
							</div>
							<div class="container text-container">
								<h4 class="product-text">for every product sold at <span style="color:#000">rs.300</span> you will get <span style="color:#000">rs.10</span></h4>
								<p>*Shipping and other charges may create difference</p>
							</div>
						</div>
	</div>
@endsection