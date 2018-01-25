<?php $__env->startSection('title'); ?>
| <?php echo e('Product List'); ?>

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
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/index.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/multi_select/js/jquery.multi-select.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/moment/moment.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/forms-pickers.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
	<h4>Products</h4>
	<ol class="breadcrumb no-bg mb-1">
		<li class="breadcrumb-item"><a href="<?php echo e(url(ADMIN_URL_PATH)); ?>">Home</a></li>
		<li class="breadcrumb-item"><a href="<?php echo e(url(ADMIN_URL_PATH.'/product')); ?>">Products</a></li>
		</ol>
	<div class="box box-block bg-white">
		<div class="row header-row">
			<h3 class="head-position">View Products</h3>
			<ul class="demo-header-actions">
			<li class="demo-tabs">
					<?php echo Form::open(array('method' => 'get', 'action' => ['Admin\Product\ProductController@index'])); ?>					
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
		
		<div class="row view-products-row table-mobile">
			<table class="table table-striped">
				<thead>
					<tr>
						<th><!-- <input type="checkbox" id="selectall"/> -->#</th>
						<th>SN</th>												
						<th>Image</th>
						<th>Product Name</th>
						<th>SKU</th>
						<th>UPC</th>
						<th>Categories</th>
						<th>MRP</th>
						<th>Selling Price</th>
						<th>Quantity</th>
						<!-- <th>Status</th> -->
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($products as $product): ?>
					<tr>
						<?php echo Form::open(array('method' => 'delete', 'action' => 'Admin\Product\ProductController@deleteProduct')); ?>

						<input type="hidden" name="c" value="<?php echo e($product->upc); ?>">
						<td><a href="javascript:;" data-toggle="modal" data-target="#delete_product_<?php echo e($product->upc); ?>" class="radius12"><i class="fa fa-times"></i></a>
							<div class="modal animated tada small-modal" id="delete_product_<?php echo e($product->upc); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
											<h4 class="modal-title" id="mySmallModalLabel">Confirmation Popup</h4>
										</div>
										<div class="modal-body">
											Are you sure to delete this product ?
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary">yes</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">no</button>
										</div>
									</div>
								</div>
							</div>
						</td>
						<?php echo Form::close(); ?>

						<td><?php echo e($index_items); ?></td>													
						<td>
							<a href="<?php echo e(url('admin/product/productimages?upc='.$product->upc)); ?>"><img src="<?php echo url('product_images/50x50/', [$product->product_image]); ?>" width="50" height="50" title="Product 1"/></a>



						</td>

						<td><?php echo e($product->product_name); ?></td>
						<td><?php echo e($product->sku); ?></td>
						<td>UPC<?php echo e($product->upc); ?></td>
						<td><?php echo $category[$product->upc]; ?></td>
						<td style="width:6%"><i class="fa fa-inr"></i> <?php echo e($product->product_mrp); ?></td>
						<td><i class="fa fa-inr"></i> <?php echo e($product->product_selling_price); ?></td>
						<td><?php echo e($product->quantity); ?></td>
						<!-- <td><div class="ss-checkbox"><input type="checkbox" class="js-switch" data-size="small" data-color="#43b968" checked></div></td> -->
						<td>
							<?php echo Form::open(array('method' => 'get', 'action' => ['Admin\Product\ProductController@editProduct'] )); ?>

							<input type="hidden" name="c" value="<?php echo e($product->upc); ?>" >
							<ul id="menu" style="margin-top:10px;padding-left:5px;">
								<li><button type="submit" class="btn btn-success" title="Edit Product" data-placement="left" data-toggle="tooltip"><i class="fa fa-pencil"></i></button></li>
							</ul>
							<?php echo Form::close(); ?>


							<?php echo Form::open(array('method' => 'get', 'action' => ['Admin\Varients\AssignVarientsController@index'])); ?>

							<input type="hidden" name="c" value="<?php echo e($product->upc); ?>" >
							<ul id="menu" style="margin-top:10px;padding-left:5px;">
								<li><button type="submit" class="btn btn-primary" data-placement="left" data-toggle="tooltip" title="Add Varients"><i class="fa fa-plus-square"></i></button></li>
							</ul>
							<?php echo Form::close(); ?>

							<ul id="menu" style="margin-top:10px;padding-left:5px;">
								<?php $productLink = url('products/product_detail?product_id='.$product->upc) ?>
								<li><button type="submit" class="btn btn-warning" data-placement="left" data-toggle="tooltip" onclick="window.open('<?php echo e($productLink); ?>','_blank')" title="See product on website"><i class="fa fa-eye" aria-hidden="true"></i></button></li>
							</ul>
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