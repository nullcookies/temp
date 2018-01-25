<?php $__env->startSection('title'); ?>
| <?php echo e('Coupons'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>


<script type="text/javascript">	
	$(document).ready(function(){	
	});
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Banner Setting for Website</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="<?php echo e(url('/admin/website-setting')); ?>">Website Setting</a></li>
							<li class="breadcrumb-item"><a href="#">Banner Image Add</a></li>							
						</ol>
						<div class="box box-block bg-white">
							<h5>Banners</h5>
							<?php if($errors->has('errors')): ?> <span class="text-danger"><?php echo e($errors); ?></span>  <?php endif; ?>
							<?php echo e(Form::open(['method'=>'post', 'files' =>'true', 'action'=>['Admin\WebsiteSetting\WebsiteSettingController@updateImage']])); ?>

								<div class="form-group">
									<label for="exampleInputEmail1">Image URL</label>
									<input type="text" class="form-control" id="link" name="link" aria-describedby="link" placeholder="Enter Image Link - URL">
									<!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
									<?php if($errors->has('link')): ?> <span class="text-danger"><?php echo e($errors->first('link')); ?></span> <?php endif; ?>
								</div>								
								<div class="form-group">  
									<label for="exampleSelect1">Banner Category</label>
									<select class="form-control" name="category" id="category">
									<option value="">Select Category</option>
									<?php foreach($category as $value): ?>
										<option value="<?php echo e($value['id']); ?>" <?php if($value['id'] == @$_GET['cid']): ?> selected <?php endif; ?>><?php echo e($value['name']); ?></option>
									<?php endforeach; ?>
									</select>
									<?php if($errors->has('category')): ?> <span class="text-danger"><?php echo e($errors->first('category')); ?></span> <?php endif; ?>
								</div>
								
								<div class="form-group">
									<label for="image">File input</label>
									<input type="file" accept=".png, .jpg, .jpeg" class="form-control-file" id="image" name="image" aria-describedby="fileHelp">
									<small id="fileHelp" class="form-text text-muted">Image should be upto 60KB Dimention 285 x 500</small>
									<?php if($errors->has('image')): ?> <span class="text-danger"><?php echo e($errors->first('image')); ?></span> <?php endif; ?>
								</div>
								
								
								<button type="submit" class="btn btn-primary">Submit</button>
							<?php echo e(Form::close()); ?>

						</div>
						
					</div>
				</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>