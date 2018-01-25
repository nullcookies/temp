<?php $__env->startSection('title'); ?>
|Import - Export in Excel and CSV
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>

<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">	
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>

<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>	
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<div class="container">
	<duv class="pull-right">
		<a class="btn btn-info" href="<?php echo e(url('admin/product/inventory')); ?>">Back</a>
	</duv>
		<!-- <a href="<?php echo e(URL::to('admin/product/downloadExcel/xls')); ?>"><button class="btn btn-success">Download Excel xls</button></a>

		<a href="<?php echo e(URL::to('admin/product/downloadExcel/xlsx')); ?>"><button class="btn btn-success">Download Excel xlsx</button></a>
 -->
		<a href="<?php echo e(URL::to('admin/product/downloadExcel/csv')); ?>"><button class="btn btn-success">Download CSV</button></a>

		<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="<?php echo e(URL::to('admin/product/importExcel')); ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
			<input type="file" name="import_file" />			
			<button class="btn btn-primary">Import File</button>
		<?php if(Session::has('incorrect_mime')): ?> <span class="text-danger"><?php echo e(Session::get('incorrect_mime')); ?> </span><?php endif; ?>
		</form>

	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>