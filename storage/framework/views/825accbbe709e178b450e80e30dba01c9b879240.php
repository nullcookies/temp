<?php $__env->startSection('content'); ?>

<div class="container-fluid fof-main">
	<div class="container">
		<span class="fof">404</span>
		<h2>Oops, sorry we can&#39;t find that page !</h2>
		<h5>Either something went wrong or the page dosn&#39;t exist anymore.</h5>
		<br/>
		<br/>
		<a href="<?php echo e(url('/')); ?>" class="home-page">Home Page</a>
	</div>
</div>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>