<?php $__env->startSection('title'); ?>
| <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
<style>
</style>

<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">	
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>

<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>	

<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>	
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>	
<script type="text/javascript">
$('input[name=all]').on('change', function() {
	if($(this).is(':checked')){
		window.location.href= '<?php echo e(url("/admin/orders")); ?>';
	}    
});
$('.mydatepicker').datepicker();
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<ol class="breadcrumb no-bg mb-1">
		<li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>">Home</a></li>
		<li class="breadcrumb-item active"><?php echo $title; ?></li>
	</ol>
	<div class="row">
		<div class="col-md-6 mb-1 mb-md-0">
			<?php if(Session::has('success')): ?>
			<div class="alert alert-success alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<strong><?php echo Session::get('success'); ?>.</strong>
			</div>				
			<?php endif; ?>

			<?php if(Session::has('danger')): ?>
			<div class="alert alert-danger alert-dismissible fade in mb-0" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<strong><?php echo Session::get('danger'); ?>.</strong>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="box box-block bg-white">
		<div class="row view-products">
			<h3>View Orders</h3>
			<?php echo e(Form::open(['method'=>'get','action'=>['Admin\Orders\OrdersController@index']])); ?>

			<ul class="pull-left">
				<li class="demo-tabs"><a href="<?php echo e(url('admin/orders/admin-order')); ?>" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Add Order</a></li>
			</ul>
			<ul class="demo-header-actions">					
			<li class="demo-tabs">						
				<select class="filter-order" name="status">
					<?php foreach($status as $keys => $value): ?>
					<option value="<?php echo e($keys); ?>" <?php echo (isset($_GET['status']) && $keys == $_GET['status']) ? "selected" : '' ?> ><?php echo e($value); ?></option>
					<?php endforeach; ?>
				</select>
			</li>
			<li class="demo-tabs"><button class="btn btn-success search-btn" type="submit">Filter</button></li>
			

		</ul>
		<?php echo e(Form::close()); ?>

	</div>
	<div class="row view-products-heading table-mobile">
		<?php echo e(Form::open(['method'=>'get','action'=>['Admin\Orders\OrdersController@index']])); ?>

		<div class="col-lg-12">
			<label for="search"><span style="font-weight:bold">Search :&nbsp;&nbsp;</span></label> 
			<input type="text" style="padding:4px;" name="key" value="<?php echo isset($_GET['key']) ? $_GET['key'] : ''?>" />
			<div class="btn-group float-right" role="group">
				<select class="select-order" name="opt">
					<option value="">Select</option>
					<option value="id" <?php if($opt == 'id'): ?> selected <?php endif; ?>>Order ID</option>
					<option value="customerName" <?php if($opt == 'customerName'): ?> selected <?php endif; ?>>Customer Name</option>
					<option value="customerPhone" <?php if($opt == 'customerPhone'): ?> selected <?php endif; ?>>Customer Phone Number</option>
					<option value="customerEmail" <?php if($opt == 'customerEmail'): ?> selected <?php endif; ?>>Customer Email</option>
					<option value="paymentType" <?php if($opt == 'paymentType'): ?> selected <?php endif; ?>>Payment Mode</option>
					<!-- <option value="courier" <?php if($opt == 'courier'): ?> selected <?php endif; ?>>Courier Company</option> 
					<option value="tracking_number" <?php if($opt == 'tracking_number'): ?> selected <?php endif; ?>>Tracking Number</option>-->
				</select>
			</div>
			<label for="category" class="ml-50"><span style="font-weight:bold">Order Date :&nbsp;&nbsp;</span></label>
			<div class="btn-group float-right pr-20">
				<input type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy" name="start_date" value="">
				<!-- <input type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy" name="end_date" value="03/01/2017"> -->
			</div>				
			<button class="btn btn-success search-btn" type="submit">Search</button>
		</div>
		<?php echo e(Form::close()); ?>

	</div>
	
	<div class="row table-mobile">

		<table class="table table-striped ">
			<thead>
				<tr>
					<!-- <th></th> -->						
					<th>Order Id</th>						
					<th>Payment Type</th>
					<th>Invoice Value</th>						
					<th>Ship To</th>						
					<th style="width:10%">Product ID</th>
					<th style="width:25%">Product</th>
					<th>Price</th>
					<th>Varients</th>
					<th>Order Status</th>
				</tr>
			</thead>
			<tbody>


				<?php if(!count($orders)): ?>
				<tr>
					<td colspan="9" align="center">No record found.</td>
				</tr>
				<?php endif; ?>

				<?php foreach($orders as $order): ?>
				<tr>
					<!-- <td>
						<?php echo Form::open(array('method' => 'delete', 'action' => ['Admin\Orders\OrdersController@deleteorder'])); ?>

						<input type="hidden" name="id" value="<?php echo e($order->id); ?>">
						<a href="javascript:;" title="Delete" style="color:#ff0000" data-toggle="modal" data-target="#delete_<?php echo e($order->id); ?>"><i class="fa fa-times"></i></a>
						<div class="modal fade small-modal in" id="delete_<?php echo e($order->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<h4 class="modal-title" id="mySmallModalLabel">Orders Delete Confirmation</h4>
									</div>
									<div class="modal-body">
										Are you sure to delete this record ?
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary">yes</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">no</button>
									</div>
								</div>
							</div>
						</div>
						<?php echo Form::close(); ?>							  	
					</td> -->
					<td><?php echo e($order->id); ?></td>						
					<td><?php echo e(strToUpper($order->paymentType)); ?></td>
					<td><?php echo e($order->orderAmount); ?></td>
					<td><strong><?php echo e($order->customerName); ?><br><?php echo e($order->customerEmail); ?></strong><br><?php echo $order->shippingCompleteAddress(); ?></td>						
					<td colspan="4">
						<table class="table mb-0">
						<?php foreach($order->products as $product): ?>
							<tr>
								<td style="width:15%"><?php echo e($product->product_id); ?></td>
								<td style="width:50%"><?php echo e($product->product_name); ?></td>
								<td style="width:15%"><?php echo e($product->selling_price); ?></td>
								<td><?php echo e($product->varients); ?></td>
							</tr>
						<?php endforeach; ?>
						</table>
					</td>
					<td><a href="<?php echo e(url('admin/orders/trackOrder/'.$order->id)); ?>" class="btn btn-sm btn-info btn-rounded mb-0 w-min-xs waves-effect waves-light">More info</a></td> 							
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			
			<?php if(count($orders) > 0): ?>		 
			<div class="table-footer">
				<div class="col-md-3"><div class="dataTables_info" id="table-3_info" role="status" aria-live="polite">Total <?php echo e($orders->total()); ?> records</div></div>
				<div class="col-md-9">
				<?php echo $__env->make('admin.pagination.limit_links', ['paginator' => $orders->appends(['status' => isset($_GET['status']) ? $_GET['status'] : 'all' ])], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
			<?php endif; ?>
			
			
		</div>	

	</div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>