        <div class="col-md-6 pdl-0">
              <div class="alert alert-success hidden" id="payment_method_alert">
              </div>
                <?php echo Form::open(array('id' => 'payment_method_form','method' => 'get','action' => ['Front\Order\OrderController@showCheckout'])); ?>

                  <fieldset>
                  <input type="hidden" name="buynowid" value="<?php echo e($buynow->id); ?>">
                    <div id="checkout-shipping-method-load">
                      <dl class="shipping-methods">
                        <dd>
                          <ul>
                            <li>
                              <input type="radio" name="selected_payment_method" value="cod" id="cod" class="radio">
                              <label for="cod" class="bold">COD</label>
                              <!-- <input type="radio" name="shipping_method" data-toggle="modal" data-target="#myModal" value="flatrate_flatrate" id="s_method_flatrate_flatrate" checked="checked" class="radio">
                              <label for="s_method_flatrate_flatrate" class="bold">COD</label> -->
                            </li>
                          </ul>
                        </dd>
                      </dl>
                    </div>
                    <div id="checkout-shipping-method-load">
                      <dl class="shipping-methods">
                        <dd>
                          <ul>
                            <li>
                              <input type="radio" name="selected_payment_method" value="online" id="online_payment" class="radio">
                              <label for="online_payment" class="bold">Online Payment</label>
                            </li>
                          </ul>
                        </dd>
                      </dl>
                    </div>
                    <div class="buttons-set1" id="shipping-method-buttons-container">
                      <button type="button" class="button" onClick="savePaymentMethod()"><span>Continue</span></button>
                    </div>
                  </fieldset>
                <?php echo Form::close(); ?>

        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Enter your Mobile Number on which the OTP will be sent</h4>
            </div>
            <div class="modal-body">
            <center>
              <form>
                <ul>
                  <div class="input-box">
                    <label for="mobile-otp">Mobile Number <span class="required">*</span> </label>
                    <br>
                    <input type="text" id="mobile-otp" name="" value="" maxlength="10" title="Mobile Number" placeholder="Enter Your Mobile Number" class="mobile-form-input">
                  </div>
                </ul>
                  <button class="button mt-10 width-50">SEND OTP</button>
                  <p class="mt-10">Not Recieved ?&nbsp;&nbsp;<a href="#">Resend OTP</a></p>
              </form>
            </center>
            </div>
          </div>
          </div>
        </div>