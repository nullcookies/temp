<?php
// Merchant key here as provided by Payu
$MERCHANT_KEY = "WHKb7c";//"gtKFFx";//"mo4YeQ";
$url = "http://localhost/payu_intergration";
// Merchant Salt as provided by Payu
$SALT = "cV7vPWSR";//"eCwWELxi";//"8BL7bcAQ";
// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://secure.payu.in/_payment";//"https://test.payu.in";//"https://secure.payu.in/_payment";
$action = '';
$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
  }
}
$formError = 0;
if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
//$newtotal = $totalCart;
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(empty($posted['key'])
     || empty($posted['txnid'])
     || empty($posted['amount'])
     || empty($posted['firstname'])
     || empty($posted['email'])
     || empty($posted['phone'])
     || empty($posted['productinfo'])
     || empty($posted['surl'])
     || empty($posted['furl'])
     || empty($posted['service_provider'])     
  ) {
    $formError = 1;
  } else {
    $hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';  
  foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    
    }
 
    $hash_string .= $SALT;
    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>

<?php
if($formError){
  echo 'some problem';
}

?>



<?php $__env->startSection('title'); ?>
	| Ecommerce website
<?php $__env->stopSection(); ?>

<?php $__env->startSection('top_newsletter'); ?>
	<?php echo $__env->make('front.common.top_newsletter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>

<meta name="title" content="kibakibi">
<meta name="description" content="ecommerece, products, online buy product">
<meta name="author" content="TechTurtle">

  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/custom.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-sm-9 wow bounceInUp animated">
        <div class="col-main">
          <div class="page-title">
            <h1>Checkout</h1>
          </div>
          <ol class="one-page-checkout" id="checkoutSteps">
            <li id="opc-billing" class="section  <?php if($buynow->init == 'yes' || $buynow->billing_address == 'yes'): ?> allow active <?php endif; ?>">
              <div class="step-title"> <span class="number">1</span>
                <h3>Billing Address</h3>
                <!--<a href="#">Edit</a> --> 
              </div>
              
              <div id="checkout-step-billing" class="step a-item" style="display:block;">
                <!-- content -->
              </div>
              
            </li>
            <li id="opc-shipping" class="section <?php if($buynow->shipping_address == 'yes'): ?> allow active <?php endif; ?>">
              <div class="step-title"> <span class="number">2</span>
                <h3 class="one_page_heading"> Shipping Address</h3>
                <!--<a href="#">Edit</a>--> 
              </div>
              
              <div id="checkout-step-shipping" class="step a-item" style="display: block;">
                <!-- shippoing content -->
              </div>
              
            </li>
            <li id="opc-shipping_method" class="section <?php if($buynow->payment_method  == 'yes'): ?> allow active <?php endif; ?>">
              <div class="step-title"> <span class="number">3</span>
                <h3 class="one_page_heading">Payment Method</h3>
                <!--<a href="#">Edit</a>--> 
              </div>
              
              <div id="checkout-step-shipping_method" class="step a-item" style="display: block;">
                <!-- shipping method -->
              </div>
              
            </li>
            
            <li id="opc-review" class="section <?php if($buynow->payment_info  == 'yes'): ?> allow active <?php endif; ?>">
              <div class="step-title"> <span class="number">4</span>
                <h3 class="one_page_heading">Payment Review</h3>
                <!--<a href="#">Edit</a>--> 
              </div>
             
              <div id="checkout-step-review" class="step a-item" style="display: block;">
              <?php if($buynow->payment_info == 'yes'): ?>       
<div class="order-review" id="checkout-review-load"> </div>
  <table class="table order-review-table">
            <?php $product_types = array(); ?>
          <?php foreach($products as $product): ?>
            <?php $product_types[] = $product->product_from; ?>
            <tr>
              <td class="text-center align-mid"><!-- <a href="javascript"><i class="fa fa-trash-o"></i></a> --><img src="<?php echo e($productImage[$product->upc]); ?>" width="64" height="64"</td>
              <td class="align-mid">
                <h3 class="bold"><?php echo e($product->product_name); ?></h3>
                <span style="width:120px; word-wrap:break-word;"><?php echo e($product->varients); ?></span>
              </td>
              <td class="align-mid">
                <h3 class="bold">Delivered By:</h3>
                <p>28th, March, 2017</p>
              </td>
              <td class="align-mid">
                <h3 class="bold">Quantity</h3>
                <p><?php echo e($product->quantity); ?></p>
              </td>
              <td class="text-right align-mid">
                <p><i class="fa fa-inr"></i>&nbsp;<?php echo e($product->product_selling_price); ?>&nbsp;&nbsp; <span style="font-size:24px;text-decoration:line-through;"><i class="fa fa-inr"></i><?php echo e($product->product_mrp); ?></span></p>
              </td>
            </tr>
            <?php endforeach; ?>
            <tr>
              <td colspan="2"></td>
              <td colspan="2" class="align-mid">
                <strong><p>Shipping Charges</p></strong>
              </td>
              <td class="text-right align-mid">
                <p><i class="fa fa-inr"></i>&nbsp;<?php echo e($buynow->shipping_price ? intval($buynow->shipping_price) : 0); ?></p>
              </td>

            </tr>
            <!-- coupon area start -->
            <?php if($buynow->applied_coupon_code == 'no'): ?>
            
            <?php if(!in_array('api',$product_types)): ?>
            <tr>
              <?php echo Form::open(array('id' => 'apply_coupon_code_form')); ?>

              <input type="hidden" name="buynowid" value="<?php echo e($buynow->id); ?>">
              <td colspan="2"></td>
              <td colspan="2" class="align-mid">
                <strong><p>Have a coupon code ?</p></strong>
              </td>
              <td class="text-right align-mid">
                <p><input type="text" autocomplete="off" name="coupon_code" placeholder="Enter Coupon Code"  class="input-text required-entry"></p>
                <p class="text-danger" id="coupon_message"></p>
                <p><button type="submit" class="button pull-right">Apply</button></p>
              </td>
              <?php echo Form::close(); ?>

            </tr>
            <?php endif; ?>
            <?php else: ?>
              <tr>
              <td colspan="2" class="align-mid">
              </td>
              <td colspan="3">
                <p>You have applied coupon <strong><?php echo e($buynow->coupon_code); ?></strong> </p>
                <p>Get discount of <i class="fa fa-inr"></i> <?php echo e($buynow->discount); ?> <strong></strong> </p>
                <p><?php if($buynow->free_shipping == 'yes'): ?> we will ship free of cost <?php endif; ?></p>
              </td>
            </tr>
            <?php endif; ?>
            <!-- coupon area ends -->
            <tr>
              <td colspan="2" class="align-mid">
                <strong>Total Amount Payable</strong>
              </td>
              <td colspan="3" class="total-pay align-mid">
                <i class="fa fa-inr"></i>&nbsp;
                <?php if($buynow->applied_coupon_code == 'yes'): ?>
                  <?php echo e($beforeCoupon); ?> - <?php if($buynow->free_shipping == 'yes'): ?> <i class="fa fa-inr"></i>&nbsp; <?php echo e($buynow->shipping_price); ?> - <?php endif; ?>  <i class="fa fa-inr"></i>&nbsp;<?php echo e($buynow->discount); ?> = <i class="fa fa-inr"></i>&nbsp;<?php echo e($totalCart); ?>

                <?php else: ?>
                  <?php echo e($totalCart); ?> 
                <?php endif; ?>
              </td>
            </tr>
          </table>
          <div class="mobile-list">
            <div class="image-box">
              <center>
                  <img src="https://cdn3.iconfinder.com/data/icons/soccer-uniform/128/barcelona.png" class="product-images">
              </center> 
            </div>
            <div class="product-details">
              <h3 class="bold">Barcelona T-shirt</h3>
              <h5><span class="bold">Color :</span> Red</h5>
              <h5><span class="bold">Size :</span>Medium</h5>
              <h5><span class="bold">Quantity :</span> 1</h5>
              <h6><span class="bold">Delivery By :</span> 28<sup>th</sup>,March 2017</h6>
            </div>
            <hr/>
            <div class="charges">
              <h2>Price</h2>
              <h3><i class="fa fa-inr"></i>&nbsp;5200&nbsp;&nbsp; <span style="font-size:24px;text-decoration:line-through;"><i class="fa fa-inr"></i>5500</span></h3>
            </div>
          </div>
            <form action="<?php echo $action; ?>" method="post" id="payuform" name="payuForm">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
            <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
            <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
            <input type="hidden" name="surl" value="<?php echo e(url('/order/getSuccess')); ?>" />
            <input type="hidden" name="furl" value="<?php echo e(url('/order/getFail')); ?>"  />
            <input type="hidden" name="curl" value="<?php echo e(url('/order/getFail')); ?>"  />
            <input type="hidden" name="service_provider" value="payu_biz" size="64" />
            <input type="hidden" name="firstname" value="<?php echo e($buynow->billing_first_name); ?>">
            <input type="hidden" name="lastname" value="<?php echo e($buynow->billing_last_name); ?>">
            <input type="hidden" name="udf1" value="<?php echo e($buynow->id); ?>">
            <input type="hidden" name="address1" class="form-control" value="<?php echo e($buynow->billing_street_address); ?>">
            <input type="hidden" name="city" class="form-control" value="<?php echo e($buynow->billing_city); ?>">
            <input type="hidden" name="state" value="<?php echo e($buynow->billing_state); ?>">
            <input type="hidden" name="zipcode" value="<?php echo e($buynow->billing_pincode); ?>" >        
            <input type="hidden" value="<?php echo e($buynow->billing_email); ?>" name="email">        
            <input type="hidden" name="phone" value="<?php echo e($buynow->billing_mobile); ?>" >
            <input name="udf2" type="hidden"   value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" />
            <input name="udf3" type="hidden" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" />
            <input name="udf4" type="hidden" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" />
            <input name="udf5" type="hidden" value="<?php echo (empty($posted['udf5']))? '' : $posted['udf5']; ?>" />
            <input name="pg" type="hidden"  value="<?php echo (empty($posted['pg'])) ?  ''  : $posted['pg']; ?>" />
            <input name="amount" type="hidden" value="<?php echo e($totalCart); ?>"/>
            <input name="productinfo" type="hidden" value="fIRST" readonly="readonly">  
            <button type="submit" class="button pull-right">Proceed To pay</button>
            </form>

              </div>
              <?php endif; ?>
        </li>
          </ol></div>
        </section>
        <aside class="col-right sidebar col-sm-3 wow bounceInUp animated" id="checkout_right_sidebar">
          
        </aside>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      $('#hiddenback').css('display','block');
      if(hash == '') {
        $('#hiddenback').css('display','none');
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();

    }
</script>
  <script type="text/javascript">
    
    
      $(document).ready(function(){
        submitPayuForm();
        <?php if($buynow->init == 'yes' || $buynow->billing_address == 'yes' ): ?>
          showBillingAddress(<?php echo e($buynow->id); ?>);
        <?php endif; ?>

        <?php if($buynow->shipping_address == 'yes'): ?>
          showShippingAddress(<?php echo e($buynow->id); ?>);
        <?php endif; ?>

        <?php if($buynow->payment_method == 'yes'): ?>
          showPaymentMethod(<?php echo e($buynow->id); ?>);
        <?php endif; ?>
        showRightSidebar(<?php echo e($buynow->id); ?>);
      });
    

    function showBillingAddress(buynowid){

      $.ajax({
        url: "<?php echo e(url('/order/show_billing_address')); ?>",
        type: "get",
        dataType: 'html',
        data: {buynowid:buynowid},
        beforeSend: function(){},
        success: function(result){
          $('#checkout-step-billing').html(result);
          $('#opc-billing').addClass('allow active');
          $('#opc-shipping').removeClass('allow active');
          $('#opc-shipping_method').removeClass('allow active');
          $('#opc-shipping_review').removeClass('allow active');
          showRightSidebar(buynowid);
        }
      });
    }

    function showShippingAddress(buynowid){
      $.ajax({
        url: "<?php echo e(url('/order/show_shipping_address')); ?>",
        type: "get",
        dataType: 'html',
        data: {buynowid:buynowid},
        beforeSend: function(){},
        success: function(result){
          $('#checkout-step-shipping').html(result);
          $('#opc-billing').removeClass('allow active');
          $('#opc-shipping').addClass('allow active');
          $('#opc-shipping_method').removeClass('allow active');
          $('#opc-shipping_review').removeClass('allow active');
          showRightSidebar(buynowid);
        }
      });
    }

    function showPaymentMethod(buynowid){
      $.ajax({
        url: "<?php echo e(url('/order/show_payment_method')); ?>",
        type: "get",
        dataType: 'html',
        data: {buynowid:buynowid},
        beforeSend: function(){},
        success: function(result){
          $('#checkout-step-shipping_method').html(result);
          $('#opc-billing').removeClass('allow active');
          $('#opc-shipping').removeClass('allow active');
          $('#opc-shipping_method').addClass('allow active');
          $('#opc-shipping_review').removeClass('allow active');
          showRightSidebar(buynowid);
        }
      });
    }

    function showPaymentInformation(buynowid){
      $.ajax({
        url: "<?php echo e(url('/order/show_payment_info')); ?>",
        type: "get",
        dataType: 'html',
        data: {buynowid:buynowid},
        beforeSend: function(){},
        success: function(result){
          $('#checkout-step-review').html(result);
          $('#opc-billing').removeClass('allow active');
          $('#opc-shipping').removeClass('allow active');
          $('#opc-shipping_method').removeClass('allow active');
          $('#opc-shipping_review').addClass('allow active');
          showRightSidebar(buynowid)
        }
      });
    }

    function showRightSidebar(buynowid){
      $.ajax({
        url: "<?php echo e(url('/order/show_checkout_sidebar')); ?>",
        type: "get",
        dataType: 'html',
        data: {buynowid:buynowid},
        beforeSend: function(){},
        success: function(result){
          $('#checkout_right_sidebar').html(result);
        }
      });
    }

    function select_saved_address(addressid, what){
      $.ajax({
        url: "<?php echo e(url('order/select_address')); ?>",
        type: 'get',
        dataType: 'json',
        data: {addressid: addressid},
        success: function(result){
          if(result['success']){
            if(what == 'billing'){
              setBillingAddress(result['data']);
            }else if(what == 'shipping'){
              setShippingAddress(result['data']);
            }
          }
        },
      });
    }

    function setBillingAddress(result){
      $('#billing_first_name').val(result['first_name']);
      $('#billing_last_name').val(result['last_name']);
      $('#billing_email').val(result['email']);
      $('#billing_mobile').val(result['mobile']);
      $('#billing_pincode').val(result['pincode']);
      $('#billing_state').val(result['state']);
      $('#billing_city').val(result['city']);
      $('#billing_country').val(result['country']);
      $('#billing_street_address').val(result['address']);
    }

    function setShippingAddress(result){
      $('#shipping_first_name').val(result['first_name']);
      $('#shipping_last_name').val(result['last_name']);
      $('#shipping_email').val(result['email']);
      $('#shipping_mobile').val(result['mobile']);
      $('#shipping_pincode').val(result['pincode']);
      $('#shipping_state').val(result['state']);
      $('#shipping_city').val(result['city']);
      $('#shipping_country').val(result['country']);
      $('#shipping_street_address').val(result['address']);
    }

    function saveBillingAddress(){
      $.ajax({
        url: "<?php echo e(url('order/saveBilingAddress')); ?>",
        type: 'post',
        data: $('#save_billing_address_form').serialize(),
        dataType: 'json',
        beforeSend: function(){},
        success: function(result){
            $('#billing_address_alert')
            .removeClass('hidden')
            .removeClass('alert-success')
            .removeClass('alert-danger')
            .addClass('alert-'+result['class'])
            .html(result['message']);

          if(result['success']){
            $('#checkout-step-billing').html('');
            showShippingAddress(<?php echo e($buynow->id); ?>);
          }
        },
        error: function(error, text){
          console.log(data);
        },
      });
    }

    function set_same_as_billing_address(buynowid, obj){
      if($("#"+obj.id).is(':checked')){
        $.ajax({
          url: "<?php echo e(url('order/getbuyNowDetail')); ?>",
          type: 'get',
          data: {buynowid:buynowid},
          dataType: 'json',
          success: function(response){

            if(response['success']){
              var result = response['data'];
              $('#shipping_first_name').val(result['billing_first_name']);
              $('#shipping_last_name').val(result['billing_last_name']);
              $('#shipping_email').val(result['billing_email']);
              $('#shipping_mobile').val(result['billing_mobile']);
              $('#shipping_pincode').val(result['billing_pincode']);
              $('#shipping_state').val(result['billing_state']);
              $('#shipping_city').val(result['billing_city']);
              $('#shipping_country').val(result['billing_country']);
              $('#shipping_street_address').val(result['billing_street_address']);
            }
          }
        });
      }
    }

    function saveShippingAddress(){
      $.ajax({
        url: "<?php echo e(url('/order/saveShippingAddress')); ?>",
        type: 'post',
        data: $('#save_shipping_address_form').serialize(),
        dataType: 'json',
        success: function(result){
          $('#shipping_address_alert')
            .removeClass('hidden')
            .removeClass('alert-success')
            .removeClass('alert-danger')
            .addClass('alert-'+result['class'])
            .html(result['message']);

          if(result['success']){
            $('#checkout-step-shipping').html('');
            showPaymentMethod(<?php echo e($buynow->id); ?>);
          }
        }
      });
    }

    function savePaymentMethod(){
      $.ajax({
        url: "<?php echo e(url('/order/save_payment_method')); ?>",
        type: 'post',
        data: $('#payment_method_form').serialize(),
        dataType: 'json',
        success: function(result){
          $('#payment_method_alert')
            .removeClass('hidden')
            .removeClass('alert-success')
            .removeClass('alert-danger')
            .addClass('alert-'+result['class'])
            .html(result['message']);

          if(result['success']){
            location.reload();
            /*$('#opc-shipping_method').html('');
            showPaymentInformation(<?php echo e($buynow->id); ?>);*/
          }
        }
      });
    }

    $(document).ready(function(){
      var couponForm    = $('#apply_coupon_code_form');
      couponForm.on('submit', function(event){
      event.preventDefault();
        $.ajax({
          url: "<?php echo e(url('/order/applyCoupon')); ?>",
          type: 'POST',
          data: couponForm.serialize(),
          dataType: 'json',
          beforeSend: function(){
            $('#coupon_message').html('<i class="fa fa-cog fa-spin"></i>');
            $('#coupon_message').removeClass('text-danger').removeClass('text-success');
          },
          success: function(result){

            if(result['fail']){

            }

            $('#coupon_message').addClass('text-'+result['class']);
            $('#coupon_message').html(result['message']);

            if(result['success']){
              location.reload();
            }
          },
          error: function(){},
        }); 
      });
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.front_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>