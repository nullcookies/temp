<header>
    <div class="header-container">
      <div class="header-top">
        <div class="container">
          <div class="row"> 
            <!-- Header Language -->
            <div class="col-xs-12 col-sm-6">
              <div class="welcome-msg">Welcome {{Auth::user() ? Auth::user()->name : 'Guest'}} </div>
            </div>
            <div class="col-xs-6 hidden-xs"> 
              <!-- Header Top Links -->
              <div class="toplinks">
                <div class="links">
                @if(Auth::user())
                  <!-- <div class="myaccount"><a title="My Account" href="javascript:;"><span class="hidden-xs">My Account</span></a> </div>
                  <div class="check"><a title="Checkout" href="checkout.html"><span class="hidden-xs">Checkout</span></a> </div>
                  <div class="demo"><a title="Blog" href="blog.html"><span class="hidden-xs">Blog</span></a> </div> -->
                  <div class="demo"><a title="Blog" href="{{url('/user/orders')}}"><span class="hidden-xs">My Orders</span></a> </div>
                  @if(Auth::user()->user_type == 'admin')
                    <div class="demo"><a title="Blog" href="{{url(ADMIN_URL_PATH)}}"><span class="hidden-xs">Admin Dashboard</span></a> </div>
                  @endif
                  <div class="demo"><a title="Blog" href="{{url('/logout')}}"><span class="hidden-xs">Logout</span></a> </div>
                @else
                  <div class="login"><a href="{{url('/login')}}"><span class="hidden-xs">Log In</span></a> </div>
                @endif
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
            @if(isset($logo))
            <div class="logo"> <a title="{{PROJECT_NAME}}" href="{!! ($logo->link != '') ? $logo->link : url('/') !!}"><img alt="{{PROJECT_NAME}}" src="{!! url('product_images/banners/', [$logo->image]) !!}"> </a> </div>
            @else
            <?php $logo = DB::table('banner')->where('cid', 1)->where('status', 1)->first(); ?>
            <div class="logo"> <a title="{{PROJECT_NAME}}" href="{!! ($logo->link != '') ? $logo->link : url('/') !!}"><img alt="{{PROJECT_NAME}}" src="{!! url('product_images/banners/', [$logo->image]) !!}"> </a> </div>
            @endif
            <!-- End Header Logo --> 
          </div>
          <div class="col-lg-5 col-md-4 col-sm-4 col-xs-12 hidden-xs">
            @include('front/search/search')
          </div>
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <a href="{{url('/wishlist')}}" title="My Wishlist" class="top-link-wishlist hidden-xs"><i class="fa fa-heart"></i></a>
            @include('front/cart/header/cart')
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
          @include('front/common/nav')          
        </div>
      </div>
    </nav>
    <!-- end nav --> 
  </header>
