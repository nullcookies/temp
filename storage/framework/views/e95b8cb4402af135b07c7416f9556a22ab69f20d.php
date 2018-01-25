<?php $__env->startSection('content'); ?>

<div class="container-fluid">
	<div class="container center segoe">
		<img src="<?php echo e(asset('massengers/img/login-flowers.jpg')); ?>">
		<h3>Welcome to our online store!</h3>
		<h2 class="caps">login or create an account</h2>
		<div class="mass-border"></div>
	</div>
</div>
<div class="container-fluid pd-40">
	<div class="container"> 
		<div class="col-sm-5 col-md-5 login bg-f9f9f9">
			<form action="<?php echo e(url('/login')); ?>" method="post">
			    <?php echo e(csrf_field()); ?>

				<h3>Login</h3>
				<div class="form-group">
					<input type="email" name="email" class="form-control" placeholder="Email Address">
					<?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
				</div>	
				<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="Password">
					<?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
				</div>
				<a href="loginsignup-step4.html" class="forgot-pass">Forgot Your Password?</a>
				<button type="submit" class="btn btn-default">Sign in</button>
			</form>
				<p class="center">or</p>
				<div class="row pdl-8">
				<div class="col-sm-6"><a href="<?php echo e(route('social.redirect', ['provider' => 'google'])); ?>"><img src="<?php echo e(asset('massengers/img/g+.png')); ?>"></a></div>
				<div class="col-sm-6"><a href="<?php echo e(route('social.redirect', ['provider' => 'facebook'])); ?>"><img src="<?php echo e(asset('massengers/img/fb.png')); ?>"></a></div>
				</div>
		</div>
		<div class="col-sm-2"></div>
		<div class="col-sm-5 col-md-5 signup bg-f9f9f9">
			<h3>Sign Up</h3>
			<form action="<?php echo e(url('/register')); ?>" method="post">
			    <?php echo e(csrf_field()); ?>

				<div class="form-group">
					<input type="text" name="name" class="form-control" placeholder="Name">
					<?php if($errors->has('name')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('name')); ?></strong>
                        </span>
                    <?php endif; ?>
				</div>
				<div class="form-group">
					<input type="email" name="email" class="form-control" placeholder="Email Address">
					<?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
				</div>	
				<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="Password">
					<?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
				</div>
				<div class="form-group">
					<input type="password" name="password_confirmation" class="form-control" placeholder="Repeat Password">
					<?php if($errors->has('password_confirmation')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                        </span>
                    <?php endif; ?>
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
		<!-- <div class="col-sm-5 col-md-5 step2 bg-f9f9f9">
			<form>
				<div class="form-group">
					<label for="emailid">Email ID*</label>
					<input type="email" id="mymailid" onload="dosomething(this)" class="form-control bg-pinku" placeholder="gauravsharma@fortek.in" disabled>
					<small class="pull-right"><a href="#">Use Different Email Id</a></small>
				</div>
				<div class="form-group mb-05">
					<label for="name">Name*</label>
					<input type="text" id="name" class="form-control">
				</div>
				<div class="form-group mb-05">
					<input type="text" class="form-control pl-50" placeholder="Mobile*">
					<div class="number">+91 |</div>
				</div>
				<div class="form-group mb-05">
					<input type="password" class="form-control" placeholder="*Create a Password">
				</div>
				<p class="center">Password should have a minimum of 6 character and atleast one number (0-9)</p>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
		<div class="col-sm-5 col-md-5 step3 bg-f9f9f9">
			<form>
				<div class="form-group">
					<label for="emailid">Email ID*</label>
					<input type="email" id="emailid" class="form-control bg-pinku" placeholder="gauravsharma@fortek.in" disabled>
				</div>
				<div class="form-group">
					<label for="emailid">Password*</label>
					<input type="email" id="emailid" class="form-control">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
				<button type="submit" class="btn btn-default">Login Without Password</button>
			</form>
		</div>
		<div class="col-sm-5 col-md-5 step4 bg-f9f9f9">
			<p class="center">Please Enter verification code (OTP) sent to: sharma.gaurav0147@gmail.com &amp; xxxxxx2488</p>
			<form>
				<div class="form-group">
					<input type="email" id="emailid" class="form-control" placeholder="Enter Code">
				</div>
				<a href="#">Resend OTP</a>
				<button type="submit" class="btn btn-default">Continue</button>
			</form>
		</div> -->
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>