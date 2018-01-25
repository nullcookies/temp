<?php $__env->startSection('css'); ?>
<style>
    html{
        overflow-x:hidden;
    }
</style>    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>
<meta name="description" content="<?php echo $product->meta_description; ?>">
<meta name="keywords" content="<?php echo $product->meta_keywords; ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <?php echo $product->meta_title; ?> -
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script src="<?php echo e(asset('massengers/js/datepicker.js')); ?>"></script>
<script src="<?php echo e(asset('massengers/js/jquery.zoom.js')); ?>"></script>
<!-- latest -->

<script type="text/javascript">
	
	function showdeliveryoptions(deliveryoptions){
		$.ajax({
			url: "<?php echo e(url('/fetchdeliveryoptions')); ?>",
			type: 'GET',
			data: {deliveryoptions:deliveryoptions},
			dataType: 'html',
			beforeSend: function(){
			    /*$('#shippingmethoddiv').html('Please wait loading data..');*/
			},
			success: function(result){
				$('#shippingmethoddiv').html(result);
			},
			error: function(data){

			}
		});
	}

	function getcalender(deliveryoption){
		$.ajax({
			url: "<?php echo e(url('/fetchdeliverycalender')); ?>",
			type: 'GET',
			data: {deliveryoption:deliveryoption},
			dataType: 'html',
			beforeSend: function(){
			    /*$('#calenderdiv').html('Please wait loading data..');*/
			},
			success: function(result){
				$('#calenderdiv').html(result);
				$('#carousel-example-generic').carousel('next');
			},
			error: function(data){

			}
		});
		//calenderdiv
	}
	$(document).ready(function(){
	    $("input[name='selectedDate'").on('change', function(){
    	    gettimings($("input[name='selectedDate'").val());
    	});
	});
	
	function gettimings(date){
	    var deliveryoption = $("input[name='shippingtime']:checked").val();
	    $.ajax({
			url: "<?php echo e(url('/fetchdeliverytimings')); ?>",
			type: 'GET',
			data: {deliveryoption:deliveryoption, date:date},
			dataType: 'html',
			beforeSend: function(){
			    $('#timeslotDiv').html('');
			},
			success: function(result){
				$('#timeslotDiv').html(result);
			},
			error: function(data){

			}
		});
	}
</script>

<!-- latest -->






<script type="text/javascript">
	$(".dont-know").click(function(){
    $(".findyourpincode").fadeToggle();
});

$('input[name="find_pincode"]').focusout(function(){
    $(".findyourpincode").fadeToggle();
    $('input[name="find_pincode"]').val('');
});
</script>
<script>
    // Set the date we're counting down to
var counterTimedate = "<?php echo e($timer); ?>";
var countDownDate = new Date(''+counterTimedate+'').getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id of days, minutes, hours, seconds

    /*document.getElementById("timer-days").innerHTML = days;*/
    document.getElementById("timeslothours").innerHTML = hours;
    document.getElementById("timeslotminutes").innerHTML = minutes;
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        /*document.getElementById("timer-days").innerHTML = "0";*/
        document.getElementById("timeslothours").innerHTML = "00";
        document.getElementById("timeslotminutes").innerHTML = "00";
    }
}, 1000);
</script>

<script>

/*var date = new Date();
date.setDate(date.getDate());

$('#calendar').datepicker({ 
    startDate: date
});*/

$(document).ready(function(){
   //cover photo
	$('#cover_photo').on('change', function(event){
		event.preventDefault();
		var file_data = $(this).prop('files')[0];   
	    var form_data = new FormData();                  
	    form_data.append('photo', file_data);
		$.ajax({
			url: "<?php echo e(url('/uploadcheckoutproductimage')); ?>",
			type: 'POST',
			data: form_data,
			dataType: 'html',
			cache: false,
			processData: false,
	        contentType: false,
	        dataType: 'json',
	        xhr: function()
			  {
			    var xhr = new window.XMLHttpRequest();
			    //Upload progress
			    xhr.upload.addEventListener("progress", function(evt){
			      if (evt.lengthComputable) {
			        var percentComplete = (evt.loaded / evt.total)*100;
			        //Do something with upload progress
			        //swal(''+percentComplete+'% Uploaded','','success');
			      }
			    }, false);
			    //Download progress
			    xhr.addEventListener("progress", function(evt){
			      if (evt.lengthComputable) {
			        var percentComplete = (evt.loaded / evt.total)*100;
			        //Do something with download progress
			        //swal(percentComplete,' Uploaded','success');
			      }
			    }, false);
			    return xhr;
			  },
	        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	        beforeSend: function(){
	            $('#uploadcoverspan').html('<i class="fa fa-circle-o-notch spin" aria-hidden="true" style="color:#d800003" ></i>');
	        },
	        success: function(result){

	        	if(result['success']){
	        		$("input[name='cover_photo']").val(result['file_url']);
	        	}

	        	$('#uploadcoverspan').html('<i class="fa fa-check" aria-hidden="true" ></i>');
	        }, 
	        error: function(data, xhr){
	        	var errors = data.responseJSON;
	        	swal(errors['photo'][0],'','warning');
	        }
		});

	}); 
});


function fetchcartcount(){
    $.ajax({
		url: "<?php echo e(url('/cartcount')); ?>",
		type: 'GET',
		dataType: 'json',
		success: function(result){
			$('#cart_count_span').html(result['count']);
		},
	});
}


function findpincodes(text){
    //alert(text);
    $.ajax({
		url: "<?php echo e(url('/suggestpincode')); ?>",
		type: 'GET',
		data: {str:text},
		dataType: 'html',
		success: function(result){
			$('#dont_know_pincode').html(result);
		},
	});
}

function setpincode(pincode, city){
    $('input[name="pincode"]').val(pincode);
    $('input[name="delivery_city"]').val(city);
}

$(document).ready(function(){
	$("input[name='selectedDate'").change(function(event){
		Date.prototype.getMonthText = function() {
		  var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
		  return months[this.getMonth()];
		}

		Date.prototype.getDayText = function() {
		  var days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat','Sun'];
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
	date.setDate(date.getDate()-1);
	if(new Date(date) <= new Date(captured)){
	    return true;
	}else{
		swal('Incorrect Date Choosen','Please Choose a Correct Date','error');
		return false;
	}
}

function updateDeliveryOptions(alias){
	$('#carousel-example-generic').carousel('next');
}

$(document).ready(function(){
	$("input[name='shippingtime']").on('change', function(event){
		var inputval = $("input[name='shippingtime']:checked").val();
		var timeslottitle = '';
		var error = true;
		if(inputval == 'standard_delivery'){
			timeslottitle = 'Standard Delivery - Free';
			error = false;
		}else if(inputval == 'fix_time_delivery'){
			timeslottitle = 'Fixtime Delivery - Rs 150';
			error = false;
		}else if(inputval == 'mid_night_delivery'){
			timeslottitle = 'Mid Night Delivery - Rs 150'
			error = false;
		}

		if(!error){
			$('.timeslottitle').html(timeslottitle);
			$('#shippingmethod').html(timeslottitle);
			/*if(inputval == 'standard_delivery'){
				var date = new Date();
				$("input[name='selectedDate'").val(date.getFullYear()+'-'+date.getMonth()+'-'+date.getDay()).trigger('change');
				$('#timeslot').html("15:00 - 18:00 hrs");
				$("input[name=delivery_option]").prop("checked",true);
				$('#deliveryoptionmodal').modal('hide');
			}else{
				
			}*/
			
			if(inputval == 'standard_delivery'){
			    $('.'+inputval+'_class').removeClass('hidden');
			    $('.fix_time_delivery_class').addClass('hidden');
			    $('.mid_night_delivery_class').addClass('hidden');
			}
			
			if(inputval == 'fix_time_delivery'){
			    $('.'+inputval+'_class').addClass('hidden');
			    $('.fix_time_delivery_class').removeClass('hidden');
			    $('.mid_night_delivery_class').addClass('hidden');
			}
			
			if(inputval == 'mid_night_delivery'){
			    $('.'+inputval+'_class').addClass('hidden');
			    $('.fix_time_delivery_class').addClass('hidden');
			    $('.mid_night_delivery_class').removeClass('hidden');
			}
			
			updateDeliveryOptions(inputval);
			
		}else{
			swal('Incorrect Delivery Option','Please Select a correct delivery option','error');
		}

	});
});

$(document).ready(function(){
	$("input[name='delivery_option']").on('change', function(event){
		var inputval = $(this).val();
		var timeslottitle = '';
		var error = false;

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

function addtocart(productid, productid2){
			var category  = $("input[name='category']").val();
			var auth      = $("input[name='auth']").val();
			var delivery_date =  $("input[name='selectedDate']").val();
			var shippingtime = $("input[name='shippingtime']").val();
			var delivery_option = $("input[name='delivery_option']").val();
			var quantity = $("input[name='quantity']").val();
	    $.ajax({
				url: "<?php echo e(url('/add_to_cart')); ?>",
				type: 'POST',
				dataType: 'json',
				data: {productid:productid,category:category,quantity:quantity,selectedDate:delivery_date, shippingtime:shippingtime, delivery_option:delivery_option},
				beforeSend: function(){
					/*swal({
					  title: 'Processing..',
					  text: 'please do not referesh the page',
					  showCancelButton: false,
					  showConfirmButton: false
					});*/
				},
				success: function(result){
					if(result['message']){
					    fetchcartcount();
						//window.location.href = "<?php echo e(url('/cart')); ?>";
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

					/*swal(errorsHtml, '', 'error');*/
				}
			});
			
			$.ajax({
				url: "<?php echo e(url('/add_to_cart')); ?>",
				type: 'POST',
				dataType: 'json',
				data: {productid:productid2,category:category,quantity:quantity,selectedDate:delivery_date, shippingtime:shippingtime, delivery_option:delivery_option},
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
					    fetchcartcount();
						window.location.href = "<?php echo e(url('/cart')); ?>";
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


$(document).ready(function(){
	$('#add_to_cart_btn').on('click', function(event){
	    var productid = $("input[name='productid']").val();
			var category  = $("input[name='category']").val();
			var auth      = $("input[name='auth']").val();
			var delivery_date =  $("input[name='selectedDate']").val();
			var shippingtime = $("input[name='shippingtime']").val();
			var delivery_option = $("input[name='delivery_option']").val();
			var quantity = $("input[name='quantity']").val();
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
					    fetchcartcount();
					    
					    swal({
    					  title: '',
    					  text: 'Product Added To Cart Successfully.',
    					  timer: 2000,
    					  className: "success",
    					  showCancelButton: false,
    					  showConfirmButton: false
    					});
						//swal('product added to cart successfully','','success');
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
		/*swal({
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
		});*/
	});
});

// varient shadow


function addtocartandredirect(){
    var productid = $("input[name='productid']").val();
			var category  = $("input[name='category']").val();
			var auth      = $("input[name='auth']").val();
			var delivery_date =  $("input[name='selectedDate']").val();
			var shippingtime = $("input[name='shippingtime']").val();
			var delivery_option = $("input[name='delivery_option']").val();
			var quantity = $("input[name='quantity']").val();
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
}


function getVarientSelected(varientid, price){
    $('.varientlabel').removeClass('dropitshadow');
    $('#varientlabel'+varientid).addClass('dropitshadow');
    $("#productpricespan").html(price);
}


// pincode

function fetchpincode(pincode){
if(pincode.length >5){
  $.ajax({
      url: "<?php echo e(url('/fetchpincode')); ?>",
      type: 'get',
      data: {pincode:pincode},
      dataType: 'json',
      beforeSend: function(){
          
      },
      success: function(data){
          $("input[name='delivery_city']").val(data['city']);
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
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form id="product_detail_submit_form">
<?php echo e(csrf_field()); ?>

<input type="hidden" name="auth" value="<?php echo e(Auth::user() ? 'yes' : 'no'); ?>" >
<div class="container-fluid mobpd10 pd-30">
	<div class="container">
		<ol class="breadcrumb ms-breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
		  <?php foreach($breadCrumbCategories as $key => $breadCrumbCategory): ?>
			<li class="breadcrumb-item <?php if($key+1 == sizeof($breadCrumbCategories)): ?> active <?php endif; ?>"><a href="<?php echo e(url('/category/'.$breadCrumbCategory['alias'])); ?>"><?php echo e($breadCrumbCategory['category_name']); ?></a></li>
		  <?php endforeach; ?>
		</ol>
	</div>
</div>

<div class="container-fluid">
	<div class="container">
	    <div class="col-md-9 pdres-0">
	        <div class="row">
        		<div class="col-md-5 pd-0 col-sm-4 product-main-image "  >
        			<div class=" zoom" id="hoverimage" style="overflow:hidden;" >
        			    <img src="<?php echo e($defaultImage); ?>" class="center-block"/>
        			</div>
        			
        			<ul class="add-more add-more-for-pen">
        			    <?php foreach($add_some_more_love as $key => $add_more_love): ?>
        				<li>
        					<input type="checkbox" name="add_more_love[]" value="<?php echo e($add_more_love->id); ?>" id="for_teddy<?php echo e($add_more_love->id); ?>"/>
        					<label for="for_teddy<?php echo e($add_more_love->id); ?>">
        					<img src="<?php echo e(asset('massengers/img/'.$add_more_love->image_url)); ?>" width="62"/>
        					<h6><?php echo $add_more_love->name; ?></h6>
        					<p><i class="fa fa-inr"></i> <?php echo e($add_more_love->price); ?></p>
        					</label>
        				</li>
        				<?php endforeach; ?>
			        </ul>
        		</div>
        		<div class="col-md-7 col-sm-8 pdres-0 roboto-light">
        			<div class="row product-title-row">
            			<div class="col-md-8 product-main-title">
            				<h3 class="mt-0 product-title"><?php echo e($product->product_name); ?></h3>
            				<p>SKU : <?php echo e($product->sku); ?></p>
            			</div>
            			<div class="col-md-4 views">
            				<span style="padding:0px; font-size:14px;padding-right:15px;"><i class="fa fa-eye"></i> 24,594</span>
            				<span style="padding:0px; font-size:14px;"><i class="fa fa-gift"></i> 18,931</span>
            			</div>
        			</div>
        			<div class="col-md-12 pd-0">
        			<ul class="nav nav-tabs product-desc">
        				<li class="active"><a data-toggle="tab" href="#description">Description</a></li>
        				<li><a data-toggle="tab" href="#delivery">Delivery Information</a></li>
        			</ul>
        
        			<div class="tab-content pd-20">
        				<div id="description" class="tab-pane fade in active">
        				  <p><?php echo $product->product_description; ?></p>
        				</div>
        				<div id="delivery" class="tab-pane fade">
        					<p>Usually delivered in 3-4 days. Enter pincode for exact delivery dates/charges</p>
        				</div>
        			</div>
        			
        			
        			<?php foreach($varientTypes as $varientType): ?>
        			<div class="row add-more">
        				<h3 style="margin-left: 15px;font-size: 16px;margin-top: 0;font-weight:bold;">Add some more love</h3>
        				<?php $varientflag = 0; ?>
        				<?php foreach($varientValues[$varientType->varient_type_id] as $varient): ?>
        			
        				<div class="col-md-3 col-xs-4 text-center varient-add">
        					<label for="varient<?php echo e($varient->id); ?>" id="varientlabel<?php echo e($varient->id); ?>" class="varientlabel <?php if($varientflag == 0 && $varient->can_auto_selected == 'yes'): ?> dropitshadow <?php endif; ?>"><img width="70" src="<?php echo e($defaultImage); ?>"/>
        					<h5><?php echo e($varient->value); ?></h5></label>
        					<input id="varient<?php echo e($varient->id); ?>" onchange="getVarientSelected(this.value, <?php echo e(App\Http\Controllers\Massengers\Product\ProductController::getVarientPrice($product->id,$varient->id, $product->product_selling_price)); ?>)" type="radio" name="varients" value="<?php echo e($varient->id); ?>">
        					<h4 class="c-red" style="margin-top:0;"><i class="fa fa-inr"></i> <?php if($varient->substract_price == 'no'): ?><?php echo e(App\Http\Controllers\Massengers\Product\ProductController::getVarientPrice($product->id,$varient->id, $product->product_selling_price)); ?> <?php else: ?> <?php echo e(App\Http\Controllers\Massengers\Product\ProductController::getVarientPrice($product->id,$varient->id, $product->product_selling_price)-$product->product_selling_price); ?> <?php endif; ?> </h4>
        				</div>
        				<?php $varientflag++; ?>
        				<?php endforeach; ?>
        			</div>
        			<?php endforeach; ?>
        			
        			<div class="row uploader loveletterform <?php if($product->image_upload_option == 'no'): ?> hidden <?php endif; ?>">
        			    <div class="form-group mobpd0 col-md-12" style="margin-bottom:0;">
        					<label class="col-md-4 pdl-0">Upload Image <span class="c-red">*</span></label>
        					<input type="file" id="cover_photo" class="col-md-7"/>
        					<span class="col-md-1 c-red" id="uploadcoverspan"></span>
        				</div>
        			</div>
        			
        			<input type="hidden" name="cover_photo" value="" />
        			
        			<div class="row pd-10 loveletterform <?php if($product->love_letter_options == 'no'): ?> hidden <?php endif; ?>">
            				<div class="form-group col-md-4">
            					<label>Paper Colour <span class="c-red">*</span></label>
            					<select name="paper_color" class="form-control">	
            					    <option value="none" selected>None</option>
            						<option value="white">White</option>
            						<option value="blue">Blue</option>
            						<option value="red">Red</option>
            						<option value="pink">Pink</option>
            						<option value="violet">Violet</option>
            					</select>
            				</div>
            				<div class="form-group col-md-4">
            					<label>Ink Colour <span class="c-red">*</span></label>
            					<select name="ink_colour" class="form-control">	
            						<option value="none" selected>None</option>
            						<option value="white">White</option>
            						<option value="blue">Blue</option>
            						<option value="red">Red</option>
            						<option value="pink">Pink</option>
            						<option value="violet">Violet</option>
            					</select>
            				</div>
            				<div class="form-group col-md-4">
            					<label>Emotions <span class="c-red">*</span></label>
            					<select name="emotions" class="form-control">
            					    <option value="none" selected>None</option>	
            						<option value="happy">Happy</option>
            						<option value="love">Love</option>
            						<option value="excited">Excited</option>
            						<option value="naughty">Naughty</option>
            					</select>
            				</div>
            				<div class="form-group col-md-12">
            					<label>Recipient's Name <span class="c-red">*</span></label>
            					<input name="receipent_name" type="text" class="form-control col-md-8" />
            				</div>
            				<div class="form-group col-md-12">
            					<label>Message(s)</label>
            					<textarea name="loveletter_message" class="form-control" rows="4" maxlength="150" style="resize:none;"></textarea>
            					<small>Maximum number of character: 150</small>
            				</div>
            				<div class="form-group col-md-12">
            					<label class="mt-10">Please Check</label>
            					<br/>
            					<input name="not_sure_what_to_say" type="checkbox" id="not-sure"/>
            					<label for="not-sure">Not Sure What To Say ? Let us decide</label>
            					<br/>
            					<input name="send_anonymous" type="checkbox" id="send-anon"/>
            					<label for="send-anon">Send Anonymously</label>
            				</div>
            			</div>
            			
            			
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
    			</div>
    			<?php if( BrowserDetect::detect()->isMobile): ?>
        			<div class="row hidden-sm hidden-md hidden-lg text-center price-section">
        			<h2 class="c-red myriad" style="font-size:28px"><i class="fa fa-inr" style="font-size:23px"></i><span id="productpricespan"><?php echo e($product->product_selling_price); ?></span></h2>
        				<input type="hidden" name="productid" value="<?php echo e($product->id); ?>">
        				<input type="hidden" name="category" value="<?php echo e($cat_alias); ?>">
        				
        				<input type="number" min="1" value="1" class="delivery-control" name="quantity"  placeholder="Enter required quantity" style="display:none;"/><br />				
        				<input type="text" name="pincode" value="" class="delivery-control" onchange="fetchpincode(this.value)" onkeyup="fetchpincode(this.value)" placeholder="*Enter Delivery Pincode"/>
        				<small class="right"><a href="javascript:;" class="dont-know">Don't Know Pincode ?</a></small>
        				<!--<div class="findyourpincode">
        					<input type="text" onkeyup="findpincodes(this.value)"  name="find_pincode" class="delivery-control" placeholder="Find Your Pincode">
        					<div class="pincode-list">
        						<ul id="dont_know_pincode">
        							
        						</ul>
        					</div>
        					
        				</div>-->
        				<input type="text" class="delivery-control" value="" name="delivery_city" placeholder="*Enter Your City"/>
        				<div class="inputdiv">
        					<a href="javascript:void(0);" data-toggle="modal" data-target=".bs-example-modal-lg" id="datetimelink" class="activeinput" title="You can select date and time of delivery after providing valid pincode">*When ?</a>
        				</div>
        				<div id="datetimeshipping" data-toggle="modal" data-target=".bs-example-modal-lg" style="display: hidden;">
        					<span id="deliverydateofmonth"></span>
        					<span id="deliverymonth"></span>
        					<span id="deliveryweekday"></span>
        					<span id="shippingmethod"></span>
        					<span id="timeslot"></span>
        				</div>
        				<!--<button type="submit" title="Buy Now" class="buy-now-btn"><img src="<?php echo e(asset('massengers/img/card-new.png')); ?>" width="24"> Buy Now</button>-->
        				<button type="submit" title="Buy Now" class="buy-now-btn"><img src="<?php echo e(asset('massengers/img/card-new.png')); ?>" width="24"> Buy Now</button>
        				<a href="javascript:;" title="Add to cart" id="add_to_cart_btn" class="price-btn"><img src="<?php echo e(asset('massengers/img/cart-new.png')); ?>" width="24"> Add to Cart</a>
        			<br/>
        			<?php if($category->showtimer == 1): ?>
        			<div class="timerbox">
        				<div class="col-sm-4 timeslot">
        					<h2><span id="timeslothours">4</span>:<span id="timeslotminutes">20</span></h2>
        				</div>
        				<div class="col-sm-8 deliveryleft">
        					<h4>Hours left for today's delivery</h4>
        				</div>
        			</div>
        			<?php endif; ?>
        		</div>
        		<?php endif; ?>
        		
    			<?php if(count($products)): ?>
                    <div class="row roboto-light recent-view">
                		<ul class="nav nav-tabs combo-tabs">
                			<li class="active"><a data-toggle="tab" href="#youmight">You Might Also Like</a></li>
                			<li><a data-toggle="tab" href="#recent">Recently Viewed</a></li>
                		</ul>
                		<div class="tab-content youmight">
                			<div id="youmight" class="tab-pane fade in active">
                			<?php foreach($products as $sameproduct): ?>
                				<div class="col-md-3 col-sm-3 text-center combo-products">
                					<a href="<?php echo e(url('category/'.$cat_alias.'/product/'.$sameproduct->id)); ?>"><img class="center-image" src="<?php echo e($productImage[$sameproduct->id]); ?>" title="<?php echo e($product->product_name); ?>"/></a>
                					<h6 style="font-family: 'Roboto-Light';color: #666;"><a href="<?php echo e(url('category/'.$cat_alias.'/product/'.$sameproduct->id)); ?>" class="product-names"><?php echo e($sameproduct->product_name); ?></a></h5>
                					<h5 class="c-red bold"><i class="fa fa-inr"></i> <?php echo e($sameproduct->product_selling_price); ?></h4>
                				</div>
                			<?php endforeach; ?>	
                			</div>
                			
                			<div id="recent" class="tab-pane">
                			<?php foreach($recentlyViewProducts as $sameproduct): ?>
                				<div class="col-md-3 col-sm-3 text-center combo-products">
                					<a href="<?php echo e(url('category/'.$cat_alias.'/product/'.$sameproduct->id)); ?>"><img class="center-image" src="<?php echo e($recentproductImage[$sameproduct->id]); ?>" title="<?php echo e($product->product_name); ?>"/></a>
                					<h6 style="font-family: 'Roboto-Light';color: #666;"><a href="<?php echo e(url('category/'.$cat_alias.'/product/'.$sameproduct->id)); ?>" class="product-names"><?php echo e($sameproduct->product_name); ?></a></h5>
                					<h5 class="c-red bold"><i class="fa fa-inr"></i> <?php echo e($sameproduct->product_selling_price); ?></h4>
                				</div>
                			<?php endforeach; ?>	
                			</div>
                		</div>
                		
                    </div>
                    <?php endif; ?>	
                
                    <?php if(count($combos)): ?>                
                    <div class="row roboto-light combo-view">
                		<ul class="nav nav-tabs combo-tabs">
                		<?php foreach($combos as $key => $combo): ?>
                			<li class="<?php if($key == 0): ?> active <?php endif; ?>"><a data-toggle="tab" href="#combo-<?php echo e($combo->id); ?>">Combo <?php echo e($key+1); ?></a></li>
                		<?php endforeach; ?>
                		</ul>
                
                		<div class="tab-content youmight">
                			<?php foreach($combos as $key => $combo): ?>
                			<div id="combo-<?php echo e($combo->id); ?>" class="tab-pane fade in <?php if($key == 0): ?> active <?php endif; ?> ">
                				<div class="col-md-3 col-sm-3 col-xs-4 text-center">
                					<img width="200" src="<?php echo e($defaultImage); ?>" class="center-image" title="<?php echo e($product->product_name); ?>"/>
                					<h6 style="font-family: 'Roboto-Light';color: #666;"><?php echo e($product->product_name); ?></h5>
                					<h5 class="c-red bold"><i class="fa fa-inr"></i> <?php echo e($product->product_selling_price); ?></h4>
                				</div>
                				<div class="col-md-1 col-sm-1 col-xs-1 text-center pd-90 pdres-60">
                					<i class="fa fa-plus c-red">
                					</i>
                				</div>
                				<div class="col-md-3 col-sm-3 col-xs-4 text-center">
                					<img src="<?php echo e($comboproductImage[$combo->id]); ?>" class="center-image"/>
                					<h6 style="font-family: 'Roboto-Light';color: #666;"><?php echo e(substr($comboproduct[$combo->id]->product_name, 0, 50)); ?></h5>
                					<h5 class="c-red bold"><i class="fa fa-inr"></i> <?php echo e($comboproduct[$combo->id]->product_selling_price); ?></h4>
                				</div>
                				<div class="col-md-3 col-sm-3 col-xs-3 text-center pd-90 pdres-60">
                				<a href="javascript:;" onclick="addtocart(<?php echo e($combo->id); ?>, <?php echo e($product->id); ?>)" title="Buy Now" class="buy-now-btn width-100"><img src="<?php echo e(asset('massengers/img/card-new.png')); ?>" width="24"> Buy Now</a>
                				<!--<p style=""><i class="fa fa-inr"></i> <?php echo e($comboproduct[$combo->id]->product_selling_price + $product->product_selling_price); ?></p>-->
                				<h2 class="c-red myriad" style="font-size:24px; margin:5px 0;"><i class="fa fa-inr" style="font-size:20px"></i><?php echo e($comboproduct[$combo->id]->product_selling_price + $product->product_selling_price); ?></h2>
                				</div>
                			</div>
                			<?php endforeach; ?>
                    	</div>
                    </div>	
                <?php endif; ?>
            </div>	
           <?php if( BrowserDetect::detect()->isDesktop): ?>
    		<div class="col-md-3 hidden-xs text-center price-section">
    			<h2 class="c-red myriad" style="font-size:28px"><i class="fa fa-inr" style="font-size:23px"></i><span id="productpricespan"><?php echo e($product->product_selling_price); ?></span></h2>
    				<input type="hidden" name="productid" value="<?php echo e($product->id); ?>">
    				<input type="hidden" name="category" value="<?php echo e($cat_alias); ?>">
    				
    				<input type="number" min="1" value="1" class="delivery-control" name="quantity"  placeholder="Enter required quantity" style="display:none;"/><br />				
    				<input type="text" name="pincode" value="" class="delivery-control" onchange="fetchpincode(this.value)" onkeyup="fetchpincode(this.value)" placeholder="*Enter Delivery Pincode"/>
    				<small class="right"><a href="javascript:;" class="dont-know">Don't Know Pincode ?</a></small>
        				<div class="findyourpincode">
        					<input type="text" onkeyup="findpincodes(this.value)"  name="find_pincode" class="delivery-control" placeholder="Find Your Pincode">
        					<div class="pincode-list">
        						<ul id="dont_know_pincode">
        							
        						</ul>
        					</div>
        					<!-- <button type="submit" class="pull-right">Search</button> -->
        				</div>
    				<input type="text" class="delivery-control" value="" name="delivery_city" placeholder="*Enter Your City"/>
    				<br/>
    				<div class="inputdiv">
    					<a href="javascript:void(0);" data-toggle="modal" data-target=".bs-example-modal-lg" id="datetimelink" onclick="showdeliveryoptions('<?php echo e($category->delivery_options); ?>')" class="activeinput" title="You can select date and time of delivery after providing valid pincode">*When ?</a>
    				</div>
    				<div id="datetimeshipping" data-toggle="modal" data-target=".bs-example-modal-lg" style="display: hidden;">
    					<span id="deliverydateofmonth"></span>
    					<span id="deliverymonth"></span>
    					<span id="deliveryweekday"></span>
    					<span id="shippingmethod"></span>
    					<span id="timeslot"></span>
    				</div>
    				<!--<button type="submit" title="Buy Now" class="buy-now-btn"><img src="<?php echo e(asset('massengers/img/card-new.png')); ?>" width="24"> Buy Now</button>-->
    				<button type="submit" title="Buy Now" class="buy-now-btn"><img src="<?php echo e(asset('massengers/img/card-new.png')); ?>" width="24"> Buy Now</button>
    				<a href="javascript:;" title="Add to cart" id="add_to_cart_btn" class="price-btn"><img src="<?php echo e(asset('massengers/img/cart-new.png')); ?>" width="24"> Add to Cart</a>
    			<br/>
    			<?php if($category->showtimer == 1): ?>
    			<div class="timerbox">
    				<div class="col-sm-4 timeslot">
    					<h2><span id="timeslothours">4</span>:<span id="timeslotminutes">20</span></h2>
    				</div>
    				<div class="col-sm-8 deliveryleft">
    					<h4>Hours left for today's delivery</h4>
    				</div>
    			</div>
    			<?php endif; ?>
    			<br/>
    		</div>
    		<?php endif; ?>
	</div>
</div>

<div id="datediv">
    <input type="hidden" name="selectedDate">
    <input type="hidden" id="shippingtimeholderinput" name="" />
</div>

 <div class="modal fade date-modal bs-example-modal-lg" id="deliveryoptionmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	<div class="modal-header" id="next-or-current">
	 <a class="left c-red" href="#carousel-example-generic" role="button" data-slide="prev" style="float:left; margin-top:5px;">
			<span class="glyphicon glyphicon-chevron-left"></span>
		</a>
		<!--<a class="right" href="#carousel-example-generic" role="button" data-slide="next" style="float:right; margin-top:5px;">
			<span class="glyphicon glyphicon-chevron-right"></span>
		</a>-->
		<h4 class="modal-title" id="head-content">Select Delivery Option</h4>
	</div>
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
		
		  <div class="carousel-inner">
		    <div class="item active">
				<div id="shippingmethoddiv">
					
				</div>
			</div>
			<div class="item ">
				<div class="app" id="calenderdiv">
					
				</div>
			</div>
			<div class="item">
			  <div id="timeslotDiv">
					 
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