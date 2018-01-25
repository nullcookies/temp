<div class="block block-progress">
            <div class="block-title ">Your Checkout</div>
            <div class="block-content">
              <dl>
                <dt class="complete"> Billing Address </dt>
                <dd class="complete">
                  <address>
                    @if(strlen($buynow->billing_first_name)>0) {{$buynow->billing_first_name}} {{$buynow->billing_last_name}} <br/>  @endif
                    @if(strlen($buynow->billing_email)>0) {{$buynow->billing_email}} <br/>  @endif
                    @if(strlen($buynow->billing_mobile)>0) {{$buynow->billing_mobile}} <br/>  @endif
                    @if(strlen($buynow->billing_street_address)>0) {{$buynow->billing_street_address}} <br/>  @endif
                    @if(strlen($buynow->billing_city)>0) {{$buynow->billing_city}} <br/>  @endif
                    @if(strlen($buynow->billing_pincode)>0) {{$buynow->billing_pincode}} <br/>  @endif
                    @if(strlen($buynow->billing_state)>0) {{$buynow->billing_state}} <br/>  @endif
                    @if(strlen($buynow->billing_country)>0) {{$buynow->billing_country}} @endif
                  </address>
                </dd>
                <dt class="complete"> Shipping Address </dt>
                <dd class="complete">
                  <address>
                    @if(strlen($buynow->shipping_first_name)>0) {{$buynow->shipping_first_name}} {{$buynow->shipping_last_name}} <br/>  @endif
                    @if(strlen($buynow->shipping_email)>0) {{$buynow->shipping_email}} <br/>  @endif
                    @if(strlen($buynow->shipping_mobile)>0) {{$buynow->shipping_mobile}} <br/>  @endif
                    @if(strlen($buynow->shipping_street_address)>0) {{$buynow->shipping_street_address}} <br/>  @endif
                    @if(strlen($buynow->shipping_city)>0) {{$buynow->shipping_city}} <br/>  @endif
                    @if(strlen($buynow->shipping_pincode)>0) {{$buynow->shipping_pincode}} <br/>  @endif
                    @if(strlen($buynow->shipping_state)>0) {{$buynow->shipping_state}} <br/>  @endif
                    @if(strlen($buynow->shipping_country)>0) {{$buynow->shipping_country}} @endif
                  </address>
                </dd>
                <dt class="complete"> Payment Method </dt>
                <dd class="complete"> {{$buynow->selected_payment_method}} <br>
              </dl>
            </div>
          </div>