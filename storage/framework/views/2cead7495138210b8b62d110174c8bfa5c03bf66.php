<?php $__env->startSection('title'); ?>
	| <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
	<style>
		

		table a .fa-arrow-circle-o-up{
			color: #20b9ae !important;
		}

		table a .fa-arrow-circle-o-down{
			color: #f59345 !important;
		}
	</style>
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/nprogress/nprogress.css')); ?>">
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>
	
	<?php if($errors->has('zone_name') || $errors->has('pincodes') || Session::has('incorrect_mime')): ?>
		<script type="text/javascript"> 
		    $(document).ready(function(){
		        $("#add_shipping_modal").modal('show',{backdrop: 'static', keyboard: false});
		    });
		</script>
	<?php endif; ?>

	<?php foreach($weights as $weight): ?>
		<?php if($errors->has($weight->weight_in_gms.'_gms')): ?>
			<script type="text/javascript">
			    $(document).ready(function(){
			        $("#add_shipping_modal").modal('show',{backdrop: 'static', keyboard: false});
			    });
			</script>
		<?php endif; ?>
	<?php endforeach; ?>
	
	<?php if($errors->has('pincode_csv') ||  Session::has('incorrect_upload_csv_format')): ?>
		<script type="text/javascript"> 
		    $(document).ready(function(){
		        $("#upload_pincode<?php echo Old('zone'); ?>").modal('show',{backdrop: 'static', keyboard: false});
		    });
		</script>
	<?php endif; ?>

	<?php if($errors->has('new_zone_name') || $errors->has('new_zone_id') ): ?>
		<script type="text/javascript"> 
		    $(document).ready(function(){
		        $("#edit_zone<?php echo Old('new_zone_id'); ?>").modal('show',{backdrop: 'static', keyboard: false});
		    });
		</script>
	<?php endif; ?>

	<?php foreach($weights as $weight): ?>
		<?php if($errors->has('new_'.$weight->weight_in_gms)): ?>
			<script type="text/javascript">
			    $(document).ready(function(){
			        $("#edit_zone<?php echo Old('new_zone_id'); ?>").modal('show',{backdrop: 'static', keyboard: false});
			    });
			</script>
		<?php endif; ?>
	<?php endforeach; ?>

	<script>
		$(document).ready(function(){

			$('#pincode_search').on('click',function(){
				var pincode 		=	$('#pincode_textbox').val();
				$.ajax({
					url: "<?php echo e(url('/admin/shipping_charges/fetch_pincode')); ?>",
					type: 'post',
					dataType: 'html',
					data: {pincode:pincode},
					beforeSend: function(){
						NProgress.start();
					},
					success: function(json){
						NProgress.done();
						$('#pincode_search_result').html(json);
					},
				});
			});
		});
	</script>

	<script>
		$('#add_shipping_modal').on('shown.bs.modal', function () {
		    $.ajax({
		    	url: "<?php echo e(url('/admin/shipping_charges/get_modal_content')); ?>",
		    	type: 'POST',
		    	dataType: 'html',
		    	beforeSend: function(){
		    		jQuery('<i/>', {
					    id: 'foo',
					    class: 'fa fa-spin fa-circle-o-notch',
					    style: 'font-size:20px;',
					}).appendTo('#add_shipping_modal_body');
					$('#add_shipping_modal_body').addClass('put_text_center');
		    	},
		    	success: function(result){
		    		$('#add_shipping_modal_body').removeClass('put_text_center');
		    		$('#add_shipping_modal_body').html(result);
		    		console.log(result);
		    	}
		    });
		});
	</script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/index.js')); ?>"></script>	
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/nprogress/nprogress.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if($errors): ?>
<?php echo e(Session::flash('errors',$errors)); ?>

<?php endif; ?>

<div class="container-fluid">
	<h4><?php echo e($title); ?></h4>
	<ol class="breadcrumb no-bg mb-1">
		<li class="breadcrumb-item"><a href="<?php echo url(ADMIN_URL_PATH); ?>">Home</a></li>
		<li class="breadcrumb-item active"><?php echo e($title); ?></li>
	</ol>

	<div class="row">
	</div>

	<div class="box box-block bg-white">
	   		<div class="row">
	   			<div class="col-md-3">
	   				<div class="form-group">
						<label class="">Search Pincode</label>
						<input type="text" name="q" placeholder="Type for search.." id="pincode_textbox" class="form-control mb-1">
						<span class="font-90 text-muted">EX: 251001, 201301</span>
					</div>
	   			</div>
	   			<div class="col-md-3">
	   				<div class="form-group">
	   					<label class="">&nbsp;</label>
						<input type="button" id="pincode_search" class="form-control btn btn-primary" value="Search">
					</div>
	   			</div>
	   		</div>
	   		<div id="pincode_search_result">
	   				
	   		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered mb-0">
						<thead>
							<tr>
								<th>#</th>
								<th>Zone Name</th>
								<?php foreach($weights as $weight): ?>
									<th><?php echo $weight->weight; ?> charge</th>
								<?php endforeach; ?>
								<th>Pincodes</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($zones as $zone): ?>
							<tr>
								<th scope="row"><?php echo e($index_items); ?></th>
								<th><?php echo e($zone->zone_name); ?></th>
								<?php foreach($weights as $weight): ?>
									<td><?php echo e($charge[$zone->id][$weight->id]); ?></td>
								<?php endforeach; ?>
								<th><?php echo e($pincode[$zone->id]); ?><span class="pull-right"><a href="<?php echo e(url('/lteadmin/log_files/pincodes/pincode'.$zone->id.'.csv')); ?>" download><i data-placement="left" data-toggle="tooltip" title="Download <?php echo e($zone->zone_name); ?> Pincode CSV" class="fa fa-arrow-circle-o-down" aria-hidden="true"></i></a>
							

								<!-- edit zone details popup -->
							
								<!-- /edit zone details popup -->

								<!-- delete zone popup -->											

								

								<!-- /delete zone popup -->

								<!-- Upload Csv file  -->
							
								<!-- /Upload csv file -->
							</tr>
							<?php $index_items++; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>