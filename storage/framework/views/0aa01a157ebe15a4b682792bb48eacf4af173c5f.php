<?php $__env->startSection('title'); ?>
| <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
<style>
</style>

<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">	
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/sweetalert2/sweetalert2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/switchery/dist/switchery.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/nprogress/nprogress.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>

<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>	
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/switchery/dist/switchery.min.js')); ?>"></script>	
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/sweetalert2/sweetalert2.min.js')); ?>"></script>	
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/nprogress/nprogress.js')); ?>"></script>
<script type="text/javascript">
	$().ready(function(){
		$('input[name="filter"]').change(function() {
			getData(1);
		});
	});

	function redirectThisPage(){
		var url = '<?php echo url("/admin/orders/orderDispatch"); ?>';
		window.location.href = url;	
	}

	function getData(page) {
		var filter = $('input[name="filter"]:checked').val();
		var url = '<?php echo url("/admin/orders/orderDispatch"); ?>';
		var str = '?page='+page+'&s='+filter;
		window.location.href = url+str;		
	}
	function changeStatus (id,status,oid) {
		$.ajax({
			url: "<?php echo e(url('admin/orders/updateStatus')); ?>",
			type: 'POST',
			dataType: 'html',
			data: {id: id,status:status,oid:oid},
			beforeSend: function(){
				NProgress.start();
			},
			success: function(result){				
				if (result != '') {
					$("#action" + id).parents("tr").hide();
					$("#totalCount").html(parseInt($("#totalCount").html()) - 1);
					swal("Success !", "Status changed successfully", "success");
				}
				NProgress.done();
			},
		});
	}
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Orders</li>
		</ol>
		<?php if($message = Session::get('success')): ?>
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong><?php echo e($message); ?></strong>
		</div>				
		<?php endif; ?>
		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3 class="head-position"><?php echo $title; ?></h3>

				<div class="pull-left" style="position: relative;top: 20px;">
					<span>Filter :</span>
					<span>
						<input type="radio" name="filter" id="manifest" value="dispatched" <?php if(isset($_GET['s']) && ($_GET['s'] == 'dispatched')): ?> checked="" <?php endif; ?> onclick="getData(<?php echo isset($_GET['page']) ?$_GET['page']:1 ?> )" ><label for="manifest">Dispatched</label>
					</span>
				</div>
				<div class="pull-right">	 
					<form action="" method="get" id="fromSearch" class="form-inline">
						<div class="form-group">
							<label for="inputPassword2" class="sr-only">Search Category</label>
							<input type="hidden" name="s" value="<?php echo e(isset($_GET['s']) ? $_GET['s'] : 'manifest'); ?>">
							<input type="text" class="form-control" name="search" id="appendedInputButton" placeholder="Search for...ID/Customer Phone" title="Search..ID/Customer Phone">
						</div>
						<button type="submit" class="btn btn-primary"><i class="ti-search"></i></button>
					</form>
				</div>

			</div>	
			<?php if(count($orders) > 0): ?>
			<div class="row shipping-label table-mobile">
				<table class="table table-striped">
					<thead>
						<!-- <th class="br-3">SN</th> -->
						<th>Order Id</th>						
						<th>Payment Type</th>
						<th>Invoice Value</th>						
						<th>Ship To</th>						
						<th style="width:8%;">Product ID</th>
						<th style="width:25%;">Product</th>
						<th style="width:6%;">Price</th>
						<th style="width:10%;">Varients</th>
						<th class="br-3">&nbsp; Action</th>
					</thead>
					<tbody id="ressult">			
									
						<?php foreach($orders as $order): ?>						
						<tr class="mani">
							<td><?php echo e($order->id); ?></td>						
						<td><?php echo e(strToUpper($order->paymentType)); ?></td>
						<td><?php echo e($order->orderAmount); ?></td>
						<td><strong><?php echo e($order->customerName); ?><br><?php echo e($order->customerEmail); ?></strong><br><?php echo $order->shippingCompleteAddress(); ?></td>						
						<td colspan="4">
							<table class="table">
							<?php foreach($order->products as $product): ?>
								<tr>
									<td style="width:15%;"><?php echo e($product->product_id); ?></td>
									<td style="width:53%;"><?php echo e($product->product_name); ?></td>
									<td style="width:13%;"><?php echo e($product->selling_price); ?></td>
									<td><?php echo e($product->varients); ?></td>
								</tr>
							<?php endforeach; ?>
							</table>
						</td> 

							<td id="action<?php echo $order->id; ?>"> 	

							<?php if(isset($_GET['s']) && ($_GET['s'] == 'dispatched')): ?>
								<span>dispatched</span>
							<?php else: ?>
								<a href="<?php echo e(url('/admin/orders/signedmanifest/'.$order->id)); ?>" class="btn btn-success btn-rounded mb-0-25 waves-effect waves-light" title="Dispatch">Dispatch</a>						
							<?php endif; ?>						
							
							
						</td>
						
						
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php /* ?>
			@if(count($orders) > 0)		 
			<div class="table-footer">
				<div class="col-md-3"><div class="dataTables_info" id="table-3_info" role="status" aria-live="polite">Total {{$orders->total()}} records</div></div>
				<div class="col-md-9">
				@include('admin.pagination.limit_links', ['paginator' => $orders])
				</div>
			</div>
			@endif
			<?php */ ?>
		</div>	

		<?php else: ?>
		<div class="row shipping-label table-mobile">
			<div class="panel panel-default">
				<div class="panel-body">
					<p>No record found</p>
				</div>
			</div>
		</div>
		<?php endif; ?>

	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>