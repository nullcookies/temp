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
<script>	
	$(document).ready(function(){

		$('input[name="orderid[]"]').on('change', function(event){
			if($('input[name="orderid[]"]:checked').length){
				$('#saveMultipleManifest').removeAttr('disabled');
			}else{
				$('#saveMultipleManifest').attr('disabled','disabled');
			}
		});

		$('#saveMultipleManifest').on('click', function(event){
			$('#bulkMenifestForm').submit();
		});
		

		$('input:radio[name=filter]').on('change',function(e){
			getData(1);
		});		
	});
	function getData(page) {
		var filter = $('input[name="filter"]:checked').val(); 
		var url = '<?php echo url("/admin/orders/manifest"); ?>';
		var str = '?s='+filter;
		window.location.href = url+str;		
	}

	function enableManifiest(thisPass, orderid) {
		var thisObj = $(thisPass);
		$(".bulkmanifest"+orderid).removeAttr('disabled');
		$(thisObj).parent().find(".manifest").show();
		$(thisObj).parent().find(".oldManifest").hide();
		$(thisObj).parent().find(".mani").hide();
	}
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="content-area py-1">
	<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Manifest</li>
		</ol>
		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3><?php echo $title; ?></h3>
				<div class="pull-left">
					<span>Filter :</span>
					<span>
						<input type="radio" name="filter" id="fulfill" value="today" <?php if(isset($_GET['s']) && ($_GET['s'] == 'today')): ?> checked="" <?php endif; ?> onclick="getData(<?php echo isset($_GET['page']) ?$_GET['page']:1 ?> )" ><label for="fulfill">Fullfilled Today</label>
					</span>
					<span>
						<input type="radio" name="filter" id="delayed" value="delayed" <?php if(isset($_GET['s']) && ($_GET['s'] == 'delayed')): ?> checked="" <?php endif; ?> onclick="getData(<?php echo isset($_GET['page']) ?$_GET['page']:1 ?> )" ><label for="delayed">Delayed</label>
					</span>
					<span>
						<input type="radio" name="filter" id="manifest" value="manifested" <?php if(isset($_GET['s']) && ($_GET['s'] == 'manifested')): ?> checked="" <?php endif; ?> onclick="getData(<?php echo isset($_GET['page']) ?$_GET['page']:1 ?> )" ><label for="manifest">Manifested</label>
					</span>
				</div>
				<div class="pull-right">	 
				<form action="" method="get" id="fromSearch" class="form-inline">
						<div class="form-group">
							<label for="inputPassword2" class="sr-only">Search Category</label>
							<input type="text" class="form-control" name="search" id="appendedInputButton" placeholder="Search for...ID/Customer Phone" title="Search..ID/Customer Phone">
						</div>
						<button type="submit" class="btn btn-primary"><i class="ti-search"></i></button>
					</form>
				</div>
			</div>	
			<?php if(count($orders) > 0): ?>
			<div class="row shipping-label table-mobile">
			<span>
				<button id="saveMultipleManifest" disabled class="btn btn-primary pull-right mb-10">Generate Manifest</button>
			</span>
			<?php echo Form::open(array('id' => 'bulkMenifestForm', 'method' => 'post', 'action' => ['Admin\Orders\OrdersController@saveBulkMenifest'])); ?>

				<table class="table table-striped">
					<thead>
						<tr>
						<th>Check</th>
						<th>Order Id</th>						
						<th>Payment Type</th>
						<th>Invoice Value</th>						
						<th>Ship To</th>						
						<th style="width:8%">Product ID</th>
						<th style="width:25%">Product</th>
						<th>Price</th>
						<th>Varients</th>
						<th class="br-3">&nbsp; Action</th>
						</tr>
					</thead>
					<tbody>			
						<?php foreach($orders as $order): ?>

						<tr class="mani">
						<?php if($order->status == 'manifest'): ?>
							<input type="hidden" name="alreadyManifested" value="1">
						<?php endif; ?>
						<td><input type="checkbox" class="bulkmanifest<?php echo e($order->id); ?>" name="orderid[]" value="<?php echo e($order->id); ?>" <?php if($order->shipping_label_printed == 'no'): ?> disabled  <?php endif; ?> ></td>
							<td><?php echo e($order->id); ?></td>						
						<td><?php echo e(strToUpper($order->paymentType)); ?></td>
						<td><?php echo e($order->orderAmount); ?></td>
						<td><strong><?php echo e($order->customerName); ?><br><?php echo e($order->customerEmail); ?></strong><br><?php echo $order->shippingCompleteAddress(); ?></td>						
						<td colspan="4">
							<table class="table">
							<?php $productTypeArr = array(); ?>
							<?php foreach($order->products as $product): ?>
							    <?php $productTypeArr[] = $product->product_type; ?>
								<tr>
									<td style="width:15%"><?php echo e($product->product_id); ?></td>
									<td style="width:55%"><?php echo e($product->product_name); ?></td>
									<td style="width:13%"><?php echo e($product->selling_price); ?></td>
									<td><?php echo e($product->varients); ?></td>
								</tr>
							<?php endforeach; ?>
							</table>
						</td> 	
							<td>
								<?php if(!in_array('api',$productTypeArr)): ?><a target='_blank' href="<?php echo e(url('admin/orders/shippinglabel/'.$order->id)); ?>" class='btn btn-primary btn-rounded btn-sm mb-0-25 waves-effect waves-light' onclick='enableManifiest(this, <?php echo e($order->id); ?>)' >Shipping Label</a><?php endif; ?>
								<!-- <?php if($order->shipping_label_printed == 'no'): ?>
								<a target='_blank' href="<?php echo e(url('admin/orders/manifestlabel/'.$order->id)); ?>" class='btn btn-info btn-rounded btn-sm mb-0-25 waves-effect waves-light manifest' onclick='enableManifiest(this, <?php echo e($order->id); ?>)' style='display:none;' >Genrate Manifest</a>
								<a class='btn btn-outline-black btn-rounded disabled oldManifest btn-sm mb-0-25 waves-effect waves-light'>Genrate Manifest</a>							
								<?php else: ?>
								<a target='_blank' href="<?php echo e(url('admin/orders/manifestlabel/'.$order->id)); ?>" class='btn btn-info btn-rounded btn-sm mb-0-25 waves-effect waves-light manifest' >Genrate Manifest</a>
								<?php endif; ?> -->
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php echo Form::close(); ?>

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
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>