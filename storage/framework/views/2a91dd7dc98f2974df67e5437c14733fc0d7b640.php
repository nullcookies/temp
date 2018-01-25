<!DOCTYPE html>
<html lang="en" ng-app="<?php echo $__env->yieldContent('ng_app'); ?>">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
		<meta name="robots" content="nofollow, noindex">
		<title><?php echo e(PROJECT_NAME); ?>-Admin <?php echo $__env->yieldContent('title'); ?></title>
		<style>
			.btn-logout {width: 60px !important;}
			.put_text_center{
				text-align: center;
			}
		</style>
		<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/jquery/jquery-1.12.3.min.js')); ?>"></script>
		<?php echo $__env->make('admin/common/headerScripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->yieldContent('pageTopScripts'); ?>
		
		<style>	
			.chart-easy-sm{
				width:60px;
				height:60px;
				position:absolute;
				margin-left:-60px;
			}
			.chart-easy-sm span {
				display: block;
				line-height: 60px;
				z-index: 2;
				font-size: 10px;
				color: #2b2b2b;
				font-weight:bold;
			}
			.chart-easy-sm canvas{
				top:10px;
				left:10px;
			}
			.daysleft{
				text-align:center;
				margin-bottom:5px;
				margin-top:5px;
				text-transform:uppercase;
				font-weight:bold;
			}
			.subnow-btn{
				background-color:#f44236;
				color:#fff;
				border:none;
			}
		</style>
	</head>
	<body class="<?php echo $__env->yieldContent('bodyclass'); ?>">
		<div class="wrapper">
			<div class="preloader"></div>
			<!-- Sidebar -->
			<div class="site-overlay"></div>
			
			<?php echo $__env->make('admin/common/left', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('admin/common/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<div class="site-content">
				<!-- Content -->
				<div class="content-area py-1">
					<?php echo $__env->yieldContent('content'); ?>
				</div>
				<?php echo $__env->make('admin/common/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>

		</div>
		<?php echo $__env->make('admin/common/footerScripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->yieldContent('pageScripts'); ?>
		<script type="text/javascript">
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		</script>
	</body>
</html>