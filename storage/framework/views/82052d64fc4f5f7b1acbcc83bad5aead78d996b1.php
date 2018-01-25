<?php $__env->startSection('title'); ?>
| <?php echo e('Product Image'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>

<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/toastr/toastr.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>	
<style type="text/css">
	.product_image{height:250px;width: 250px;}
</style>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>	
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/toastr/toastr.min.js')); ?>"></script>
<script>
$(document).ready(function(){
	toastr.options = {
		positionClass: 'toast-top-right'
	};
});
	
	function changeDefaultImage (imageid) {
		$.ajax({
			url: "<?php echo e(url(ADMIN_URL_PATH.'/product/ajax/ajaxcall')); ?>",
			type:'post',
			data: {imageid:imageid,product_id:<?php echo e($productdata->id); ?>,change_default_image:1},
			dataType: 'json',
			success:function(json){
				console.log(json);
				if(json['success']){
	                toastr.success(json['msg']);
	            }
			}
		});
	}
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<h4>Upload Image</h4>
	<ol class="breadcrumb no-bg mb-1">
		<li class="breadcrumb-item"><a href="<?php echo e(url('admin')); ?>">Home</a></li>
		<li class="breadcrumb-item"><a href="<?php echo e(url('admin/product')); ?>">Product</a></li>
		<li class="breadcrumb-item active"><?php echo e($productdata->product_name); ?></li>
	</ol>
	
	<div class="box box-block bg-white">
	<div class="row" style="border-bottom:2px solid #000; padding-bottom:10px;">
		<h3 style="position:absolute">Upload Image</h3>
		<ul class="demo-header-actions">
			<li class="demo-tabs">
			<a href="#">&nbsp;</a>
			</li>
		</ul>
		<div class="col-md-6 mb-1 mb-md-0 pull-right">
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
	<?php if(count($errors) > 0): ?>
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				<?php foreach($errors->all() as $error): ?>
					<li><?php echo e($error); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
	
		<div class="row bg-white mb-1"  style="margin-top:10px;padding:10px;">
			<h5>File Upload</h5>
		<?php echo e(Form::open(['method'=>'post', 'class'=> 'form-inline mb-1', 'id'=> 'frmupload', 'files' => 'ture', 'action' => ['Admin\Product\ProductController@imageUploadPost']])); ?>

		<form class="form-inline mb-1">			
			<div class="form-group">
				<label for="image">File Upload</label>
				<input type="hidden" name="product_id" value="<?php echo e($productdata->id); ?>">
				<input class="form-control" id="image" name="image" placeholder="Upload a image" type="file">
			</div>
			<button type="submit" class="btn btn-primary">Upload</button>
		<?php echo e(Form::close()); ?>

		</div>
		<div class="row bg-white" style="margin-top:10px;padding:10px;">
		<h5>Product Image</h5>
			<?php foreach($images as $image): ?>
			<div class="col-sm-3" style="padding: 10px;"> 
				<a class="product_image" href="<?php echo e('#'.$image->id); ?>" title="<?php echo e($image->image); ?>" data-title="<?php echo e($productdata->product_name); ?>">
					<img src="<?php echo url('product_images/', [$image->image]); ?>" class="img-fluid">
				</a>
				<div class="form-check" align="center">
					<label class="form-check-label">
						<input class="form-check-input run-toast" 
							<?php if($image->default_image == 'yes'): ?> checked <?php endif; ?> name="default_image" onchange="changeDefaultImage(<?php echo e($image->id); ?>)" type="radio">
						Default Image ?
					</label>
					<a href="<?php echo e(url('/admin/product/deleteimage?id='.$image->id)); ?>" class="btn btn-danger btn-sm mb-0-25 waves-effect waves-light">Delete</a>
					<a href="<?php echo e(url('/admin/product/imagescrop?id='.$image->id.'&upc='.$productdata->id)); ?>" class="btn btn-primary btn-sm">Crop</a>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>