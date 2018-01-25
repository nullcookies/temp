<?php $__env->startSection('title'); ?>
Mail Me
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">	
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/sweetalert.css')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/sweetalert.min.js')); ?>"></script>
<?php if(Session::has('success')): ?>
	<script>
	  $(document).ready(function(){
	    swal("Mail Sent Successfully!", "", "success");
	  });
	</script>
<?php endif; ?>
<script>
	$(document).ready(function(){
		$("#summernote").summernote({
			disableResizeEditor: true,
			minHeight : 200,
		});

		$('#summernote').html('');
		$('#summernote_textarea').attr('name','message_body');
		$('#contactfrm').submit(function(){
			$('textarea[name="message_body"]').val($('#summernote_content').html());
		});
	});

</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content-area py-1">
	<div class="container-fluid">
		<h4>Contact Us</h4>
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Mailing</li>
		</ol>
		<div class="row">
			<div class="col-md-6 mb-1 mb-md-0">
			

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
		<div class="box-block bg-white">
			<h5>Sending Mail To <?php echo e(isset($_GET['n']) ? $_GET['n'] : 'Customer Care'); ?> </h5>
			<p class="text-muted mb-1">You will receive the reply over here as well as over your mail.</p>
			<?php echo Form::open(['method' => 'post', 'id' => 'contactfrm', 'action' => ['Admin\Contact\ContactController@postcontact']]); ?>

			<div class="form-group row">
				<label for="sendingto" class="col-sm-2 col-form-label">Sending To</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="sendingto" name="email" placeholder="info@example.com" value="<?php if(isset($_GET['e']) && !empty($_GET['e'])): ?> <?php echo e($_GET['e']); ?> <?php endif; ?>">
					<?php if($errors->has('email')): ?> <span class="text-danger"><?php echo e($errors->first('email')); ?> </span><?php endif; ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="subject" class="col-sm-2 col-form-label">Subject</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
					<?php if($errors->has('subject')): ?> <span class="text-danger"><?php echo e($errors->first('subject')); ?> </span><?php endif; ?>
				</div>
			</div>
			<div class="form-group row">
				<div id="summernote"></div><?php if($errors->has('message_body')): ?> <span class="text-danger"><?php echo e($errors->first('message_body')); ?> </span><?php endif; ?>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
					<center><button type="submit" class="btn btn-purple">Send Mail</button></center>
				</div>
			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>