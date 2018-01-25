<?php $__env->startSection('content'); ?>

<div class="container-fluid pd-50">
	<div class="container dd">
		<ul class="cart-tab">
			<li><a href="#"></a></li>
			<li><a href="#"></a></li>
			<li><a href="#"></a></li>
			<li><a href="#"></a></li>
		</ul>
	</div>
</div>	
<div class="container-fluid pd-50">
	<div class="container cart">
		<h1>Order Summary</h1>
		<br/>
		<div class="cart-div2">
			<table class="table cart-table2">
				<thead>
					<tr>
						<th>Gift 1</th>
						<th>To be delivered between <span class="c-red">11:00 - 12:00 hrs</span> on <span class="c-red">Mon, Mar 20</span></th>
						<th class="right"><a href="#" class="view-details">Hide Details</a></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<div class="img-box">
								<img src="<?php echo e(url('massengers/img/team1.jpg')); ?>"/>
							</div>
							<div class="content-box">
								<p>Kendall Jenner</p>
								<a href="#">Remove</a>
							</div>
						</td>
						<td>
							<p class="c-red">Sanya </p>
							<p>Rohini, Delhi</p>
							<p>+91-123456789</p>
						</td>
						<td class="va-mid">
							<p class="c-red right"><i class="fa fa-inr"></i> 1699 x 1</p>
						</td>
					</tr>
					<tr>
						<td class="width-50">
							<div class="img-box">
								<img src="<?php echo e(url('massengers/img/team1.jpg')); ?>"/>
							</div>
							<div class="content-box">
								<p>Kendall Jenner</p>
								<a href="#">Remove</a>
							</div>
						</td>
						<td>
							<p class="c-red">Sanya </p>
							<p>Rohini, Delhi</p>
							<p>+91-123456789</p>
						</td>
						<td class="va-mid">
							<p class="c-red right"><i class="fa fa-inr"></i> 1699 x 1</p>
						</td>
					</tr>
					<tr>
						<td>
							<div class="img-box">
								<img src="<?php echo e(url('massengers/img/team1.jpg')); ?>"/>
							</div>
							<div class="content-box">
								<p>Kendall Jenner</p>
								<a href="#">Remove</a>
							</div>
						</td>
						<td>
							<p class="c-red">Sanya </p>
							<p>Rohini, Delhi</p>
							<p>+91-123456789</p>
						</td>
						<td class="va-mid">
							<p class="c-red right"><i class="fa fa-inr"></i> 1699 x 1</p>
						</td>
					</tr>
					<tr>
						<td colspan="2"></td>
						<td class="bdtop right">
							<p>Sub Total <span class="c-red"><i class="fa fa-inr"></i> 5097</span></p>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<p>Have a Coupon Code&#47;Card Number to redeem&#63; <a href="#" class="c-red">Click Here</a></p>
						</td>
						<td class="bdtop right">
							<p>Shipping Charges <span class="c-red"><i class="fa fa-inr"></i> 200</span></p>
						</td>
					</tr>
					<tr>
						<td colspan="2">
						</td>
						<td class="bdtop right">
							<p>Total <span class="c-red"><i class="fa fa-inr"></i> 5297</span></p>
						</td>
					</tr>
					<tr>
						<td colspan="2"><input type="checkbox" class="pos-ab"/><p class="ml-20">I agree to the Terms &amp; Conditions&#47;Disclaimer&#47;Terms of use</p></td>
						<td class="width-30">
							<a href="<?php echo e(url('checkout1')); ?>" class="con-shop">Back</a>
							<a href="<?php echo e(url('checkout3')); ?>" class="con-shop">Proceed to Pay</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="container-fluid bg-black pd-30">
	<div class="container cart2">
		<div class="col-md-6">
			<h3><span class="c-red">Need Help?</span> Call us on 1234567891</h3>
		</div>
		<div class="col-md-6">
			<h3 class="pull-right"><span class="c-red">3.79 Lakh</span>  People trust us</h3>
		</div>
	</div>
</div>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>