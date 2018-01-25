<?php $__env->startSection('title'); ?>
| <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">	
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
<style>
.timeline.timeline-center .tl-left{
	text-align:right;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>

<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>	
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
						<h4>Order Status</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Order Status</li>
						</ol>
						<?php if($order): ?>
						<div class="box box-block bg-white">
							<h3 class="order-status">Order Details</h3>
							<div class="box box-order table-mobile">
							<table class="table table-striped table-order min-width-600">
									<thead>
										<tr class="bg-f5">
											<th>Order Date:</th>
											<td><?php echo e(Carbon\Carbon::parse($order->created_at)->format('D d-M-Y')); ?></td>
											<th>Status:</th>
											<td><?php echo e($order->status); ?></td>
										</tr>
									</thead>
									<tbody>
										<tr class="bg-fff">
											<td>Order ID:</td>
											<td><?php echo e($order->id); ?></td>
											<td>Amount:</td>
											<td><i class="fa fa-inr"></i> <?php echo e($order->orderAmount); ?></td>
										</tr>
										<tr class="bg-fff">
											<td>AWB No.</td>
											<td><?php echo e($order->awb_number); ?></td>
											<td>Expected Delivery Date</td>
											<td><?php echo e(Carbon\Carbon::parse($order->created_at)->addDays(10)->format('D d-M-Y')); ?></td>
										</tr>
									</tbody>
								</table>
								<table class="table table-striped table-order min-width-600">
									<thead>
										<tr class="bg-f5">
											<th>Product Name</th>
											<th>UPC</th>
											<th>Quantity</th>
											<th>Link</th>
											<th>Varients</th>
											<th>Price</th>
											<th>Type</th>
										</tr>
									</thead>
									<tbody>
									<?php $sumProductPrices = 0;$productTypeArr = array(); ?>
									<?php foreach($order->products as $product): ?>
										<?php $sumProductPrices += ($product->selling_price*$product->quantity); ?>
										<?php $productTypeArr[] = $product->product_type; ?>
										<tr class="bg-fff">
											<td><?php echo e($product->product_name); ?></td>
											<td><?php echo e($product->product_id); ?></td>
											<td><?php echo e($product->quantity); ?></td>
											<td><a href="<?php echo e(url($product->product_type == 'api' ? 'products/api_product_detail?product_id='.$product->product_id : 'products/product_detail?product_id='.$product->product_id)); ?>">Click here</a></td>
											<td><?php echo e($product->varients); ?></td>
											<td><i class="fa fa-inr"></i> <?php echo e($product->selling_price); ?></td>
											<td><?php echo e($product->product_type == 'api' ? 'Marketplace Product' : 'Your Product'); ?></td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								<table class="table table-striped table-order min-width-600">
									<tbody>
										<tr class="bg-f5">
											<td colspan="2"></td>
											<th>Subtotal:</th>
											<td><i class="fa fa-inr"></i> <?php echo e($sumProductPrices); ?>/-</td>
										</tr>
										<tr class="bg-f5">
											<td colspan="2"></td>
											<th>Shipping:</th>
											<td><i class="fa fa-inr"></i> <?php echo e($order->shippingCharge); ?>/-</td>
										</tr>
										<tr class="bg-f5">
											<td colspan="2"></td>
											<th>Discount:</th>
											<td><i class="fa fa-inr"></i> <?php echo e($order->coupon_amount); ?>/-</td>
										</tr>
										<tr class="bg-f5"> 
											<th>Payment Status:</th>
											<td><?php echo e($payment_status); ?></td>
											<th>Total:</th>
											<td><i class="fa fa-inr"></i> <?php echo e(($sumProductPrices + $order->shippingCharge )- $order->coupon_amount); ?>/-</td>
										</tr>
										<tr class="bg-f5">
											<th>Commission Earned:</th>
											<td><i class="fa fa-inr"></i> <?php echo e($commission_earned); ?></td>
											<th>Payment Type:</th>
											<td><?php echo e($order->paymentType == 'cod' ? 'COD' : 'Prepaid'); ?></td>
										</tr>
									</tbody>
								</table>
								<?php if(!in_array('api',$productTypeArr)): ?>
								<div class="card-footer clearfix min-width-600">
									<a target="_blank" href="<?php echo e(url('/admin/orders/shippinglabel/'.$order->id)); ?>" class="btn btn-danger label-left float-xs-right">
										<span class="btn-label"><i class="fa fa-print"></i></span>
										Print Shipping Label
									</a>
									<a target="_blank" href="<?php echo e(url('/admin/orders/invoice/'.$order->id)); ?>" class="btn btn-info label-left float-xs-right mr-0-5">
										<span class="btn-label"><i class="fa fa-file-text-o"></i></span>
										Print Invoice
									</a>
								</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="box box-block bg-white">
							<h3 class="shipping-details">Shipping Details</h3>
							<div class="timeline timeline-center mt-20">
								<div class="tl-item">
									<div class="tl-wrap b-a-success">
										<div class="tl-content box-block bg-white br-5">
											<span class="arrow left b-a-white"></span>
											Order Received
										</div>
										<p class="content-timeline"><?php echo e(Carbon\Carbon::parse($order->created_at)->format('D d/m/Y')); ?></p>
										<span class="time"><?php echo e(Carbon\Carbon::parse($order->created_at)->format('h:i:s A')); ?></p>
									</div>
								</div>
								<?php if($order->manifest): ?>
								<div class="tl-item tl-left">
									<div class="tl-wrap b-a-success">
										<div class="tl-content box-block bg-warning br-5">
											<span class="arrow right b-a-warning"></span>
											Manifested
										</div>
										<p class="content-timeline"><?php echo e(Carbon\Carbon::parse($order->manifest->dispatchDate)->format('D d/m/Y')); ?></p>
										<span class="time"><?php echo e(Carbon\Carbon::parse($order->manifest->dispatchDate)->format('h:i:s A')); ?></p>
									</div>
								</div>
								<?php if($order->is_dispatched == 'yes'): ?>
								<div class="tl-item">
									<div class="tl-wrap b-a-success">
										<div class="tl-content box-block bg-primary br-5">
											<span class="arrow left b-a-primary"></span>
											<!--<h6>Title</h6>-->
											Dispatched
										</div>
										<p class="content-timeline"><?php echo e(Carbon\Carbon::parse($order->dispatched_time)->format('D d/m/Y')); ?></p>
										<span class="time"><?php echo e(Carbon\Carbon::parse($order->dispatched_time)->format('h:i:s A')); ?></p>
									</div>
								</div>
								<?php if($order->is_delivered == 'yes'): ?>
								<div class="tl-item tl-left">
									<div class="tl-wrap b-a-success">
										<div class="tl-content box-block bg-success br-5 ml-15">
											<span class="arrow right b-a-success"></span>
											Delivered
										</div>
										<p class="content-timeline"><?php echo e(Carbon\Carbon::parse($order->delivery_time)->format('D d/m/Y')); ?></p>
										<span class="time"><?php echo e(Carbon\Carbon::parse($order->delivery_time)->format('h:i:s A')); ?></p>
									</div>
								</div>
								<?php if($order->is_completed == 'yes'): ?>
								<div class="tl-item">
									<div class="tl-wrap b-a-success">
										<div class="tl-content box-block bg-white br-5">
											<span class="arrow left b-a-white"></span>
											Completed
										</div>
										<p class="content-timeline"><?php echo e(Carbon\Carbon::parse($order->order_complete_time)->format('D d/m/Y')); ?></p>
										<span class="time"><?php echo e(Carbon\Carbon::parse($order->order_complete_time)->format('h:i:s A')); ?></p>
									</div>
								</div>
								<?php endif; ?> <!-- completed if  -->

								<?php endif; ?> <!-- delivered if  -->

								<?php endif; ?> <!-- dispatchd if -->

								<?php endif; ?> <!-- manifest if -->
							</div>
						</div>
						<?php if($order->returnOrder): ?>
						<div class="box box-block bg-white">
							<h3 class="returns-status">Returns Status :</h3>
							<div class="timeline timeline-center mt-20">
							<div class="tl-item">
								<div class="tl-wrap b-a-success">
									<div class="tl-content box-block bg-white br-5">
										<span class="arrow left b-a-white"></span>
										placed return
									</div>
									<p class="content-timeline"><?php echo e(Carbon\Carbon::parse($order->returnOrder->recordInsertedDate)->format('D d/m/Y')); ?></p>
									<span class="time"><?php echo e(Carbon\Carbon::parse($order->returnOrder->recordInsertedDate)->format('h:i:s A')); ?></p>
								</div>
							</div>
							<?php if($order->returnOrder->status == 'approve'): ?>
							<div class="tl-item tl-left">
								<div class="tl-wrap b-a-success">
									<div class="tl-content box-block bg-success br-5">
										<span class="arrow right b-a-success"></span>
										Return Accepted
									</div>
									<!-- <p class="content-timeline">Thu, 02/06/2017</p>
									<span class="time">03:38:40 PM</p> -->
								</div>
							</div>
							<?php endif; ?>

							<?php if($order->returnOrder->status == 'reject'): ?>
							<div class="tl-item tl-left">
								<div class="tl-wrap b-a-success">
									<div class="tl-content box-block bg-danger br-5">
										<span class="arrow right b-a-danger"></span>
										Return Rejected
									</div>
									<!-- <p class="content-timeline">Thu, 02/06/2017</p>
									<span class="time">03:38:40 PM</p> -->
								</div>
							</div>
							<?php endif; ?>
						</div>
						<?php endif; ?>

						<?php else: ?>
							<div class="box box-block bg-white">
							No order found
							</div>
						<?php endif; ?>
						</div>						
					</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>