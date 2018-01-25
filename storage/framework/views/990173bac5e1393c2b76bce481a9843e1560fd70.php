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
  
  <style type="text/css">
    
    .inline_block{
      display: inline;
    }
    .martop15{
        margin-top:15px;
    }
    @media  only screen and (min-width:768px){
        .baderight{
            float:right !important;
        }
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <div class="main container">
      <div class="col-main" style="display: block;">
        <div class="cart wow bounceInUp animated">
          <div class="page-title martop15">
            <h2>Shopping Cart</h2>
          </div>
          <div class="table-responsive">
              <input type="hidden" value="Vwww7itR3zQFe86m" name="form_key">
              <fieldset>
                <table class="data-table cart-table" id="shopping-cart-table">
                  <colgroup>
                  <col width="1">
                  <col>
                  <col width="1">
                  <col width="1">
                  <col width="1">
                  <col width="1">
                  <col width="1">
                  </colgroup>
                  <thead>
                    <tr class="first last">
                      <th rowspan="1">&nbsp;</th>
                      <th rowspan="1"><span class="nobr">Product Name</span></th>
                      <th rowspan="1"></th>
                      <th colspan="1" class="a-center"><span class="nobr">Unit Price</span></th>
                      <th class="a-center" rowspan="1">Qty</th>
                      <th colspan="1" class="a-center">Subtotal</th>
                      <th class="a-center" rowspan="1">&nbsp;</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  <?php foreach($cartItems as $cartItem): ?>
                    <tr class="first odd">
                      <td class="image"><a class="product-image" target="_blank" title="<?php echo e($cartProduct[$cartItem->id]['product_name']); ?>" href="<?php echo e(url('/products/'.$productDetailPage[$cartItem->id].'?product_id='.$cartItem->product_id)); ?>"><img width="75" alt="<?php echo e($cartProduct[$cartItem->id]['product_name']); ?>" src="<?php echo e($productImage[$cartItem->id]); ?>"></a></td>
                      <td><h2 class="product-name"> <a target="_blank" title="<?php echo e($cartProduct[$cartItem->id]['product_name']); ?>" href="<?php echo e(url('/products/'.$productDetailPage[$cartItem->id].'?product_id='.$cartItem->product_id)); ?>"><?php echo e($cartProduct[$cartItem->id]['product_name']); ?></a> </h2>&nbsp;<p><span style="color: #5D9DD0;"><?php echo e($cartProduct[$cartItem->id]['category']); ?></span></p><p><?php echo e($cartVarient[$cartItem->id]); ?></p></td>
                      <td class="a-center"><a title="Edit item parameters" class="edit-bnt" href="#configure/id/15945/"></a></td>
                      <td class="a-right"><span class="cart-price"> <span class="price"><i class="fa fa-inr"></i><?php echo e($cartProduct[$cartItem->id]['product_selling_price']); ?></span> </span></td>
                      <td class="a-center movewishlist" style="width:15%">
                      <?php echo Form::open(array('method' => 'post', 'class' => 'inline_block', 'action' => ['Front\Cart\CartController@updateQty', $cartItem->id])); ?>  
                        <input maxlength="4" autocomplete="off" class="input-text qty" title="Qty" size="4" value="<?php echo e($cartItem->quantity); ?>" name="qty">
                        <button class="button" type="submit">update</button>
                      <?php echo Form::close(); ?>

                      </td>
                      <td class="a-right movewishlist"><span class="cart-price"> <span class="price"><i class="fa fa-inr"></i><?php echo e($cartProduct[$cartItem->id]['product_selling_price'] * $cartItem->quantity); ?></span> </span></td>
                      <td class="a-center last">
                        <?php echo Form::open(array('method' => 'delete', 'action' => ['Front\Cart\CartController@destroy', $cartItem->id])); ?>

                          <button class="button remove-item" title="Remove item" type="submit" >Delete</button>
                        <?php echo Form::close(); ?>

                      </td>
                    </tr>
                  <?php endforeach; ?> 
                  </tbody>
                </table>
              </fieldset>
          </div>
          <!-- BEGIN CART COLLATERALS -->
          <div class="cart-collaterals row">
            <div class="col-sm-4 baderight">
            <div class="totals">
              <h3>Shopping Cart Total</h3>
              <div class="inner">
                <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
                  <colgroup>
                  <col>
                  <col width="1">
                  </colgroup>
                  <tbody>
                    <tr>
                      <td colspan="1" class="a-left" style=""> Subtotal </td>
                      <td class="a-right" style=""><span class="price"><i class="fa fa-inr"></i><?php echo e($productPrice); ?></span></td>
                    </tr>
                  </tbody>
                </table>
                <ul class="checkout">
                  <li>
                    <button class="button btn-proceed-checkout" title="Proceed to Checkout" onclick="proceedToCartCaheckout();" type="button"><span>Proceed to Checkout</span></button>
                  </li>
                </ul>
              </div>
              <!--inner--> 
              </div>
            </div>
          </div>
          <!--cart-collaterals--> 
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  
  <script type="text/javascript">
    $(document).ready(function(){
      
    });

    function proceedToCartCaheckout(){
      $.ajax({
        url : "<?php echo e(url('/proceedToCartCaheckout')); ?>",
        type: 'POST',
        dataType: 'json',
        success: function(result){
          if(result['success']){
            var url = "<?php echo e(url('/order/checkout')); ?>"+"?buynow="+result['buynowid'];    
            $(location).attr('href',url);
          }
        }
      });
    }
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layouts/front_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>