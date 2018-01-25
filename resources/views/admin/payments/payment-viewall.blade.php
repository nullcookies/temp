@extends('admin/layouts/layout')

@section('title')
	| {{'Setting'}}
@endsection

@section('ng_app'){{'app'}}@endsection

@section('pageTopScripts')
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/multi_select/css/multi-select.css')}}">	
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/clockpicker/dist/bootstrap-clockpicker.min.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')}}">

	<style>
		
		table, tr, td{
			border:1px solid #ccc;
		}
		
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

	@if($errors->has('domain_name') || $errors->has('service_provider') || $errors->has('domain_user_id') || $errors->has('domain_password') || Session::has('domain_setup_request')) 
		<script>
			$(document).ready(function(){
				$('#personal').removeClass('active in');
				$('#personal').attr('aria-expanded',false);
				$('#submit-domain').addClass('active in');
				$('#submit-domain').attr('aria-expanded',true);
				$('#personal_tab').removeClass('active');
				$('#submit_detail_tab').addClass('active');

			});	
		</script>
	@endif

	<script>
		
		function showPassword(requestid){
			$('#password'+requestid).attr('type','text');
		}

		function hidePassword(requestid){
			$('#password'+requestid).attr('type','password');
		}
	</script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.min.js"></script>
    <script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/commision_module/payment_module.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/index.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/multi_select/js/jquery.multi-select.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/moment/moment.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/forms-pickers.js')}}"></script>
    <script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.min.js')}}"></script>
    <script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/morris/morris.min.js')}}"></script>
                <script type="text/javascript">
				
				Morris.Line({
    element: 'line',
    resize: true,
    data: [
        {y: '2014 Q1', value: 230},
        {y: '2014 Q2', value: 400},
        {y: '2014 Q3', value: 800},
        {y: '2014 Q4', value: 600},
        {y: '2015 Q1', value: 500},
        {y: '2015 Q2', value: 700},
        {y: '2015 Q3', value: 900},
        {y: '2015 Q4', value: 600},
        {y: '2016 Q1', value: 800},
        {y: '2016 Q2', value: 700}
    ],
    xkey: 'y', 
    ykeys: ['value'],
    labels: ['Value'],
    gridLineColor: '#ddd',
    lineColors: ['#3e70c9'],
    lineWidth: 1,
    hideHover: 'auto'
});
				
				
				
				
				
				
				</script>
	
@endsection

@section('bodyclass')
	fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
			<div class="container-fluid" ng-controller = "paymnetParentController" ng-init = "get_me_gmv()">
				<!-- Content -->
				<div class="content-area py-1">
					<div class="container-fluid">
						<div class="col-md-4">
							<div class="col-sm-12">
								<div class="box-block tile tile-2 bg-success mb-2">
									<div class="t-icon right"><i class="ti-bar-chart"></i></div>
									<div class="t-content">
										<h1 class="mb-1"><i class="fa fa-inr"></i> 47,855</h1>
										<h6 class="text-uppercase">Total GMV</h6>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="box-block tile tile-2 bg-danger mb-2">
									<div class="t-icon right"><i class="ti-shopping-cart-full"></i></div>
									<div class="t-content">
										<h1 class="mb-1"><i class="fa fa-inr"></i> 1,325</h1>
										<h6 class="text-uppercase">Un-billed Amount</h6>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="box-block tile tile-2 bg-primary mb-2">
									<div class="t-icon right"><i class="ti-package"></i></div>
									<div class="t-content">
										<h1 class="mb-1"><i class="fa fa-inr"></i> 6,800</h1>
										<h6 class="text-uppercase">Total GMV</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<h5 class="payment_summary">Payment Summary</h5>
							<div class="col-sm-12">
								<div class="box-block box-block23 tile tile-3 mb-2">
									<div class="t-icon right"><i class="ti-bar-chart"></i></div>
									<div class="t-content">
										<h6 class="text-uppercase text-success">Billed Amount</h6>
										<h1 class="mb-0"><i class="fa fa-inr"></i> 47,855</h1>
									</div>
								</div>
								<p class="payout">Next Payout Date : 12 March 2017</p>
							</div>
							<div class="col-sm-12">
								<div class="box-block box-block2 tile tile-3 mb-2">
									<div class="t-icon right"><i class="ti-shopping-cart-full"></i></div>
									<div class="t-content">
										<h6 class="text-uppercase text-danger">Un-billed Amount</h6>
										<h1 class="mb-0"><i class="fa fa-inr"></i> 1,325</h1>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="box-block box-block2 tile tile-3 mb-2">
									<div class="t-icon right"><i class="ti-package"></i></div>
									<div class="t-content">
										<h6 class="text-uppercase text-primary">GMV FY (2017-18</h6>
										<h1 class="mb-0"><i class="fa fa-inr"></i> 6,800</h1>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<h5 class="mb-1">Line chart</h5>
							<div id="line" class="chart-container"></div>
						</div>
						<div class="col-md-12 col-sm-12 table-mobile">
							<table class="table table-hover payment-table">
								<thead>
									<tr>
										<th>S No.</th>
										<th>Reference Number</th>
										<th>Amount</th>
										<th>Remitance Date</th>
										<th>More Info</th>
										<th>Download</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>123456789</td>
										<td>2000</td>
										<td>01-01-2017</td>
										<td><a href="tab1.blade.php" target="_blank"><i class="fa fa-eye"></i></a></td>
										<td><a href="#"><i class="fa fa-download"></i></a></td>
									</tr>
									<tr>
										<td>2</td>
										<td>123456789</td>
										<td>2000</td>
										<td>01-01-2017</td>
										<td><a href="tab1.blade.php"><i class="fa fa-eye"></i></a></td>
										<td><a href="#"><i class="fa fa-download"></i></a></td>
									</tr>
									<tr>
										<td>3</td>
										<td>123456789</td>
										<td>2000</td>
										<td>01-01-2017</td>
										<td><a href="tab1.blade.php"><i class="fa fa-eye"></i></a></td>
										<td><a href="#"><i class="fa fa-download"></i></a></td>
									</tr>
									<tr>
										<td>4</td>
										<td>123456789</td>
										<td>2000</td>
										<td>01-01-2017</td>
										<td><a href="tab1.blade.php"><i class="fa fa-eye"></i></a></td>
										<td><a href="#"><i class="fa fa-download"></i></a></td>
									</tr>
									<tr>
										<td>5</td>
										<td>123456789</td>
										<td>2000</td>
										<td>01-01-2017</td>
										<td><a href="tab1.blade.php"><i class="fa fa-eye"></i></a></td>
										<td><a href="#"><i class="fa fa-download"></i></a></td>
									</tr>
									<tr>
										<td>6</td>
										<td>123456789</td>
										<td>2000</td>
										<td>01-01-2017</td>
										<td><a href="tab1.blade.php"><i class="fa fa-eye"></i></a></td>
										<td><a href="#"><i class="fa fa-download"></i></a></td>
									</tr>
									<tr>
										<td>7</td>
										<td>123456789</td>
										<td>2000</td>
										<td>01-01-2017</td>
										<td><a href="tab1.blade.php"><i class="fa fa-eye"></i></a></td>
										<td><a href="#"><i class="fa fa-download"></i></a></td>
									</tr>
									<tr>
										<td>8</td>
										<td>123456789</td>
										<td>2000</td>
										<td>01-01-2017</td>
										<td><a href="tab1.blade.php"><i class="fa fa-eye"></i></a></td>
										<td><a href="#"><i class="fa fa-download"></i></a></td>
									</tr>
									<tr>
										<td>9</td>
										<td>123456789</td>
										<td>2000</td>
										<td>01-01-2017</td>
										<td><a href="tab1.blade.php"><i class="fa fa-eye"></i></a></td>
										<td><a href="#"><i class="fa fa-download"></i></a></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="row pagination">
								<ul class="pagination m-0">
									<li class="page-item">
										<a class="page-link" href="#" aria-label="Previous">
											<span aria-hidden="true">&laquo;</span>
											<span class="sr-only">Previous</span>
										</a>
									</li>
									<li class="page-item"><a class="page-link" href="#">1</a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item"><a class="page-link" href="#">4</a></li>
									<li class="page-item"><a class="page-link" href="#">5</a></li>
									<li class="page-item">
										<a class="page-link" href="#" aria-label="Next">
											<span aria-hidden="true">&raquo;</span>
											<span class="sr-only">Next</span>
										</a>
									</li>
								</ul>
							</div>	
					</div>
					<div class="col-md-12">
							<p class="page-number">SHOWING 1 TO 5 OF 5 PAGES (1 PAGE)</p>
						</div>
				</div>
				
	@endsection