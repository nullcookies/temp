<?php $__env->startSection('content'); ?>

<div class="container-fluid pd-20">
	<div class="container">
		<ol class="breadcrumb ms-breadcrumb">
		  <li class="breadcrumb-item"><a href="index.html">Home</a></li>
		  <li class="breadcrumb-item active">Careers</li>
		</ol>
	</div>
</div>

<div class="container-fluid pdb-50">
	<div class="container careers-main">
		<h4>Personal Information</h4>
		<div class="col-md-8 form-car-box">
			<form class="career-form">
				<div class="form-group col-md-6 col-sm-6">
					<label for="">First Name</label>
					<input type="text" class="form-control" placeholder="First Name">
				</div>
				<div class="form-group col-md-6 col-sm-6">
					<label for="">Last Name</label>
					<input type="text" class="form-control" placeholder="Last Name">
				</div>
				<div class="form-group col-md-6 col-sm-6">
					<label for="">Mobile</label>
					<input type="text" class="form-control" placeholder="Mobile Number">
				</div>
				<div class="form-group col-md-6 col-sm-6">
					<label for="">E-mail Address</label>
					<input type="text" class="form-control mb-5" placeholder="E-mail Address">
					<small>We&#39;ll never share your email with anyone else.</small>
				</div>
				<div class="form-group col-md-6 col-sm-6">
					<label for="">E-mail Address</label>
					<select class="form-control">
						<option>Content Writer</option>
						<option>Content Writer</option>
						<option>Content Writer</option>
					</select>
				</div>
				<div class="form-group col-md-6 col-sm-6">
					<label for="">Total Experience</label>
					<select class="form-control">
						<option>1 Year</option>
						<option>2 Year</option>
						<option>3 Year</option>
					</select>
				</div>
				<div class="form-group col-md-6 col-sm-6">
					<label for="">City</label>
					<input type="text" class="form-control" placeholder="City">
				</div>
				<div class="form-group col-md-6 col-sm-6">
					<label for="">State</label>
					<input type="text" class="form-control" placeholder="State">
				</div>
				<div class="form-group col-md-6 col-sm-6">
					<label for="">Address</label>
					<input type="text" class="form-control" placeholder="Location">
				</div>
				<div class="form-group col-md-6 col-sm-6">
					<label for="">Address</label>
					<input type="text" class="form-control" placeholder="Location 2">
				</div>
				<div class="form-group col-md-12">
					<label for="">Upload Your Resume</label>
					<input type="file">
				</div>
				<center>
					<button type="submit" class="career-submit">Send</button>
				</center>
			</form>
		</div>
		<div class="col-md-4">
			<center>
				<img src="<?php echo e(url('massengers/img/hiring.png')); ?>" class="img-responsive">
			</center>	
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>