<div class="alert alert-success hidden" id="shipping_address_alert">
</div>
<input type="checkbox" class="billing-save" name="shipping[save_in_address_book]" title="Save in address book" id="set_same_as_billing_address" onclick="set_same_as_billing_address({{$buynow->id}},this)">
  <label class="ml-20" for="shipping:save_in_address_book">Same as Billing Address</label>
        {!! Form::open(array('id' => 'save_shipping_address_form')) !!}
          <fieldset class="group-select">
            <ul>
              @if(Auth::user())
                <li>
                  <label for="billing-address-select">Select a billing address from your address book or enter a new address.</label>
                  <br>
                  <select name="billing_address_id" id="billing-address-select" class="address-select" title="" onChange="select_saved_address(this.value,'shipping')">
                    <option>Select an saved address</option>
                  @foreach($addresses as $address)
                    <option value="{{$address->id}}">{{$address->first_name}}, {{$address->last_name}}, {{$address->email}}, {{$address->mobile}}, {{$address->pincode}}</option>
                  @endforeach
                    <option value="">New Address</option>
                  </select>
                </li>
              @endif
              <li id="billing-new-address-form">
                <fieldset>
                  <input type="hidden" name="buynowid" value="{{$buynow->id}}">
                  <ul>
                    <li>
                      <div class="customer-name">
                        <div class="input-box name-firstname">
                          <label for="billing:firstname"> First Name <span class="required">*</span> </label>
                          <br>
                          <input type="text" id="shipping_first_name" name="shipping_first_name" value="" title="First Name" class="input-text required-entry">
                        </div>
                        <div class="input-box name-lastname">
                          <label for="billing:lastname"> Last Name <span class="required">*</span> </label>
                          <br>
                          <input type="text" id="shipping_last_name" name="shipping_last_name" value="" title="Last Name" class="input-text required-entry">
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="input-box">
                        <label for="billing:email">Email <span class="required">*</span> </label>
                        <br>
                        <input type="text" id="shipping_email" name="shipping_email" value="" title="Email" class="input-text">
                      </div>
                      <div class="input-box">
                        <label for="billing:mobile">Mobile <span class="required">*</span> </label>
                        <br>
                        <input type="text" id="shipping_mobile" name="shipping_mobile" value="" title="Mobile" class="input-text">
                      </div>
                    </li>
      <li>
        <div class="input-box">
                        <label for="billing:postcode">PinCode <span class="required">*</span></label>
                        <br>
                        <input type="text" title="Zip/Postal Code" name="shipping_pincode" id="shipping_pincode" value="" class="input-text validate-zip-international required-entry">
                      </div>
        <div id="" class="input-box">
                        <label for="billing:region">State/Province <span class="required">*</span></label>
                        <br>
                        <input type="text" id="shipping_state" name="shipping_state" value="Alabama" title="State/Province" class="input-text required-entry" style="display: block;">
                  
                        <input type="text" id="" name="" value="" title="State/Province" class="input-text required-entry" style="display: none;">
                      </div>
      </li>
      <li>
        <div class="input-box">
                        <label for="billing:city">City <span class="required">*</span></label>
                        <br>
                        <input type="text" title="City" name="shipping_city" value="" class="input-text required-entry" id="shipping_city">
                      </div>
        <div class="input-box">
                        <label for="billing:country_id">Country <span class="required">*</span></label>
                        <br>
                        <input type="text" id="shipping_country" name="shipping_country" value="" title="State/Province" class="input-text required-entry" style="display: block;">
                      </div>
      </li>
                    <li>
                      <label for="billing:street1">Address <span class="required">*</span></label>
                      <br>
                      <textarea name="shipping_street_address" id="shipping_street_address" title="Comment" class="required-entry input-text textarea-resize" cols="5" rows="3"></textarea>
                    </li>
                    
                  </ul>
                </fieldset>
              </li>
            </ul>
            <p class="require"><em class="required">* </em>Required Fields</p>
            <button type="button" class="button continue" onClick="saveShippingAddress()"><span>Continue</span></button>
          </fieldset>
        {!! Form::close() !!}