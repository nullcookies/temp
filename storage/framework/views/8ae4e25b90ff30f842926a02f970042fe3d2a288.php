<?php $__env->startSection('title'); ?>
| Homepage Social Media
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
			<li class="breadcrumb-item active">Homepage Social Media</li>
		</ol>
		
		<?php if(Session::has('success')): ?>
				<div class="alert alert-success alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong><?php echo Session::get('success'); ?>.</strong>				
				</div>
				<?php endif; ?>
				<?php if(Session::has('danger')): ?>
				<div class="alert alert-danger alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						<strong><?php echo Session::get('danger'); ?>.</strong>
				</div>
				<?php endif; ?>
		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3 class="head-position">Homepage Social Media</h3>
				<ul class="demo-header-actions">				    
					<li class="demo-tabs"><a href="<?php echo e(url('admin/socialmedia/addsocial')); ?>" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Add New</a></li>
					
				</ul>
			</div>	
			

		<table class="table table-bordered">
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Alias</th>
					<th>Link</th>
					<th width="280px">Action</th>
				</tr>
				<?php foreach($items as $key => $item): ?>
				<tr>
					 <td><?php echo e(++$i); ?></td>
					<td><?php echo e($item->name); ?></td>
					<td><?php echo e($item->slug); ?></td>
					<td><?php echo e($item->link); ?></td>
					
					<td>
						<a class="btn btn-primary" href="<?php echo e(url('admin/socialmedia/editsocial/'.$item->id)); ?>">Edit</a>
						<?php echo Form::open(['method' => 'DELETE','action' => ['Admin\WebsiteSetting\WebsiteSettingController@deletesocial'],'style'=>'display:inline']); ?>

						<?php echo e(Form::hidden('id', $item->id)); ?>

						<?php echo Form::submit('Delete', ['class' => 'btn btn-danger']); ?>

						<?php echo Form::close(); ?>

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