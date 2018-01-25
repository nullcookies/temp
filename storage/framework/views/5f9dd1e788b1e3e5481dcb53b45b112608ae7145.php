<?php $__env->startSection('content'); ?>

<div class="container-fluid pd-30 aboutuscrumb">
	<div class="container">
		<ol class="breadcrumb ms-breadcrumb">
		  <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
		  <li class="breadcrumb-item active"><a>Contact Us</a></li>
		</ol>
	</div>
</div>
<div class="container-fluid">
    <div class="container roboto-light trackall pdb-50">
        <h3 class="rob-reg bold caps">Get in Touch</h3>
        <div class="col-md-12 mobpd0 pd-20">
            <div class="col-md-4 mobpd0 mob-center">
                <div class="col-md-3 mobpd0 icon-center">
                    <i class="fa fa-home"></i>
                </div>
                <div class="col-md-9 mobpd0">
                    <h4 style="margin:0;font-weight:bold;margin-bottom:5px;">Address:</h4>
                    <p style="font-size:14px;" class="bold">B-12, First Floor, Parasvanath Majestic Arcade, Ghaziabad, UP - 201014</p>
                </div>
            </div>
            <div class="col-md-4 mobpd0 mob-center">
                <div class="col-md-3 mobpd0 icon-center">
                    <i class="fa fa-phone"></i>
                </div>
                <div class="col-md-9 mobpd0">
                    <h4 style="margin:0;font-weight:bold;margin-bottom:5px;">Phone:</h4>
                    <p style="font-size:14px;" class="bold">+91-7838576144</p>
                </div>
            </div>
            <div class="col-md-4 mobpd0 mob-center">
                <div class="col-md-3 mobpd0 icon-center">
                    <i class="fa fa-envelope"></i>
                </div>
                <div class="col-md-9 mobpd0">
                    <h4 style="margin:0;font-weight:bold;margin-bottom:5px;">Email:</h4>
                    <p style="font-size:14px;" class="bold"><a href="mailto:info@massengers.com" style="text-decoration:none;color:#d80003;">info@massengers.com</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-12 mobpd0 pd-20">
            <h3 class="rob-reg bold caps">Miscellaneous Information</h3>
            <p>Please, do not hesitate to get in touch. 
                Please use this form to get in touch with us. 
                If you've got a specific question about our services, then why not check out our website and get in touch with us! 
                If you have any questions or comments, please get in touch with us. </p>
        </div>
        <div class="col-md-12 mobpd0 pd-20">
            <div class="col-md-8 pdl-0 mobpd0">
                <h3 class="rob-reg bold caps">Contact Form</h3>
                <?php if(Session::has('success')): ?>
                <div class="alert alert-success">
                  <?php echo e(Session::get('success')); ?>

                </div>
                <?php endif; ?>
                
                <?php if(Session::has('error')): ?>
                <div class="alert alert-danger">
                  <?php echo e(Session::get('error')); ?>

                </div>
                <?php endif; ?>
                <form action="<?php echo e(url('/contact-us')); ?>" method="post" class="contact-form">
                    <?php echo e(csrf_field()); ?>

                    <div class="col-md-4 pdl-0 mobpd0">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Name">
                            
                            <?php if($errors->has('name')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('name')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4 mobpd0">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        <?php if($errors->has('email')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4 pdr-0 mobpd0">
                        <div class="form-group">
                            <input type="text" name="mobile" class="form-control" placeholder="Phone">
                            
                            <?php if($errors->has('mobile')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('mobile')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-12 pd-0 message-newbox">
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="3" placeholder="Message"></textarea>
                             <?php if($errors->has('message')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('message')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-12 pd-0">
                        <button type="submit" class="sendit" title="Send">Send</button><button type="reset" class="clearit" title="Clear">Clear</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4 mobpd0 pdr-0 map-margin">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.7614587150388!2d77.36653971456947!3d28.636910582416018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce552cf930df5%3A0x9ef4e5b68c235e6e!2sParsvnath+Majestic+Arcade!5e0!3m2!1sen!2sin!4v1504937383337" width="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>    
    </div>
</div>    
<div class="container-fluid bg-f9f9">
    <div class="container trackall pdb-50">
        <h3 class="rob-reg bold">Track Order</h3>
        <div class="col-md-12 trackit roboto-light">
            <div class="col-md-6 mobpd0">
                <div class="form-group">
                    <label class="control-label col-sm-3 mobpd0" for="orderid-track">Order Id*</label>
                    <div class="col-sm-9 mobpd0">
                      <input type="text" class="form-control" id="orderid-track">
                    </div>
                </div>
            </div>
            <div class="col-md-6 mobpd0">
                <div class="form-group">
                    <label class="control-label col-sm-3 mobpd0" for="emailid-track">Email Id*</label>
                    <div class="col-sm-9 mobpd0">
                      <input type="text" class="form-control" id="emailid-track">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mobpd0 pd-20">
            <center><button type="submit" class="btn btn-default btn-track2" title="Track Order">Track Order</button></center> 
        </div>
    </div>
</div>	
<!--<div class="container-fluid pd-40">
	<div class="container">
		<h1 class="center roboto c-red">Talk To Us</h1>
		<h4 class="center roboto c-red">We have answers right now!</h4>
	</div>
</div>
<div class="container-fluid tracker">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<form class="contactform">
					<div class="form-group">
						<select class="form-control">
							<option>Select your query type</option>
							<option>Complaint/Feedback</option>
							<option>Pre-Order Inquiry</option>
							<option>Post-Order Inquiry</option>
							<option>Appreciation</option>
							<option>Website Issue</option>
						</select>
					</div>
					<div class="col-sm-6 your-name form-group">
						<input type="text" class="form-control" name="" placeholder="Your Name">
					</div>
					<div class="col-sm-6 your-email form-group">
						<input type="text" class="form-control" name="" placeholder="Your Email">
					</div>
					<div class="form-group">
						<textarea placeholder="Comment" rows="3" class="form-control"></textarea>
					</div>
					<button type="submit" class="btn btn-contact">Submit</button>
				</form>

				<h3 class="roboto c-red">Our Offices</h3>
				<p class="roboto"><span class="bold c-red">Corporate Office</span><br/>
				B-12, First Floor, Parasvanath Majestic Arcade, Ghaziabad, UP - 201014</p>
				<p class="roboto"><i class="fa fa-phone"></i> +91-9582212488</p>
			</div>
			<div class="col-sm-6 center">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1041.083113559326!2d77.368839495204!3d28.636587748589765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9ef4e5b68c235e6e!2sParsvnath+Majestic+Arcade!5e0!3m2!1sen!2sin!4v1503383673080" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>	
		<div class="row service-row">
			<h3 class="roboto c-red">Massengers Customer Care</h3>
			<div class="table-responsive">
    			<table class="table roboto contact-table">
    				<thead>
    					<th>Service Type</th>
    					<th>Contact Coordinates</th>
    					<th>Availability</th>
    				</thead>
    				<tbody>
    					<tr>
    						<td>Customer Care Number</td>
    						<td>+91 9582212488</td>
    						<td>08:00 to 22:30 hrs</td>
    					</tr>
    					<tr>
    						<td>Email Address</td>
    						<td><a href="mailto:info@massengers.com">info@massengers.com</a></td>
    						<td>24/7</td>
    					</tr>
    					<tr>
    						<td>Live Chat Support</td>
    						<td><a href="javascript:;">Chat Now</a></td>
    						<td>09:00 to 20:00 hrs</td>
    					</tr>
    				</tbody>
    			</table>
			</div>
		</div>
	</div>
</div>-->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>