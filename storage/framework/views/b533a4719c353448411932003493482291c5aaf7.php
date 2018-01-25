<?php $__env->startSection('content'); ?>

<div class="container-fluid">
	<div class="container center segoe">
		<img src="<?php echo e(asset('massengers/img/login-flowers.jpg')); ?>" class="img-responsive center-block">
		<h3 class="caps text-left">Welcome to Massengers</h3>
		<!--<div class="mass-border"></div>-->
	</div>
</div>
<div class="container-fluid pd-40">
	<div class="container"> 
		<div class="col-sm-5 col-md-5 login bg-f9f9f9">
				<div class="row mt-60">
				<div class="col-sm-6"><a href="<?php echo e(route('social.redirect', ['provider' => 'google'])); ?>" title="Login With Google"><img src="<?php echo e(asset('massengers/img/g+.png')); ?>" width="150"></a></div>
				<div class="col-sm-6"><a href="<?php echo e(route('social.redirect', ['provider' => 'facebook'])); ?>" title="Login With Facebook"><img src="<?php echo e(asset('massengers/img/fb.png')); ?>" width="150"></a></div>
				</div>
		</div>
		<div class="col-sm-2"></div>
		<div class="col-sm-5 col-md-5 step3 bg-f9f9f9">
			<?php echo Form::open(['method' => 'post', 'action' => ['Auth\CustomauthController@sendotp']]); ?>

				<div class="form-group">
					<label for="emailid">Email ID*</label>
					<input type="text" name="email" required="required" id="emailid" class="form-control bg-pinku" placeholder="Enter your registerd email or Mobile Number">
					<?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
				</div>
				<center>
				<button type="submit" class="btn btn-default" title="Send OTP">Send OTP</button>
				</center>
			<?php echo Form::close(); ?>

			
		</div>
	</div>
</div>	

<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>