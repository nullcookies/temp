<?php $__env->startSection('content'); ?>
	
	
<div class="container-fluid pd-50">
	<div class="container dd">
		<ul class="cart-tab">
			<li><a href="#"></a></li>
			<li><a href="#"></a></li>
			<li><a href="#"></a></li>
			<li><a href="#"></a></li>
		</ul>
			<h1>Delivery Details</h1>
			
		<div class="cart-div2">
			<table class="table cart-table2">
				<thead>
					<tr>
						<th class="center">Gift 1</th>
						<th class="center">To be delivered between <span class="c-red">11:00 - 12:00 hrs</span> on <span class="c-red">Mon, Mar 20</span></th>
						<th class="center"><a href="#" class="view-details">View Details</a></th>
					</tr>
				</thead>
				<tbody>
					<td colspan="3" class="apd-30">
						<div class="col-md-12">
							<form>
								<div class="form-group col-md-6">
									<input type="text" class="delivery-control" placeholder="Recipient's Name"/>
								</div>
								<div class="form-group col-md-6">
									<input type="text" class="delivery-control" placeholder="Recipient's Email ID (Optional)"/>
								</div>
								<div class="form-group col-md-6">
									<input type="text" class="delivery-control" placeholder="Recipient's Address"/>
									<small class="right mr-15">Line 1</small>
								</div>
								<div class="form-group col-md-6 mb-35">
									<select class="delivery-control">
										<option>Select Occassion</option>
										<option>Select Occassion</option>
										<option>Select Occassion</option>
										<option>Select Occassion</option>
										<option>Select Occassion</option>
									</select>
								</div>
								<div class="form-group col-md-6">
									<input type="text" class="delivery-control" placeholder="Recipient's Address"/>
									<small class="right mr-15">Line 2</small>
								</div>
								<div class="form-group col-md-6 mb-45">
									<input type="checkbox" id="my-check"/>
									<label for="my-check">Message on Card</label>
								</div>
								<div class="form-group col-md-6">
									<input type="text" class="delivery-control" placeholder="Recipient's Pincode"/>
								</div>
								<div class="form-group col-md-6">
									<input type="text" class="delivery-control" placeholder="Recipient's Mobile"/>
								</div>
							</form>
						</div>					
					</td>
				</tbody>
			</table>
		</div>	
		
		<div class="cart-div2">
			<table class="table cart-table2">
				<thead>
					<tr>
						<th class="center">Gift 2</th>
						<th class="center">To be delivered between <span class="c-red">11:00 - 12:00 hrs</span> on <span class="c-red">Mon, Mar 20</span></th>
						<th class="center"><a href="#" class="view-details">View Details</a></th>
					</tr>
				</thead>
				<tbody>
					<td colspan="3" class="apd-30">
						<!--<div class="address-box dotted pd-60 center">
							<p><i class="fa fa-plus"></i></p>
							<h3>Add New Address</h3>
						</div>-->
						<div class="col-md-4 dotted pd-60 center mr-15 br-5">
							<p><i class="fa fa-plus"></i></p>
							<h3>Add New Address</h3>
						</div>
						<div class="col-md-4 solid br-5">
							<div>
								<a href="#" class="check-btn"><i class="fa fa-check"></i></a>
								<a href="#" class="pencil-btn"><i class="fa fa-pencil"></i></a>
							</div>
							<h4>Sanya</h4>
							<p>Rohini, Delhi</p>
							<p>+91 123456789</p>
							<br/>
							<center>
								<a href="#" class="address">Address Selected</a>
							</center>
						</div>
						<!--<div class="address-box solid">
							<h4>Sanya</h4>
							<p>Rohini, Delhi</p>
							<p>+91 123456789</p>
							<center>
								<a href="#" class="address">Address Selected</a>
							</center>
						</div>-->
					</td>
				</tbody>
			</table>
			<div class="container">
				<div class="col-md-4">
					<select class="sel-occ">
						<option>Select occassion</option>
						<option>Select occassion</option>
						<option>Select occassion</option>
						<option>Select occassion</option>
					</select>
				</div>
				<div class="col-md-4">
					<h4>Gift1 to be delivered yet</h4>
				</div>
				<div class="col-md-4">
					<label class="c-red">Message on Card</label>
					<input type="checkbox" c/>
				</div>
			</div>
		<table class="table cart-table2">
			<thead>
				<th class="center">Sender's Details</th>
			</thead>
			<tbody>
				<tr>
					<td>
						<div class="col-md-3">
							<h3>Gaurav Sharma</h3>
						</div>
						<div class="col-md-4">
							<h3>+91 9582212488</h3>
						</div>
						<div class="col-md-5">
							<h3>gaurav.sharma0147@gmail.com</h3>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<br/>
			<center>
				<a href="<?php echo e(url('/checkout2')); ?>" class="save-continue">Save &amp; Continue</a>
			</center>
		</div>	
	</div>
</div>
<div class="container-fluid bg-black pd-30">
	<div class="container cart2">
		<div class="col-md-6">
			<h3><span class="c-red">Need Help?</span> Call us on +91 9582212488</h3>
		</div>
		<div class="col-md-6">
			<h3 class="pull-right"><span class="c-red">4 Million</span>  People Trusted Us</h3>
		</div>
	</div>
</div>	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>