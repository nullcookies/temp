<?php $__env->startSection('js'); ?>

<script src="<?php echo e(asset('massengers/js/datepicker.js')); ?>"></script>

<script>
var date = new Date();
date.setDate(date.getDate());

$('#calendar').datepicker({ 
    startDate: date
});


$(document).ready(function(){
	$("input[name='selectedDate'").change(function(event){
		Date.prototype.getMonthText = function() {
		  var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		  return months[this.getMonth()];
		}

		Date.prototype.getDayText = function() {
		  var days = ['Sun', 'Mon', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
		  return days[this.getDay()];
		}
		var date = new Date($(this).val());
		$('#deliverydateofmonth').html(date.getDate());
		$('#deliverymonth').html(date.getMonthText());
		$('#deliveryweekday').html(date.getDayText());
	});
});

function checkcorrectdate(captured){
	var date = new Date();
	date.setDate(date.getDate());
	if(new Date(date) <= new Date(captured)){
	    return true;
	}else{
		swal('Incorrect Date Choosen','Please Choose a Correct Date','error');
		return false;
	}
}


$(document).ready(function(){
	$("input[name='shippingtime']").on('change', function(event){
		var inputval = $(this).val();
		var timeslottitle = '';
		var error = true;
		if(inputval == 'standard_delivery'){
			timeslottitle = 'Standard Delivery - Free';
			error = false;
		}else if(inputval == 'fixtime_delivery'){
			timeslottitle = 'Fixtime Delivery - Rs 200';
			error = false;
		}else if(inputval == 'mid_night_delivery'){
			timeslottitle = 'Mid Night Delivery - Rs 200'
			error = false;
		}

		if(!error){
			$('.timeslottitle').html(timeslottitle);
			$('#shippingmethod').html(timeslottitle);
			$('#carousel-example-generic').carousel('next');
		}else{
			swal('Incorrect Delivery Option','Please Select a correct delivery option','error');
		}

	});
});

$(document).ready(function(){
	$("input[name='delivery_option']").on('change', function(event){
		var inputval = $(this).val();
		var timeslottitle = '';
		var error = true;
		if(inputval == '12_15'){
			timeslottitle = "12:00 - 15:00 hrs";
			error = false;
		}else if(inputval == '15_18'){
			timeslottitle = "15:00 - 18:00 hrs"
			error = false;
		}else if(inputval == '18_21'){
			timeslottitle = "18:00 - 21:00 hrs"
			error = false;
		}

		if(!error){
			$('#timeslot').html(timeslottitle);
			$('#deliveryoptionmodal').modal('hide');

		}else{
			swal('Incorrect Delivery Option','Please Select a correct delivery option','error');
		}
	});	
});

// for form submit
$(document).ready(function(){
	$('#product_detail_submit_form').on('submit', function(event){
		event.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			url: "<?php echo e(url('/validatebeforecheckout')); ?>",
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
				if(result['message']){
					window.location.href = "<?php echo e(url('/product/checkout')); ?>/"+result['buynow'];
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

// add to cart

$(document).ready(function(){
	$('#add_to_cart_btn').on('click', function(event){
		swal({
		  title: "Input Desired Quantity",
		  type: "input",
		  showCancelButton: true,
		  closeOnConfirm: false,
		  inputPlaceholder: "input desired quantity",
		}, 
		function(quantity){
			var productid = $("input[name='productid']").val();
			var category  = $("input[name='category']").val();
			var auth      = $("input[name='auth']").val();
			var delivery_date =  $("input[name='selectedDate']").val();
			var shippingtime = $("input[name='shippingtime']").val();
			var delivery_option = $("input[name='delivery_option']").val();
			$.ajax({
				url: "<?php echo e(url('/add_to_cart')); ?>",
				type: 'POST',
				dataType: 'json',
				data: {productid:productid,category:category, auth:auth,quantity:quantity,selectedDate:delivery_date, shippingtime:shippingtime, delivery_option:delivery_option},
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
						swal('product added to cart successfully','','success');
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
});

</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form id="product_detail_submit_form">
<?php echo e(csrf_field()); ?>

<input type="hidden" name="auth" value="<?php echo e(Auth::user() ? 'yes' : 'no'); ?>" >
<div class="container-fluid pd-50">
	<div class="container">
		<ol class="breadcrumb ms-breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
		  <?php foreach($breadCrumbCategories as $breadCrumbCategory): ?>
			<li class="breadcrumb-item"><a href="<?php echo e(url('/category/'.$breadCrumbCategory['alias'])); ?>"><?php echo e($breadCrumbCategory['category_name']); ?></a></li>
		  <?php endforeach; ?>
		</ol>
	</div>
</div>

<div class="container-fluid">
	<div class="container">
		<div class="col-md-4" style="overflow:hidden;">
			<img width="300" src="<?php echo e($defaultImage); ?>"/>
		</div>
		<div class="col-md-5">
			<div class="col-md-6">
				<h4><?php echo e($product->product_name); ?></h4>
				<p>SKU : <?php echo e($product->sku); ?></p>
			</div>
			<div class="col-md-6 views">
				<span style="padding:0 10px; font-size:16px;"><i class="fa fa-eye"></i> 24,594</span>
				<span style="padding:0 10px; font-size:16px;"><i class="fa fa-gift"></i> 18,931</span>
			</div>
			<div class="col-md-12">
			<ul class="nav nav-tabs product-desc">
				<li class="active"><a data-toggle="tab" href="#description">Description</a></li>
				<li><a data-toggle="tab" href="#delivery">Delivery Information</a></li>
			</ul>

			<div class="tab-content pd-20">
				<div id="description" class="tab-pane fade in active">
				  <?php echo $product->product_description; ?>

				</div>
				<div id="delivery" class="tab-pane fade">
					<p>Usually delivered in 3-4 days. Enter pincode for exact delivery dates/charges</p>
				</div>
			</div>
			<?php foreach($varientTypes as $varientType): ?>
			<div class="row">
				<h3 style="margin-left:15px;">Add some more love</h3>
				<?php foreach($varientValues[$varientType->varient_type_id] as $varient): ?>
				<div class="col-md-3 col-xs-4 text-center">
					<label for="varient<?php echo e($varient->id); ?>"><img width="70" src="<?php echo e($defaultImage); ?>"/>
					<h5><?php echo e($varient->value); ?></h5></label>
					<input id="varient<?php echo e($varient->id); ?>" type="radio" name="varients" value="<?php echo e($varient->id); ?>">
					<h4><i class="fa fa-inr"></i> <?php echo e(App\Http\Controllers\Massengers\Product\ProductController::getVarientPrice($product->id,$varient->id, $product->product_selling_price)); ?></h4>
				</div>
				<?php endforeach; ?>
			</div>
			<?php endforeach; ?>
			
			<?php if($product->love_letter_options == 'yes'): ?>
			<div class="row pd-20">
				

			<div class="form-group col-md-12">
					<label class="col-md-4">Check Image <span class="c-red">*</span></label>
					<input type="file" class="col-md-8" />
				</div>
				<div class="form-group col-md-6">
					<label class="col-md-8">Paper Colour <span class="c-red">*</span></label>
					<input type="text" class="form-control col-md-4"/>
				</div>
				<div class="form-group col-md-6">
					<label class="col-md-8">Ink Colour <span class="c-red">*</span></label>
					<input type="text" class="form-control col-md-4"/>
				</div>
				<div class="form-group col-md-12">
					<label class="col-md-6">Receipent's Name <span class="c-red">*</span></label>
					<input type="text" class="form-control col-md-8" />
				</div>
				<div class="form-group col-md-12">
					<label class="col-md-6">Receipent's Name <span class="c-red">*</span></label>
					<textarea class="form-control" rows="4" maxlength="150" style="resize:none;"></textarea>
					<small>Maximum number of character: 150</small>
				</div>
			</div>
			<?php endif; ?>
			
			<ul class="service-detail">
					<li>
						<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
						<p>Trusted Company</p>
					</li>
					<li>
						<img src="<?php echo e(asset('massengers/img/truck.png')); ?>">
						<p>Free Shipping</p>
					</li>
					<li>
						<img src="<?php echo e(asset('massengers/img/pay.png')); ?>">
						<p>Secure payment</p>
					</li>
				</ul>
			</div>
			</div>
		<div class="col-md-3 text-center price-section">
			<h2><i class="fa fa-inr"></i> <?php echo e($product->product_selling_price); ?></h2>
				<input type="hidden" name="productid" value="<?php echo e($product->id); ?>">
				<input type="hidden" name="category" value="<?php echo e($cat_alias); ?>">
				<input type="hidden" name="varients" value="selected_varients">
				<input type="number" min="1" value="1" class="delivery-control" name="quantity"  placeholder="Enter required quantity" style="display:none;"/><br />				
				<input type="text" name="pincode" value="251001" class="delivery-control" placeholder="*Enter Delivery Pincode"/>
				<small class="right"><a href="#" class="dont-know">Don't Know Pincode ?</a></small>
				<br/><br/>
				<input type="text" class="delivery-control" value="muzaffarnagar" name="delivery_city" placeholder="*Enter Your City"/>
				<br/>
				<div class="inputdiv">
					<a href="javascript:void(0);" data-toggle="modal" data-target=".bs-example-modal-lg" id="datetimelink" class="activeinput" title="You can select date and time of delivery after providing valid pincode">* When ?</a>
				</div>
				<div id="datetimeshipping" data-toggle="modal" data-target=".bs-example-modal-lg" style="display: hidden;">
					<span id="deliverydateofmonth"></span>
					<span id="deliverymonth"></span>
					<span id="deliveryweekday"></span>
					<span id="shippingmethod"></span>
					<span id="timeslot"></span>
				</div>
				<br/>
				<button type="submit" class="buy-now-btn"><img src="<?php echo e(asset('massengers/img/card-new.png')); ?>" width="16"> Buy Now</button>
				<a href="javascript:;" id="add_to_cart_btn" class="price-btn"><img src="<?php echo e(asset('massengers/img/cart-new.png')); ?>" width="16"> Add to Cart</a>
			<br/>
			<span style="font-size:48px">3:40</span><h4>Hours left for today's delivery</h4>
			<br/>
		</div>
	</div>
</div>

<?php if(count($products)): ?>
<div class="container-fluid pd-50">
	<div class="container">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#youmight">You Might Also Like</a></li>
		</ul>
		<div class="tab-content youmight">
			<div id="youmight" class="tab-pane fade in active">
			<?php foreach($products as $sameproduct): ?>
				<div class="col-md-3 text-center">
					<a href="<?php echo e(url('category/'.$cat_alias.'/product/'.$sameproduct->id)); ?>"><img src="<?php echo e($productImage[$sameproduct->id]); ?>"/></a>
					<h5><a href="<?php echo e(url('category/'.$cat_alias.'/product/'.$sameproduct->id)); ?>"><?php echo e($sameproduct->product_name); ?></a></h5>
					<h4 class="c-red"><i class="fa fa-inr"></i> <?php echo e($sameproduct->product_selling_price); ?></h4>
				</div>
			<?php endforeach; ?>	
			</div>
		</div>
	</div>
</div>
<?php endif; ?>	

<!-- combo section -->


<div class="container-fluid pd-50">
	<div class="container">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#combo-1">Combo 1</a></li>
			<li><a data-toggle="tab" href="#combo-2">Combo 2</a></li>
			<li><a data-toggle="tab" href="#combo-3">Combo 3</a></li>
		</ul>

		<div class="tab-content youmight">
			<div id="combo-1" class="tab-pane fade in active">
				<div class="col-md-3 text-center">
					<img width="200" src="<?php echo e($defaultImage); ?>"/>
					<h5><?php echo e($product->product_name); ?></h5>
					<h4 class="c-red"><i class="fa fa-inr"></i> <?php echo e($product->product_selling_price); ?></h4>
				</div>
				<div class="col-md-1 text-center pd-90">
					<i class="fa fa-plus c-red">
					</i>
				</div>
				<div class="col-md-3 text-center">
					<img src="<?php echo e(url('massengers/img/cake1.png')); ?>"/>
					<h5>Vanilla Fruit Cake &amp; Raspberry Fruit Wine</h5>
					<h4 class="c-red"><i class="fa fa-inr"></i> 1399</h4>
				</div>
				<div class="col-md-3 text-center pd-90">
				<a href="#" class="buy-now-btn"><i class="fa fa-credit-card"></i> Buy Now</a>
				<br/><br/>
				<p><i class="fa fa-inr"></i> 2199</p>
				</div>
			</div>
			<div id="combo-2" class="tab-pane fade">
				<div class="col-md-3 text-center">
					<img width="200" src="<?php echo e($defaultImage); ?>"/>
					<h5><?php echo e($product->product_name); ?></h5>
					<h4 class="c-red"><i class="fa fa-inr"></i> <?php echo e($product->product_selling_price); ?></h4>
				</div>
				<div class="col-md-1 text-center pd-90">
					<i class="fa fa-plus c-red">
					</i>
				</div>
				<div class="col-md-3 text-center">
					<img src="<?php echo e(url('massengers/img/cake1.png')); ?>"/>
					<h5>Vanilla Fruit Cake &amp; Raspberry Fruit Wine</h5>
					<h4 class="c-red"><i class="fa fa-inr"></i> 1399</h4>
				</div>
				<div class="col-md-3 text-center pd-90">
				<a href="#" class="buy-now-btn"><i class="fa fa-credit-card"></i> Buy Now</a>
				<br/><br/>
				<p><i class="fa fa-inr"></i> 2199</p>
				</div>
			</div>
			<div id="combo-3" class="tab-pane fade">
				<div class="col-md-3 text-center">
					<img width="200" src="<?php echo e($defaultImage); ?>"/>
					<h5><?php echo e($product->product_name); ?></h5>
					<h4 class="c-red"><i class="fa fa-inr"></i> <?php echo e($product->product_selling_price); ?></h4>
				</div>
				<div class="col-md-1 text-center pd-90">
					<i class="fa fa-plus c-red">
					</i>
				</div>
				<div class="col-md-3 text-center">
					<img src="<?php echo e(url('massengers/img/cake1.png')); ?>"/>
					<h5>Vanilla Fruit Cake &amp; Raspberry Fruit Wine</h5>
					<h4 class="c-red"><i class="fa fa-inr"></i> 1399</h4>
				</div>
				<div class="col-md-3 text-center pd-90">
				<a href="#" class="buy-now-btn"><i class="fa fa-credit-card"></i> Buy Now</a>
				<br/><br/>
				<p><i class="fa fa-inr"></i> 2199</p>
				</div>
			</div>
		</div>
	</div>
</div>	



<!-- combo section ends -->

<input type="hidden" name="selectedDate">
<div class="modal fade bs-example-modal-lg" id="deliveryoptionmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="width:38em;margin:0 auto;">
	<div class="modal-header">
		<!-- <a class="left" href="#carousel-example-generic" role="button" data-slide="prev" style="float:left; margin-top:5px;">
			<span class="glyphicon glyphicon-chevron-left"></span>
		</a>
		<a class="right" href="#carousel-example-generic" role="button" data-slide="next" style="float:right; margin-top:5px;">
			<span class="glyphicon glyphicon-chevron-right"></span>
		</a> -->
		<h4 class="modal-title" id="head-content">Select Delivery Option</h4>
	</div>
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
		<!-- Wrapper for slides -->
		  <div class="carousel-inner">
			<div class="item active">
				<div class="app">
					<div class="app__main">
						<div class="calendar">
							<div id="calendar"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="item">
				<div id="shippingmethoddiv">
					<div class="scroll-pane">
						<ul>
							<li>
								<a data-shippingmethod="EXPRESS_DELIVERY" class="timeslotdetails" data-ga-title="Standard Delivery" tabindex="0">
									<input type="radio" value="standard_delivery" class="input-group-field applycoupon shippingtime" name="shippingtime" id="EXPRESS_DELIVERY" tabindex="0">
									<label for="EXPRESS_DELIVERY">
									<span class="rdo-span"></span>
									<span class="timesloter">Standard Delivery</span>
									</label>
									<div class="input-group-button button del-method-btn">
										<span class="delcost">Free</span>
									</div>
								</a>
							</li>
							<li>
								<a data-shippingmethod="FIXTIME_DELIVERY" class="timeslotdetails" data-ga-title="Fixed Time Delivery" tabindex="0">
								<input type="radio" value="fixtime_delivery" class="input-group-field applycoupon shippingtime" name="shippingtime" id="FIXTIME_DELIVERY" tabindex="0">
								<label for="FIXTIME_DELIVERY">
								<span class="rdo-span"></span>
								<span class="timesloter"> Fixed Time Delivery </span>
								</label>
								<div class="input-group-button button del-method-btn">
								<span class="delcost webprice">
									<span class="WebRupee"><i class="fa fa-inr"></i></span> 200</span>
								</div>
								</a>
							</li>
							<li>
								<a class="timeslotdetails" tabindex="0">
								<input type="radio" value="mid_night_delivery" class="input-group-field applycoupon shippingtime" name="shippingtime" id="MIDNIGHT_DELIVERY" tabindex="0" >
								<label for="MIDNIGHT_DELIVERY">
									<span class="rdo-span"></span>
									<span class="timesloter">Mid Night Delivery </span>
								</label>
								<div class="input-group-button button del-method-btn">
									<span class="delcost webprice">
									<span class="WebRupee"><i class="fa fa-inr"></i></span> 200</span>
								</div>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			 <div class="item">
			  <div id="timeslotDiv">
					<div class="row">
						<div class="tabs-panel time-slot">
							<div style="display:none;" class="shippingMethodName">Standard Delivery</div>
							<div style="display:none;" class="shippingMethodId">EXPRESS_DELIVERY</div>
							<div class="scroll-pane" data-ga-category="SelectDate &amp; Timeslot_Standard Delivery">
								<ul>
									<li><span class="timeslottitle">Standard Delivery - Free</span>
										<ul class="slot">
											<li class="timeslottable">
												<a href="javascript:void(0);" data-ga-title="12:00 - 15:00 hrs" tabindex="0" >
													<input type="radio" value="12_15" class="input-group-field " name="delivery_option" id="EXPRESS_DELIVERY-10020" tabindex="0">
													<label for="EXPRESS_DELIVERY-10020">
													<span class="rdo-span"></span>
													<span class="timeSlotId" style="display:none;">10020</span>
													<span class="timerange">12:00 - 15:00</span>&nbsp;<span class="hrs"> hrs</span>
													<span class="priceblock" style="display:none;"><span class="timeslotprice">Free</span>
													</span>
													</label>
												</a>
											</li>
											<li class="timeslottable">
												<a href="javascript:void(0);" data-ga-title="15:00 - 18:00 hrs" tabindex="0">
													<input type="radio" value="15_18" class="input-group-field " name="delivery_option" id="EXPRESS_DELIVERY-10045" tabindex="0">
													<label for="EXPRESS_DELIVERY-10045">
													<span class="rdo-span"></span>
													<span class="timeSlotId" style="display:none;">10045</span>
													<span class="timerange">15:00 - 18:00</span>&nbsp;<span class="hrs"> hrs</span><span class="priceblock" style="display:none;"><span class="timeslotprice">Free</span></span>
													</label>
												</a>
											</li>
											<li class="timeslottable">
												<a href="javascript:void(0);" data-ga-title="18:00 - 21:00 hrs" tabindex="0">
													<input type="radio" value="18_21" class="input-group-field " name="delivery_option" id="EXPRESS_DELIVERY-10021" tabindex="0">
													<label for="EXPRESS_DELIVERY-10021">
													<span class="rdo-span"></span>
													<span class="timeSlotId" style="display:none;">10021</span>
													<span class="timerange">18:00 - 21:00</span>&nbsp;<span class="hrs"> hrs</span>
													<span class="priceblock" style="display:none;">
													<span class="timeslotprice">Free</span></span>
													</label>
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		  </div>
		</div>
		<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>