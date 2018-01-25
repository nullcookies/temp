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
	<div class="container-fluid" ng-controller="listTrialController">
		<div class="card card-block">
			<div class="row">
				<div class="col-md-12">
					<h5 class="mb-1">[[heading]]</h5>
					Filter:
					<input type="text" ng-model="filter">
					Order By
					<select ng-model="orderBy">
						<option value="username">User Name</option>
						<option value="email">email</option>
						<option value="mobile">Mobile</option>
						<option value="status">status</option>
						<option value="subdomain">Subdomain</option>
					</select>
					<table class="table mb-md-0">
						<thead>
							<tr>
								<th>#</th>
								<th>User Name</th>
								<th>Email</th>
								<th>Mobile</th>
								<th>Status</th>
								<th>Subdomain</th>
								<th>Completed Steps</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody infinite-scroll="NextPage()" infinite-scroll-use-document-bottom="true">
							<tr ng-repeat="trial in trials|filter:filter|orderBy:orderBy" class="repeat-item">
								<th scope="row">[[$index+1]]</th>
								<td>[[trial.username]]</td>
								<td>[[trial.email]]</td>
								<td>[[trial.mobile]]</td>
								<td>[[trial.status]]</td>
								<td>[[trial.subdomain]]</td>
								<td>[[trial.step]]</td>
								<td><button href="javascript:;" ng-click="deleteTrial(trial.id)"><i class="fa fa-trash"></i></button></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection