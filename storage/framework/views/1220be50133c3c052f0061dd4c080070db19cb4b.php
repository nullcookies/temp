<?php $__env->startSection('title'); ?>
| Homepage Hot Deal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>

<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">	
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.css')); ?>">
<style>
img{width: 100%;}

	/*.dropify{height: 80px;width: 80px;}*/

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>

<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>	
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>	
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/moment/moment.js')); ?>"></script>	
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>	
<script type="text/javascript">
$('input[name="daterange"]').daterangepicker({	
		locale: {
			format: 'YYYY-MM-DD'
		},	
		buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-success',
        cancelClass: 'btn-inverse',
        startDate: '<?php echo $item->start_date; ?>',
        endDate: '<?php echo $item->end_date; ?>'
	});
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
		<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Update Homepage Hot Deal</li>
		</ol>
		<div class="box box-block bg-white">	
		
			<div class="row cc-row header-row">	
			<h3>Update Homepage Hot Deal</h3>			
				<ul class="demo-header-actions">
				<?php if(Session::has('success')): ?>
				<li class="demo-tabs alert alert-success alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<strong><?php echo Session::get('success'); ?>.</strong>
				<?php endif; ?>

				<?php if(Session::has('danger')): ?>
				<li class="demo-tabs alert alert-danger alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						<strong><?php echo Session::get('danger'); ?>.</strong>
				</li>
				<?php endif; ?>
				</li>
					<li class="demo-tabs"><a href="<?php echo e(url('admin/product/product-hot-deal')); ?>" class="btn btn-black w-min-sm mb-0-25 waves-effect waves-light">Back</a></li>
					
				</ul>
			</div>
		</div>
		<?php echo e(Form::open(['class'=>'form-horizontal', 'files' =>'true','method'=>'post', 'action'=>['Admin\Product\HomepageTagController@producthotdealupdate', $item->id]])); ?>

		 
		<div class="col-lg-6 col-md-6">			
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Deal Date Range</label>
					<div class="col-xs-8">
						<input class="form-control" name="daterange" value="<?php if(!empty($item->start_date) && !empty($item->ends_date)): ?> <?php echo e($item->start_date); ?> - <?php echo e($item->end_date); ?> <?php endif; ?>" type="text" readonly="true">
						<?php if($errors->has('daterange')): ?> <span class="text-danger"><?php echo e($errors->first('daterange')); ?> </span> <?php endif; ?>

					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product Name </label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="name" value="<?php echo e($item->name); ?>">
						<?php if($errors->has('name')): ?> <span class="text-danger"><?php echo e($errors->first('name')); ?> </span> <?php endif; ?>

					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product Image</label>
					<div class="col-xs-8">
						<input type="hidden" name="imageSrc" value="<?php echo e($item->image); ?>">
						<input class="form-control" type="file" name="image" accept=".png, .jpg, .jpeg, .gif">
						<?php if($errors->has('image')): ?> <span class="text-danger"><?php echo e($errors->first('image')); ?> </span> <?php endif; ?>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product Rating</label>
					<div class="col-xs-8">
						<input class="form-control" type="number" min="1" max="5" name="rating" value="<?php echo e($item->rating); ?>">
						<?php if($errors->has('rating')): ?> <span class="text-danger"><?php echo e($errors->first('rating')); ?> </span> <?php endif; ?>
					</div>
				</div>	
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product Old Price</label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="old_price" value="<?php echo e($item->old_price); ?>">
						<?php if($errors->has('old_price')): ?> <span class="text-danger"><?php echo e($errors->first('old_price')); ?> </span> <?php endif; ?>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product New Price</label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="new_price" value="<?php echo e($item->new_price); ?>">
						<?php if($errors->has('new_price')): ?> <span class="text-danger"><?php echo e($errors->first('new_price')); ?> </span> <?php endif; ?>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Product Link</label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="link" value="<?php echo e($item->link); ?>">
						<?php if($errors->has('link')): ?> <span class="text-danger"><?php echo e($errors->first('link')); ?> </span> <?php endif; ?>
					</div>
				</div>
				<div class="form-group row">
				<label for="setbillingaddress" class="col-xs-4 col-form-label"></label>					
					<div class="col-xs-8">
						<button class="btn btn-success" type="submit" name="btnSubmit">Submit</button>
						 
					</div>
				</div>
				 
		</div>
		<div class="col-lg-6 col-md-6">
		<?php if(!empty($item->image)): ?>
			<div class="col-xs-8 col-xs-offset-2">
				<img src="<?php echo e(url('products-images/'.$item->image)); ?>" class="dropify">
			</div>
		<?php endif; ?>
		</div>
		<!-- </form> -->
		<?php echo e(Form::close()); ?>


		
					
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>