<?php $__env->startSection('content'); ?>

<div class="container-fluid pd-50">
	<div class="container cart">
		<h1>Your Cart</h1>
		<br/>
		<div class="cart-div">
			<table class="table table-responsive cart-table">
				<thead>
					<tr>
						<th>Products</th>
						<th>Send To</th>
						<th>Quantity</th>
						<th>Amount</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<div class="img-box">
								<img src="<?php echo e(asset('massengers/img/team1.jpg')); ?>"/>
							</div>
							<div class="content-box">
								<p>Kendall Jenner</p>
								<a href="#">Remove</a>
							</div>
						</td>
						<td>
							<p class="c-red">Mon, Mar 20, 11:00 Hrs-12:00 Hrs</p>
							<p>Fixed Time Delivery</p>
						</td>
						<td>
							<p class="c-red">1</p>
						</td>
						<td>
							<p class="c-red"><i class="fa fa-inr"></i> 1699</p>
						</td>
					</tr>
					<tr>
						<td>
							<div class="img-box">
								<img src="<?php echo e(asset('massengers/img/team1.jpg')); ?>"/>
							</div>
							<div class="content-box">
								<p>Kendall Jenner</p>
								<a href="#">Remove</a>
							</div>
						</td>
						<td>
							<p class="c-red">Mon, Mar 20, 11:00 Hrs-12:00 Hrs</p>
							<p>Fixed Time Delivery</p>
						</td>
						<td>
							<p class="c-red">1</p>
						</td>
						<td>
							<p class="c-red"><i class="fa fa-inr"></i> 1699</p>
						</td>
					</tr>
					<tr>
						<td>
							<div class="img-box">
								<img src="<?php echo e(asset('massengers/img/team1.jpg')); ?>"/>
							</div>
							<div class="content-box">
								<p>Kendall Jenner</p>
								<a href="#">Remove</a>
							</div>
						</td>
						<td>
							<p class="c-red">Mon, Mar 20, 11:00 Hrs-12:00 Hrs</p>
							<p>Fixed Time Delivery</p>
						</td>
						<td>
							<p class="c-red">1</p>
						</td>
						<td>
							<p class="c-red"><i class="fa fa-inr"></i> 1699</p>
						</td>
					</tr>
					<tr>
						<td class="bdtop" colspan="2">
							<p class="c-red">&#042; Shipping charges to be displayed in the Order Summary Page.</p>
						</td>
						<td class="bdtop">
							<p>Subtotal</p>
						</td>
						<td class="bdtop">
							<p class="c-red"><i class="fa fa-inr"></i> 5097</p>
						</td>
					</tr>
					<tr>
						<td class="bdtop" colspan="2">
						</td>
						<td class="bdtop">
							<p>Total</p>
						</td>
						<td class="bdtop">
							<p class="c-red"><i class="fa fa-inr"></i> 5097</p>
						</td>
					</tr>
				</tbody>
				<!--<tfoot>
					<tr>
						<td colspan="2"></td>
						<td>
							<a href="index.html" class="con-shop">Continue Shopping</a>
						</td>
						<td>
							<a href="#" class="con-shop">Proceed to checkout</a>
						</td>
					</tr>
				</tfoot>-->
			</table>
			<ul class="cart-list">
				<li><a href="<?php echo e(url('/categoryproduct')); ?>" class="con-shop">Continue Shopping</a></li>
				<li><a href="<?php echo e(url('/checkout1')); ?>" class="con-shop">Proceed to Pay</a></li>
			</ul>
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