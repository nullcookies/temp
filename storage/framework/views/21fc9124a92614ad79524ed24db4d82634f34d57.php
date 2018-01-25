<?php $__env->startSection('title'); ?>
| <?php echo e('Coupons'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/multi_select/css/multi-select.css')); ?>">	
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/clockpicker/dist/bootstrap-clockpicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')); ?>">

<style>	
	.radius12{
		border-radius: 12px !important;
	}
	.view-products-row table td:nth-child(7) {width: 1%;}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>
<script>
	$("#selectall").change(function () {
		$("input:checkbox").prop('checked', $(this).prop("checked"));
		$("input:checkbox").prop('checked', $(this).prop("checked"));
	});
</script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
	<h4>Products</h4>
	<ol class="breadcrumb no-bg mb-1">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item"><a href="<?php echo e(url('admin/product')); ?>">Products</a></li>
		<li class="breadcrumb-item active"><a href="<?php echo e(url('admin/product/deleted')); ?>">Deleted Products</a></li>
	</ol>
	<div class="box box-block bg-white">
		<div class="row header-row">
			<h3 class="head-position">Deleted Products</h3>
			<ul class="demo-header-actions">
				<li class="demo-tabs">
					<?php echo Form::open(array('method' => 'get', 'action' => ['Admin\Product\ProductController@deleted'])); ?>

					<div class="col-md-9">
						<div class="form-group">
							<input type="text" class="form-control" name="c" value="<?php echo isset($_GET['c']) ? $_GET['c'] : ''; ?>" placeholder="Search by Product name or category">
						</div>
					</div>

					<div class="col-md-3">
						<input type="submit" class="btn btn-success" value="Search" name="">
					</div>											
					<?php echo Form::close(); ?> 
				</li>
				<li class="demo-tabs"><a href="<?php echo e(url(ADMIN_URL_PATH.'/product/upload')); ?>" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Upload Product</a></li>
			</ul>
		</div>
		<?php if(Session::has('success')): ?>
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>								
			<strong><?php echo Session::get('success'); ?>.</strong>
		</div>				
		<?php endif; ?>
		<?php if(Session::has('danger')): ?>
		<div class="alert alert-danger alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<strong><?php echo Session::get('danger'); ?>.</strong>
		</div>				
		<?php endif; ?>
		<div class="row view-products-row table-mobile">
			<table class="table table-striped">
				<thead>
					<tr>
						
						<th>SN</th>												
						<th>Image</th>
						<th>Product Name</th>
						<th>SKU</th>
						<th>UPC</th>
						<th>Categories</th>
						<th>Mrp</th>
						<th>Selling Price</th>
						<th>Quantity</th>
						<!-- <th>Status</th> -->
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($products as $product): ?>
					<tr>													
						<td><?php echo e($index_items); ?></td>													
						<td>
							<a href="<?php echo e(url('admin/product/productimages?upc='.$product->upc)); ?>"><img src="<?php echo url('product_images/50x50/'.$product->product_image); ?>" width="50" height="50" title="Product 1"/></a>


							
						</td>
						
						<td><?php echo e($product->product_name); ?></td>
						<td><?php echo e($product->sku); ?></td>
						<td>UPC<?php echo e($product->upc); ?></td>
						<td><?php echo e($category[$product->upc]); ?></td>
						<td><i class="fa fa-inr"></i> <?php echo e($product->product_mrp); ?></td>
						<td><i class="fa fa-inr"></i> <?php echo e($product->product_selling_price); ?></td>
						<td><?php echo e($product->quantity); ?></td>
						<!-- <td><div class="ss-checkbox"><input type="checkbox" class="js-switch" data-size="small" data-color="#43b968" checked></div></td> -->
						<td>
							<?php echo Form::open(array('method' => 'post', 'action' => ['Admin\Product\ProductController@restoreProduct'] )); ?>

							<input type="hidden" name="c" value="<?php echo e($product->upc); ?>" >
							<button type="submit" title="Restore Product" data-placement="left" data-toggle="tooltip" class="btn btn-success"><i class="fa fa-recycle"></i></button>
							<?php echo Form::close(); ?>


							<?php echo Form::open(array('method' => 'delete', 'action' => ['Admin\Product\ProductController@permanentDeleteProduct', $product->upc])); ?>

							<button type="submit" data-placement="left" data-toggle="tooltip" title="Delete Product" class="btn btn-danger"><i class="fa fa-close">&nbsp;</i></button>
							<?php echo Form::close(); ?>

						</td>
					</tr>
					<?php $index_items++; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="pull-left"><span>Total <?php echo $products->total(); ?> Product</span></div>
			<div class="row pagination">
				<?php echo $__env->make('admin.pagination.limit_links', ['paginator' => $products], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>
		
	</div>
</div>					
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>