<?php $__env->startSection('content'); ?>
	
<div class="container-fluid pd-40">
	<div class="container">
		<h1 class="center roboto c-red">Welcome to Massengers!</h1>
	</div>
</div>
<div class="container-fluid tracker">
	<div class="container">
		<div class="col-sm-6 track-order">
			<h2 class="center c-red">Track Order</h2>
			<p class="center">Track all your orders by entering your order id or by your registered email address</p>
			<br/>
			<form class="trackform">
				<div class="form-group">
					<input type="text" placeholder="Order ID" class="form-control">
				</div>
				<h2 class="center or">OR</h2>
				<div class="form-group">
					<input type="text" placeholder="Email/Mobile Number" class="form-control">
				</div>
				<div class="form-group center">
					<button type="button" class="btn btn-track">Track Order</button>
				</div>
			</form>
		</div>
		<div class="col-sm-6 center delivery-box">
			<img src="<?php echo e(asset('massengers/img/delivery-truck.png')); ?>">
			<h3 class="c-red">Massengers Delivery</h3>
		</div>
	</div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>