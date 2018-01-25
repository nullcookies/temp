<?php $__env->startSection('title'); ?>
| Homepage Product Setting
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
<style>
	legend {font-size: 1.2rem;width: 21.6%;}
	fieldset{border:1px solid #ccc;}
</style>

<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">	
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/select2/dist/css/select2.min.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>

<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content-area py-1">
	<div class="container-fluid">		
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>">Home</a></li>
			<li class="breadcrumb-item active">Homepage Product Setting</li>
		</ol>
		

		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3 class="head-position">Homepage Product Setting</h3>
				<ul class="demo-header-actions">	
				<li class="demo-tabs">&nbsp;</li>			    
					<!-- <li class="demo-tabs"><a href="<?php echo e(route('admin.product.homepagetag.create')); ?>" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Add New</a></li> -->
					
				</ul>
			</div>	
			<?php if($message = Session::get('success')): ?>
			<div class="alert alert-success">
				<p><?php echo e($message); ?></p>
			</div>
			<?php endif; ?>

		<table class="table table-bordered">
				<tr>
					<th>No</th>
					<th>Tag Name</th>
					<th width="280px">Action</th>
				</tr>
				<?php foreach($items as $key => $item): ?>
				<tr>
					 <td><?php echo e(++$i); ?></td>
					<td><?php echo e($item->tag); ?></td>

					<td>
						<a class="btn btn-info" href="<?php echo e(route('admin.product.homepagetag.show',$item->id)); ?>">Show Products</a>
						<a class="btn btn-primary" href="<?php echo e(route('admin.product.homepagetag.edit',$item->id)); ?>">Edit</a>
						<!-- <?php echo Form::open(['method' => 'DELETE','route' => ['admin.product.homepagetag.destroy', $item->id],'style'=>'display:inline']); ?>

						<?php echo Form::submit('Delete', ['class' => 'btn btn-danger']); ?>

						<?php echo Form::close(); ?> -->
					</td>
				</tr>
				<?php endforeach; ?>
		</table>
			<?php echo $items->render(); ?>

			
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>