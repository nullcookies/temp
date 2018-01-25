<?php $__env->startSection('title'); ?>
| Homepage Page
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
<style>
	.dropify{height: 80px;width: 80px;}
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
			<li class="breadcrumb-item active">Pages</li>
		</ol>
		

		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3 class="head-position">Pages</h3>
				<ul class="demo-header-actions">				    
					<li class="demo-tabs"><a href="<?php echo e(route('admin.pages.create')); ?>" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Add New</a></li>
					
				</ul>
			</div>	
			<?php if(Session::has('success')): ?>
			<div class="alert alert-success alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<strong><?php echo Session::get('success'); ?>.</strong>
			</div>				
			<?php endif; ?>
		<table class="table table-bordered">
				<tr>
					<th>SN</th>
                    <th>Name</th>
                    <th>Alias</th>
                    <th>Content</th>
                   
                    
                    <th width="280px">Action</th>
				</tr>
				<?php if(count($items) > 0): ?>
				<?php foreach($items as $key => $item): ?>
				<tr>
					 <td><?php echo e(++$i); ?></td>
					<td><?php echo e($item->name); ?></td>                    
                    <td><?php echo e($item->alias); ?> </td>
                    <td><?php echo e(substr(strip_tags($item->content),0,100)); ?> </td>
                    

					<td>
						<a class="btn btn-primary" href="<?php echo e(route('admin.pages.edit',$item->id)); ?>">Edit</a>
						<?php echo Form::open(['method' => 'DELETE','action' => ['Admin\WebsiteSetting\HomepagePagesController@destroy', $item->id],'style'=>'display:inline']); ?>

						<?php echo Form::submit('Delete', ['class' => 'btn btn-danger']); ?>

						<?php echo Form::close(); ?>

						
					</td>
				</tr>
				<?php endforeach; ?>
				<?php else: ?>
				<tr><td colspan="9" align="center"> No any Data found in database</td></tr>
				<?php endif; ?>
				
		</table>
			<?php echo $items->render(); ?>

			
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>