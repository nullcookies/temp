<?php $__env->startSection('title'); ?>
	| dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>
	<style type="text/css">
	@-moz-document url-prefix(){
	.btn-adjust{padding: 0.5rem 0.8rem;}
	}
	</style>
	<?php if($errors->has('repeat_password') || $errors->has('new_password')): ?>
		<script type="text/javascript">
		    $(document).ready(function(){
		        $("#reset_pass<?php echo e(old('user_id')); ?>").modal('show',{backdrop: 'static', keyboard: false});
		    });
		</script>
	<?php endif; ?>

	<?php if($errors->has('update_customer_name') || $errors->has('update_customer_mobile') || $errors->has('update_gender') || $errors->has('update_user_id') ): ?>
		<script type="text/javascript">
		    $(document).ready(function(){
		        $("#update_user_info<?php echo e(old('update_user_id')); ?>").modal('show',{backdrop: 'static', keyboard: false});
		    });
		</script>
	<?php endif; ?>

	<?php if($errors->has('change_access_mode_user_id') || $errors->has('new_access_mode')): ?>
		<script type="text/javascript">
		    $(document).ready(function(){
		        $("#change_access_mode<?php echo e(old('change_access_mode_user_id')); ?>").modal('show',{backdrop: 'static', keyboard: false});
		    });
		</script>
	<?php endif; ?>

	<?php if($errors->has('new_user_type') || $errors->has('change_user_type_user_id')): ?>
		<script type="text/javascript">
		    $(document).ready(function(){
		        $("#change_user_type<?php echo e(old('change_user_type_user_id')); ?>").modal('show',{backdrop: 'static', keyboard: false});
		    });
		</script>
	<?php endif; ?>

	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/index.js')); ?>"></script>	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

	<h4>User Management</h4>
	<?php if($canwrite): ?>
	<span class="pull-right"><a href="<?php echo e(url(ADMIN_URL_PATH.'/create_user')); ?>" class="btn btn-success">Create User</a></span>
	<?php endif; ?>
	<ol class="breadcrumb no-bg mb-1">
		<li class="breadcrumb-item"><a href="<?php echo url(ADMIN_URL_PATH); ?>">Home</a></li>
		<li class="breadcrumb-item active">User Management</li>
	</ol>
	<div class="box box-block bg-white">
	   <?php echo Form::open(array('method' => 'get', 'action' => ['Admin\User\UserManagementController@index'])); ?>

	   		<div class="row">
	   			<div class="col-md-3">
	   				<div class="form-group">
						<label class="">Name, Email or Mobile</label>
						<input type="text" name="q" placeholder="Type for search.." value="<?php echo e($filterq); ?>" class="form-control">
						<span class="font-90 text-muted">EX: Tarun, tarun@gmail.com, 9717403522</span>
					</div>
	   			</div>
	   			<div class="col-md-3">
	   				<div class="form-group">
						<label class="">User Type</label>
						<select name="user_type" class="form-control">
							<option value="all" <?php if($filter_user_type == 'all'): ?> selected  <?php endif; ?> >All</option>
							<option value="customer" <?php if($filter_user_type == 'customer'): ?> selected  <?php endif; ?> >Customer</option>
							<option value="admin" <?php if($filter_user_type == 'admin'): ?> selected  <?php endif; ?> >Admin</option>
						</select>
					</div>
	   			</div>
	   			<div class="col-md-3">
	   				<div class="form-group">
						<label class="">Access Mode</label>
						<select name="access_mode" class="form-control">
							<option value="all" <?php if($filter_access_mode == 'all'): ?> selected  <?php endif; ?> >All</option>
							<?php foreach($access_modes as $access_mode): ?>
							<option value="<?php echo e($access_mode->id); ?>" <?php if($filter_access_mode == $access_mode->id): ?> selected  <?php endif; ?> ><?php echo e($access_mode->authority); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
	   			</div>
	   			<div class="col-md-3">
	   				<div class="form-group">
	   					<label class="">Action</label>
						<input type="submit" class="form-control btn btn-primary" value="Search" >
					</div>
	   			</div>
	   		</div>
	   <?php echo Form::close(); ?>

	   <?php if($errors->has('user_id')): ?>
	   <div class="row">
	   		<div class="col-md-12">
	   			<div class="alert alert-danger-fill alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
					<strong>Cant Delete User!</strong> <a class="btn btn-outline-white" href="<?php echo url(ADMIN_URL_PATH.'/user_management'); ?>">Reload</a>  The page and try again
				</div>
	   		</div>
	    </div>
		<?php endif; ?>

		<?php if(Session::has('err_msg')): ?>
		<div class="row">
	   		<div class="col-md-12">
	   			<div class="alert alert-danger-fill alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
					<?php echo Session::get('err_msg'); ?>

				</div>
	   		</div>
	    </div>
		<?php endif; ?>

		<?php if(Session::has('success_msg')): ?>
		<div class="row">
	   		<div class="col-md-12">
	   			<div class="alert alert-success-fill alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
					<?php echo Session::get('success_msg'); ?>

				</div>
	   		</div>
	    </div>
		<?php endif; ?>
       <div class="table-responsive">
           <table class="table table-bordered table-striped">
              <thead>
                 <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>user_type</th>
                    <th>User Access Mode</th>
                    <th>Created_at</th>
                    <th>Modified At</th>
                    <?php if($canwrite): ?>
                    <th>Action</th>
                 	<?php endif; ?>
                 </tr>
              </thead>
              <tbody>
              	<?php foreach($users as $key => $user): ?>
                 <tr>
                 	<th><?php echo e($key+1); ?></th>
                    <th><?php echo e($user->name); ?></th>
                    <td><?php echo e($user->email); ?></td>
                    <td><?php echo e($user->mobile); ?></td>
                    <td><?php echo e($user->user_type); ?><?php if($canwrite): ?> <span data-placement="right" data-toggle="tooltip" title="Change User Type" class="pull-right"><a href="javascript:;" data-toggle="modal" data-target=".modal.change_user_type<?php echo e($user->id); ?>" data-backdrop="static" data-keyboard="false"><i class="fa fa-exchange"></i></a></span><?php endif; ?></td>
                    <td><?php echo e($user->authority); ?><?php if($canwrite): ?> <span data-placement="right" data-toggle="tooltip" title="Change Access Mode" class="pull-right"><a href="javascript:;" data-toggle="modal" data-target=".modal.change_access_mode<?php echo e($user->id); ?>" data-backdrop="static" data-keyboard="false" ><i class="fa fa-exchange"></i></a></span><?php endif; ?></td>
                    <td><?php echo e(date('D d-m-Y',strtotime($user->created_at))); ?></td>
                    <td><?php echo e(date('D d-m-Y',strtotime($user->updated_at))); ?></td>
                    <?php if($canwrite): ?>
                    <td>
                    <span data-placement="top" data-toggle="tooltip" title="Edit Basic Info"><button type="button" class="btn btn-primary btn-adjust" data-toggle="modal" data-target=".modal.edit_info<?php echo e($user->id); ?>" data-backdrop="static" data-keyboard="false"><i class="fa fa-pencil"></i></button></span>
                    <span data-placement="top" data-toggle="tooltip" title="Reset User Password"><button type="button" class="btn btn-warning btn-adjust" data-toggle="modal" data-target=".modal.reset_pass<?php echo e($user->id); ?>" data-backdrop="static" data-keyboard="false"><i class="fa fa-key"></i></button></span>
                    <span data-placement="top" data-toggle="tooltip" title="Delete User"><button type="button" class="btn btn-danger btn-adjust" data-toggle="modal" data-target=".modal.tada.delete<?php echo e($user->id); ?>" data-backdrop="static" data-keyboard="false"><i class="fa fa-trash"></i></button></span>
					<div class="modal animated tada delete<?php echo e($user->id); ?> small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
									<h4 class="modal-title" id="mySmallModalLabel">Confirmation Popup</h4>
								</div>
								<div class="modal-body">
									Are you really want to delete user ?
								</div>
								<div class="modal-footer">
									<?php echo Form::open(array('method' => 'delete','action' => ['Admin\User\UserManagementController@deleteUser'])); ?>

										<input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
										<button type="submit" class="btn btn-primary">Yes, Delete</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">No, It was a mistake</button>
									<?php echo Form::close(); ?>

								</div>
							</div>
						</div>
					</div>
					<!-- Reset Password Popup -->
					<div class="modal animated reset_pass<?php echo e($user->id); ?> small-modal" id="reset_pass<?php echo e($user->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog">
						<?php echo Form::open(array('method' => 'post','action' => ['Admin\User\UserManagementController@reset_password'])); ?>

							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
									<h4 class="modal-title" id="mySmallModalLabel">Enter New Password For <b><?php echo e($user->name); ?></b></h4>
								</div>
								<div class="modal-body">
									<div>
										<div class="form-group text-bold">
											<label> <strong>New Password</strong></label>
											<input type="password" name="new_password" placeholder="Enter New Password" class="form-control">
											<?php if($errors->has('new_password')): ?><span class="text-danger"><?php echo e($errors->first('new_password')); ?></span><?php endif; ?>
										</div>
										<div class="form-group">
											<label><strong>Repeat Password</strong></label>
											<input type="password" name="repeat_password" placeholder="Again Type Password" class="form-control">
											<?php if($errors->has('repeat_password')): ?><span class="text-danger"><?php echo e($errors->first('repeat_password')); ?></span><?php endif; ?>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
									<button type="submit" class="btn btn-primary">Reset</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal">No, It was a mistake</button>
								</div>
							</div>
						<?php echo Form::close(); ?>

						</div>
					</div>
					<!-- End Reset Password Popup -->

					<!-- Update User Basic Info Popup -->
					<div class="modal animated edit_info<?php echo e($user->id); ?> small-modal" id="update_user_info<?php echo e($user->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog">
						<?php echo Form::open(array('method' => 'post','action' => ['Admin\User\UserManagementController@edit_user_basic_info'])); ?>

							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
									<h4 class="modal-title" id="mySmallModalLabel"><b><?php echo e($user->name); ?></b> Profile</h4>
								</div>
								<div class="modal-body">
									<div>
										<div class="form-group text-bold">
											<label> <strong>User Name</strong></label>
											<input type="text" name="update_customer_name" value="<?php echo e(Old('update_customer_name') ? Old('update_customer_name') : $user->name); ?>" placeholder="Enter Customer Name" class="form-control">
											<?php if($errors->has('update_customer_name')): ?><span class="text-danger"><?php echo e($errors->first('update_customer_name')); ?></span><?php endif; ?>
										</div>
										<div class="form-group">
											<label><strong>User Mobile</strong></label>
											<input type="text" name="update_customer_mobile" value="<?php echo e(Old('update_customer_mobile') ? Old('update_customer_mobile') : $user->mobile); ?>" placeholder="Enter Customer Mobile" class="form-control">
											<?php if($errors->has('update_customer_mobile')): ?><span class="text-danger"><?php echo e($errors->first('update_customer_mobile')); ?></span><?php endif; ?>
										</div>
										<div class="form-group">
											<label><strong>Gender</strong></label>
											<p>
												<label class="form-check-inline">
													<input class="form-check-input" type="radio"  name="update_gender" value="male" <?php if(Old('update_gender') == 'male' || $user->user_gender == 'male'): ?> checked <?php endif; ?> > Male
												</label>
												<label class="form-check-inline">
													<input class="form-check-input" type="radio" name="update_gender" value="female"  <?php if(Old('update_gender') == 'female' || $user->user_gender == 'female'): ?> checked <?php endif; ?> > Female
												</label>
											</p>
											<p>
												<?php if($errors->has('update_gender')): ?><span class="text-danger"><?php echo e($errors->first('update_gender')); ?></span><?php endif; ?>
											</p>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="update_user_id" value="<?php echo $user->id; ?>">
									<button type="submit" class="btn btn-primary">Update</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal">No, It was a mistake</button>
								</div>
							</div>
						<?php echo Form::close(); ?>

						</div>
					</div>
					<!-- Update User Basic Info Popup -->

					<!-- Change Access mode Popup -->
					<div class="modal animated change_access_mode<?php echo e($user->id); ?> small-modal" id="change_access_mode<?php echo e($user->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog">
						<?php echo Form::open(array('method' => 'post','action' => ['Admin\User\UserManagementController@update_access_mode'])); ?>

							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
									<h4 class="modal-title" id="mySmallModalLabel">Change Access Mode For <b><?php echo e($user->name); ?></b></h4>
								</div>
								<div class="modal-body">
									<div>
										<div class="form-group">
											<label><strong>Access Mode</strong> &nbsp;<span><a data-container="body" data-toggle="popover" data-placement="right" title="What is access mode ?" data-content="Access mode set the permissions for users, if they have only read permission or have read-write permission." href="javascript:;"><i class="fa fa-question-circle-o"></i></a></span></label>
											<p>
												<?php foreach($access_modes as $access_mode): ?>
												<label class="form-check-inline">
													<input class="form-check-input" type="radio"  name="new_access_mode" value="<?php echo $access_mode->id; ?>" <?php if(Old('new_access_mode') == $access_mode->id || $user->authorityid == $access_mode->id ): ?> checked <?php endif; ?> > <?php echo $access_mode->authority; ?>

												</label>
												<?php endforeach; ?>
											</p>
											<p>
												<?php if($errors->has('new_access_mode')): ?><span class="text-danger"><?php echo e($errors->first('new_access_mode')); ?></span><?php endif; ?>
											</p>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="change_access_mode_user_id" value="<?php echo $user->id; ?>">
									<button type="submit" class="btn btn-primary">Update</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal">No, It was a mistake</button>
								</div>
							</div>
						<?php echo Form::close(); ?>

						</div>
					</div>
					<!--  Change Access mode Popup -->

					<!-- Change User Type Popup -->
					<div class="modal animated change_user_type<?php echo e($user->id); ?> small-modal" id="change_user_type<?php echo e($user->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog">
						<?php echo Form::open(array('method' => 'post','action' => ['Admin\User\UserManagementController@update_user_type'])); ?>

							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
									<h4 class="modal-title" id="mySmallModalLabel">Change User Type For <b><?php echo e($user->name); ?></b></h4>
								</div>
								<div class="modal-body">
									<div>
										<div class="form-group">
											<label><strong>User Type</strong> </label>
											<p>
												<label class="form-check-inline">
													<input class="form-check-input" type="radio"  name="new_user_type" value="customer" <?php if(Old('new_user_type') == 'customer' || $user->user_type == 'customer' ): ?> checked <?php endif; ?> > customer
												</label>
												<label class="form-check-inline">
													<input class="form-check-input" type="radio"  name="new_user_type" value="admin" <?php if(Old('new_user_type') == 'admin' || $user->user_type == 'admin' ): ?> checked <?php endif; ?> > Admin
												</label>
											</p>
											<p>
												<?php if($errors->has('new_user_type')): ?><span class="text-danger"><?php echo e($errors->first('new_user_type')); ?></span><?php endif; ?>
											</p>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="change_user_type_user_id" value="<?php echo $user->id; ?>">
									<button type="submit" class="btn btn-primary">Update</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal">No, It was a mistake</button>
								</div>
							</div>
						<?php echo Form::close(); ?>

						</div>
					</div>
					<!--   Change User Type Popup -->
                    </td>
                    <?php endif; ?>
                 </tr>   
                <?php endforeach; ?>   
              </tbody>
           </table>
           <?php if(count($users)>0): ?>
           		<span class="pull-right"><?php echo $users->render(); ?></span>
           <?php endif; ?>
        </div>  
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>