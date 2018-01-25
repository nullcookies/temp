<?php $__env->startSection('title'); ?>
	| <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
	<style>
		.run-toast{cursor: pointer;}
	</style>
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">	
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/nestable/nestable.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/toastr/toastr.min.css')); ?>">	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>

	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/ui-nestable.js')); ?>"></script>	
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/nestable/jquery.nestable.js')); ?>"></script>	
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/toastr/toastr.min.js')); ?>"></script>	
<script type="text/javascript">
	
	$(document).ready(function(){
		toastr.options = {
			positionClass: 'toast-top-right'
		};
	});
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content-area py-1">
	<div class="container-fluid">
		<h4><?php echo $title; ?></h4>
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>">Home</a></li>
			<li class="breadcrumb-item active"><?php echo $title; ?></li>
		</ol>
		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3 class="head-position"><?php echo $title; ?></h3>
				<ul class="demo-header-actions">
					<li class="demo-tabs"><a href="<?php echo e(url('/admin/category/categorylist')); ?>" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Category List</a></li>
					<li class="demo-tabs"><a href="<?php echo e(url('/admin/category/add')); ?>" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Create Category</a></li>
					
				</ul>
			</div>
			<div class="row">
				<div class="col-md-6 category-list" style="padding: 10px;">			        
			        <?php echo $__env->make('admin/category/category', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>			        
				</div>				
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>