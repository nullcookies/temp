<?php $__env->startSection('title'); ?>
	| dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/index.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<h4>Notifications & Notices</h4>
	<ol class="breadcrumb no-bg mb-1">
		<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
		<li class="breadcrumb-item active">Notices</li>
	</ol>
	<div class="box box-block bg-white">
		<div class="clearfix">
			<div class="float-md-left">
				<div class="form-group">
					<?php echo Form::open(array('method' => 'get','action' => ['Admin\StaticPage\StaticPagesController@notices'])); ?>

					<input type="text" autocomplete="off" class="form-control" name="q" placeholder="Search...">
					<?php echo Form::close(); ?>

				</div>
			</div>
		</div>
		<div class="management mb-1">
		<?php foreach($results as $result): ?>
			<div class="m-item pad-1-5">
				<div class="mi-title">
					<a class="text-black"><?php echo e($result->title); ?></a>
					<div class="float-md-right">
						<span class="font-90 text-muted"><?php echo e($result->type); ?></span>
					</div>
				</div>
				<div class="mi-text"><?php echo $result->content; ?></div>
				<div class="clearfix">
					<div class="float-md-right">
						<span class="font-90 text-muted"><?php echo e(date_format(date_create($result->created_at),'D d-m-Y H:i')); ?></span>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
		<nav class="text-xs-right">
			<?php if(count($results)): ?> <span><?php echo $results->render(); ?></span> <?php endif; ?>
		</nav>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>