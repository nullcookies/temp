<?php $__env->startSection('js'); ?>
<!-- cropie -->

  <script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">
  
  <script type="text/javascript">
        $uploadCrop = $('#upload-demo').croppie({
            enableExif: true,
            viewport: {
                width: 100,
                height: 100,
                type: 'rectangle'
            },
            boundary: {
                width: 150,
                height: 150
            }
    });

$('#upload').on('change', function () { 
	var reader = new FileReader();
    reader.onload = function (e) {
    	$uploadCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    	
    }
    reader.readAsDataURL(this.files[0]);
});

$('.upload-result').on('click', function (ev) {
	$uploadCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {
		$.ajax({
			url: "<?php echo e(url('/uploadprofileimage')); ?>",
			type: "POST",
			dataType: 'json',
			data: {"image":resp},
			success: function (data) {
			    
			    if(data['error'] == 0){
			        html = '<img width="100%" src="' + resp + '" />';
    				$("#upload-demo-i").html(html);
    				location.reload();
			    }
				
			}
		});
	});
});

</script>

<!-- cropie -->
<script
  src="<?php echo e(asset('massengers/js/jquery-ui.min.js')); ?>"></script>
<script>
  $( function() {
    $( "#datepicker123" ).datepicker();
  } );
  </script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
  
  <script>
      
      $(document).ready(function(){
          
          $('#updateprofileform').on('submit', function(event){
              event.preventDefault();
              var form_data = $(this).serialize();
              
              $.ajax({
                 url: "<?php echo e(url('/updateprofile')); ?>",
                 type: 'POST',
                 data: form_data,
                 dataType: 'json',
                 beforeSend: function(){
                     
                 },
                 success: function(result){
                     location.reload();
                 },
                 error: function(data){
                    errorsHtml = '';
    				$.each(data.responseJSON, function(key, value) {
    					if($.isArray(value)){
    						errorsHtml += value[0];
    					}else{
    						errorsHtml += value;
    					}
    					return false;
    	            });
    	            $('#updateprofilemessage').html('<div class="alert alert-danger">'+errorsHtml+'</div>');
                 },
              });
          })
      });
  </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>

<link href="<?php echo e(asset('massengers/css/jquery-ui.theme.min.css')); ?>" rel="stylesheet" />
<style>
    .profile-profile .profile-edit{
    	position: absolute;
        right: 0;
        margin-right: 20px;
        margin-top: 20px;
        text-decoration: none;
        color: #d80003;
        display: inline-block;
    }
    .profile-profile .profile-edit:focus{
    	outline: none;
    }
    .read-more2{
        border:1px solid #d80003;
    }
    .profileaddress{
        padding:10px;
    }
    .profile-addaddress{
        height: 157px;
        border: 1px dotted #d80003;
        border-radius: 30px;
        display: block;
        padding: 10px;
        text-align:center;
    }
    .profile-addaddress h4{
        margin-top:60px;    
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid mobpd10 pd-30">
	<div class="container">
		<ol class="breadcrumb ms-breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
			<li class="breadcrumb-item active" >Profile</li>
			
		</ol>
	</div>
</div>
<div class="container-fluid pd-30">
	<div class="container roboto-light">
		<div class="col-md-3 col-sm-3 profile-box">
			<ul class="profile-tabs">
				<li><a href="#account">My Account</a></li>
				<li class="active"><a href="#profile" data-toggle="tab" title="My Profile">My Profile</a></li>
				<li><a href="#address" data-toggle="tab" title="My Address Book">My Address Book</a></li>
				<!--<li><a href="#remainders" data-toggle="tab">My Reminders</a></li>-->
				<li><a href="#orders" data-toggle="tab" title="My Orders">My Orders</a></li>
				<li><a href="#rstpwd" data-toggle="tab" title="Reset Password">Reset Password</a></li>
				<li><a href="<?php echo e(url('/logout')); ?>" title="Log Out">Log Out</a></li>
			</ul>
		</div>
			<div class="col-md-9 col-sm-9 profile-content">
				<div class="tab-content">
					<!--<div id="account" class="tab-pane fade in active">
							
					</div>-->
					<div id="profile" class="tab-pane fade in active">
						<h3 class="c-red">Your Profile</h3>
						<!-- <form class="formchangepwd">
							<div class="form-group">
								<input type="text" placeholder="Name"/>
							</div>
							<div class="form-group">
								<input type="text" placeholder="Email Address"/>
							</div>
							<button class="savebtn">Save</button>
						</form> -->
						<div class="row pd-10">
							<div class="col-md-4 col-sm-6 profile-profile">
							    <a href="javascript:;" class="profile-edit" data-toggle="modal" data-target="#profileedit">Edit</a>
								<h4><?php echo e(Auth::user()->name); ?></h4>
								<img width="50%" src="<?php echo e($profile_image); ?>"> 
								<label style="cursor:pointer;" data-toggle="modal" data-target="#uploadprofilepic">Update Picture</label>
								<p>Mobile No. : <span class="c-red">+91-<?php echo e(Auth::user()->mobile); ?></span></p>
								<p>Mail Id : <span class="c-red"><?php echo e(Auth::user()->email); ?></span></p>
								<p>DOB: <span class="c-red"><?php echo e(Carbon\Carbon::parse(Auth::user()->dob)->format('D d-M-Y')); ?></span></p>
							</div>	
						</div>
					</div>
					
					
					<div id="address" class="tab-pane fade">
						<h3 class="c-red">My Address Book</h3>
						<div class="row pd-10">
						    <!--<div class="col-md-4 col-sm-4 profileaddress">
						        <a href="javascript:;" class="addmodal profile-addaddress" data-toggle="modal" data-target="#addressmodal">
						            <h4>Add New Address</h4>
						        </a>
						    </div>-->
						<?php foreach($addresses as $address): ?>
							<div class="col-md-4 col-sm-6 profile-address">
							    <div class="profile-address-box">
    								<h4><?php echo e($address->name); ?></h4>
    								<p><?php echo e($address->city); ?></p>
    								<p><?php echo e($address->state); ?> - <?php echo e($address->pincode); ?></p>
    								<p>Mobile No. : <span class="c-red">+91-<?php echo e($address->mobile); ?></span></p>
    								<p class="mb-10">Email : <span class="c-red"><?php echo e($address->email); ?></span></p>
								</div>
							</div>
						<?php endforeach; ?>	
						</div>	
					</div>
					
					
					<!--<div id="remainders" class="tab-pane fade">
						<h3 class="c-red">My Reminders</h3>
						<form class="formchangepwd">
							<div class="form-group">
								<input placeholder="* Name"/>
							</div>
							<div class="form-group">
								<input placeholder="* Occasion"/>
							</div>
							<div class="form-group">
								<input placeholder="* Date" id="datepicker123"/>
							</div>
							<button class="savebtn">Save</button>
						</form>
						
						<table class="table profile-orders">
							<thead class="bg-red">
								<th>Name</th>
								<th>Occasion</th>
								<th>Date</th>
							</thead>
							<tbody>
								<tr>
									<td>Sanya</td>
									<td>Gift 1</td>
									<td>Fri, Aug 01, 2017</td>
								</tr>
							</tbody>
						</table>
					</div>-->


					<div id="orders" class="tab-pane fade">
						<h3 class="c-red">My Orders</h3>
						<table class="table profile-orders roboto-light">
							<thead class="bg-red">
								<th>Order No.</th>
								<th>Recipient</th>
								<th>Amount</th>
								<th>Order Date</th>
								<th>Delivery Date</th>
								<th>Status</th>
							</thead>
							<tbody>
							    <?php foreach($orders as $order): ?>
								<tr>
									<td>OR-<?php echo e($order->id); ?></td>
									<td><?php echo e($order->shippingName); ?></td>
									<td><i class="fa fa-inr"></i> <?php echo e($order->orderAmount); ?></td>
									<td><?php echo e(Carbon\Carbon::parse($order->created_at)->format('D d-m-Y')); ?></td>
									<td><?php if($order->is_delivered == 'yes'): ?> <?php echo e(Carbon\Carbon::parse($order->delivery_time)->format('D d-m-Y')); ?> <?php else: ?> -- <?php endif; ?></td>
									<td><?php echo e($order->status); ?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					
					
					<div id="rstpwd" class="tab-pane fade">
						<h3 class="c-red">Change Password</h3>
						    <?php if(Session::has('success')): ?>
                                <div class="alert alert-success"><?php echo Session::get('success'); ?></div>
                            <?php endif; ?>
                            <?php if(Session::has('failure')): ?>
                                <div class="alert alert-danger"><?php echo Session::get('failure'); ?></div>
                            <?php endif; ?>
						    <form action="<?php echo e(url('/change-password')); ?>" method="post" role="form" class="formchangepwd">
                                <?php echo e(csrf_field()); ?>


							<div class="form-group">
								<input name="old" placeholder="Current Password"/>
								<?php if($errors->has('old')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('old')); ?></strong>
                                    </span>
                                <?php endif; ?>
							</div>
							<div class="form-group">
								<input name="password" placeholder="New Password"/>
								 <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
							</div>
							<div class="form-group">
								<input name="password_confirmation" placeholder="Verify New Password"/>
								<?php if($errors->has('password_confirmation')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                    </span>
                                <?php endif; ?>
							</div>
							<button class="savebtn" title="Save">Save</button>
						</form>
					</div>
				</div>
			</div>
	</div>
</div>
<div class="modal2 fade in" id="profileedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content newsletter-content">
			<div class="modal-body text-center">
				<button type="button" class="close close-btn" data-dismiss="modal">&times;</button>
				<h2 class="modal-title c-red">Edit Your Profile Info</h2>
				
				<form id="updateprofileform" method="post" action="<?php echo e(url('/updateprofile')); ?>">
				    <?php echo csrf_field(); ?>

				    <div id="updateprofilemessage"></div>
					<input type="text" class="news-input" name="name" value="<?php echo e(Auth::user()->name); ?>" placeholder="Enter Your Name">
					<input type="text" class="news-input" name="mobile" value="<?php echo e(Auth::user()->mobile); ?>" placeholder="Enter Your Mobile Number">
					<input type="text" class="news-input" name="dob" value="<?php echo e(Carbon\Carbon::parse(Auth::user()->dob)->format('m/d/Y')); ?>" id="datepicker" placeholder="Enter Your Date of Birth">
					<button class="read-more2" type="submit" title="Save">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="uploadprofilepic" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <center><h4 class="modal-title">Upload Profile Image</h4></center>
          </div>
      <div class="modal-body" style="padding:45px 2px 2px ">
        <div class="row">
	  		<div class="col-md-4 text-center">
				<div id="upload-demo"></div>
	  		</div>
    	  		<div class="col-md-3" style="padding:30px;text-align:center;">
				<label for="upload"><i class="fa fa-upload" style="font-size:30px;cursor:pointer;" aria-hidden="true"></i></label>
				<br/>
				<input type="file" style="display:none;" id="upload">
				<br/>
				<button class="btn btn-success upload-result">Save Image</button>
	  		</div>
	  		<div class="col-md-5" style="">
				<div id="upload-demo-i" style="background:#e1e1e1;width:200px;height:200px;"></div>
	  		</div>
	  		
	  		
	  	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>