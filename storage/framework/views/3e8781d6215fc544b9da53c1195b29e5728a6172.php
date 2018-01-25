<?php $__env->startSection('title'); ?>
	| Ecommerce website
<?php $__env->stopSection(); ?>



<?php $__env->startSection('meta'); ?>

<meta name="title" content="kibakibi">
<meta name="description" content="ecommerece, products, online buy product">
<meta name="author" content="TechTurtle">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container">
      <div class="std">
        <div class="page-not-found wow bounceInRight animated">
          <h2>404</h2>
          <h3>Oops! The Page you requested was not found!</h3>
          <div><a href="<?php echo e(url('/')); ?>" type="button" class="btn-home"><span>Back to Website</span></a></div>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.front_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>