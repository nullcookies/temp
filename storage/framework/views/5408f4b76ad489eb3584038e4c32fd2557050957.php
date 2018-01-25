<div class="block block-progress">
            <div class="block-title ">Your Checkout</div>
            <div class="block-content">
              <dl>
                <dt class="complete"> Billing Address </dt>
                <dd class="complete">
                  <address>
                    <?php if(strlen($buynow->billing_first_name)>0): ?> <?php echo e($buynow->billing_first_name); ?> <?php echo e($buynow->billing_last_name); ?> <br/>  <?php endif; ?>
                    <?php if(strlen($buynow->billing_email)>0): ?> <?php echo e($buynow->billing_email); ?> <br/>  <?php endif; ?>
                    <?php if(strlen($buynow->billing_mobile)>0): ?> <?php echo e($buynow->billing_mobile); ?> <br/>  <?php endif; ?>
                    <?php if(strlen($buynow->billing_street_address)>0): ?> <?php echo e($buynow->billing_street_address); ?> <br/>  <?php endif; ?>
                    <?php if(strlen($buynow->billing_city)>0): ?> <?php echo e($buynow->billing_city); ?> <br/>  <?php endif; ?>
                    <?php if(strlen($buynow->billing_pincode)>0): ?> <?php echo e($buynow->billing_pincode); ?> <br/>  <?php endif; ?>
                    <?php if(strlen($buynow->billing_state)>0): ?> <?php echo e($buynow->billing_state); ?> <br/>  <?php endif; ?>
                    <?php if(strlen($buynow->billing_country)>0): ?> <?php echo e($buynow->billing_country); ?> <?php endif; ?>
                  </address>
                </dd>
                <dt class="complete"> Shipping Address </dt>
                <dd class="complete">
                  <address>
                    <?php if(strlen($buynow->shipping_first_name)>0): ?> <?php echo e($buynow->shipping_first_name); ?> <?php echo e($buynow->shipping_last_name); ?> <br/>  <?php endif; ?>
                    <?php if(strlen($buynow->shipping_email)>0): ?> <?php echo e($buynow->shipping_email); ?> <br/>  <?php endif; ?>
                    <?php if(strlen($buynow->shipping_mobile)>0): ?> <?php echo e($buynow->shipping_mobile); ?> <br/>  <?php endif; ?>
                    <?php if(strlen($buynow->shipping_street_address)>0): ?> <?php echo e($buynow->shipping_street_address); ?> <br/>  <?php endif; ?>
                    <?php if(strlen($buynow->shipping_city)>0): ?> <?php echo e($buynow->shipping_city); ?> <br/>  <?php endif; ?>
                    <?php if(strlen($buynow->shipping_pincode)>0): ?> <?php echo e($buynow->shipping_pincode); ?> <br/>  <?php endif; ?>
                    <?php if(strlen($buynow->shipping_state)>0): ?> <?php echo e($buynow->shipping_state); ?> <br/>  <?php endif; ?>
                    <?php if(strlen($buynow->shipping_country)>0): ?> <?php echo e($buynow->shipping_country); ?> <?php endif; ?>
                  </address>
                </dd>
                <dt class="complete"> Payment Method </dt>
                <dd class="complete"> <?php echo e($buynow->selected_payment_method); ?> <br>
              </dl>
            </div>
          </div>