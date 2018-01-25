<?php echo Form::open(array('id' => 'save_billing_address_form')); ?>

<div class="alert alert-success hidden" id="billing_address_alert">

</div>
<fieldset class="group-select">
  <ul>
  <?php if(Auth::user()): ?>
    <li>
      <label for="billing-address-select">Select a billing address from your address book or enter a new address.</label>
      <br>
      <select name="billing_address_id" id="billing-address-select" class="address-select" title="" onChange="select_saved_address(this.value,'billing')">
        <option>Select an saved address</option>
      <?php foreach($addresses as $address): ?>
        <option value="<?php echo e($address->id); ?>"><?php echo e($address->first_name); ?>, <?php echo e($address->last_name); ?>, <?php echo e($address->email); ?>, <?php echo e($address->mobile); ?>, <?php echo e($address->pincode); ?></option>
      <?php endforeach; ?>
        <!-- <option value="">New Address</option> -->
      </select>
    </li>
  <?php endif; ?>

    <li id="billing-new-address-form">
      <fieldset>
        <input type="hidden" name="buynowid" value="<?php echo e($buynow->id); ?>">
        <ul>
          <li>
            <div class="customer-name">
              <div class="input-box name-firstname">
                <label for="billing:firstname"> First Name <span class="required">*</span> </label>
                <br>
                <input type="text" id="billing_first_name" name="billing_first_name" value="<?php echo e($buynow->billing_first_name); ?>" title="First Name" class="input-text required-entry">
              </div>
              <div class="input-box name-lastname">
                <label for="billing:lastname"> Last Name <span class="required">*</span> </label>
                <br>
                <input type="text" id="billing_last_name" name="billing_last_name" value="<?php echo e($buynow->billing_last_name); ?>" title="Last Name" class="input-text required-entry">
              </div>
            </div>
          </li>
          <li>
            <div class="input-box name-firstname">
              <label for="billing:email">Email <span class="required">*</span> </label>
              <br>
              <input type="text" id="billing_email"  name="billing_email" value="<?php echo e($buynow->billing_email); ?>" title="Email" class="input-text">
            </div>
            <div class="input-box name-lastname">
              <label for="billing:mobile">Mobile <span class="required">*</span> </label>
              <br>
              <input type="text" id="billing_mobile" name="billing_mobile" value="<?php echo e($buynow->billing_mobile); ?>" title="Mobile" class="input-text">
            </div>
          </li>
<li>
<div class="input-box">
              <label for="billing:postcode">PinCode <span class="required">*</span></label>
              <br>
              <input type="text" title="Zip/Postal Code" name="billing_pincode" id="billing_pincode" value="<?php echo e($buynow->billing_pincode); ?>" class="input-text validate-zip-international required-entry">
            </div>
<div id="" class="input-box">
              <label for="billing:region">State/Province <span class="required">*</span></label>
              <br>
              <input type="text" name="billing_state" id="billing_state" value="<?php echo e($buynow->billing_state); ?>" title="State/Province" class="input-text required-entry">
        
              <input type="text" id="billing:region" value="Alabama" title="State/Province" class="input-text required-entry" style="display: none;">
            </div>
</li>
<li>
<div class="input-box">
              <label for="billing:city">City <span class="required">*</span></label>
              <br>
              <input type="text" title="City" name="billing_city" value="<?php echo e($buynow->billing_city); ?>" class="input-text required-entry" id="billing_city">
            </div>
<div class="input-box">
              <label for="billing:country_id">Country <span class="required">*</span></label>
              <br>
              <input type="text" title="Country" name="billing_country" value="<?php echo e($buynow->billing_country); ?>" class="input-text required-entry" id="billing_country">
            </div>
</li>
          <li>
            <label for="billing:street1">Address <span class="required">*</span></label>
            <br>
            <textarea name="billing_street_address"  id="billing_street_address" title="Address" resizable="none" class="required-entry input-text textarea-resize" cols="5" rows="3"><?php echo e($buynow->billing_street_address); ?></textarea>
          </li>
        </ul>
      </fieldset>
    </li>
  </ul>
  <p class="require"><em class="required">* </em>Required Fields</p>
  <button type="button" id="submit_billing_address_form" onclick="saveBillingAddress()" class="button continue"><span>Continue</span></button>
</fieldset>
<?php echo Form::close(); ?>