<header>
    <div class="header-container">
      <div class="header-top">
        <div class="container">
          <div class="row"> 
            <!-- Header Language -->
            <div class="col-xs-12 col-sm-6">
              <div class="welcome-msg">Welcome <?php echo e(Auth::user() ? Auth::user()->name : 'Guest'); ?> </div>
            </div>
            <div class="col-xs-6 hidden-xs"> 
              <!-- Header Top Links -->
              <div class="toplinks">
                <div class="links">
                <?php if(Auth::user()): ?>
                  <!-- <div class="myaccount"><a title="My Account" href="javascript:;"><span class="hidden-xs">My Account</span></a> </div>
                  <div class="check"><a title="Checkout" href="checkout.html"><span class="hidden-xs">Checkout</span></a> </div>
                  <div class="demo"><a title="Blog" href="blog.html"><span class="hidden-xs">Blog</span></a> </div> -->
                  <div class="demo"><a title="Blog" href="<?php echo e(url('/user/orders')); ?>"><span class="hidden-xs">My Orders</span></a> </div>
                  <?php if(Auth::user()->user_type == 'admin'): ?>
                    <div class="demo"><a title="Blog" href="<?php echo e(url(ADMIN_URL_PATH)); ?>"><span class="hidden-xs">Admin Dashboard</span></a> </div>
                  <?php endif; ?>
                  <div class="demo"><a title="Blog" href="<?php echo e(url('/logout')); ?>"><span class="hidden-xs">Logout</span></a> </div>
                <?php else: ?>
                  <div class="login"><a href="<?php echo e(url('/login')); ?>"><span class="hidden-xs">Log In</span></a> </div>
                <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 logo-block"> 
            <!-- Header Logo -->
            <?php if(isset($logo)): ?>
            <div class="logo"> <a title="<?php echo e(PROJECT_NAME); ?>" href="<?php echo ($logo->link != '') ? $logo->link : url('/'); ?>"><img alt="<?php echo e(PROJECT_NAME); ?>" src="<?php echo url('product_images/banners/', [$logo->image]); ?>"> </a> </div>
            <?php else: ?>
            <?php $logo = DB::table('banner')->where('cid', 1)->where('status', 1)->first(); ?>
            <div class="logo"> <a title="<?php echo e(PROJECT_NAME); ?>" href="<?php echo ($logo->link != '') ? $logo->link : url('/'); ?>"><img alt="<?php echo e(PROJECT_NAME); ?>" src="<?php echo url('product_images/banners/', [$logo->image]); ?>"> </a> </div>
            <?php endif; ?>
            <!-- End Header Logo --> 
          </div>
          <div class="col-lg-5 col-md-4 col-sm-4 col-xs-12 hidden-xs">
            <?php echo $__env->make('front/search/search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <a href="<?php echo e(url('/wishlist')); ?>" title="My Wishlist" class="top-link-wishlist hidden-xs"><i class="fa fa-heart"></i></a>
            <?php echo $__env->make('front/cart/header/cart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          </div>
        </div>
      </div>
    </div>
    
    <!-- end header --> 
    
    <!-- Navigation -->
    <nav>
      <div class="container">
        <div class="mm-toggle-wrap">
          <div class="mm-toggle"><i class="fa fa-bars"></i><span class="mm-label">Menu</span> </div>
        </div>
        <div class="nav-inner"> 
          <!-- BEGIN NAV -->
          <?php echo $__env->make('front/common/nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>          
        </div>
      </div>
    </nav>
    <!-- end nav --> 
  </header>
