<?php $__env->startSection('content'); ?>
	
<div class="container-fluid pd-40">
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
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>