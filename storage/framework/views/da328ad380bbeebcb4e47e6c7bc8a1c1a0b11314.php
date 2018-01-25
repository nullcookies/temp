<?php $__env->startSection('title'); ?>
| Home Page Product Setting
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
	
		<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Add Homepage Tag</li>
		</ol>
		<div class="box box-block bg-white">
			
		</div>
		<?php echo Form::model($item, ['method' => 'PATCH','route' => ['admin.product.homepagetag.update', $item->id]]); ?>

		 
		<div class="col-lg-6 col-md-10">				
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Tag Name </label>
					<div class="col-xs-8">
						<?php echo Form::text('tag', null, array('placeholder' => 'Tag Name','class' => 'form-control')); ?>

					</div>
				</div>
				<div class="form-group row">
				<label for="example-text-input" class="col-xs-4 col-form-label">&nbsp;</label>
				<div class="col-xs-8">
				<button class="btn btn-success" type="submit" name="btnSubmit">Submit</button>
				</div>
				</div>
		</div>
		
		<!-- </form> -->
		<?php echo e(Form::close()); ?>

					
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>