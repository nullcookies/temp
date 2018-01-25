<?php $__env->startSection('title'); ?>
	| <?php echo e('Setting'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('ng_app'); ?><?php echo e('ecommAppAdmin'); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/multi_select/css/multi-select.css')); ?>">	
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/clockpicker/dist/bootstrap-clockpicker.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/sweetalert.css')); ?>"/>
	<style>
		
		table, tr, td{
			border:1px solid #ccc;
		}
		
		.radius12{
			border-radius: 12px !important;
		}
		.view-products-row table td:nth-child(7) {width: 1%;}
	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>

<script src="<?php echo e(asset('js/sweetalert.min.js')); ?>"></script>

	<script>
		$("#selectall").change(function () {
		    $("input:checkbox").prop('checked', $(this).prop("checked"));
			$("input:checkbox").prop('checked', $(this).prop("checked"));
		});
	</script>
	
	<?php if(Session::has('personal_detail')): ?>
		<script>
		  $(document).ready(function(){
		    swal("Saved Successfully!", "", "success");
		  });
		</script>
	<?php endif; ?>
	
	<?php if(Session::has('domain_setup_request')): ?>
		<script>
		  $(document).ready(function(){
		    swal("Saved Successfully!", "", "success");
		  });
		</script>
	<?php endif; ?>

	<?php if($errors->has('domain_name') || $errors->has('service_provider') || $errors->has('domain_user_id') || $errors->has('domain_password') || Session::has('domain_setup_request')): ?> 
		<script>
			$(document).ready(function(){
				$('#personal').removeClass('active in');
				$('#personal').attr('aria-expanded',false);
				$('#submit-domain').addClass('active in');
				$('#submit-domain').attr('aria-expanded',true);
				$('#personal_tab').removeClass('active');
				$('#submit_detail_tab').addClass('active');

			});	
		</script>
	<?php endif; ?>
	
	<?php if(Session::has('business_detail')): ?>
	    <script>
	        $(document).ready(function(){
	           $('#personal').removeClass('active in');
			   $('#personal').attr('aria-expanded',false);
			   
			   $('#business').addClass('active in');
			   $('#business').attr('aria-expanded',true);
			   
			   $('#personal_tab').removeClass('active');
				$('#business_detail_tab').addClass('active');
	        });
	    </script>
	    <script>
  $(document).ready(function(){
    swal("Saved Successfully!", "", "success");
  });
</script>
	<?php endif; ?>
	
	<?php if(Session::has('pickup_detail')): ?>
	    <script>
	        $(document).ready(function(){
	           $('#personal').removeClass('active in');
			   $('#personal').attr('aria-expanded',false);
			   
			   $('#pickup').addClass('active in');
			   $('#pickup').attr('aria-expanded',true);
			   
			   $('#personal_tab').removeClass('active');
			   $('#pickup_detail_tab').addClass('active');
	        });
	    </script>
	    <script>
  $(document).ready(function(){
    swal("Saved Successfully!", "", "success");
  });
</script>
	<?php endif; ?>
    
    
    <?php if(Session::has('bank_detail')): ?>
	    <script>
	        $(document).ready(function(){
	           $('#personal').removeClass('active in');
			   $('#personal').attr('aria-expanded',false);
			   
			   $('#bank').addClass('active in');
			   $('#bank').attr('aria-expanded',true);
			   
			   $('#personal_tab').removeClass('active');
			   $('#bank_detail_tab').addClass('active');
	        });
	    </script>
	    <script>
  $(document).ready(function(){
    swal("Saved Successfully!", "", "success");
  });
</script>
	<?php endif; ?>
	<script>
		
		function showPassword(requestid){
			$('#password'+requestid).attr('type','text');
		}

		function hidePassword(requestid){
			$('#password'+requestid).attr('type','password');
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
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
	fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Profile</li>
		</ol>
		<div class="box box-block bg-white">
			<div class="row header-row">
				<h3>Setup Profile</h3>
				
			</div>
			<div class="row row-tabs">
				<div class="col-md-12 mb-1 mb-md-0">
					<ul class="nav nav-tabs">
						<li class="nav-item nav-item2">
							<a class="nav-link  active" id="personal_tab" data-toggle="tab" href="#personal">Personal Details</a>
						</li>
						<li class="nav-item nav-item2">
							<a class="nav-link" id="business_detail_tab" data-toggle="tab" href="#business">Business Details</a>
						</li>
						<li class="nav-item nav-item2">
							<a class="nav-link" id="pickup_detail_tab" data-toggle="tab" href="#pickup">Pick Up Details</a>
						</li>
						<li class="nav-item nav-item2">
							<a class="nav-link" data-toggle="tab" id="bank_detail_tab" href="#bank">Bank Details</a>
						</li>
						<!--<li class="nav-item nav-item2">
							<a class="nav-link" data-toggle="tab" id="submit_detail_tab" href="#submit-domain">Submit Domain</a>
						</li>-->
					</ul>
				</div>
			</div>
			<div class="tab-content">
				<div id="personal" class="tab-pane fade in active">
					<div class="box-block">
						<div class="row">
							<div class="col-md-6">
								<?php echo Form::open(array('method' => 'post', 'files' => 'true', 'action' => ['Admin\Setting\SettingController@savePersonalInfo'])); ?>

								<input type="hidden" name="mobile" value="<?php echo e(Auth::user()->mobile); ?>" />
								<input type="hidden" name="email" value="<?php echo e(Auth::user()->email); ?>" />
									<div class="form-group row">
										<label for="name" class="col-sm-3 col-form-label">Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="name" name="name" value="<?php echo e(Auth::user()->name); ?>" placeholder="Name">
										</div>
									</div>
									<div class="form-group row">
										<label for="name" class="col-sm-3 col-form-label">Website Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="name" name="website_name" value="<?php echo e(Auth::user()->website_name); ?>" placeholder="Website Name">
										</div>
									</div>
									<div class="form-group row">
										<label for="name" class="col-sm-3 col-form-label">Phone</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" disabled id="name" name="" value="<?php echo e(Auth::user()->mobile); ?>" placeholder="Phone">
										</div>
									</div>
									<div class="form-group row">
										<label for="name" class="col-sm-3 col-form-label">Email ID</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" disabled name="" value="<?php echo e(Auth::user()->email); ?>" id="email" placeholder="Email ID">
										</div>
									</div>
									<div class="form-group row">
										<label for="name" class="col-sm-3 col-form-label">City</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="city" id="name" value="<?php echo e(Auth::user()->city); ?>" placeholder="City">
										</div>
									</div>
									<div class="form-group row">
										<label for="name" class="col-sm-3 col-form-label">State</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="name" value="<?php echo e(Auth::user()->state); ?>" name="state" placeholder="State">
										</div>
									</div>
									<div class="form-group row">
										<label for="name" class="col-sm-3 col-form-label">Type</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" value="<?php echo e(Auth::user()->user_type); ?>" disabled="disabled" id="name" placeholder="Type">
										</div>
									</div>
									<div class="form-group row">
											<label for="name" class="col-sm-3 col-form-label">Upload Signature</label>
											<div class="col-sm-9">
												<input type="file" class="form-control" name="signature" id="email">
												<?php if($errors->has('signature')): ?> <?php echo e($errors->first('signature')); ?> <?php endif; ?>
											</div>
											<?php if(Auth::user()->signature!=''): ?><img src="<?php echo e(Auth::user()->signature); ?>" width="100" style="margin-left:15px; margin-top:10px;"/><?php endif; ?>
										</div>
									<div class="box-block">	
										<div class="row">
											<center>
												<button type="submit" class="btn btn-primary">Submit Details</button>
											</center>
										</div>
									</div>
							<?php echo Form::close(); ?>

							</div>
						</div>
					</div>
				</div>
				
				<!--- Business Details Tab Starts -->
				<div id="business" class="tab-pane fade">
					<div class="box-block">
						<div class="row">
							<div class="col-md-6">
								<?php echo Form::open(array('method' => 'post', 'files' => 'true', 'action' => ['Admin\Setting\SettingController@saveBusinessInfo'])); ?>

										<div class="form-group row">
											<label for="name" class="col-sm-4 col-form-label">Company Legal Name</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="company_legal_name" id="name" value="<?php echo e(isset($businessDetail)?$businessDetail->company_legal_name: ''); ?>" placeholder="Company Legal Name">
											</div>
										</div>
										<div class="form-group row">
											<label for="name" class="col-sm-4 col-form-label">City Registered</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="city_registered" value="<?php echo e(isset($businessDetail)?$businessDetail->city_registered: ''); ?>" id="name" placeholder="City Registered">
											</div>
										</div>
										<div class="form-group row">
											<label for="name" class="col-sm-4 col-form-label">Type</label>
											<div class="col-sm-8">
												<select name="type" class="sel-pad form-control">
												<?php if(isset($businessType)): ?>
													<option value="individual" <?php if($businessType== 'individual'): ?> selected <?php endif; ?>>Individual</option>
													<option value="llp" <?php if($businessType== 'llp'): ?> selected <?php endif; ?> >LLP</option>
													<option value="llc" <?php if($businessType== 'llc'): ?> selected <?php endif; ?> >LLC</option>
													<option value="corporation" <?php if($businessType== 'corporation'): ?> selected <?php endif; ?> >Corporation</option>
													<option value="partnership" <?php if($businessType== 'partnership'): ?> selected <?php endif; ?> >Partnership</option>
													<option value="proprietorship" <?php if($businessType== 'proprietorship'): ?> selected <?php endif; ?> >Proprietorship</option>
													<option value="pvt_ltd" <?php if($businessType== 'pvt_ltd'): ?> selected <?php endif; ?> >Private Limited</option>
													<option value="public_ltd" <?php if($businessType== 'public_ltd'): ?> selected <?php endif; ?> >Public Limited</option>
												<?php endif; ?>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label for="name" class="col-sm-4 col-form-label">Address</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" value="<?php echo e(isset($businessDetail)?$businessDetail->address: ''); ?>" id="name" name="address" placeholder="Address">
											</div>
										</div>
										<div class="form-group row">
											<label for="name" class="col-sm-4 col-form-label">TIN</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="tin" value="<?php echo e(Old('tin')?  Old('tin') : isset($businessDetail) ? $businessDetail->tin: ''); ?>" id="email" placeholder="TIN">
											</div>
										</div>
										<div class="form-group row">
											<label for="name" class="col-sm-4 col-form-label">Upload Tin Proof</label>
											<div class="col-sm-8">
												<input type="file" class="form-control" name="tin_proff" id="email">
												<?php if($errors->has('tin_proff')): ?> <?php echo e($errors->first('tin_proff')); ?> <?php endif; ?>
											</div>
											<?php if(isset($businessDetail) && ($businessDetail->tin_proff!='')): ?><img src="<?php echo e($businessDetail->tin_proff); ?>" width="100"  style="margin-left:15px; margin-top:10px;" /><?php endif; ?>
										</div>
										<div class="form-group row">
											<label for="name" class="col-sm-4 col-form-label">PAN</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="pan" value="<?php echo e($businessDetail?$businessDetail->pan: ''); ?>" id="name" placeholder="PAN">
											</div>
										</div>
										<div class="form-group row">
											<label for="name" class="col-sm-4 col-form-label">Upload PAN Proff</label>
											<div class="col-sm-8">
												<input type="file" class="form-control" name="pan_proff" id="email">
												<?php if($errors->has('pan_proff')): ?> <?php echo e($errors->first('pan_proff')); ?> <?php endif; ?>
											</div>
											<?php if(isset($businessDetail) && ($businessDetail->pan_proff!='')): ?><img src="<?php echo e($businessDetail->pan_proff); ?>" width="100"  style="margin-left:15px; margin-top:10px;"/><?php endif; ?>
										</div>
										<div class="form-group row">
											<label for="name" class="col-sm-4 col-form-label">CST Number</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="cst" value="<?php echo e($businessDetail?$businessDetail->cst: ''); ?>" id="name" placeholder="CST">
											</div>
										</div>
										<div class="form-group row">
											<label for="name" class="col-sm-4 col-form-label">Upload CST Proff</label>
											<div class="col-sm-8">
												<input type="file" class="form-control" name="cst_proff" id="email">
												<?php if($errors->has('cst_proff')): ?> <?php echo e($errors->first('cst_proff')); ?> <?php endif; ?>
											</div>
											<?php if(isset($businessDetail) && $businessDetail->cst_proff!=''): ?><img src="<?php echo e($businessDetail->cst_proff); ?>" width="100"  style="margin-left:15px; margin-top:10px;"/><?php endif; ?>
										</div>
										<div class="box-block">	
											<div class="row">
												<center>
													<button type="submit" class="btn btn-primary" style="margin-left:-35px;">Submit Details</button>
												</center>
											</div>
										</div>
								<?php echo Form::close(); ?>

							</div>
						</div>
					</div>
				</div>
				
				<div id="pickup" class="tab-pane fade">
					<div class="box-block">
						<div class="row">
							<div class="col-md-6">
								<?php echo Form::open(array('method' => 'post', 'action' => ['Admin\Setting\SettingController@savePickupDetail'])); ?>

									<div class="form-group row">
										<label for="name" class="col-sm-4 col-form-label">Pick up Address</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="name" name="pickup_address" value="<?php echo e($pickupDetail?$pickupDetail->pickup_address: ''); ?>" placeholder="Pick up Address">
										</div>
									</div>
										<div class="form-group row">
											<label for="name" class="col-sm-4 col-form-label">Pick up Pincode</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="name" value="<?php echo e($pickupDetail?$pickupDetail->pickup_pincode: ''); ?>" name="pickup_pincode" placeholder="Pick up Pincode">
											</div>
										</div>
										
										<div class="form-group row">
											<label for="name" class="col-sm-4 col-form-label">Mobile Number</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="name" value="<?php echo e($pickupDetail?$pickupDetail->pickup_mobile: ''); ?>" name="pickup_mobile" placeholder="Mobile Number">
											</div>
										</div>
										<div class="form-group row">
											<label for="name" class="col-sm-4 col-form-label">Email</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="email" value="<?php echo e($pickupDetail?$pickupDetail->pickup_email: ''); ?>" name="pickup_email" placeholder="Email">
											</div>
										</div>
								
										<div class="box-block">	
											<div class="row">
												<center>
													<button type="submit" class="btn btn-primary">Save Pickup Details</button>
												</center>
											</div>
										</div>
							<?php echo Form::close(); ?>

							</div>
						</div>
					</div>
				</div>
				<div id="bank" class="tab-pane fade">
					<div class="box-block">
						<div class="row">
							<div class="col-md-6">
								<?php echo Form::open(array('method' => 'post', 'action' => ['Admin\Setting\SettingController@savebankDetails'])); ?>

									<div class="form-group row">
										<label for="name" class="col-sm-4 col-form-label">Techturtle Client ID</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="name" disabled="" value="<?php echo e(Auth::user()->id); ?>" placeholder="Techturtle Client ID">
										</div>
									</div>
										<div class="form-group row">
											<label for="name" class="col-sm-4 col-form-label">Account Number</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" value="<?php echo e($bankDetail?$bankDetail->account_number: ''); ?>" name="account_number" id="name" placeholder="Account Number">
											</div>
										</div>
										<div class="form-group row">
											<label for="name" class="col-sm-4 col-form-label">Type</label>
											<div class="col-sm-8">
												<select class="sel-pad form-control" name="type">
													<option name="saving" <?php if($account_type == 'saving'): ?> selected <?php endif; ?> >Savings</option>
													<option name="current" <?php if($account_type == 'current'): ?> selected <?php endif; ?> >Current</option>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label for="name" class="col-sm-4 col-form-label">Bank Name</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" value="<?php echo e($bankDetail?$bankDetail->bank_name: ''); ?>" name="bank_name" id="name" placeholder="Bank Name">
											</div>
										</div>
										<div class="form-group row">
											<label for="name" class="col-sm-4 col-form-label">IFSC</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" value="<?php echo e($bankDetail?$bankDetail->ifsc_code: ''); ?>" name="ifsc_code" id="email" placeholder="IFSC">
											</div>
										</div>
								
								<div class="box-block">	
									<div class="row">
										<center>
											<button class="btn btn-primary">Save Bank Details</button>
										</center>
									</div>
								</div>
							<?php echo Form::close(); ?>

							</div>
						</div>
					</div>
				</div>
				
				<div id="submit-domain" class="tab-pane fade">
					<div class="row advance_row">
						<div class="container">
							<p>In order to set up your website it is required that you provide us all the details that are mentioned below. We require these details from you so that we can integrate your domain with your website. Techturtle values its association with you and the privacy of the information provided by you holds immense importance for us. All the details provided by you will be confidential and won’t be shared with anyone or any organization.</p>

							<?php if(Session::has('message')): ?>
							<div class="alert alert-<?php echo e(Session::has('class') ? Session::get('class') : ''); ?>">
							  <strong><?php echo e(Session::get('message')); ?></strong>
							</div>
							<?php endif; ?>

							<?php echo Form::open(array('method' => 'post', 'action' => ['Admin\DomainRequest\DomainRequestController@create'])); ?>

								<div class="col-md-8">
									<div class="form-group row">
										<label for="example-text-input" class="col-xs-4 col-form-label">Enter Domain Name :</label>
										<div class="col-xs-8">
											<input class="form-control" type="text" value="<?php echo e(Old('domain_name') ? Old('domain_name') : 'http://'); ?>" name="domain_name" id="example-text-input">
											<?php if($errors->has('domain_name')): ?> <span class="text-danger"><?php echo e($errors->first('domain_name')); ?></span> <?php endif; ?>
										</div>
									</div>
									<div class="form-group row">
										<label for="example-text-input" class="col-xs-4 col-form-label">Select Service Provider :</label>
										<div class="col-xs-8">
											<input class="form-control" type="text" value="<?php echo e(Old('service_provider') ? Old('service_provider') : ''); ?>" name="service_provider" id="example-text-input">
											<?php if($errors->has('service_provider')): ?> <span class="text-danger"><?php echo e($errors->first('service_provider')); ?></span> <?php endif; ?>
										</div>
									</div>
									<div class="form-group row">
										<label for="example-text-input" class="col-xs-4 col-form-label">USER ID :</label>
										<div class="col-xs-8">
											<input class="form-control" type="text" value="<?php echo e(Old('domain_user_id') ? Old('domain_user_id') : ''); ?>" name="domain_user_id" id="example-text-input">
											<?php if($errors->has('domain_user_id')): ?> <span class="text-danger"><?php echo e($errors->first('domain_user_id')); ?></span> <?php endif; ?>
										</div>
									</div>
									<div class="form-group row">
										<label for="example-text-input" class="col-xs-4 col-form-label">Password :</label>
										<div class="col-xs-8">
											<input class="form-control" type="password" value="" name="domain_password" id="example-text-input">
											<p>We will not share your details to anyone, all the data is server side encrypted</p>
											<?php if($errors->has('domain_password')): ?> <span class="text-danger"><?php echo e($errors->first('domain_password')); ?></span> <?php endif; ?>
										</div>
									</div>
								</div>
							
							<div class="col-md-4 agreement">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 400 400" style="enable-background:new 0 0 400 400;" xml:space="preserve" width="64px" height="64px">
								<g id="XMLID_9_">
									<polygon id="XMLID_821_" points="300,399.999 360,340 300,340" fill="#43b968"/>
									<path id="XMLID_822_" d="M360,310V0H40v400h230v-90H360z M100,80h200v30H100V80z M100,140h200v30H100V140z M100,200h200v30H100V200   z M183.743,342.322L180.208,360l-29.497-29.498L121.213,360l-3.535-17.678L100,338.787l24.389-24.389   c-2.344-4.274-3.678-9.18-3.678-14.398c0-16.568,13.432-30,30-30c16.568,0,30,13.432,30,30c0,5.219-1.334,10.125-3.678,14.398   l24.388,24.389L183.743,342.322z" fill="#43b968"/>
								</svg>
								<p>Confidential<br/> Agreement</p>
							</div>
							<div class="col-md-12">
								<div class="setup-submit">
								   <button type="submit" class="btn btn-success">Save</button>
								</div>
							</div>
							<?php echo Form::close(); ?>

						</div>
						<div class="container time-section">
							<div class="col-md-12">
							<div class="col-md-4">
								
							</div>
							<div class="col-md-4">
								<h3>IT TAKES 24 - 48 HOURS</h3>
							</div>
							<div class="col-md-4">
								
							</div>
							</div>
							<br/>
							<p>It takes about 24-48 hours for your website to get live on the domain provided by you as there are several technicalities involved in completing the process. Your Service Provider also takes some time to make your website live on the provided domain. If it has been more than 48 hours since the initiation of the process and your website is still not live then you need to contact the Customer Care by clicking on the Contact Techturtle tab provided in the left navigation of your dashboard.</p>
						</div>
						<hr />
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<h2>Your Current requested domains</h2>
								</div>
							</div>
							<div class="row">
								<table class="table">
									<thead>
										<tr>
											<th>Sr</th>
											<th>Domain Name</th>
											<th>Service Provider</th>
											<th>Username</th>
											<th>Password</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($domainRequests as $key => $domainRequest): ?>
											<tr>
												<td><?php echo e($key+1); ?></td>
												<td><?php echo e($domainRequest->domain_name); ?></td>
												<td><?php echo e($domainRequest->service_provider); ?></td>
												<td><?php echo e($domainRequest->user_name); ?></td> 
												<td><input type="password" id="password<?php echo e($domainRequest->id); ?>" disabled="" style="background: #E8EBF0;border:none;" value="<?php echo e($domainRequest->password); ?>"><a href="javascript:;" onmousedown="showPassword(<?php echo e($domainRequest->id); ?>)" onmouseup="hidePassword(<?php echo e($domainRequest->id); ?>)" class="btn btn-warning"><i class="fa fa-eye"></i></a></td>
												<td><?php echo e($domainRequest->status); ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			  </div>
			</div>
		</div>
	</div>			
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>