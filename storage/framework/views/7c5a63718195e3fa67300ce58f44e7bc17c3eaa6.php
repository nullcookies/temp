<!-- wishlist item start -->
<?php foreach($cartItems as $cartItem): ?>
  <li class="item first">
    <div class="item-inner"> <a class="product-image" target="_blank" title="<?php echo e($cartProduct[$cartItem->id]['product_name']); ?>" href="<?php echo e(url('/products/'.$productDetailPage[$cartItem->id].'?product_id='.$cartItem->product_id)); ?>"><img alt="<?php echo e($cartProduct[$cartItem->id]['product_name']); ?>" src="<?php echo e($productImage[$cartItem->id]); ?>"> </a>
      <div class="product-details">
        <div class="access"><a class="btn-remove1" title="Remove This Item" href="javascript:;" onclick="removeCart(<?php echo e($cartItem->id); ?>) ">Remove</a></div>
          <strong><?php echo e($cartItem->quantity); ?></strong> x <span class="price"><i class="fa fa-inr"></i><?php echo e($sellingPrice[$cartItem->id]); ?></span>
        <p class="product-name"><a target="_blank" href="<?php echo e(url('/products/'.$productDetailPage[$cartItem->id].'?product_id='.$cartItem->product_id)); ?>"><?php echo e(substr($cartProduct[$cartItem->id]['product_name'],0,50)); ?></a> </p>
      </div>
    </div>
  </li>
<?php endforeach; ?>

<?php if(sizeof($cartItems)< 1): ?>
	No Item In  Cart
<?php endif; ?>
<!-- wishlist item end -->