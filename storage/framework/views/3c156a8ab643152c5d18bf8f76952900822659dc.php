<?php $__env->startSection('meta'); ?>

<meta name="title" content="kibakibi">
<meta name="description" content="ecommerece, products, online buy product">
<meta name="author" content="TechTurtle">
  
  <style type="text/css">
   .select-text{
    background: #fff;
    border: 1px solid #f0f0f0;
    padding: 10px;
    width: 80%;
    margin-top: 5px;
    outline: none;
    margin-bottom: 10px;
}
.select-text:focus{
  padding:10px;
}
@media  only screen and (max-width:767px){
  .account-login .col2-set .col-1{
    border-right:0 !important;
    min-height:0px !important;
  }
}
@media  only screen and (min-width:768px){
.account-login .col2-set .col-1{
  min-height:631px !important;
}
}
.account-login .col2-set .col-2{
  margin-bottom:15px;
}
  </style>
<?php $__env->stopSection(); ?>

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
                <a href="<?php echo url('login'); ?>" class="button create-account" type="button"><span>Login</span></a>
              </div>
            </div>
          </div>
          <form method="post" role="form" action="<?php echo e(url('/register')); ?>">
          <?php echo csrf_field(); ?>

          <div class="col-2 registered-users"><strong>New Customers</strong>
            <div class="content">
              <!--<p>If you have an account with us, please log in.</p>-->
              <ul class="form-list">
                <li>
                  <label for="name">Name <span class="required">*</span></label>
                  <br>
                  <input type="text" title="Name" class="input-text required-entry" id="name" name="name" value="<?php echo e(old('name')); ?>">
                </li>
        <li>
                  <label for="mobile">Mobile <span class="required">*</span></label>
                  <br>
                  <input type="text" title="Email Address" class="input-text required-entry" id="mobile" name="mobile" value="<?php echo e(old('mobile')); ?>">
                </li>
        <li>
                  <label for="email">Email Address <span class="required">*</span></label>
                  <br>
                  <input type="text" title="Email Address" class="input-text required-entry" id="email" name="email" value="<?php echo e(old('email')); ?>">
                </li>
                <li>
                  <label for="gender">Gender <span class="required">*</span></label>
                  <br>
                    <select name="gender" class="select-text required-entry">
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                </li>
                <li>
                  <label for="pass">Password <span class="required">*</span></label>
                  <br>
                  <input type="password" title="Password" id="pass" class="input-text required-entry validate-password" name="password">
                  <?php if($errors->has('password')): ?>
                      <p class="required">
                          <?php echo e($errors->first('password')); ?>

                      </p>
                  <?php endif; ?>
                </li>
        <li>
                  <label for="conpass">Confirm Password <span class="required">*</span></label>
                  <br>
                  <input type="password" title="Confirm Password" id="conpass" class="input-text required-entry validate-password" name="password_confirmation">
                  <?php if($errors->has('password_confirmation')): ?>
                      <p class="required">
                          <?php echo e($errors->first('password_confirmation')); ?>

                      </p>
                  <?php endif; ?>
                </li>
              </ul>
              <p class="required">* Required Fields</p>
              <div class="buttons-set">
                <button id="send2" name="send" type="submit" class="button login"><span>Register</span></button></div>
            </div>
          </div>
          </form>
        </fieldset>
      </div>
      <br>
      <br>
      <br>
      <br>
      <br>
    </div>
  </section>
  <script>
function switchVisible() {
            if (document.getElementById('register')) {

                if (document.getElementById('register').style.display == 'none') {
                    document.getElementById('register').style.display = 'block';
                    document.getElementById('login').style.display = 'none';
                }
                else {
                    document.getElementById('register').style.display = 'none';
                    document.getElementById('login').style.display = 'block';
                }
            }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layouts/front_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>