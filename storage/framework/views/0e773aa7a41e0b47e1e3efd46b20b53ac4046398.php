<?php $__env->startSection('title'); ?>
| <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
<style>
.deleteItem{position: absolute;margin-left: 10px;}
</style>
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">	
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>

<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>
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
					<strong><?php echo Session::get('success'); ?>. </strong>
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
			<div class="row header-row">
				<h3 class="head-position"><?php echo $title; ?></h3>
				<ul class="demo-header-actions">
				    <li class="demo-tabs">
				    <?php echo Form::open(array('method' => 'get', 'class' => 'form-inline', 'action' => ['Admin\Category\CategoryController@categorylist'])); ?>

						<div class="form-group">
							<label for="inputPassword2" class="sr-only">Search Category</label>
							<input type="text" class="form-control" name="cat" placeholder="Search for..." value="<?php echo e($serchVal); ?>">
						</div>
						<button type="submit" class="btn btn-primary"><i class="ti-search"></i></button>
					<?php echo Form::close(); ?>

					</li>
					<li class="demo-tabs"><a href="<?php echo e(url('/admin/category/add')); ?>" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Create Category</a></li>
					
				</ul>
			</div>	
			<div class="row row-tabs">
				<table class="table table-striped table-varients">
					<thead>
						<tr>
							<th class="red-head">Category</th>
							<th class="red-head">Parent Category</th>
							
							<th><span style="color:red">&nbsp;Action</span></th>
						</tr>
					</thead>
					<tbody id="resultCategory">
						<?php foreach($categories as $category): ?>
						<tr>
							<td <?php if($category->status == 'disable'): ?>style="color:red"<?php endif; ?>>
							<?php echo e($category->category); ?></td>
							<td><?php echo e($category->parentcategory); ?></td>
							
							<td>
							<ul id="menu" style="margin:0px;padding-left:5px;">
							  <li><a href="<?php echo e(url('admin/category/edit/'.$category->id)); ?>" title="Edit" style="color:#000"><i class="fa fa-pencil"></i></a></li>
							  <li class="deleteItem">
							  	<?php echo Form::open(array('method' => 'delete', 'action' => ['Admin\Category\CategoryController@deletecategory'])); ?>

								<input type="hidden" name="categoryid" value="<?php echo e($category->id); ?>">
								<a href="javascript:;" title="Delete" style="color:#ff0000" data-toggle="modal" data-target="#delete_category_<?php echo e($category->id); ?>"><i class="fa fa-times"></i></a>
								<div class="modal animated rotateIn small-modal" id="delete_category_<?php echo e($category->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
												<h4 class="modal-title" id="mySmallModalLabel">Category Delete Confirmation</h4>
											</div>
											<div class="modal-body">
												Are you sure to delete this record ?
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary">yes</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal">no</button>
											</div>
										</div>
									</div>
								</div>
								<?php echo Form::close(); ?>							  	
							  </li>
							</ul> 
							</td>
						</tr>
						<?php endforeach; ?>
						
					</tbody>
				</table>		
				<?php if(count($categories) > 0): ?>		 
				<div class="table-footer">
					<div class="col-md-3"><div class="dataTables_info" id="table-3_info" role="status" aria-live="polite">Total <?php echo e($categories->total()); ?> records</div></div>
					<div class="col-md-9">
					<?php echo $__env->make('admin.pagination.limit_links', ['paginator' => $categories], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
			
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>