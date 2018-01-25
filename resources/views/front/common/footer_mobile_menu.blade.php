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
    <li><a href="{{url('/')}}">Home</a></li>
    <li><a href="{{url('products?catid=1')}}">Electronics</a></li>
	<li><a href="{{url('products?catid=3')}}">Men</a></li>
	<li><a href="{{url('products?catid=7')}}">Women</a></li>
	<li><a href="{{url('products?catid=8')}}">Baby & Kids</a></li>
	<li><a href="{{url('products?catid=1383')}}">Home & Kitchen</a></li>
	<li><a href="{{url('products?catid=1589')}}">Health & Sports</a></li>
	<li><a href="{{url('products?catid=1590')}}">Books & Media</a></li>
	<li><a href="{{url('products?catid=776')}}">Automotive</a></li>

   
    
  </ul>
  <div class="top-links">
    <ul class="links">
    @if(Auth::user())
      <li><a title="My Account" href="javascript:;">My Account</a> </li>
      <li><a title="Wishlist" href="javascript:;">Wishlist</a> </li>
      <li><a title="Checkout" href="javascript:;">Checkout</a> </li>
      @if(Auth::user()->user_type == 'admin')
      <li><a title="Blog" href="{{url(ADMIN_URL_PATH)}}">Seller Portal</a> </li>
      @endif
      <li><a title="Blog" href="{{url('/logout')}}">Logout</a> </li>
    @else
      <li class="last"><a title="Login" href="{{url('/login')}}">Login</a> </li>
    @endif
    </ul>
  </div>
</div>
