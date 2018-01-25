<?php $__env->startSection('title'); ?>
| <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
<style>
</style>

<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">	
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/sweetalert2/sweetalert2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/switchery/dist/switchery.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/nprogress/nprogress.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>

<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>	
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/switchery/dist/switchery.min.js')); ?>"></script>	
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/sweetalert2/sweetalert2.min.js')); ?>"></script>	
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/nprogress/nprogress.js')); ?>"></script>
<script type="text/javascript">
	$().ready(function(){
		$('input[name="filter"]').change(function() {
			getData(1);
		});
	});
	function getData(page) {
		var filter = $('input[name="filter"]:checked').val();
		var url = '<?php echo url("/admin/orders/return"); ?>';
		var str = '?page='+page+'&s='+filter;
		window.location.href = url+str;		
	}
	function changeStatus (id,status,oid) {
		$.ajax({
			url: "<?php echo e(url('admin/orders/updateStatus')); ?>",
			type: 'POST',
			dataType: 'html',
			data: {id: id,status:status,oid:oid},
			beforeSend: function(){
				NProgress.start();
			},
			success: function(result){				
				if (result != '') {
                    $("#action" + id).parents("tr").hide();
                    $("#totalCount").html(parseInt($("#totalCount").html()) - 1);
                    swal("Success !", "Status changed successfully", "success");
                }
                NProgress.done();
			},
		});
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
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Orders</li>
		</ol>
		<div class="box box-block bg-white">
			<div class="row">
				<h3><?php echo $title; ?></h3>
				<div class="pull-left">
					<span style="margin-right:20px;">Filter :</span>
					<span>
						<input type="radio" <?php if(isset($_GET['s']) && ($_GET['s'] == 'open')): ?> checked="" <?php endif; ?> onclick="getData(<?php echo isset($_GET['page']) ?$_GET['page']:1 ?> )" name="filter" id="open" value="open"><label for="open">Open Return Request
					</label>
				</span>
				<span>
					<input type="radio" <?php if(isset($_GET['s']) && ($_GET['s'] == 'approve')): ?> checked="" <?php endif; ?> onclick="getData(<?php echo isset($_GET['page']) ?$_GET['page']:1 ?> )" name="filter" id="approve" value="approve"><label for="approve">Approve Return Request</label>
				</span>
				<span>
					<input type="radio" <?php if(isset($_GET['s']) && ($_GET['s'] == 'reject')): ?> checked="" <?php endif; ?> onclick="getData(<?php echo isset($_GET['page']) ?$_GET['page']:1 ?> )" name="filter" id="reject" value="reject"><label for="reject">Reject Return Request</label>
				</span>
			</div>

		</div>	
		<?php if(count($orders) > 0): ?>
		<div class="row shipping-label table-mobile">
			<table class="table table-striped table-center">
				<thead>
					<tr><th>SN</th>
					<th class="br-1">Order Id</th>											
						<th class="br-1">Customer Name</th>
						<th class="br-1">Comment</th>
						<th class="br-1">Date</th>				 
						<th class="br-3">&nbsp; Action</th>
					</tr>
				</thead>
				<tbody id="ressult">			
				<?php $i = $orders->perPage() * ($orders->currentPage()-1); ?>			
					<?php foreach($orders as $order): ?>
					<tr><td><?php echo e(++$i); ?></td>
					<td><?php echo $order->oid; ?></td>												
						<td><?php echo $order->customerName; ?></td>
						<td><?php echo $order->comment; ?></td>				 
						<td><?php echo $order->date; ?></td>
						<td id="action<?php echo $order->id; ?>"> 
						<?php if(!isset($_GET['s']) || ($_GET['s'] == 'open')): ?>
							<a href="javascript:" onclick="changeStatus(<?php echo e($order->id); ?>, 'approve',<?php echo e($order->oid); ?>)" class="btn btn-success btn-rounded btn-sm mb-0-25 waves-effect waves-light" title="Approve">Approve</a>
							<a href="javascript:" onclick="changeStatus(<?php echo e($order->id); ?>, 'reject',<?php echo e($order->oid); ?>)" class="btn btn-danger btn-rounded btn-sm mb-0-25 waves-effect waves-light" title="Reject">Reject</a>
						<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php if(count($orders) > 0): ?>		 
			<div class="table-footer">
				<div class="col-md-3"><div class="dataTables_info" id="table-3_info" role="status" aria-live="polite">Total <?php echo e($orders->total()); ?> records</div></div>
				<div class="col-md-9">
				<?php echo $__env->make('admin.pagination.limit_links', ['paginator' => $orders], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
			<?php endif; ?>			
		</div>	

		<?php else: ?>
		<div class="row shipping-label table-mobile">
			<div class="panel panel-default">
				<div class="panel-body">
					<p>No record found</p>
				</div>
			</div>
		</div>
		<?php endif; ?>

	</div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>