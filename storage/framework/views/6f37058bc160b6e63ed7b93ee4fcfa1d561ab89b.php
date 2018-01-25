<?php $__env->startSection('js'); ?>
	<script type="text/javascript">
		
		function removeCart(cartid){
			swal({
			        title: "Are you sure?",
			        text: "You will not be able to recover Cart Item!",
			        type: "warning",
			        showCancelButton: true,
			        confirmButtonColor: "#DD6B55",
			        confirmButtonText: "Yes, delete it!",
			        cancelButtonText: "No, cancel please!",
			        closeOnConfirm: false,
			        closeOnCancel: false 
			    },
			    function(isConfirm) {
			        if (isConfirm) {
			            
			            $.ajax({
			            	url: "<?php echo e(url('/delete_cart_item')); ?>",
			            	type: 'post',
			            	data: {cartid:cartid},
			            	dataType: 'json',
			            	beforeSend: function(){
								swal({
								  title: 'Processing..',
								  text: 'please do not referesh the page',
								  showCancelButton: false,
								  showConfirmButton: false
								});
							},
							success: function(result){
								if(result['message']){
									location.reload();
								}
							},
							error: function(data){
								errorsHtml = '';
								$.each(data.responseJSON, function(key, value) {
									if($.isArray(value)){
										errorsHtml += value[0];
									}else{
										errorsHtml += value;
									}
									return false;
						        });

								swal(errorsHtml, '', 'error');
							}
			            });
			        } else {
			            swal("Cancelled", "Your Cart Item is safe :)", "error");
			        }
			    }
			);
		}


		// checkout by cart

		$(document).ready(function(){
			$('#checkout_by_cart').on('click', function(event){
				swal({
			        title: "Are you sure?",
			        text: "All items will be autometically removed from cart",
			        type: "warning",
			        showCancelButton: true,
			        confirmButtonColor: "#DD6B55",
			        confirmButtonText: "Yes, Proceed to pay!",
			        cancelButtonText: "No, cancel please!",
			        closeOnConfirm: false,
			        closeOnCancel: true, 
			    },
			    function(isConfirm) {
			        if (isConfirm) {
			            
			            $.ajax({
			            	url: "<?php echo e(url('/checkout_by_cart')); ?>",
			            	type: 'post',
			            	dataType: 'json',
			            	beforeSend: function(){
								swal({
								  title: 'Processing..',
								  text: 'please do not referesh the page',
								  showCancelButton: false,
								  showConfirmButton: false
								});
							},
							success: function(result){
								if(result['message']){
									window.location.href = "<?php echo e(url('/product/checkout')); ?>/"+result['buy_now_id'];
								}
							},
							error: function(data){
								errorsHtml = '';
								$.each(data.responseJSON, function(key, value) {
									if($.isArray(value)){
										errorsHtml += value[0];
									}else{
										errorsHtml += value;
									}
									return false;
						        });

								swal(errorsHtml, '', 'error');
							}
			            });
			        } 
			    }
			);
			});
		})
	</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if(count($carts) && Auth::user()): ?>
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
				<?php foreach($carts as $cart): ?>
					<tr>
						<td>
							<div class="img-box">
								<img src="<?php echo e($productimage[$cart->id]); ?>"/>
							</div>
							<div class="content-box">
								<p><?php echo e($cart->product_name); ?></p>
								<a href="javascript:;" onclick="removeCart(<?php echo e($cart->id); ?>)">Remove</a>
							</div>
						</td>
						<td>
							<p class="c-red"><?php echo e($delivering_on[$cart->id]); ?>, <?php echo e($delivery_timing[$cart->id]); ?></p>
							<p><?php echo e($delivery_option[$cart->id]); ?></p>
						</td>
						<td>
							<p class="c-red"><?php echo e($cart->quantity); ?></p>
						</td>
						<td>
							<p class="c-red"><i class="fa fa-inr"></i> <?php echo e($cart->product_selling_price); ?></p>
						</td>
					</tr>
				<?php endforeach; ?>	
				
					<tr>
						<td class="bdtop" colspan="2">
							<p class="c-red">&#042; Shipping charges to be displayed in the Order Summary Page.</p>
						</td>
						<td class="bdtop">
							<p>Subtotal</p>
						</td>
						<td class="bdtop">
							<p class="c-red"><i class="fa fa-inr"></i> <?php echo e($subtotal); ?></p>
						</td>
					</tr>
					<tr>
						<td class="bdtop" colspan="2">
						</td>
						<td class="bdtop">
							<p>Total</p>
						</td>
						<td class="bdtop">
							<p class="c-red"><i class="fa fa-inr"></i> <?php echo e($subtotal); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<ul class="cart-list">
				<li><a href="<?php echo e(url('/')); ?>" class="con-shop">Continue Shopping</a></li>
				<li><a href="javascript:;" id="checkout_by_cart" class="con-shop">Proceed to Pay</a></li>
			</ul>
		</div>
	</div>
</div>
<?php else: ?>
<div class="container-fluid pd-50">
	<div class="container minicart">
		<h1>Your Cart</h1>
		<center>
			<img src="<?php echo e(asset('massengers/img/frownface.png')); ?>"/>
		</center>
		<h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h3>
		<h4>Lorem Ipsum is simply dummy text.</h4>
		<br/>
		<a href="<?php echo e(url('/')); ?>" class="shop-now cart-btn">Shop Now</a>
	</div>
</div>
<?php endif; ?>
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