<!-- mobile menu -->
<div id="mobile-menu">
  <ul>
    <li>
      <div class="mm-search">
        <form id="search1" name="search">
          <div class="input-group">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> </button>
            </div>
            <input type="text" class="form-control simple" placeholder="Search ..." name="srch-term" id="srch-term">
          </div>
        </form>
      </div>
    </li>
    <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
    <li><a href="<?php echo e(url('products?catid=1')); ?>">Electronics</a></li>
	<li><a href="<?php echo e(url('products?catid=3')); ?>">Men</a></li>
	<li><a href="<?php echo e(url('products?catid=7')); ?>">Women</a></li>
	<li><a href="<?php echo e(url('products?catid=8')); ?>">Baby & Kids</a></li>
	<li><a href="<?php echo e(url('products?catid=1383')); ?>">Home & Kitchen</a></li>
	<li><a href="<?php echo e(url('products?catid=1589')); ?>">Health & Sports</a></li>
	<li><a href="<?php echo e(url('products?catid=1590')); ?>">Books & Media</a></li>
	<li><a href="<?php echo e(url('products?catid=776')); ?>">Automotive</a></li>

   
    
  </ul>
  <div class="top-links">
    <ul class="links">
    <?php if(Auth::user()): ?>
      <li><a title="My Account" href="javascript:;">My Account</a> </li>
      <li><a title="Wishlist" href="javascript:;">Wishlist</a> </li>
      <li><a title="Checkout" href="javascript:;">Checkout</a> </li>
      <?php if(Auth::user()->user_type == 'admin'): ?>
      <li><a title="Blog" href="<?php echo e(url(ADMIN_URL_PATH)); ?>">Seller Portal</a> </li>
      <?php endif; ?>
      <li><a title="Blog" href="<?php echo e(url('/logout')); ?>">Logout</a> </li>
    <?php else: ?>
      <li class="last"><a title="Login" href="<?php echo e(url('/login')); ?>">Login</a> </li>
    <?php endif; ?>
    </ul>
  </div>
</div>
