<?php $__env->startSection('title'); ?>
	| <?php echo e('Setting'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('ng_app'); ?><?php echo e('app'); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/multi_select/css/multi-select.css')); ?>">	
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/clockpicker/dist/bootstrap-clockpicker.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')); ?>">

	<style>
		
		table, tr, td{
			border:1px solid #ccc;
		}
		
		.radius12{
			border-radius: 12px !important;
		}
		.view-products-row table td:nth-child(7) {width: 1%;}
	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>
	<script>
		$("#selectall").change(function () {
		    $("input:checkbox").prop('checked', $(this).prop("checked"));
			$("input:checkbox").prop('checked', $(this).prop("checked"));
		});
	</script>

	<?php if($errors->has('domain_name') || $errors->has('service_provider') || $errors->has('domain_user_id') || $errors->has('domain_password') || Session::has('domain_setup_request')): ?> 
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
	<?php endif; ?>

	<script>
		
		function showPassword(requestid){
			$('#password'+requestid).attr('type','text');
		}

		function hidePassword(requestid){
			$('#password'+requestid).attr('type','password');
		}
	</script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.min.js"></script>
    <script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
	
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/index.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/multi_select/js/jquery.multi-select.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/moment/moment.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/forms-pickers.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/morris/morris.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/commision_module/payment_module.js')); ?>"></script>
                <script type="text/javascript">
				
				
				
				
				
				
				
				</script>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
	fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container-fluid" ng-controller = "paymnetParentController" ng-init = "get_me_gmv()">
		<div class="content-area py-1" >
       
        
					<div class="container-fluid">
						<div class="col-md-4">
							<div class="col-sm-12">
								<div class="box-block tile tile-2 bg-success mb-2">
									<div class="t-icon right"><i class="ti-bar-chart"></i></div>
									<div class="t-content">
										<h1 class="mb-1"><i class="fa fa-inr"></i> [[gmv]]</h1>
										<h6 class="text-uppercase">Total GMV</h6>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="box-block tile tile-2 bg-danger mb-2">
									<div class="t-icon right"><i class="ti-shopping-cart-full"></i></div>
									<div class="t-content">
										<h1 class="mb-1"><i class="fa fa-inr"></i>[[unbiled_amount_data]]</h1>
										<h6 class="text-uppercase">Un-billed Amount</h6>
                                      <!--  <input type="button" ng-click = "get_unbiled_amount()" value="Manual calculate unbilled ammount(for testing)"/>-->
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="box-block tile tile-2 bg-primary mb-2">
									<div class="t-icon right"><i class="ti-package"></i></div>
									<div class="t-content">
										<h1 class="mb-1"><i class="fa fa-inr"></i> [[biled_amount_data]]</h1>
										<h6 class="text-uppercase">Billed Amount</h6>
                                       
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
										<h1 class="mb-0"><i class="fa fa-inr"></i> [[biled_amount_data]]</h1>
									</div>
								</div>
								<p class="payout">Next Payout Date : 25 June 2017</p>
							</div>
							<div class="col-sm-12">
								<div class="box-block box-block2 tile tile-3 mb-2">
									<div class="t-icon right"><i class="ti-shopping-cart-full"></i></div>
									<div class="t-content">
										<h6 class="text-uppercase text-danger">Un-billed Amount</h6>
										<h1 class="mb-0"><i class="fa fa-inr"></i> [[unbiled_amount_data]]</h1>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="box-block box-block2 tile tile-3 mb-2">
									<div class="t-icon right"><i class="ti-package"></i></div>
									<div class="t-content">
										<h6 class="text-uppercase text-primary">GMV FY (2017-18</h6>
										<h1 class="mb-0"><i class="fa fa-inr"></i> [[gmv]]</h1>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 remmitance table-mobile">
							<h5 class="remmitance_history">Remmitance History</h5>
							<table class="table table-striped">
								<thead>
									<tr>
										
										<th>REF. NO.</th>
										<th>AMOUNT</th>
										<th>DATE</th>
										<th><a href="#"><i class="fa fa-download"></i></a></th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat = "reff in reffVal">
										
										<td><a href="<?php echo e(route('details')); ?>/[[reff.refrerence_no]]" target="_new">[[reff.refrerence_no]]</a></td>
										<td>[[reff.commision_amount]]</td>
										<td>[[reff.date]]</td>
										<td><a href="<?php echo e(route('dounload_csv')); ?>/[[reff.refrerence_no]]"><i class="fa fa-download"></i></a></td>
									</tr>
									
								</tbody>
								<tfoot>
									<tr>
										<td colspan="5"><a href="<?php echo e(route('view_all_from_reff_cntrl')); ?>">View All Notifications</a></td>
									</tr>
								</tfoot>
							</table>
                          <!--<input type="button" ng-click="add_to_rimmidence_history()" value="Pay Now(for testing)"/>-->
                          
                            
						</div>
						
					</div>
					<div class="container-fluid">
						<div class="col-md-8">
							<h5 class="mb-1">Store Performance</h5>
									<div id="line" class="chart-container"></div>
						</div>
						<div class="col-md-4 settlement-table">
							<h6 class="services_agreements">Services & Agreements</h6>
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td>1</td>
										<td>Invoice & TDS Details</td>
										<td><a href="#"><i class="fa fa-download"></i></a></td>
									</tr>
									<tr>
										<td>2</td>
										<td>Transaction Details <small>(Settled / Unsettled)</small></td>
										<td><a href="#"><i class="fa fa-download"></i></a></td>
									</tr>
									<tr>
										<td>3</td>
										<td>Statement</td>
										<td><a href="#"><i class="fa fa-download"></i></a></td>
									</tr>
									<tr>
										<td>4</td>
										<td>Logistics Agreement</td>
										<td><a href="#"><i class="fa fa-download"></i></a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
	</div>			
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>