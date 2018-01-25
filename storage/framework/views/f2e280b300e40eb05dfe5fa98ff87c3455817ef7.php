<?php $__env->startSection('title'); ?>
	| <?php echo e('Website-analytics'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/multi_select/css/multi-select.css')); ?>">	
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/clockpicker/dist/bootstrap-clockpicker.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/chartist/chartist.min.css')); ?>">


	<style>
		
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
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/index.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/multi_select/js/jquery.multi-select.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/moment/moment.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/forms-pickers.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/chartjs/Chart.bundle.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/chartist/chartist.min.js')); ?>"></script>
	<script>
		new Chartist.Line('#line-area', {
		  labels: [<?php echo e($date); ?>],
		  series: [
		  	[<?php echo e($visitors); ?>]
		    
		  ]
		}, {
		  low: 0,
		  showArea: true
		});
	</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
	fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
		<div class="container-fluid">
						<h3><i class="fa fa-pie-chart"></i>&nbsp;Website Analytics</h3>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Analytics</li>
						</ol>
							<div class="box-block">
								<div class="row box-block bg-white">
									<div class="col-md-12">
										<div class="col-md-4">
											<div class="col-xs-12 active-box">
												<div class="box-block tile tile-2 bg-success mb-2 user-data">
													<div class="t-icon right"><i class="ti-user"></i></div>
													<div class="t-content">
														<h6>Users</h6>
														<h1 class="mb-1"><?php echo e($recently_active); ?></h1>
														<h6 class="text-uppercase">Active Users</h6>
													</div>
												</div>
											</div>
											<div class="col-xs-12">
												<div class="box-block tile tile-2 bg-primary mb-2">
													<div class="t-icon right"><i class="ti-package"></i></div>
													<div class="t-content">
														<h1 class="mb-1"><?php echo e($today_sessions); ?></h1>
														<h6 class="text-uppercase">Sessions Today</h6>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<h5 class="mb-1">User Statistics</h5>
											<p style="transform:rotate(-90deg); margin-top:150px;position:absolute;margin-left:-50px;font-weight:bold;">Number of Users</p>
											<div id="line-area" class="chart-container">
											</div>
											<p style="text-align:center;font-weight:bold;">Days</p>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>