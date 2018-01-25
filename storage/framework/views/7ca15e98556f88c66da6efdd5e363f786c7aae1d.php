<?php $__env->startSection('title'); ?>
	| <?php echo e('Product Bulk Upload'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/multi_select/css/multi-select.css')); ?>">	
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/clockpicker/dist/bootstrap-clockpicker.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/select2/dist/css/select2.min.css')); ?>">

	<style>
		#suggested_categories li{
			cursor: pointer;
		}
	</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>
	
	<script>
		function showCategory(cat){
			console.log(cat);
			$.ajax({
				url: "<?php echo e(url(ADMIN_URL_PATH.'/product/fetchCategory')); ?>",
				type: 'POST',
				data: {category:cat},
				dataType: 'html',
				beforeSend: function(){

				},
				success: function(result){
					$('#suggested_categories').html(result);
				}
			});
		}
	</script>

	<script>
		function addCategoryToProduct(catid){
			$.ajax({
				url: "<?php echo e(url(ADMIN_URL_PATH.'/product/setupCategory')); ?>",
				type: 'POST',
				data: {catid:catid},
				dataType: 'html',
				beforeSend: function(){
				},
				success: function(result){
					$('#suggested_categories').html('');
					$('#searchText').val('');
					$('#final_categories').append(result);
				}
			});
		}
	</script>

	<script>
		function removeInput(id){
			$('#selected_catagoey_li_'+id).remove();
		}
		
		$(document).ready(function(){
			$("select").select2({
				placeholder: "Select Product Category",
  				allowClear: true
			});
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
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/select2/dist/js/select2.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container-fluid">
		<h4>Products</h4>
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item"><a href="#">Products</a></li>
			<li class="breadcrumb-item"><a href="#">Add Products</a></li>
			<li class="breadcrumb-item active">Upload Excel</li>
		</ol>
		<div class="box box-block bg-white">
		<div class="pull-right">
		<?php if($errors->has('product_csv')): ?> <span class="alert alert-danger"><?php echo e($errors->first('product_csv')); ?> </span> <?php endif; ?>
		<?php if($errors->has('category')): ?> <span class="alert alert-danger"><?php echo e($errors->first('category')); ?> </span> <?php endif; ?>
			<?php if(Session::has('incorrect_mime')): ?>
				<div class="alert alert-danger">
				  <strong><?php echo Session::get('incorrect_mime'); ?></strong> 
				</div>
			<?php endif; ?>
		</div>
			<div class="row" style="border-bottom:2px solid #000; padding-bottom:10px;">
				<h3>Upload Excel Sheet</h3>
			</div>
		</div>
	</div>
	<div class="container row-upload">		
		<div class="col-md-12">
			<div class="col-md-8 upload-list">
			<ul>
			<li><a target="_blank" href="<?php echo e(url('admin/product/uploadImages')); ?>">Upload Images and get links</a></li>
				<li>Download Sample Sheet</li>
				<li>Fill Sheet</li>
				<li>Upload Products</li>
				<li>Preferred for products more than 10</li>
			</ul>
			</div>
			<div class="col-md-4 down-upload">
				<p class="downloadnow">*Don't have the Excel Sheet<a href="<?php echo e(url('/sample_files/UploadingData.xlsx')); ?>" download><button type="button" class="btn btn-download w-min-sm mb-0-25 waves-effect waves-light"  data-toggle="modal" onclick="NProgress.start();">Download Now &nbsp;<i class="fa fa-download"></i></button></a></p>
			</div>
			<div class="row">
				<div class="col-md-8">
				<h3>Upload Excel Sheet as per the Prescribed Format</h3>
				</div>
			</div>
		</div>
		<?php echo Form::open(array('method' => 'post','files' => 'true','action' => ['Admin\Product\ProductController@upload_by_csv'])); ?>

			<div class="row form-row">
					<label for="uses-per-customer" class="col-sm-4 control-label"><span style="color:red">*</span>Select Categories:
										</label>
					<select name="category[]" multiple>
						<?php foreach($categories as $category): ?>
							<option value="<?php echo e($category->id); ?>"><?php if(strlen($category->parentTop3)): ?> <?php echo e($category->parentTop3); ?> / <?php endif; ?> <?php if(strlen($category->parentTop2)): ?><?php echo e($category->parentTop2); ?>/ <?php endif; ?>  <?php if(strlen($category->parentTop1)): ?><?php echo e($category->parentTop1); ?>/ <?php endif; ?><?php echo e($category->category); ?></option>
						<?php endforeach; ?>
					</select>
			</div>
			<div class="row form-row">
				<ul id="suggested_categories" class="suggested_categories">
				</ul>
			</div>
			<div class="row form-row">
				<ul id="final_categories">
				</ul>
			</div>
			<div class="row upload-excel">
				<div class="col-md-8">
					<h6>Upload Excel Sheet</h6>
				</div>
				<div class="col-md-4 text-center">
					<span class="btn btn-success btn-file" style="border-radius:0px;">
						Upload Now <i class="fa fa-upload"></i><input name="product_csv" type="file" accept=".xls, .xlsx">
					</span>
				</div>
			</div>
			<div class="row">
				<input type="submit" name="submit" value="Upload" class="btn btn-primary">
			</div>
		<?php echo Form::close(); ?>

	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>