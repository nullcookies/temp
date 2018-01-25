<?php $__env->startSection('title'); ?>
| Homepage Hot Deal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>

<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">	
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/sweetalert.css')); ?>"/>
<style type="text/css">
	.dropify{}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>

<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>	
<script src="<?php echo e(asset('js/sweetalert.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.min.js')); ?>"></script>
<script type="text/javascript">
	$(document).ready(function(){		
		$("#summernote").summernote({

			disableResizeEditor: true,
			minHeight : 200,
		});

		$('#summernote_textarea').attr('name','content');

		$('#frmpages').submit(function(){
			$('textarea[name="content"]').val($('#summernote_content').html());
		});

	});
</script>
<?php if($errors->has('product_desc')): ?>
	<script>
		$(document).ready(function(){
			$('#my_summernote_frame').css('border-color','#ea6b6b');
		});
	</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
		<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Pages</li>
		</ol>
		<div class="box box-block bg-white">	
		
			<div class="row cc-row header-row">	
			<h3>Update Testimonials</h3>			
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
					<li class="demo-tabs"><a href="<?php echo e(route('admin.testimonials.index')); ?>" class="btn btn-black w-min-sm mb-0-25 waves-effect waves-light">Back</a></li>
					
				</ul>
			</div>

		</div>

		<?php echo Form::open(['id'=>'frmpages', 'files' =>'true','method'=>'PATCH', 'route' => ['admin.testimonials.update', $item->id]]); ?>

		 
		<div class="col-lg-9 col-md-9">			
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Avatar </label>
					<div class="col-xs-8">
						<input type="hidden" name="imageSrc" value="<?php echo e($item->image); ?>">
						<input class="form-control" type="file" name="image" accept=".png, .jpg, .jpeg">
						<?php if($errors->has('image')): ?> <span class="text-danger"><?php echo e($errors->first('image')); ?> </span> <?php endif; ?>

					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Name </label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="name" value="<?php echo e($item['name']); ?>">
						<?php if($errors->has('name')): ?> <span class="text-danger"><?php echo e($errors->first('name')); ?> </span> <?php endif; ?>

					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Designation </label>
					<div class="col-xs-8">
						<input class="form-control" type="text" name="designation" value="<?php echo e($item['designation']); ?>">
						<?php if($errors->has('designation')): ?> <span class="text-danger"><?php echo e($errors->first('designation')); ?> </span> <?php endif; ?>

					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-4 col-form-label">Content</label>
					<div class="col-xs-8">
						<div id="summernote"><?php echo urldecode($item['content']); ?></div>
						<?php if($errors->has('content')): ?> <span class="text-danger"><?php echo e($errors->first('content')); ?> </span> <?php endif; ?>
					</div>
				</div>					
				
				<input type="hidden" name="status" value="yes">				
				<div class="form-group row">
				<label for="setbillingaddress" class="col-xs-4 col-form-label"> 	</label>					
					<div class="col-xs-8">
						<button class="btn btn-success" type="submit" name="btnSubmit">Submit</button>
						 
					</div>
				</div>
				 
		</div>
		<div class="col-lg-3 col-md-3">
		<?php if(!empty($item->image)): ?>
			<div class="col-xs-8">
				<img src="<?php echo e(url('testimonials/'.$item->image)); ?>" class="dropify full-width">
			</div>
		<?php endif; ?>
		</div>
		<!-- </form> -->
		<?php echo e(Form::close()); ?>

					
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>