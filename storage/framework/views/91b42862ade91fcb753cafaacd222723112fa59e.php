<?php $__env->startSection('title'); ?>
Contacts Techturtle
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">	
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/switchery/dist/switchery.min.css')); ?>">
<style type="text/css">
	

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>
<script type="text/javascript">
	function sendMail (email,n) {
		var url = '<?php echo url("admin/message/mail-me"); ?>';
		var str = '?e='+email+'&n='+n;
		window.location.href = url+str;	
	}

</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content-area py-1">
	<div class="container-fluid">
		<h4>Contact Techturtle</h4>
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Contact Techturtle</li>
		</ol>
		<div class="row row-sm">
			<div class="col-md-4">
				<div class="box box-block bg-white">
					<div class="row">
						<div class="col-md-4 col-sm-4 text-center">
							<img class="img-fluid b-a-radius-circle" src="<?php echo e(url('lteadmin/img/avatars/customercare.png')); ?>" alt="">
						</div>
						<div class="col-md-8 col-sm-8">
							<h5>Customer Care</h5>
							<p>
								Help us understand your concern. For any general query or when unsure about whom to contact, get in touch with customer Service.
							</p>
							<button class="btn btn-outline-primary btn-rounded" onclick="sendMail('info@techturtle.in','Customer Care')">Send email</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box box-block bg-white">
					<div class="row">
						<div class="col-md-4 col-sm-4 text-center">
							<img class="img-fluid b-a-radius-circle" src="<?php echo e(url('lteadmin/img/avatars/logistic.png')); ?>" alt="">
						</div>
						<div class="col-md-8 col-sm-8">
							<h5>Logistics</h5>
							<p>
								Need info on Logistics? In case of any queries regarding the logistics carriers or the process directly contact the Logistics.
							</p>
							<button class="btn btn-outline-primary btn-rounded" onclick="sendMail('logistics@techturtle.in','Logistics')">Send email</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box box-block bg-white">
					<div class="row">
						<div class="col-md-4 col-sm-4 text-center">
							<img class="img-fluid b-a-radius-circle" src="<?php echo e(url('lteadmin/img/avatars/accounts.png')); ?>" alt="">
						</div>
						<div class="col-md-8 col-sm-8">
							<h5>Accounts</h5>
							<p>
								Concerned about your account status? Need help managing your account? For any type of account related queries please feel free to contact us.
							</p>
							<button class="btn btn-outline-primary btn-rounded" onclick="sendMail('payments@techturtle.in','Accounts')">Send email</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row row-sm">
			<div class="col-md-4">
				<div class="box box-block bg-white">
					<div class="row">
						<div class="col-md-4 col-sm-4 text-center">
							<img class="img-fluid b-a-radius-circle" src="<?php echo e(url('lteadmin/img/avatars/training.png')); ?>" alt="">
						</div>
						<div class="col-md-8 col-sm-8">
							<h5>Training</h5>
							<p>
								Get in touch with us for any assistance regarding efficient store management or Admin support. We will be happy to help.
							</p>
							<button class="btn btn-outline-primary btn-rounded" onclick="sendMail('training@techturtle.in','Training')">Send email</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box box-block bg-white">
					<div class="row">
						<div class="col-md-4 col-sm-4 text-center">
							<img class="img-fluid b-a-radius-circle" src="<?php echo e(url('lteadmin/img/avatars/marketing.png')); ?>" alt="">
						</div>
						<div class="col-md-8 col-sm-8">
							<h5>Marketing</h5>
							<p>
								For any queries about Marketing Management like social media campaigns, offer creation, etc. get in touch with Marketing.
							</p>
							<button class="btn btn-outline-primary btn-rounded" onclick="sendMail('marketing@techturtle.in','Marketing')">Send email</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box box-block bg-white">
					<div class="row">
						<div class="col-md-4 col-sm-4 text-center">
							<img class="img-fluid b-a-radius-circle" src="<?php echo e(url('lteadmin/img/avatars/ceo.png')); ?>" alt="">
						</div>
						<div class="col-md-8 col-sm-8">
							<h5>CEO</h5>
							<p>
								We value your association with us. You can directly get in touch with our CEO by sending an email stating your concern.
							</p>
							<button class="btn btn-outline-primary btn-rounded" onclick="sendMail('ceo@techturtle.in','Subscription')">Send email</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>