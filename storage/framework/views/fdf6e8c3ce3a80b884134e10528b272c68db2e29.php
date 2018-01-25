<?php $__env->startSection('content'); ?>
  <section class="main-container col1-layout">
    <div class="main container">
      <div class="account-login">
        <div class="page-title">
          <h2>Login or Create an Account</h2>
        </div>
        <fieldset class="col2-set">
          <div class="col-1 new-users"><strong>New Customers</strong>
            <div class="content">
              <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
              <div class="buttons-set">
                <a href="<?php echo url('register'); ?>" class="button create-account" type="button"><span>Create an Account</span></a>
              </div>
            </div>
          </div>
          <?php echo Form::open(); ?>

          <div class="col-2 registered-users"><strong>Registered Customers</strong>
            <div class="content">
              <p>If you have an account with us, please log in.</p>
              <ul class="form-list">
                <li>
                  <label for="email">Email Address <span class="required">*</span></label>
                  <br>
                  <input type="text" title="Email Address" class="input-text required-entry" id="email" value="<?php echo e(old('email')); ?>" name="email">
                  <?php if($errors->has('email')): ?>
                      <span class="help-block required">
                          <?php echo e($errors->first('email')); ?>

                      </span>
                  <?php endif; ?>
                </li>
                <li>
                  <label for="pass">Password <span class="required">*</span></label>
                  <br>
                  <input type="password" title="Password" id="pass" class="input-text required-entry validate-password" name="password">
                  <?php if($errors->has('password')): ?>
                      <span class="help-block required">
                          <?php echo e($errors->first('password')); ?>

                      </span>
                  <?php endif; ?>
                </li>
              </ul>
              <!-- <p class="required">* Required Fields</p> -->
              <div class="buttons-set">
                <button name="get_login" type="submit" class="button login"><span>Login</span></button>
                <a class="forgot-word" href="javascript:;">Forgot Your Password?</a> </div>
            </div>
          </div>
          <?php echo Form::close(); ?>

        </fieldset>
      </div>
      <br>
      <br>
      <br>
      <br>
      <br>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layouts/front_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>