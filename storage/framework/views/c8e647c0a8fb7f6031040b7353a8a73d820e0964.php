<?php $__env->startSection('title'); ?>
	| <?php echo e('Product Upload Option'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/multi_select/css/multi-select.css')); ?>">	
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/clockpicker/dist/bootstrap-clockpicker.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/index.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/multi_select/js/jquery.multi-select.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/moment/moment.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/forms-pickers.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<div class="container-fluid">
						<h4>Products</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Products</a></li>
							<li class="breadcrumb-item active">Add Products</li>
						</ol>
						<div class="box box-block bg-white">
							<div class="row" style="border-bottom:2px solid #000; padding-bottom:10px;">
								<h3>Add Products</h3>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 add-products">
							<div class="col-md-6 box1">
								<h4>Upload 1 by 1&nbsp;<i class="fa fa-upload pull-right"></i></h4>
								<ul>
									<li>Upload Products One by One</li>
									<li>Preferred Method for uploading less than 10 Products</li>
									<li style="visibility:hidden">Upload Products</li>
									<li style="visibility:hidden">Preferred for products more than 10</li>
									<li style="visibility:hidden">Preferred for products more than 10</li>
								</ul>
								<a class="btn btn-success" href="<?php echo e(url(ADMIN_URL_PATH.'/product/create')); ?>" style="color: white;">Add Products</a>
							</div>
							<div class="col-md-6 box2">
								<h4>Upload Excel Sheet&nbsp;<i class="fa fa-file-excel-o pull-right"></i></h4>
								<ul>
									<li>Download Sample Sheet</li>
									<li>Fill Sheet</li>
									<li>Upload Products</li>
									<li>Preferred for products more than 10</li>
									<li style="visibility:hidden">Upload Products</li>
									<li style="visibility:hidden">Preferred for products more than 10</li>
								</ul>
								<a class="btn btn-success" href="<?php echo e(url(ADMIN_URL_PATH.'/product/bulkUpload')); ?>" style="color: white;">Add Products</a>
							</div>
						</div>
					</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>