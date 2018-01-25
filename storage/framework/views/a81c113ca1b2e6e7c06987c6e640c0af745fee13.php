<?php $__env->startSection('css'); ?>

<style>
    html{
        overflow-x:hidden;
    }
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script type="text/javascript">
	
	$(document).ready(function(){
		// to save address
		$('#save_address_form').on('submit', function(event){
			event.preventDefault();
			var formData = $(this).serialize();
			$.ajax({
				url: "<?php echo e(url('/savecustomeraddressajax')); ?>",
				type: 'POST',
				data: formData,
				dataType: 'json',
				beforeSend: function(){
					swal({
					  title: 'Processing..',
					  text: 'please do not referesh the page',
					  showCancelButton: false,
					  showConfirmButton: false
					});
				},
				success: function(result){
					if(result['success']){
						location.reload();
					}
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
					swal(errorsHtml, '', 'error');
				}
			});
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("input[name='addressid']").on('change', function(event){
			var addressid = $(this).val();
			$.ajax({
				url: "<?php echo e(url('/fetchaddressajax')); ?>",
				type: 'POST',
				data: {addressid:addressid},
				dataType: 'json',
				beforeSend: function(){
					swal({
					  title: 'Processing..',
					  text: 'please do not referesh the page',
					  showCancelButton: false,
					  showConfirmButton: false
					});
				},
				success: function(result){
					console.log(result);
					$("input[name='shipping_name']").val(result['name']);
					$("input[name='shipping_email']").val(result['email']);
					$("input[name='shipping_city']").val(result['city']);
					$("input[name='shipping_state']").val(result['state']);
					$("input[name='shipping_address_line_1']").val(result['address']);
					$("input[name='shipping_pincode']").val(result['pincode']);
					$("input[name='shipping_mobile']").val(result['mobile']);
                    $('.shipping_name_view_p').html(result['name']);
                    $('.shipping_address_view_p').html(result['city']+' '+result['state']);
                    $('.shipping_mobile_view_p').html(result['mobile']);
					swal('Address successfully selected');
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
					swal(errorsHtml, '', 'error');
				}
			});
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#delivery_detail_form').on('submit', function(event){
			event.preventDefault();
			var formData = $(this).serialize();
			$.ajax({
				url: "<?php echo e(url('/save_delivery_details')); ?>",
				type: 'POST',
				data: formData,
				dataType: 'json',
				beforeSend: function(){
					swal({
					  title: 'Processing..',
					  text: 'please do not referesh the page',
					  showCancelButton: false,
					  showConfirmButton: false
					});
				},
				success: function(result){
					if(result['success']){
						location.reload();
					}
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
					swal(errorsHtml, '', 'error');
				}
			});
		});
	});
</script>

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#proceed_to_pay_form').on('submit', function(event){
			event.preventDefault();
			var formData = $(this).serialize();
			$.ajax({
				url: "<?php echo e(url('/proceed_to_pay')); ?>",
				type: 'post',
				dataType: 'json',
				data: formData,
				beforeSend: function(){
					swal({
					  title: 'Processing..',
					  text: 'please do not referesh the page',
					  showCancelButton: false,
					  showConfirmButton: false
					});
				},
				success: function(result){
					if(result['success']){
						swal({
    					  title: 'Redirecting to payment gateway..',
    					  text: 'please do not referesh the page',
    					  showCancelButton: false,
    					  showConfirmButton: false,
    					  type: 'success',
    					});
						window.location.href = "<?php echo e(url('gotopaymentgateway/')); ?>"+'/'+result['buynowid'];
					}
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
					swal(errorsHtml, '', 'error');
				}
			});
		});
	});
</script>

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#back_to_delivery_detail').on('click', function(){
			var buynowid = "<?php echo e($buynow->id); ?>";
			$.ajax({
				url: "<?php echo e(url('/go_back_to_delivey_details')); ?>",
				type: 'post',
				data: {buynowid:buynowid},
				dataType: 'json',
				beforeSend: function(){
					swal({
					  title: 'Processing..',
					  text: 'please do not referesh the page',
					  showCancelButton: false,
					  showConfirmButton: false
					});
				},
				success: function(result){
					if(result['success']){
						location.reload();
					}
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
					swal(errorsHtml, '', 'error');
				}
			});
		});
	});
</script>

<script type="text/javascript">
	
	function removeItem(itemid){
			swal({
			        title: "Are you sure?",
			        text: "You will not be able to recover this time!",
			        type: "warning",
			        showCancelButton: true,
			        confirmButtonColor: "#d80003",
			        confirmButtonText: "Yes, delete it!",
			        cancelButtonText: "No, cancel please!",
			        closeOnConfirm: false,
			        closeOnCancel: true, 
			    },
			    function(isConfirm) {
			        if (isConfirm) {
			            
			            $.ajax({
			            	url: "<?php echo e(url('/delete_checkout_product')); ?>",
			            	type: 'post',
			            	data: {itemid:itemid},
			            	dataType: 'json',
			            	beforeSend: function(){
								swal({
								  title: 'Processing..',
								  text: 'please do not referesh the page',
								  showCancelButton: false,
								  showConfirmButton: false
								});
							},
							success: function(result){
								if(result['message']){
									location.reload();
								}
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

								swal(errorsHtml, '', 'error');
							}
			            });
			        } 
			    }
			);
		}
		
		
		
		function getAddressSelected(addressid){
		    $('.addresscheck').addClass('hidden');
		    $('#address'+addressid).removeClass('hidden');
		}
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid mobpd10 pd-30">
	<div class="container">
		<ol class="breadcrumb ms-breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
			<li class="breadcrumb-item active" >Product</li>
			<li class="breadcrumb-item active" >Checkout</li>
		</ol>
	</div>
</div>

<!-- delivery detail section starts -->

<?php if($buynow->saved_delivery_details == 'no'): ?>

<?php echo Form::open(array('id'=> 'delivery_detail_form')); ?>

<input type="hidden" name="checkoutid" value="<?php echo e($buynow->id); ?>">
<div class="container-fluid pd-50">
	<div class="container dd">
		<ul class="cart-tab">
			<li class="active"><a href="#"></a></li>
			<li><a href="#"></a></li> 
			<li><a href="#"></a></li> 
		</ul>
			<h1>Delivery Details</h1>

		<div class="cart-div2">
		<?php if(!Auth::user()): ?>
			<table class="table cart-table2">
				<thead>
					<tr>
						<th class="center">&nbsp;</th>
						<th class="center">To be delivered between <span class="c-red"><?php echo e($delivery_timing); ?>hrs</span> on <span class="c-red"><?php echo e($delivering_on); ?></span></th>
						<th class="center"><a href="javascript:;" class="view-details">View Details</a></th>
					</tr>
					<tr>
					    <table id="viewd">
					        <?php foreach($buy_now_products as $buynowproduct): ?>
					    	<tr>
								<td>
									<div class="img-box">
										<img src="<?php echo e($buynowproduct->image); ?>"/>
									</div>
									<div class="content-box">
										<p><?php echo e($buynowproduct->product_name); ?></p>
										<a href="javascript:;" onclick="removeItem(<?php echo e($buynowproduct->id); ?>)">Remove</a>
									</div>
								</td>
								<td>
									<p class="c-red shipping_name_view_p"><?php echo e($buynowproduct->shipping_first_name); ?> </p>
        							<p class="shipping_address_view_p"><?php echo e($buynowproduct->shipping_city); ?>, <?php echo e($buynowproduct->shipping_state); ?></p>
        							<p class="shipping_mobile_view_p">+91-<?php echo e($buynowproduct->shipping_mobile); ?></p>
								</td>
								<td class="va-mid">
									<p class="c-red right"><i class="fa fa-inr"></i> <?php echo e($buynowproduct->product_selling_price); ?> x <?php echo e($buynowproduct->quantity); ?></p>
								</td>
							</tr>
							<?php endforeach; ?>
					    </table>
					</tr>
				</thead>
				<tbody>
					<td colspan="3" class="apd-30">
						<div class="col-md-12 pt-20" style="border:1px solid #000;">
							<div class="form-group col-md-6">
								<input type="text" name="shipping_name" class="delivery-control" value="<?php echo e($buynow->shipping_first_name); ?>" placeholder="Recipient's Name"/>
							</div>
							<div class="form-group col-md-6">
								<input type="text" name="shipping_email" class="delivery-control" value="<?php echo e($buynow->shipping_email); ?>" placeholder="Recipient's Email ID (Optional)"/>
							</div>
							<div class="form-group col-md-6">
								<input type="text" name="shipping_city" class="delivery-control" value="<?php echo e($buynow->shipping_city); ?>" placeholder="Recipient's City"/>
							</div>
							<div class="form-group col-md-6">
								<input type="text" name="shipping_state" class="delivery-control" value="<?php echo e($buynow->shipping_state); ?>"  placeholder="Recipient's State"/>
							</div>
							<div class="form-group col-md-6">
								<input type="text" name="shipping_address_line_1" class="delivery-control" value="<?php echo e($buynow->shipping_street_address); ?>" placeholder="Recipient's Address line 1"/>
								<small class="right mr-15">Line 1</small>
							</div>
							
							<div class="form-group col-md-6">
								<input type="text" name="shipping_address_line_2" class="delivery-control" placeholder="Recipient's Address line 2"/>
								<small class="right mr-15">Line 2</small>
							</div>
							
							<div class="form-group col-md-6">
								<input type="text" name="shipping_pincode" class="delivery-control" value="<?php echo e($buynow->shipping_pincode); ?>" placeholder="Recipient's Pincode"/>
							</div>
							<div class="form-group col-md-6">
								<input type="text" name="shipping_mobile" class="delivery-control" value="<?php echo e($buynow->shipping_mobile); ?>" placeholder="Recipient's Mobile"/>
							</div>
						</div>					
					</td>
				</tbody>
			</table>
			<?php endif; ?>

			<?php if(Auth::user()): ?>
			<table class="table cart-table2">
				<thead>
					<tr>
						<th class="center">&nbsp;</th>
						<th class="center">To be delivered between <span class="c-red"><?php echo e($delivery_timing); ?>hrs</span> on <span class="c-red"><?php echo e($delivering_on); ?></span></th>
						<th class="center"><a href="javascript:;" class="view-details">View Details</a></th>
					</tr>
					<tr>
					    <table id="viewd">
					        <?php foreach($buy_now_products as $buynowproduct): ?>
					    	<tr>
								<td>
									<div class="img-box">
										<img src="<?php echo e($buynowproduct->image); ?>"/>
									</div>
									<div class="content-box">
										<p><?php echo e($buynowproduct->product_name); ?></p>
										<a href="javascript:;" onclick="removeItem(<?php echo e($buynowproduct->id); ?>)">Remove</a>
									</div>
								</td>
								<td>
									<p class="c-red shipping_name_view_p"><?php echo e($buynowproduct->shipping_first_name); ?> </p>
        							<p class="shipping_address_view_p"><?php echo e($buynowproduct->shipping_city); ?>, <?php echo e($buynowproduct->shipping_state); ?></p>
        							<p class="shipping_mobile_view_p">+91-<?php echo e($buynowproduct->shipping_mobile); ?></p>
								</td>
								<td class="va-mid">
									<p class="c-red right"><i class="fa fa-inr"></i> <?php echo e($buynowproduct->product_selling_price); ?> x <?php echo e($buynowproduct->quantity); ?></p>
								</td>
							</tr>
							<?php endforeach; ?>
					    </table>
					</tr>
				</thead>
				<tbody>
				    <div class="row detailsrow">
				    <tr>
    					<td colspan="3" class="apd-30">
    						<!--<div class="address-box dotted pd-60 center">
    							<p><i class="fa fa-plus"></i></p>
    							<h3>Add New Address</h3>
    						</div>-->
    						<a href="javascript:;" class="addmodal" data-toggle="modal" data-target="#addressmodal">
    							<div class="col-md-3 dotted select-address center mr-15 br-5">
    								<p class="hidden-xs"><i class="fa fa-plus"></i></p>
    								<h3>Add New Address</h3>
    							</div>
    						</a>
    
    						<input type="hidden" name="shipping_name" value="<?php echo e($buynow->shipping_first_name); ?>" class="delivery-control" placeholder="Recipient's Name"/>
    						<input type="hidden" name="shipping_email" value="<?php echo e($buynow->shipping_email); ?>" class="delivery-control" placeholder="Recipient's Email ID (Optional)"/>
    						<input type="hidden" name="shipping_city" value="<?php echo e($buynow->shipping_city); ?>" class="delivery-control" placeholder="Recipient's City"/>
    						<input type="hidden" name="shipping_state" value="<?php echo e($buynow->shipping_state); ?>" class="delivery-control" placeholder="Recipient's State"/>
    						<input type="hidden" name="shipping_address_line_1" value="<?php echo e($buynow->shipping_street_address); ?>" class="delivery-control" placeholder="Recipient's Address line 1"/>
    						<input type="hidden" name="shipping_address_line_2" class="delivery-control" placeholder="Recipient's Address line 2"/>
    						<input type="hidden" name="shipping_pincode" value="<?php echo e($buynow->shipping_pincode); ?>" class="delivery-control" placeholder="Recipient's Pincode"/>
    						<input type="hidden" name="shipping_mobile" value="<?php echo e($buynow->shipping_mobile); ?>" class="delivery-control" placeholder="Recipient's Mobile"/>
    						
    						<?php foreach($addresses as $address): ?>
    						<div class="col-md-3 solid br-5 select-address">
    						 <div id="address<?php echo e($address->id); ?>" class="addresscheck hidden">
    								<a href="javascript:;" class="check-btn"><i class="fa fa-check"></i></a>
    								
    							</div> 
    							<h4><?php echo e($address->name); ?></h4>
    							<p><?php echo e($address->city); ?>, <?php echo e($address->state); ?></p>
    							<p>+91 <?php echo e($address->mobile); ?></p>
    							<br/>
    							<center>
    								<label style="cursor: pointer;" id="label_<?php echo e($address->id); ?>" for="address_<?php echo e($address->id); ?>" class="address">Select Address</label>
    							</center>
    						</div>
    						<input type="radio" style="display: none;" onchange="getAddressSelected(<?php echo e($address->id); ?>)" id="address_<?php echo e($address->id); ?>" name="addressid" value="<?php echo e($address->id); ?>">
    						<?php endforeach; ?>
    					</td>
					</tr>
					</div>
				</tbody>
			</table>
			<?php endif; ?>
			<!--<div class="container">
				<div class="col-md-4">
					<select class="sel-occ" name="occassion">
						<option value="">Select occassion</option>
						<option <?php if($buynow->occassion == 'birthday'): ?> selected <?php endif; ?> value="birthday">Birthday</option>
						<option value="anniversary" <?php if($buynow->occassion == 'anniversary'): ?> selected <?php endif; ?> >Anniversary</option>
					</select>
				</div>
				<div class="col-md-4">
					<h4>&nbsp;</h4>
				</div>
				<div class="col-md-4">
					<label class="c-red" for="message_on_card">Message on Card</label>
					<input type="checkbox" id="message_on_card"/>
					<input type="hidden" name="message" value="message_on_card">
				</div>
			</div>-->
			<div class="row" style="margin:0">
			    <ul style="list-style:none;">
			        <li style="padding:5px 0;">
			            <select class="sel-occ" name="occassion">
						<option value="">Select occassion</option>
						<option <?php if($buynow->occassion == 'birthday'): ?> selected <?php endif; ?> value="birthday">Birthday</option>
						<option value="anniversary" <?php if($buynow->occassion == 'anniversary'): ?> selected <?php endif; ?> >Anniversary</option>
					</select>
			        </li>
			        <li>
			            <label class="c-red" for="message_on_card">Message on Card</label>
    					<input type="checkbox" id="message_on_card"/>
    					<input type="hidden" name="message" value="message_on_card">
			        </li>
			    </ul>
			</div>
		<table class="table cart-table2">
			<thead>
				<th class="center">Sender's Details</th>
			</thead>
			<tbody style="border:1px solid #000;">
				<tr>
					<td style="padding:10px 0;">
						<div class="col-md-3">
							<!-- <h3>Gaurav Sharma</h3> -->
							<input type="text" name="sender_name" value="<?php echo e(strlen($buynow->billing_first_name) ?$buynow->billing_first_name:$sender_name); ?>" class="delivery-control" placeholder="Sender's Name"/> 
						</div>
						<div class="col-md-4">
							<!-- <h3>+91 9582212488</h3> -->
							<input type="text" name="sender_mobile" value="<?php echo e($buynow->billing_mobile); ?>" class="delivery-control" placeholder="Sender's mobile"/>
						</div>
						<div class="col-md-5">
							<!-- <h3>gaurav.sharma0147@gmail.com</h3> -->
							<input type="text" name="sender_email" value="<?php echo e(strlen($buynow->billing_email)? $buynow->billing_email : $sender_email); ?>" class="delivery-control" placeholder="Sender's Email"/>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<br/>
			<center>
				<button class="save-continue" type="submit" title="Save and Continue">Save &amp; Continue</button>
			</center>
		</div>	
	</div>
</div>
<div class="container-fluid bg-f9f9 pd-30">
	<div class="container cart2">
		<div class="col-md-6 col-xs-12">
			<h3><span class="c-red">Need Help?</span> Call us on +91-7838571644</h3>
		</div>
		<div class="col-md-6 col-xs-12">
			<h3 class="pushright"><span class="c-red">4 Million</span>  People Trusted Us</h3>
		</div>
	</div>
</div>	

<?php echo Form::close(); ?>


<?php if(Auth::user()): ?>
<!-- save address modal -->
<div id="addressmodal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<div class="container">
		<?php echo Form::open(array('id' => 'save_address_form')); ?>

			<div class="cart-div2">
				<table class="table cart-table2">
					<thead>
						<tr>
							<th class="center">&nbsp;</th>
							<th class="center">Write Down delivery address</th>
							<th class="center">&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<td colspan="3" class="apd-30">
							<div class="col-md-12">
								<form>
									<div class="form-group mobpd0 col-md-6">
										<input type="text" name="name" class="delivery-control" placeholder="Recipient's Name"/>
									</div>
									<div class="form-group mobpd0 col-md-6">
										<input type="text" name="email" class="delivery-control" placeholder="Recipient's Email ID (Optional)"/>
									</div>
									<div class="form-group mobpd0 col-md-6">
										<input type="text" name="city" class="delivery-control" placeholder="Recipient's City"/>
									</div>
									<div class="form-group mobpd0 col-md-6">
										<input type="text" name="state" class="delivery-control" placeholder="Recipient's State"/>
									</div>
									<div class="form-group mobpd0 col-md-6">
										<input type="text" name="address_line_1" class="delivery-control" placeholder="Recipient's Address line 1"/>
										<small class="right mr-15">Line 1</small>
									</div>
									
									<div class="form-group mobpd0 col-md-6">
										<input type="text" name="address_line_2" class="delivery-control" placeholder="Recipient's Address line 2"/>
										<small class="right mr-15">Line 2</small>
									</div>
									
									<div class="form-group mobpd0 col-md-6">
										<input type="text" name="pincode" class="delivery-control" placeholder="Recipient's Pincode"/>
									</div>
									<div class="form-group mobpd0 col-md-6">
										<input type="text" name="mobile" class="delivery-control" placeholder="Recipient's Mobile"/>
									</div>
								</form>
							</div>					
						</td>
					</tbody>
				</table>
			</div>
			<center><button class="save-continue" type="submit" style="margin-top:10px;" title="Save">Save</button></center>
		<?php echo Form::close(); ?>

		</div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php endif; ?> 

<!-- ends the delivery detail section -->

<!-- order details section start -->
<?php if($buynow->saved_delivery_details == 'yes'): ?>

<?php echo Form::open(array('id' => 'proceed_to_pay_form')); ?>

<input type="hidden" name="checkoutid" value="<?php echo e($buynow->id); ?>">
<div class="container-fluid pd-50">
	<div class="container cart">
	    
	    <ul class="cart-tab">
			<li><a href="#"></a></li>
			<li class="active"><a href="#"></a></li> 
			<li><a href="#"></a></li> 
		</ul>
		<h1>Order Summary</h1>
		<br/>
		<div class="cart-div2">
			<table class="table cart-table2">
				<thead>
					<tr>
						<th class="center">&nbsp;</th>
						<th class="center">To be delivered between <span class="c-red"><?php echo e($delivery_timing); ?>hrs</span> on <span class="c-red"><?php echo e($delivering_on); ?></span></th>
						<th class="center">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($buy_now_products as $buynowproduct): ?>
					<tr>
						<td>
							<div class="img-box">
								<img src="<?php echo e($buynowproduct->image); ?>"/>
							</div>
							<div class="content-box">
								<p><?php echo e($buynowproduct->product_name); ?></p>
								<a href="javascript:;" onclick="removeItem(<?php echo e($buynowproduct->id); ?>)">Remove</a>
							</div>
						</td>
						<td class="address-table valignmiddle">
							<p class="c-red"><?php echo e($buynowproduct->shipping_first_name); ?> </p>
							<p><?php echo e($buynowproduct->shipping_city); ?>, <?php echo e($buynowproduct->shipping_state); ?></p>
							<p>+91-<?php echo e($buynowproduct->shipping_mobile); ?></p>
						</td>
						<td class="va-mid">
							<p class="c-red <?php echo e(count($add_more_love_products[$buynowproduct->id]) ? '' : 'right'); ?>"><i class="fa fa-inr"></i> <?php echo e($buynowproduct->product_selling_price); ?> x <?php echo e($buynowproduct->quantity); ?></p>
							<?php foreach($add_more_love_products[$buynowproduct->id] as $addmoreproduct): ?>
							<p class="c-red"> + <?php echo e($addmoreproduct->name); ?> <i class="fa fa-inr"></i> <?php echo e($addmoreproduct->price); ?></p>
							<?php endforeach; ?>
							
							<?php if(isset($varientname[$buynowproduct->id])): ?>
							<p class="c-red">&nbsp;</p></p>
							<p class="c-red right"> + <?php echo e($varientname[$buynowproduct->id]->value); ?>  &nbsp;<i class="fa fa-inr"></i> <?php echo e($varientPrice[$buynowproduct->id]); ?></p>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
					<tr>
						<td colspan="2"></td>
						<td class="bdtop right" width="100%">
							<p>Sub Total <span class="c-red"><i class="fa fa-inr"></i> <?php echo e($subtotal); ?></span></p>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<p>Have a Coupon Code&#47;Card Number to redeem&#63; <a href="#" class="c-red" style="text-decoration:none;">Click Here</a></p>
						</td>
						<td class="bdtop right" width="100%">
							<p>Shipping Charges <span class="c-red"><i class="fa fa-inr"></i> <?php echo e($shipping_charge); ?></span></p>
						</td>
					</tr>
					
					<tr>
						<td colspan="2">
						</td>
						<td class="bdtop right" width="100%">
							<p>Total <span class="c-red"><i class="fa fa-inr"></i> <?php echo e($subtotal + $shipping_charge); ?></span></p>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="vertical-align:middle;"><input type="checkbox" name="term_conditions" class="pos-ab" id="i_agree"/><label class="ml-20 lightweight" for="i_agree">I agree to the Terms &amp; Conditions&#47;Disclaimer&#47;Terms of use</label></td>
						<td class="width-30 text-right">
							<a href="javascript:;" id="back_to_delivery_detail" class="con-shop hidden-xs" title="Back">Back</a>
							<button type="submit" class="con-shop hidden-xs" title="Proceed to Pay">Proceed to Pay</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="pull-right hidden-md hidden-sm hidden-lg">
    		<ul class="cart-list2">
    			<li><a href="javascript:;" id="back_to_delivery_detail" class="con-shop" title="Back">Back</a></li>
    			<li><button type="submit" class="con-shop" title="Proceed to Pay">Proceed to Pay</a></li>
    		</ul>
		</div>
	</div>
</div>
<?php echo Form::close(); ?>

<?php endif; ?>
<!-- order details section ends -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>