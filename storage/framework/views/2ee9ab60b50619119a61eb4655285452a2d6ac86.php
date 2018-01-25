<?php $__env->startSection('js'); ?>
<script
  src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
  integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
  crossorigin="anonymous"></script>
<script>
  $( function() {
    $( "#datepicker123" ).datepicker();
  } );
  </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid pd-30">
	<div class="container">
		<div class="col-md-3 col-sm-3 profile-box">
			<ul class="profile-tabs">
				<li><a href="#account">My Account</a></li>
				<li class="active"><a href="#profile" data-toggle="tab">My Profile</a></li>
				<li><a href="#address" data-toggle="tab">My Address Book</a></li>
				<!--<li><a href="#remainders" data-toggle="tab">My Reminders</a></li>-->
				<li><a href="#orders" data-toggle="tab">My Orders</a></li>
				<li><a href="#rstpwd" data-toggle="tab">Reset Password</a></li>
				<li><a href="<?php echo e(url('/logout')); ?>">Sign Out</a></li>
			</ul>
		</div>
			<div class="col-md-9 col-sm-9 profile-content">
				<div class="tab-content">
					<!--<div id="account" class="tab-pane fade in active">
							
					</div>-->
					<div id="profile" class="tab-pane fade in active">
						<h3 class="c-red">Your Profile</h3>
						<!-- <form class="formchangepwd">
							<div class="form-group">
								<input type="text" placeholder="Name"/>
							</div>
							<div class="form-group">
								<input type="text" placeholder="Email Address"/>
							</div>
							<button class="savebtn">Save</button>
						</form> -->
						<div class="row pd-10">
							<div class="col-sm-4 profile-profile">
								<h4><?php echo e(Auth::user()->name); ?></h4>
								<p>Mobile No. : <span class="c-red">+91-<?php echo e(Auth::user()->mobile); ?></span></p>
								<p>Mail Id : <span class="c-red"><?php echo e(Auth::user()->email); ?></span></p>
							</div>	
						</div>
					</div>
					
					
					<div id="address" class="tab-pane fade">
						<h3 class="c-red">My Address Book</h3>
						<div class="row pd-10">'
						<?php foreach($addresses as $address): ?>
							<div class="col-sm-4 profile-address">
							    <div class="profile-address-box">
    								<h4><?php echo e($address->name); ?></h4>
    								<p><?php echo e($address->city); ?></p>
    								<p><?php echo e($address->state); ?> - <?php echo e($address->pincode); ?></p>
    								<p>Mobile No. : <span class="c-red">+91-<?php echo e($address->mobile); ?></span></p>
    								<p class="mb-10">Email : <span class="c-red"><?php echo e($address->email); ?></span></p>
								</div>
							</div>
						<?php endforeach; ?>	
						</div>	
					</div>
					
					
					<!--<div id="remainders" class="tab-pane fade">
						<h3 class="c-red">My Reminders</h3>
						<form class="formchangepwd">
							<div class="form-group">
								<input placeholder="* Name"/>
							</div>
							<div class="form-group">
								<input placeholder="* Occasion"/>
							</div>
							<div class="form-group">
								<input placeholder="* Date" id="datepicker123"/>
							</div>
							<button class="savebtn">Save</button>
						</form>
						
						<table class="table profile-orders">
							<thead class="bg-red">
								<th>Name</th>
								<th>Occasion</th>
								<th>Date</th>
							</thead>
							<tbody>
								<tr>
									<td>Sanya</td>
									<td>Gift 1</td>
									<td>Fri, Aug 01, 2017</td>
								</tr>
							</tbody>
						</table>
					</div>-->


					<div id="orders" class="tab-pane fade">
						<h3 class="c-red">My Orders</h3>
						<table class="table profile-orders">
							<thead class="bg-red">
								<th>Order No.</th>
								<th>Recipient</th>
								<th>Amount</th>
								<th>Order Date</th>
								<th>Delivery Date</th>
								<th>Status</th>
							</thead>
							<tbody>
							    <?php foreach($orders as $order): ?>
								<tr>
									<td>OR-<?php echo e($order->id); ?></td>
									<td><?php echo e($order->shippingName); ?></td>
									<td><i class="fa fa-inr"></i> <?php echo e($order->orderAmount); ?></td>
									<td><?php echo e(Carbon\Carbon::parse($order->created_at)->format('D d-m-Y')); ?></td>
									<td><?php if($order->is_delivered == 'yes'): ?> <?php echo e(Carbon\Carbon::parse($order->delivery_time)->format('D d-m-Y')); ?> <?php else: ?> -- <?php endif; ?></td>
									<td><?php echo e($order->status); ?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					
					
					<div id="rstpwd" class="tab-pane fade">
						<h3>Change Password</h3>
						    <?php if(Session::has('success')): ?>
                                <div class="alert alert-success"><?php echo Session::get('success'); ?></div>
                            <?php endif; ?>
                            <?php if(Session::has('failure')): ?>
                                <div class="alert alert-danger"><?php echo Session::get('failure'); ?></div>
                            <?php endif; ?>
						    <form action="<?php echo e(url('/change-password')); ?>" method="post" role="form" class="formchangepwd">
                                <?php echo e(csrf_field()); ?>


							<div class="form-group">
								<input name="old" placeholder="Current Password"/>
								<?php if($errors->has('old')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('old')); ?></strong>
                                    </span>
                                <?php endif; ?>
							</div>
							<div class="form-group">
								<input name="password" placeholder="New Password"/>
								 <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
							</div>
							<div class="form-group">
								<input name="password_confirmation" placeholder="Verify New Password"/>
								<?php if($errors->has('password_confirmation')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                    </span>
                                <?php endif; ?>
							</div>
							<button class="savebtn">Save</button>
						</form>
					</div>
				</div>
			</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>