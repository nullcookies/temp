

<?php $__env->startSection('title'); ?>
| <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/toastr/toastr.min.css')); ?>">
<style>
		.run-toast{cursor: pointer;}
	</style>	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/toastr/toastr.min.js')); ?>"></script>	
<script>
function saveme(id) {
	var min = $('#tr_'+id+' [name=standmin]').val();
	var max = $('#tr_'+id+' [name=standmax]').val();
	var comm = $('#tr_'+id+' [name=standcommission]').val();
	$.ajax({
		url: "<?php echo e(url('/admin/commission/saveStandCommission')); ?>",
		type: 'post',
		dataType: 'html',
		data: {id:id,min:min,max:max,comm:comm},
		beforeSend: function(){
		},
		success: function(json){
			jsonobj = JSON.parse(json);
			//console.log(jsonobj.msg);
			toastr.options = {
				positionClass: 'toast-top-right'
			};
			toastr.success(jsonobj.msg);			
		},
	});
}


function deleteme (id) {
	$.ajax({
		url: "<?php echo e(url('/admin/commission/deleteStandCommission')); ?>",
		type: 'post',
		dataType: 'html',
		data: {id:id},
		beforeSend: function(){
		},
		success: function(json){
			jsonobj = JSON.parse(json);
			//console.log(jsonobj.msg);
			toastr.options = {
				positionClass: 'toast-top-right'
			};
			toastr.error(jsonobj.msg);
			$('#tr_'+id).hide();			
		},
	});
}

$(document).ready(function(){
	/*$('#btnUpdateCatCommission').on('click',function(event){
		$('#frm_cat_commission').on('submit', function(event){
			event.preventDefault();
			$.ajax({
				url: "<?php echo e(url('/admin/commission/saveCatCommission')); ?>",
				type : 'POST',
				data: $('#frm_cat_commission').serialize(),
				dataType: 'json',
				success: function(result){
					console.log(result);
				}
			});
		});
		$('#frm_cat_commission').submit();
	});*/
});
	$('[name=category]').change(function(){

		var id = $(this).val();
		$.ajax({
		url: "<?php echo e(url('/admin/commission/setdefaultcategory')); ?>",
		type: 'post',
		dataType: 'json',
		data: {id:id},
		beforeSend: function(){
		},
		success: function(json){
			//jsonobj = JSON(json);
			//console.log(jsonobj.msg);
			toastr.options = {
				positionClass: 'toast-top-right'
			};
			toastr.success(json['msg']);			
		},
	});
	});
		
		
	
	
</script>


<?php if($errors->has('minprice') || $errors->has('maxprice') || $errors->has('commission')): ?>
	<script type="text/javascript"> 
	    $(document).ready(function(){
	        $("#standard").modal('show',{backdrop: 'static', keyboard: false});
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
		<li class="breadcrumb-item active">Commission Type - 2</li>
	</ol>
	<div class="card card-block"><p id="result"></p>
		<?php if($message = Session::get('success')): ?>
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong><?php echo e($message); ?></strong>
		</div>				
		<?php endif; ?>
		<?php if($message = Session::get('danger')): ?>
		<div class="alert alert-danger alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong><?php echo e($message); ?></strong>
		</div>				
		<?php endif; ?>
		<div class="row">
			<div class="col-md-6">
				<h5 class="head-position">Standard Commission</h5>
				<ul class="demo-header-actions">
					<li class="demo-tabs"><a href="#" class="btn btn-primary w-min-sm mb-0-25 waves-effect waves-light" data-toggle="modal" data-target="#standard" data-whatever="@mdo">Add</a></li>					
				</ul>
				<table class="table mb-md-0">
					<thead>
						<tr>
							
							<th>Min Selling Price</th>
							<th>Max Selling Price</th>
							<th>Commision in %</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php foreach($standard_commission as $commission): ?>
						<tr id="tr_<?php echo e($commission->id); ?>">
							
							<td><div class="col-md-12"><input type="text" value="<?php echo e($commission->min); ?>" name="standmin" class="form-control"></div></td>
							<td><div class="col-md-12"><input type="text" value="<?php echo e($commission->max); ?>" name="standmax" class="form-control"></div></td>
							<td><div class="col-md-12"><input type="text" value="<?php echo e($commission->commission); ?>" name="standcommission" class="form-control"></div></td>
							<td><a href="javascript:void(0);" onclick="saveme(<?php echo e($commission->id); ?>)" class="btn btn-sm btn-success">Update</a></td>
							<td><a href="javascript:void(0);" onclick="deleteme(<?php echo e($commission->id); ?>)" class="btn btn-sm btn-danger">Delete</a></td>
							<!--  -->
						</tr>
						<?php endforeach; ?>	
					</tbody>
				</table>
				<div class="modal fade" id="standard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title" id="exampleModalLabel">Add New Standard Commission</h4>
							</div>
							<?php echo Form::open(['id' => 'frm_standard_commission', 'method'=>'post', 'action' => ['Admin\Commission\CommissionController@postStandard']]); ?>


							<div class="modal-body">											
								<div class="form-group row">
									<label for="minprice" class="col-xs-3 col-form-label">Min Price:</label>
									<div class="col-xs-9">
										<input type="text" class="form-control" name="minprice" id="minprice">
										<?php if($errors->has('minprice')): ?> <span class="text-danger"><?php echo e($errors->first('minprice')); ?> </span> <?php endif; ?>
									</div>
								</div>
								<div class="form-group row">
									<label for="maxprice" class="col-xs-3 col-form-label">Max Price:</label>
									<div class="col-xs-9">
										<input type="text" class="form-control" name="maxprice" id="maxprice">
										<?php if($errors->has('maxprice')): ?> <span class="text-danger"><?php echo e($errors->first('maxprice')); ?> </span> <?php endif; ?>
									</div>
								</div>
								<div class="form-group row">
									<label for="commission" class="col-xs-3 col-form-label">Commision in %:</label>
									<div class="col-xs-9">
										<input type="text" class="form-control" name="commission" id="commission">
										<?php if($errors->has('commission')): ?> <span class="text-danger"><?php echo e($errors->first('commission')); ?> </span> <?php endif; ?>
									</div>
								</div>											
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
							<?php echo Form::close(); ?>

						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-check-inline">
						<input type="radio" value="2" name="category" id="chk_standard" <?php if($default_category == 2): ?> checked <?php endif; ?> class="form-check-input"><h4>Standard Commission</h4> 
					</label>
				<label class="form-check-inline">
					<input type="radio" value="1" name="category" id="chk_category" <?php if($default_category == 1): ?> checked <?php endif; ?> class="form-check-input"> <h4>Category Commission</h4>
				</label>

			</div>
		</div>	

	</div>
	<div class="card card-block">
	<div class="row">
		<div class="col-md-12">
			<h5 class="mb-1">Category Commission</h5>
			<?php echo Form::open(['id' => 'frm_cat_commission', 'method' => 'post', 'action' => ['Admin\Commission\CommissionController@saveCatCommission']]); ?>

			<ul class="demo-header-actions">
				<li class="demo-tabs"><button type="submit" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Update Category Commision</button></li>
			</ul>	
						
			<table class="table mb-md-0">
				<thead>
					<tr>
						<th>SN</th>
						<th>Category ID</th>
						<th>Category Name</th>
						<th>Commision in %</th>

					</tr>
				</thead>
				<tbody>

					<?php $i = $category_commission->perPage() * ($category_commission->currentPage()-1) ?>
					
					<?php foreach($category_commission as $category): ?>
					<tr id="tr_<?php echo e($category->id); ?>">
						<th scope="row"><?php echo e(++$i); ?></th>
						<td><div class="col-xs-4"><input type="text" value="<?php echo e($category->category_id); ?>" name="catid[]" class="form-control" readonly="true"></div></td>
						<td><?php echo e($category->category); ?></td>
						<td><div class="col-xs-4"><input type="text" value="<?php echo e($category->price); ?>" name="catcommission[]" class="form-control"></div></td>

					<?php endforeach; ?>
				</tbody>
			</table>
			<?php echo Form::close(); ?>

			<div class="paging-footer">
				<div class="col-md-3">
					<div class="dataTables_info" id="table-3_info" role="status" aria-live="polite">Total <?php echo e($category_commission->total()); ?> orders</div>
				</div>
				<div class="col-md-9">
					<?php echo $__env->make('admin.pagination.limit_links', ['paginator' => $category_commission], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
		</div>

	</div>		
</div>
</div>				
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>