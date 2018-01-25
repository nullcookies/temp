<!DOCTYPE html>
<html>
<head>
<title>Kibakibi Mobile</title>
<link rel="icon" href="http://www.kibakibipoint.com/img/favicon.png"/>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<script src="{{asset('js/jquery-1.11.3.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/jquery.mobile-1.4.5.min.css')}}">
<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('css/styleMobile.css')}}">
<script src="{{asset('js/jquery.mobile-1.4.5.min.js')}}"></script>
</head>
<body>

<div data-role="page" id="pageone">
 <div data-role="header">
    <div class="topheader">
		<ul class="headerlist">
      @if(Auth::user())
			<li><a target="_blank" href="{{url('user/orders')}}"><i class="fa fa-user"></i> My Orders</a></li>
			<li><a target="_blank" href="{{url('/cart')}}"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
      <li><a href="{{url('/logout')}}"><i class="fa fa-lock"></i> Logout</a></li>
      @else
			<li><a href="{{url('/login')}}"><i class="fa fa-lock"></i> Login</a></li>
      @endif
		</ul>
		<img src="images/logo.png" class="pd-10">
		<form class="pd-10 lr-15">
			<input type="text" placeholder="Search Here"><button class="searchbtn"><i class="fa fa-search"></i></button>
		</form>
		<div class="cartdiv">
			<h3><a target="_blank" href="{{url('/cart')}}" style="color: white;"><i class="fa fa-shopping-cart"></i></a> <span class="cartno">{{$cartCount}}</span></h3>
		</div>
  	</div>
</div>
  <div data-role="main" class="ui-content">
    <div data-role="collapsibleset">
    <h2>Categories</h2>
    @foreach($navCategories as $categoryLevel1)
      <div data-role="collapsible" id="my-collapsible">
        <h3 class="mthin">{{$categoryLevel1['name']}}</h3>
        <ul data-role="listview">
          @foreach($categoryLevel1['childs'] as $categoryLevel2)
  	      <li><a target="_blank" href="{{url('products?catid='.$categoryLevel2['category_id'])}}">{{$categoryLevel2['name']}}</a>
          </li>
          @endforeach
	      </ul>
      </div>
    @endforeach
    </div>
    <a href="#">
    	<img src="images/banner1.png" class="pd-10" width="100%">
    </a>
    <a href="#">
    	<img src="images/banner2.png" class="pd-10" width="100%">
    </a>	
    <div class="ui-grid-a">
      <div class="ui-block-a pd0510">
        <a href="#" class="imagebox">
        	<img src="images/1.jpg" style="width:100%;position: inherit;">
        	<h4 class="imagetext">New Dresses</h4>
        </a>	
      </div>
      <div class="ui-block-b pd1005">
        <a href="#" class="imagebox">
        	<img src="images/2.jpg" style="width:100%;position: inherit;">
        	<h4 class="imagetext">New Dresses</h4>
        </a>
    </div>  
  </div>
  <div class="ui-grid-a">
      <div class="ui-block-a pd0510">
        <a href="#" class="imagebox">
        	<img src="images/3.jpg" style="width:100%;position: inherit;">
        	<h4 class="imagetext">New Dresses</h4>
        </a>	
      </div>
      <div class="ui-block-b pd1005">
        <a href="#" class="imagebox">
        	<img src="images/4.jpg" style="width:100%;position: inherit;">
        	<h4 class="imagetext">New Dresses</h4>
        </a>
    </div>  
  </div>
  <a href="#">
 	<img src="images/banner3.png" class="pd-10" width="100%">
  </a>
  <a href="#">
  	<img src="images/banner4.png" class="pd-5" width="100%">
  </a>
  <a href="#">	
  	<img src="images/banner5.png" class="pd-5" width="100%">
  </a>
  <a href="#">	
  	<img src="images/banner6.png" class="pd-5" width="100%">
  </a>
  <a href="#">
  	<img src="images/banner7.png" class="pd-5" width="100%">
  </a>
  <a href="#">
  	<img src="images/banner8.png" class="pd-ban" width="100%">
  </a>	
    <ul data-role="listview" style="padding:15px; ">
      @if(Auth::user())
      <li><a target="_blank" href="{{url('/url')}}">Cart</a></li>
      <li><a target="_blank" href="{{url('/logout')}}">Logout</a></li>
      @else
      <li><a href="{{url('/login')}}">Login</a></li>
      @endif
      <li><a href="#">Customer Service</a></li>
      <li><a href="#">Help</a></li>
    </ul>
  <div data-role="footer">
    <h1>2017 Kibakibi.com</h1>
  </div>
</div> 
<script>
</script>
</body>
</html>
