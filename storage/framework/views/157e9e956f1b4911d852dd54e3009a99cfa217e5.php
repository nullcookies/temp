<?php $__env->startSection('title'); ?>
    | Ecommerce website
<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>

<meta name="title" content="kibakibi">
<meta name="description" content="ecommerece, products, online buy product">
<meta name="author" content="TechTurtle">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/custom.css')); ?>" />
<style>
    .content-wrapper {
    margin: auto;
    text-align: center;
    background-color: #f2d03b !important;
    padding-top: 80px;
    padding-bottom: 120px;
}
footer{
    margin-top:0px !important;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <div class="container">
      <div class="col-md-offset-3 col-md-6">
    <center><img src="<?php echo e(url('images/message/success.png')); ?>"/></center>
<h3>Payment Successful</h3>
<h4>Congratulations! Your order has been placed successfully.</h4>
<h5>Your <strong>transaction Id: <?php echo e($order->txnId); ?></strong></h5>
<h5>Your <strong>Order No: <?php echo e($order->id); ?></strong></h5>
<h5>
    
   
<?php echo e($order->paymentType == 'cod' ? 'You are required to pay Rs' : 'You have paid'); ?> <i class="fa fa-inr"></i> <?php echo e($order->orderAmount); ?>. <?php echo e($order->paymentType == 'cod' ? 'when you receive the product.' : 'for your purchase'); ?>  </h5>
<br/><br/>
<a href="<?php echo e(url('/')); ?>" type="button" class="btn-home"><span>Back to Homepage</span></a>
</div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.front_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>