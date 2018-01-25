<?php $__env->startSection('title'); ?>
	| <?php echo e('Coupons'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
	<style type="text/css">
			.box{
				border:none !important;
				background:transparent !important;
			}
			.table td{
				vertical-align:middle;
			}
			ul#menu li {
				display:inline;
			}
			.row label{
				padding:10px;
				}
			.btn-outline-primary{
				background-color:black;
				color:#fff;
				border:none;
			}
			.btn-outline-primary:hover{
				border:none;
				color:#fff;
			}
		</style>
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/multi_select/css/multi-select.css')); ?>">	
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/clockpicker/dist/bootstrap-clockpicker.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>
	<script>
		function changeStatus(value){

			var status    = 'disabled';
			if($('#toggle_status'+value).is(':checked')){
				status    =	'enabled';
			}

			$.ajax({
				url: "<?php echo e(url('admin/coupon/change_status')); ?>",
				type: 'post',
				dataType: 'json',
				data: {status:status, coupon_id:value},
				success: function(result){
					console.log(result);
				}
			});
		}
	</script>

	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/index.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/multi_select/js/jquery.multi-select.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/moment/moment.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/forms-pickers.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container-fluid">
		<h4>Coupons</h4>
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Coupons</li>
		</ol>
		<div class="box box-block">
			<div class="row" style="border-bottom:2px solid #000; padding-bottom:10px;">
				<h3 style="position:absolute">Manage Coupons</h3>
				<ul class="demo-header-actions" style="float:right;margin: 0;padding: 0;list-style: none; margin-right:10px;">
					<li class="demo-tabs" style="float: left;display: block;position: relative; margin-right:10px"><a href="<?php echo url(ADMIN_URL_PATH.'/coupon/create'); ?>" class="btn btn-warning w-min-sm mb-0-25 waves-effect waves-light">Create Coupon</a></li>
					<!-- <li class="demo-tabs" style="float: left;display: block;position: relative;"><button type="button" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Delete</button></li> -->
				</ul>
			</div>
			<?php echo Form::open(array('method' => 'get', 'action' => ['Admin\Coupon\CouponController@index'])); ?>

				<div class="row" style="padding:10px;text-align:center;">
					<div class="col-lg-12">
					<label for="search"><span style="font-weight:bold">Search :&nbsp;&nbsp;</span><p style="font-size:10px; font-weight: bold;">Coupon name or code</p></label> <input type="text" value="<?php echo e($searchq); ?>" name="q" style="width:120px;padding:4px;"/><div class="btn-group float-right" role="group">
						<!-- <button type="button" class="btn btn-outline-primary waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Coupon Name
						</button>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#">1111</a>
							<a class="dropdown-item" href="#">2222</a>
						</div> -->
					</div>
					<label for="date-start"><span style="font-weight:bold">Date Start :&nbsp;&nbsp;</span></label> <input type="date" value="<?php echo e($start_date); ?>" name="start_date" id="datepicker" style="width:150px;padding:4px;"/>
					<label for="date-end"><span style="font-weight:bold">Date End :&nbsp;&nbsp;</span></label> <input type="date" name="end_date" value="<?php echo e($end_date); ?>" id="datepicker" style="width:150px;padding:4px;"/>
					<label for="status"><span style="font-weight:bold">Status :&nbsp;&nbsp;</span></label><div class="btn-group float-right" style="padding-right:20px" role="group">
						<select name="status" class="form-control"> 
							<option value="all" <?php if($status == 'all'): ?> selected <?php endif; ?> >All</option>
							<option value="enabled" <?php if($status == 'enabled'): ?> selected <?php endif; ?> >Enabled</option>
							<option value="disabled" <?php if($status == 'disabled'): ?> selected <?php endif; ?> >Disabled</option>
						</select>
					</div>
					<button type="submit" title="Done" style="padding:5px 4px;border:0;background-color:#43b968;color:#fff;"><i class="fa fa-check"></i></button>
					<a href="<?php echo e(url(ADMIN_URL_PATH.'/coupon/')); ?>" title="Cancel" style="padding:5px;background-color:red;color:#fff;"><i class="fa fa-times"></i></a>
					</div>
				</div>
			<?php echo Form::close(); ?>

			<div class="row">
			<table class="table table-striped">
						<thead>
							<tr>
								<th></th>
								<th>#</th>
								<th>Coupon Name</th>
								<th>Code</th>
								<th>Discount</th>
								<th>Date Start</th>
								<th>Date End</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($coupons as $coupon): ?>
							<tr>
								<td style="text-align:center;"><a href="javascript:;" data-toggle="modal" data-target="#delete_coupon_<?php echo e($coupon->id); ?>" style="color:#000"><i data-placement="top" data-toggle="tooltip" title="Delete" class="fa fa-times"></i></a>
								</td>
								<td><?php echo e($index_items); ?></td>
								<td><?php echo e($coupon->coupon_name); ?></td>
								<td><?php echo e($coupon->coupon_code); ?></td>
								<td><?php echo e($coupon->discount); ?> (in <?php echo e($coupon->coupon_type); ?>)</td>
								<td><?php echo e(date('D d-m-Y',strtotime($coupon->date_start))); ?></td>
								<td><?php echo e(date('D d-m-Y',strtotime($coupon->date_end))); ?></td>
								<td><div class="ss-checkbox"><input type="checkbox" id="toggle_status<?php echo e($coupon->id); ?>" onchange="changeStatus(<?php echo e($coupon->id); ?>)" class="js-switch" data-size="small" data-color="#43b968" <?php if($coupon->status == 'enabled'): ?> checked <?php endif; ?> ></div></td>
								<td>
									<ul id="menu" style="margin-top:10px;padding-left:5px;">
									  <li>
									  <?php echo Form::open(array('method' => 'get', 'action' => ['Admin\Coupon\CouponController@update_coupon'])); ?>

									  	<input type="hidden" name="c" value="<?php echo e(($coupon->id)); ?>">
									  	<button type="submit" title="Update" class="btn btn-sm btn-success"><i class="fa fa-paint-brush"></i></button>
									  <?php echo Form::close(); ?>

									  </li>
									</ul> 
								</td>

								<!-- delete coupon popup -->
								<div class="modal animated tada small-modal" id="delete_coupon_<?php echo e($coupon->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
												<h4 class="modal-title" id="mySmallModalLabel">Confirmation Popup</h4>
											</div>
											<div class="modal-body">
												Are you sure to delete this coupon ?
											</div>
											<?php echo Form::open(array('method' => 'delete','action' => ['Admin\Coupon\CouponController@delete'])); ?>

												<div class="modal-footer">
													<input type="hidden" name="delete_coupon_id" value="<?php echo e($coupon->id); ?>">
													<button type="submit" class="btn btn-primary">Yes,delete !</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
												</div>
											<?php echo Form::close(); ?>

										</div>
									</div>
								</div>
								<!-- / delete coupon popup -->
								<?php $index_items++; ?>
							</tr>
							<?php endforeach; ?>						
						</tbody>
					</table>

					<?php if(count($coupons)>0): ?> 
					<div class="table-footer">
					<div class="col-md-3"><div class="dataTables_info" id="table-3_info" role="status" aria-live="polite">Total <?php echo e($coupons->total()); ?> records</div></div>
					<div class="col-md-9">
					<?php echo $__env->make('admin.pagination.limit_links', ['paginator' => $coupons], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>
				</div>
					<?php endif; ?>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>