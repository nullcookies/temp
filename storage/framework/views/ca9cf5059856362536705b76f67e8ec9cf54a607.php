<?php $__env->startSection('title'); ?>
| <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
<style>
	.hide{display:none;}
	.subcategory{margin:0 0 10px 0;}
	.padding-bottom30{padding-bottom: 30px;}
	select,input{margin-bottom:10px;}
</style>

<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">	
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>

<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>	

<script>
	$("document").ready(function() {
		getSubCategory("subCategory1", "subCategory1");
		$("#subCategory1").change(function() {
			$("#category").val($("#subCategory1").val());
			getSubCategory("subCategory1", "subCategory2");
			$('#subCategory2').find('option').remove();
			$('#subCategory3').find('option').remove();
			$('#subCategory4').find('option').remove();
			$('#subCategory5').find('option').remove();
			$('#subCategory2').hide();
			$('#subCategory3').hide();
			$('#subCategory4').hide();
			$('#subCategory5').hide();            
		});
		$("#subCategory2").change(function() {

			$("#category").val($("#subCategory2").val());
			getSubCategory("subCategory2", "subCategory3");
			$('#subCategory3').find('option').remove();
			$('#subCategory4').find('option').remove();
			$('#subCategory5').find('option').remove();
			$('#subCategory3').hide();
			$('#subCategory4').hide();
			$('#subCategory5').hide();
		});
		$("#subCategory3").change(function() {
			$("#category").val($("#subCategory3").val());
			getSubCategory("subCategory3", "subCategory4");
			$('#subCategory4').find('option').remove();
			$('#subCategory5').find('option').remove();
			$('#subCategory4').hide();
			$('#subCategory5').hide();
		});
		$("#subCategory4").change(function() {
			$("#category").val($("#subCategory4").val());
			getSubCategory("subCategory4", "subCategory5");
			$('#subCategory5').find('option').remove();
			$('#subCategory5').hide();
		});
		$("#subCategory5").change(function() {
			$("#category").val($("#subCategory5").val());
			$("#category").trigger("change");
		});
		
	});
function getSubCategory(id1, id2) {
	$('#category').trigger("change");
	var categoryId = $("#" + id1).val();
	if (categoryId == 0) {
		return false;
	}
	if (typeof (categoryId) == 'undefined' || categoryId == null) {
		categoryId = 0;
	}
	$.ajax({
		url: "<?php echo e(url(ADMIN_URL_PATH.'/category/subCategory')); ?>",
		type: "POST",
		data: {categoryId: categoryId,subcategory:1},
		dataType: 'json',
		success : function(data){
			console.log(data['data']);
			result = data['data'];
			if (result != '') {
				$("#" + id2).show();
				var select = '';
				var option = '';
				select = document.getElementById(id2);
				option = document.createElement("option");
				option.text = 'none';
				option.value = 0;
				select.add(option);
				for (var sn = 0; sn < result.length; sn++) {
					select = document.getElementById(id2);
					option = document.createElement("option");
					option.text = result[sn]['category'];
					option.value = result[sn]['id']
					select.add(option);
				}

			}
		}
        });/*.done(function(result) {
        	
        });*/
}

</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content-area py-1">
	<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>">Home</a></li>
			<li class="breadcrumb-item active"><?php echo $title; ?></li>
		</ol>
		<div class="row">
			<div class="col-md-6 mb-1 mb-md-0">
				<?php if(Session::has('success')): ?>
				<div class="alert alert-success alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong><?php echo Session::get('success'); ?>. New ID : <?php echo Session::get('category_id'); ?></strong>
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
		<div class="box box-block bg-white">
			<div class="row" style="border-bottom:2px solid #000; padding-bottom:10px;">
				<h3><?php echo $title; ?></h3>
				<ul class="demo-header-actions">
					<li class="demo-tabs"><a href="<?php echo e(url('/admin/category')); ?>" class="btn btn-black w-min-sm mb-0-25 waves-effect waves-light">Back</a></li>
					
				</ul>
			</div>
		</div>
		<div class="col-md-6">
			<?php if(count($errors) > 0): ?>
			<div class="alert alert-danger">
				<ul>
					<?php foreach($errors->all() as $error): ?>
					<li><?php echo e($error); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>

			<div class="error"><?php echo e($errors->first('category')); ?></div>

			<?php echo Form::open(array('method' => 'post', 'action' => ['Admin\Category\CategoryController@save'])); ?>

			<div class="form-group padding-bottom30">
				<label for="type"  class="col-sm-4 form-control-label">Parent Category:</label>
				<div class="col-sm-8">						
					<select name="top1" id="subCategory1" class="form-control hide subcategory"></select>
					<select name="top2" id="subCategory2" class="form-control hide subcategory"></select>
					<select name="top3" id="subCategory3" class="form-control hide subcategory"></select>
					<select name="top4" id="subCategory4" class="form-control hide subcategory"></select>
					<select name="top5" id="subCategory5" class="form-control hide subcategory"></select>
				</div>					
			</div>
			<div class="form-group padding-bottom30">
				<label for="coupon-name" class="col-sm-4 form-control-label">Category<span style="color:red">*</span>&nbsp;:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="category_name" name="category" placeholder="">
				</div>
			</div>
				<!--<div class="form-group" style="display:none;">
					<label for="code" class="col-sm-4 form-control-label"><span style="color:red">*</span>&nbsp;Variants:</label>
					
					<div class="col-sm-8 varient-multi" style="padding-bottom:10px">
						<select multiple class="form-control" id="exampleSelect2" name="variants" style="height:300px">
						<option>Normal</option>
						<option>Small</option>
						<option>Medium</option>
						<option>Large</option>
						<option>XL</option>
						<option>XXL</option>
						<option>XXXL</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
						<option>9</option>
						<option>10</option>
						<option>11</option>
					</select>
					</div>
				</div>-->
				
				
				
				<div class="form-group padding-bottom30">
					<label for="status" class="col-sm-4 form-control-label">Status:</label>
					<div class="col-sm-8">
						<select class="form-control" id="status" name="status" data-plugin="select2">
							<option value="1">Enabled</option>
							<option value="0">Disabled</option>
						</select>
					</div>
				</div>	
				<div class="form-group padding-bottom30">
					<label for="coupon-name" class="col-sm-4 form-control-label">&nbsp;Sort:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="sort_order" name="sort_order" value="1" placeholder="">
					</div>
				</div>							
				
				<div class="row" style="margin-top:50px;margin-right:15px;float:right;text-align:center;">
					<button type="submit" name="save" class="btn btn-success">Save</button>
				</div>
				<?php echo Form::close(); ?>

			</div>
		</div>
	</div>

	<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>