<html>
<head>
<title>@yield('title') Massengers</title>

<!-- Meta --->

<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#d80003">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- Meta Ends --->
@yield('meta')
<link rel="icon" href="{{asset('massengers/img/favicon.PNG')}}"/>
<link rel="apple-touch-startup-image" href="{{asset('massengers/img/favicon.PNG')}}">
<link rel="stylesheet" href="{{asset('massengers/css/bootstrap.min.css')}}"/>
<link rel="stylesheet" href="{{asset('massengers/css/font-awesome.min.css')}}"/>
<link rel="stylesheet" href="{{asset('massengers/css/style.css')}}"/>
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="{{asset('massengers/css/owl.carousel.min.css')}}"/>
<link rel="stylesheet" href="{{asset('massengers/css/owl.theme.default.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link rel="stylesheet" href="{{asset('css/sweetalert.css')}}"/>
<link rel="stylesheet" href="{{asset('massengers/css/slimmenu.min.css')}}"/>

<!-- Global Site Tag (gtag.js) - Google Tag Manager -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-91285710-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-91285710-1');
</script>

<!-- Global Site Tag (gtag.js) - Google Tag Manager Ends -->

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '240500266409832');
fbq('track', 'PageView');
</script>
<noscript>
<img height="1" width="1"
src="https://www.facebook.com/tr?id=240500266409832&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->

<script src="{{ asset('js/share.js') }}"></script>

@yield('css')
</head>
<body>
<!-- Header Section Starts  -->
<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mess">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		</div>
		<a class="navbar-brand hidden-xs" href="{{url('/')}}" title="Massengers">
			<img src="{{asset('massengers/img/logo.png')}}" alt="Massengers"  class="logo-image"/>
		</a>
		<a class="navbar-brand hidden-lg hidden-md hidden-sm" title="Massengers" href="{{url('/')}}">
			<img src="{{asset('massengers/img/logo.png')}}" width="115" alt="Massengers" class="logo-image"/>
		</a>
		<div class="collapse navbar-collapse" id="mess">
			<ul class="nav navbar-nav navbar-left hidden-xs">
				<li class="side-none">
					<a href="{{url('/category/need-today')}}" title="Need Today" class="new-image">
						<img src="{{asset('massengers/img/time.png')}}" alt="Need Today"/>
						<p>Need Today</p>
					</a>
				</li>
				<li>
					<a href="{{url('/contact-us')}}" title="Help" class="new-image">
						<img src="{{asset('massengers/img/help.png')}}" alt="Help"/>
						<p>Help</p>
					</a>
				</li>
				<li>
					<a href="{{url('/corporate')}}" title="Corporate" class="new-image">
						<img src="{{asset('massengers/img/co.png')}}" alt="Corporate"/>
						<p>Corporate</p>
					</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right hidden-xs">
				<li>
					<a href="{{url('/track-order')}}" title="Track Order" class="new-image">
						<img src="{{asset('massengers/img/track.png')}}" alt="Track Order"/>
						<p>Track Order</p>
					</a>
				</li>
				@if(!Auth::user())
				<li>
					<!--<a href="#" data-toggle="modal" data-target="#myModal" class="new-image">
						<img src="{{asset('massengers/img/login.png')}}"/>
						<p>Login / Register</p>
					</a>-->
					<a href="{{url('/login')}}" title="Login/Register" class="new-image">
						<img src="{{asset('massengers/img/login.png')}}" alt="Login/Register"/>
						<p>Login / Register</p>
					</a>
				</li>
				@endif
				@if(Auth::user())
				<li class="login-hover">
					<a href="javascript:;" class="new-image" title="Profile">
						<!--<i class="fa fa-user" style="font-size: 35px;color: #D80003;"></i>-->
						<img src="{{asset('massengers/img/login-user.png')}}" height="36"/>
						<p class="user-name">Hi {{substr(Auth::user()->name,0,15)}}</p>
					</a>
					<ul class="hover">
						<li><a href="{{url('/profile')}}" title="View Profile">View Profile</a></li>
						<li><a href="{{url('/logout')}}" title="Logout">Logout</a></li>
					</ul>
				</li>
				@endif
				<li>
					<!--<a href="javascript:;" id="cart" class="new-image">
						<img src="{{asset('massengers/img/cart.png')}}"/>
						<p>Cart</p>
					</a>-->
					<a href="{{url('/cart')}}" title="Check Your Cart" id="" class="new-image">
						<img src="{{asset('massengers/img/cart.png')}}" alt="Cart"/>
						<p>Cart</p>
						 
						 <?php 
						    if(Auth::guest()){
                                $user_id = app('request')->session()->getId();
                            }else{
                                $user_id = Auth::user()->id;
                            }
						 
						   $count = App\Models\Cart\Cart::join('product','product.id','=','cart.product_id')->leftJoin('product_images','product_images.product_id','=','cart.product_id')->where('product_images.default_image','yes')->where('cart.user_id', $user_id)->select('cart.*','product.product_name','product.product_selling_price','product_images.image')->groupBy('cart.id')->get();
						 ?>
						
						<div id="cart_count_span" class="cart-add">{{count($count)}}</div>
					</a>
				</li>
				
			</ul>
			<!--<ul class="nav navbar-nav navbar-right hidden-sm hidden-md hidden-lg">
			    <li>
					<a href="{{url('/need-today')}}" class="new-image">
						<img src="{{asset('massengers/img/time.png')}}"/>
						<p>Need Today</p>
					</a>
				</li>
				<li>
					<a href="{{url('/help')}}" class="new-image">
						<img src="{{asset('massengers/img/help.png')}}"/>
						<p>Help</p>
					</a>
				</li>
				<li>
					<a href="{{url('/track-order')}}" class="new-image">
						<img src="{{asset('massengers/img/track.png')}}"/>
						<p>Track Order</p>
					</a>
				</li>
				@if(!Auth::user())
				<li>
					<a href="#" data-toggle="modal" data-target="#myModal" class="new-image">
						<img src="{{asset('massengers/img/login.png')}}"/>
						<p>Login / Register</p>
					</a>
				</li>
				@endif
				@if(Auth::user())
				<li>
					<a href="javascript:;" class="new-image">
						<!--<i class="fa fa-user" style="font-size: 35px;color: #D80003;"></i>-->
						<!--<img src="{{asset('massengers/img/login-user.png')}}" height="36"/>
						<p>Hi {{substr(Auth::user()->name,0,15)}}</p>
					</a>
				</li>
				@endif
				
				<li>
					<a href="{{url('cart')}}" onclick="toggle_visibility('hideme')" class="new-image">
						<img src="{{asset('massengers/img/cart.png')}}"/>
						<p>Cart</p>
					</a>
				</li>
				
			</ul>-->
		</div>
	</div>	
</nav>
<div class="container center">
	<ul class="nav navbar-nav mob-menu hidden-sm hidden-md hidden-lg">
		<li>
			<a href="{{url('/category/need-today')}}" class="new-image">
				<img src="{{asset('massengers/img/time.png')}}"/>
				<p>Need Today</p>
			</a>
		</li>
		<li>
			<a href="{{url('/contact-us')}}" class="new-image">
				<img src="{{asset('massengers/img/help.png')}}"/>
				<p>Help</p>
			</a>
		</li>
		<li>
			<a href="{{url('/track-order')}}" class="new-image">
				<img src="{{asset('massengers/img/track.png')}}"/>
				<p>Track Order</p>
			</a>
		</li>
		@if(!Auth::user())
		<li>
			<a href="{{url('/login')}}" class="new-image">
				<img src="{{asset('massengers/img/login.png')}}"/>
				<p>Login / Register</p>
			</a>
		</li>
		@endif
		@if(Auth::user())
		<li>
			<a href="{{url('profile')}}" class="new-image">
				<!--<i class="fa fa-user" style="font-size: 35px;color: #D80003;"></i>-->
				<img src="{{asset('massengers/img/login-user.png')}}" class="after-login"/>
				<p class="mobile-user-name">Hi {{substr(Auth::user()->name,0,15)}}</p> 
			</a>
		</li>
		@endif
		
		<li>
			<a href="{{url('cart')}}" onclick="toggle_visibility('hideme')" class="new-image">
				<img src="{{asset('massengers/img/cart.png')}}"/>
				<p>Cart</p>
			</a>
		</li>
	</ul>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<div class="container">
			<h4>Login/Sign Up</h4>
			<div class="col-md-4 col-xs-12 login-section">
				<h5>Login</h5>
				<div id="login-errors" class="alert hidden alert-danger fade in alert-dismissable">
				</div>
				<form class="login-form" id="login-form" method="post" action="{{url('/ajaxLogin')}}">
				{!! csrf_field() !!}
                    <div class="form-group">
                        <div class="col-xs-12 pd-10">
                            <label for="email" class="col-md-4">Email</label>
                            <input type="text" class="formInput" id="email" name="email"><br/>
                        </div>
                        <div class="col-xs-12 pd-10">
                            <label for="phone" class="col-md-4">Password</label>
                            <input type="password" class="formInput" name="password">
                        </div>
                    </div>
					<br/>
                    <div class="form-group">
                        <div class="col-xs-12">
							<center>
								<button type="submit" id="login-btn" class="my-button">Submit</button>
							</center>
                        </div>
                    </div>
					<div class="form-group">
                        <div class="col-xs-12">
							<center>
								<a href="javascript:;" class="fgtpwd">Forgot Password</a>
							</center>
                        </div>
                    </div>
                </form>
			</div>
			<div class="col-md-4 col-xs-12 signup-section">
				<h5>Sign Up</h5>
				<div id="signup-errors" class="alert hidden alert-danger fade in alert-dismissable">
				</div>
				<form class="signup-form" id="signup-form" method="post" action="{{url('/register')}}">
				{{csrf_field()}}
                    <div class="form-group">
						<div class="col-xs-12 pd-10">
                            <label for="name" class="col-md-4">Name</label>
                            <input type="text" class="formInput" id="name" name="name"><br>
                            <!-- <span>error</span> -->
                        </div>
                        <div class="col-xs-12 pd-10">
                            <label for="email" class="col-md-4">Email</label>
                            <input type="text" class="formInput" id="email" name="email"><br>
                            <!-- <span>error</span> -->
                        </div>
                        <div class="col-xs-12 pd-10">
                            <label for="password" class="col-md-4">Password</label>
                            <input type="password" class="formInput" name="password"><br>
                            <!-- <span>error</span> -->
                        </div>
						<div class="col-xs-12 pd-10">
                            <label for="rptpassword" class="col-md-4">Repeat Password</label>
                            <input type="password" class="formInput" name="password_confirmation"><br>
                            <!-- <span>error</span> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
							<center>
								<button type="submit" id="signup-btn" class="my-button-white">Submit</button>
							</center>
                        </div>
                    </div>
                </form>
			</div>

			<div class="col-md-4 col-xs-12">
			<!--<div class="row">
			    <div class="col-md-6 col-sm-6 col-xs-6">
			        <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-lg waves-effect waves-light btn-block google">Google+</a>
			    </div>
			    <div class="col-md-6 col-sm-6 col-xs-6">
			        <a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" class="btn btn-lg waves-effect waves-light btn-block github">Facebook</a>
			    </div>
			</div>-->

				 <center>
					<ul class="login-social">
					    <li>
							<a href="{{ route('social.redirect', ['provider' => 'google']) }}"><img src="{{asset('massengers/img/g+.png')}}
							"/></a>
						</li>
						<li>
							<a href="{{ route('social.redirect', ['provider' => 'facebook']) }}"><img src="{{asset('massengers/img/fb.png')}}"/></a>
						</li>
						<br/>
						
					</ul>
				</center> 
			</div>
		</div>
    </div>
  </div>
</div>
<div class="container-fluid section1 fixme">
	<div class="container section1-1">
		<div class="search-box">
			<form action="{{url('/search')}}" class="search-bar">
				<input type="text" name="q" placeholder="Search Products"/>
				<button type="submit" title="Search"><i class="fa fa-search"></i></button>
			</form>
			<!--<input type="text" placeholder="Search Products"/>
			<a href="#" class="search-btn"><i class="fa fa-search"></i></a>-->
		</div>
		<div class="service-box">
			<ul>
				<li>
					<a href="{{url('/')}}" title="Lovers Place">
						<img src="{{asset('massengers/img/loversplace.png')}}" alt="Lovers Place"/>
						<p>Lovers Place</p>
					</a>
				</li>
				<li>
					<a href="http://blog.massengers.com/" title="Massengers Blog">
						<img src="{{asset('massengers/img/lovemantra.png')}}" alt="Lovers Mantra"/>
						<p>Lovers Mantra</p>
					</a>
				</li>
				<li>
					<a href="{{url('/love-birds')}}" title="Love Birds">
						<img src="{{asset('massengers/img/love-birds.png')}}" alt="Love Birds"/>
						<p>Lovers Birds</p>
					</a>
				</li>
				<li>
					<a href="{{url('/love-confession-board')}}" title="Confess Your Love">
						<img src="{{asset('massengers/img/lcb.png')}}" alt="Love Confession Board"/>
						<p>Love Confession Board</p>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	<br/><br/>
	<form action="{{url('/search')}}" class="search-bar small-search-bar">
		<input type="text" name="q" placeholder="Search Products"/>
		<button type="submit"><i class="fa fa-search"></i></button>
	</form>
	<a href="{{url('/')}}">
		<i class="fa fa-heart"></i> Lovers Place
	</a>
	<a href="http://blog.massengers.com/">
		<i class="fa fa-heart"></i> Lovers Mantra
	</a>
	<a href="{{url('/love-birds')}}">
		<i class="fa fa-heart"></i> Lovers Birds
	</a>
	<a href="{{url('/love-confession-board')}}">
		<i class="fa fa-heart"></i> Love Confession Board
	</a>
	<a href="{{url('/corporate')}}">
		<i class="fa fa-heart"></i> Corporate
	</a>
</div>

<div id="main">
  <span class="mobile-services" id="mobile-services-toggle" onclick="openNav()">&#9776; Services</span>
  <a href="{{url('/love-confession-board')}}" class="hidelcb pull-right hidden-sm hidden-lg hidden-md"><img src="{{asset('massengers/img/confession-icon.png')}}" width="30"><span>Love Confession Board</span></a>
</div>

@include('massengers/common/navigation')
<?php 
	$homepagenav    =   new App\Http\Controllers\Admin\WebsiteSetting\HomepageNavController;
	$allCategories 	=	$homepagenav->fetchAllHomePageNav();
	$categories 	=	$homepagenav->getChildFromArray(0, $allCategories);
?>
<div class="container-fluid hidden-sm hidden-md hidden-lg" style="padding:0">
    <ul class="slimmenu" id="navigation">
        @foreach($categories as $categoryLevel1)
        <li>
            <a href="{{url('/category/'.$categoryLevel1['alias'])}}"><i class="fa fa-heart"></i> {{$categoryLevel1['name']}}</a>
            <ul>
                @foreach($categoryLevel1['childs'] as $categoryLevel2)
                <li>
                    <a href="{{url('/category/'.$categoryLevel2['alias'])}}"> {{$categoryLevel2['name']}}</a>
                    <ul>
                        @foreach($categoryLevel2['childs'] as $categoryLevel3)
                            <li><a href="{{url('/category/'.$categoryLevel3['alias'])}}">{{$categoryLevel3['name']}}</a></li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>
</div>
<!-- Header Section Ends  -->
<div class="minicartview">
	<h4 class="center">Items in Cart</h4>
	<ul>
		<li>
			<table class="table">
				<tbody>
					<td width="20%"><img src="{{asset('massengers/img/cake1.png')}}" width="50"></td>
					<td width="60%">
						<p>Cake 1</p>
						<p class="quantiti">Quantity: 1</p>
					</td>
					<td width="20%"><p><i class="fa fa-inr"></i> 200</p></td>
				</tbody>
			</table>
		</li>
		<li>
			<table class="table">
				<tbody>
					<td width="20%"><img src="{{asset('massengers/img/cake1.png')}}" width="50"></td>
					<td width="60%">
						<p>Cake 1</p>
						<p class="quantiti">Quantity: 1</p>
					</td>
					<td width="20%"><p><i class="fa fa-inr"></i> 200</p></td>
				</tbody>
			</table>
		</li>
		<li>
			<table class="table">
				<tbody>
					<td width="20%"><img src="{{asset('massengers/img/cake1.png')}}" width="50"></td>
					<td width="60%">
						<p>Cake 1</p>
						<p class="quantiti">Quantity: 1</p>
					</td>
					<td width="20%"><p><i class="fa fa-inr"></i> 200</p></td>
				</tbody>
			</table>
		</li>
	</ul>
	<a href="#" class="btn">Checkout</a>
	<!-- <div class="emptycart">
		<img src="img/empty-cart.png">
		<h4>Your Cart Is Empty</h4>
		<a href="#">Start Shopping Now</a>
	</div> -->
</div>

@yield('content')

<!-- Footer Section Starts  -->


<div class="container-fluid footer-section">
	<div class="container">
		<div class="row footer-details">
			<div class="col-md-4">
				<h4>Massengers</h4>
				<p class="message-title">Our online portal meets your everlasting desires for a perfect relationships. We help you maintain and cherish every moment with your loved ones. It&#39;s time to melt their heart and live life like never before.</p>
				<ul class="social">
					<li><a href=" https://www.facebook.com/MassengersOnline/" title="Facebook"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#" title="Twitter"><i class="fa fa-twitter"></i></a></li>
					<li><a href="#" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>
					<li><a href="https://www.instagram.com/love_with_massengers/" title="Instagram"><i class="fa fa-instagram"></i></a></li>
				</ul>
			</div>
			<div class="col-md-4 serivces-divs"> 
				<ul class="service-list">
					<li><a href="{{url('category/love-letters')}}" title="Love Letters">Love Letters</a></li>
					<li><a href="{{url('/category/cakes')}}" title="Delicious Cakes">Delicious Cakes</a></li>
					<li><a href="{{url('category/home-decorative')}}" title="Flower Bouquet">Flower Bouquet</a></li>
					<li><a href="{{url('/category/fan-mails')}}" title="Fan Mails">Fan Mail</a></li>
					<li><a href="{{url('category/parker-pens')}}" title="Parker Pens">Parker Pens</a></li>
					<li><a href="{{url('/love-confession-board')}}" title="Confess Your Love">Love Confession Board</a></li>
					<li class="pdl-60"><a href="{{url('/love-birds')}}" title="About Us">Love Birds</a></li>
					<li class="pdl-60"><a href="http://blog.massengers.com/" title="Massengers Blog">Love Mantra</a></li>
					<li class="pdl-60"><a href="{{url('/track-order')}}" title="Track Order">Track Order</a></li>
					<li class="pdl-60"><a href="{{url('/career')}}" title="Careers">Careers</a></li>
					<li class="pdl-60"><a href="{{url('/contact-us')}}" title="Contact Us">Contact Us</a></li>
					<!--<li class="pdl-60"><a href="{{url('/about-us')}}">About Us</a></li>-->
				</ul>
			</div>
			<div class="col-md-4 latest-news">
				<h3 class="c-white roboto-light ">Get latest news delivered daily</h3>
				<p>We will send you breaking news right into your inbox</p>
				<form class="subscribe" id="newsletter-form">
					<input type="text" placeholder="Enter your Email" name="email" />
					<button id="newsletter-btn" type="submit" title="Subscribe">Subscribe</button>
					<span id="loader-subs" style="color: #fff;"></span>
					<p id="subscription-msg" class="text-warning hidden">newsletter msg</p>
				</form>
				<img width="215" alt="Payment Accepted" src="{{asset('massengers/img/bank.png')}}"/>
			</div>
		</div>
		<div class="row row-footer">
			<center>
				<ul class="footer-terms">
					<li><a href="{{url('/terms-and-conditions')}}" title="Terms & Conditions">Terms &amp; Conditions</a></li>
					<li><a href="{{url('/disclaimer')}}" title="Disclaimer">Disclaimer </a></li>
					<li><a href="{{url('/privacy-policy')}}" title="Privacy Policy">Privacy Policy</a></li>
					<li><a href="javascipt:;" title="Sitemap">Sitemap</a></li>
				</ul>
			</center>
		</div>	
	</div>
</div>
<div class="container-fluid section12">
	<div class="container">
		<p>
			&copy; Copyright 2017 Massengers. All Rights Reserved
		</p>
	</div>
</div>
<a href="#" class="scrollToTop" title="Top of the Page"></a>

<div class="modal2 fade in" id="formnewsletter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content newsletter-content">
			<div class="modal-body text-center">
				<!--<button type="button" class="close close-btn" data-dismiss="modal2">&times;</button>-->
				<a href="javascript:;" class="close close-btn closeit">&times;</a>
				<h2 class="modal-title c-red">Welcome</h2>
				<h4>Signup to our newsletter below and get <span style="color:#d80003">10% Off</span> on your first order.</h4>
				<form class="subscribe" id="newsletter-form1">
					<input type="text" class="news-input" placeholder="Enter your Email" name="email" />
					<button id="newsletter-btn1" type="submit">Subscribe</button>
					<span id="loader-subs1" class="text-danger"></span>
					<p id="subscription-msg1" class="text-danger hidden">newsletter msg</p>
				</form>
				<h5>We respect your privacy. We will never share or sell your information.</h5>
					<a href="javascipt:;" class="c-red closeit">No Thanks, I want to pay full price.</a>
					<p>T&C apply</p>	
			</div>
		</div>
	</div>
</div>

<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-body center">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<br/>
			<h1 class="first-section">Hey, First time here ?</h1>
			<h4>Sign up to get notified on all things Blue &#33;</h4>
			<br/>
			<h3 class="also-section">Also, you get</h3>
			<h1 class="off-section">15&#37; OFF</h1>
			<h3>Use code &#58; Massengers15</h3>
			<br/>
			<h4>Valid for first time customers only</h4>
			<form>
				<input type="text" placeholder="Enter Email Address"/>
				<br/><br/>
				<button class="btn btn-join">Join Now</button>
			</form>
	  </div>
	</div>
  </div>
</div>
<div class="popup-notifier">
	<!--<a href="#" class="popup-close-btn"><img src="{{asset('massengers/img/delete-cross.png')}}"></a>
	<div class="popup-image">
		<img src="https://www.bettys.co.uk/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/h/a/happy-birthday-chocolate-cake-2000130_6.jpg" width="60px;">
	</div>
	<div class="popup-text">
		<h6>Manoj Ganesan from Namakkal,Tamil Nadu, India just bought <a href="#">Apple Creampie Cake with Flowers</a></h6>
	</div>-->
</div>
<!--<a href="#" class="scrollup" style="display: none;"></a>-->
<!--<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>-->
<!-- Footer Section Ends  -->		
<script src="{{asset('massengers/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('massengers/js/bootstrap.min.js')}}"></script>
<script src="{{asset('massengers/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('massengers/js/jquery.slimmenu.min.js')}}"></script>
<script src="{{asset('massengers/js/custom.js')}}"></script>
<script type="text/javascript" src="{{asset('massengers/js/common.js')}}"></script> 
<script type="text/javascript" src="{{asset('massengers/js/jquery.mobile-menu.min.js')}}"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> 
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script src="{{asset('js/notify.min.js')}}"></script>
<script type="text/javascript">
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
</script>

<script>
function toggle_visibility(id) {
    var e = document.getElementById(id);
    if (e.style.display == 'block' || e.style.display=='') e.style.display = 'none';
    else e.style.display = 'block';
}
</script>
<script>
	$( ".popup-close-btn" ).click(function() {
      $( ".popup-notifier" ).fadeOut( "slow", "linear" );
    });
</script>
<script type="text/javascript">
    //$(".popup-notifier").hide(0).delay(500).fadeIn(3000);
</script>
<script>
	$(document).ready(function(){
		$('#signup-form').on('submit', function(event){
			event.preventDefault();
			var formData = $(this).serialize();
			$.ajax({
				url : "{{url('/ajaxRegister')}}",
				type: 'POST',
				data: formData,
				dataType: 'json',
				beforeSend: function(){
					$('#signup-btn').html('<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>');
				},
				success: function(result){
					$('#signup-errors').addClass('hidden');
					$('#signup-form').trigger("reset");
					$('#signup-btn').html('Submit');
					swal('successfully registered','You can now Login using these credientials','success');
					//window.location.href = result.intended;
				},
				error: function(data){
					$('#signup-btn').html('Submit');
					errorsHtml = '';
					$.each(data.responseJSON, function(key, value) {
						if($.isArray(value)){
							errorsHtml += '<span>' + value[0] + '</span>';
						}else{
							errorsHtml += '<span>' + value + '</span>';
						}
						return false;
		            });

					$('#signup-errors').html(errorsHtml);
		            $('#signup-errors').removeClass('hidden');
				}
			});
		});


		$('#login-form').on('submit', function(event){
			event.preventDefault();
			var form_data = $(this).serialize();
			$.ajax({
				url : "{{url('/ajaxLogin')}}",
				type: 'POST',
				dataType: 'json',
				data: form_data,
				beforeSend: function(){
					$('#login-btn').html('<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>');
				},
				success: function(reult){
					$('#login-errors').addClass('hidden');
					window.location.href = reult.intended;
				},
				error: function(data){
					$('#login-btn').html('Submit');
					errorsHtml = '';
					$.each(data.responseJSON, function(key, value) {
						if($.isArray(value)){
							errorsHtml += '<span>' + value[0] + '</span>';
						}else{
							errorsHtml += '<span>' + value + '</span>';
						}
						return false;
		            });

					$('#login-errors').html(errorsHtml);
		            $('#login-errors').removeClass('hidden');
				}
			});
		});
	})
</script>


<script type="text/javascript">
	
	$(document).ready(function(){

		$('#newsletter-form').submit(function(event){
			event.preventDefault();
			var form_data = $(this).serialize();
			$.ajax({
				url : "{{url('/savenewsletter')}}",
				type: 'POST',
				dataType: 'json',
				data: form_data,
				beforeSend: function(){
					$('#loader-subs').html('<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>');
				},
				success: function(result){
					$('#loader-subs').html('');
					$('#subscription-msg').html(result['message']);
				},
				error: function(data){
					$('#loader-subs').html('');
					errorsHtml = '';
					$.each(data.responseJSON, function(key, value) {
						if($.isArray(value)){
							errorsHtml += '<span>' + value[0] + '</span>';
						}else{
							errorsHtml += '<span>' + value + '</span>';
						}
						return false;
		            });

					$('#subscription-msg').html(errorsHtml);
		            $('#subscription-msg').removeClass('hidden');
				}
			});
		});
	});

</script>
<script type="text/javascript">
	
	$(document).ready(function(){

		$('#newsletter-form1').submit(function(event){
			event.preventDefault();
			var form_data = $(this).serialize();
			$.ajax({
				url : "{{url('/savenewsletter')}}",
				type: 'POST',
				dataType: 'json',
				data: form_data,
				beforeSend: function(){
					$('#loader-subs1').html('<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>');
				},
				success: function(result){
					$('#loader-subs1').html('');
					$('#subscription-msg1').html(result['message']);
				},
				error: function(data){
					$('#loader-subs1').html('');
					errorsHtml = '';
					$.each(data.responseJSON, function(key, value) {
						if($.isArray(value)){
							errorsHtml += '<span>' + value[0] + '</span>';
						}else{
							errorsHtml += '<span>' + value + '</span>';
						}
						return false;
		            });

					$('#subscription-msg1').html(errorsHtml);
		            $('#subscription-msg1').removeClass('hidden');
				}
			});
		});
	});

</script>

@if(!Session::has('newsletter-shown') && !Auth::user())
    
    <script>
        $(document).ready(function(){
            $('#formnewsletter').modal('show');
        });
    </script>
    <script>
        $('.closeit').click(function(){
            $('#formnewsletter').modal('hide');
        });
    </script>
    {{ Session::put('newsletter-shown',1) }}
@endif

@yield('js')

<script>

$(document).ready(function(){
    setInterval(function(){
        $.ajax({
            url: "{{url('/getnotificationproducts')}}",
            type: "get",
            dataType: 'json',
            success: function(result){
                var image = "{{asset('massengers/img/delete-cross.png')}}";
                $('.popup-notifier').html('<a href="javascript:;" onclick="closeNotification()" class="popup-close-btn"><img src="'+image+'"></a><div class="popup-image"><img src="'+result['image_url']+'" height="50" width="50"></div><div class="popup-text"><h6>Someone recently purchased <br/><a href="'+result['url']+'">'+result['product_name']+'</a></h6></div>');
                $(".popup-notifier").hide(0).fadeIn(1000);
            }
        });
    },30000);
    
});


function closeNotification(){
    $(".popup-notifier").fadeOut( "slow", "linear" );;
}

/*$(document).ready(function(){
    setInterval(function(){
        $.ajax({
            url: "{{url('/getnotificationproducts')}}",
            type: "get",
            dataType: 'json',
            success: function(result){
                var image = "{{asset('massengers/img/delete-cross.png')}}";
                $('.popup-notifier').html('<a href="javascript:;" class="popup-close-btn"><img src="'+image+'"></a><div class="popup-image"><img src="'+result['image_url']+'" height="50" width="50px;"></div><div class="popup-text"><h6>Someone recently buyed <a href="'+result['url']+'">'+result['product_name']+'</a></h6></div>');
                $(".popup-notifier").hide(0).fadeIn(1000);
            }
        });
    },16000);
});*/

</script>
<script src="{{asset('js/jquery.jscroll.js')}}"></script>

<script type="text/javascript">
    $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: "<div class='fullwidth text-center'><i class='fa fa-circle-o-notch fa-spin load' style='font-size:30px;color:#D80003;margin-top:15px;'></i> </div>",
            padding: 20,
            debug: true,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>

<script type="text/javascript">
    /*$(function() {
        $('.infinite-scroll-confession').jscroll({
           autoTrigger: false,
           loadingHtml: "<div class='fullwidth text-center'><i class='fa fa-circle-o-notch fa-spin load' style='font-size:30px;color:#D80003;margin-top:15px;'></i> </div>",
        });
    });*/
    
    $(function() {
        $('ul.pagination').hide();
        $('.infinite-scroll-confession').jscroll({
           autoTrigger: true,
            loadingHtml: "<div class='fullwidth text-center'><i class='fa fa-circle-o-notch fa-spin load' style='font-size:30px;color:#D80003;margin-top:15px;'></i> </div>",
            padding: 20,
            debug: true,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll-confession',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        $('ul.pagination').hide();
        $('.infinite-scroll-confession-reply').jscroll({
           autoTrigger: true,
            loadingHtml: "<div class='fullwidth text-center'><i class='fa fa-circle-o-notch fa-spin load' style='font-size:30px;color:#D80003;margin-top:15px;'></i> </div>",
            padding: 20,
            debug: true,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll-confession-replyl',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>

<script type='text/javascript'>var fc_CSS=document.createElement('link');fc_CSS.setAttribute('rel','stylesheet');var fc_isSecured = (window.location && window.location.protocol == 'https:');var fc_lang = document.getElementsByTagName('html')[0].getAttribute('lang'); var fc_rtlLanguages = ['ar','he']; var fc_rtlSuffix = (fc_rtlLanguages.indexOf(fc_lang) >= 0) ? '-rtl' : '';fc_CSS.setAttribute('type','text/css');fc_CSS.setAttribute('href',((fc_isSecured)? 'https://d36mpcpuzc4ztk.cloudfront.net':'http://assets1.chat.freshdesk.com')+'/css/visitor'+fc_rtlSuffix+'.css');document.getElementsByTagName('head')[0].appendChild(fc_CSS);var fc_JS=document.createElement('script'); fc_JS.type='text/javascript'; fc_JS.defer=true;fc_JS.src=((fc_isSecured)?'https://d36mpcpuzc4ztk.cloudfront.net':'http://assets.chat.freshdesk.com')+'/js/visitor.js';(document.body?document.body:document.getElementsByTagName('head')[0]).appendChild(fc_JS);window.livechat_setting= 'eyJ3aWRnZXRfc2l0ZV91cmwiOiJtYXNzZW5nZXJzd2ViLmZyZXNoZGVzay5jb20iLCJwcm9kdWN0X2lkIjpudWxsLCJuYW1lIjoiTWFzc2VuZ2Vyc3dlYiIsIndpZGdldF9leHRlcm5hbF9pZCI6bnVsbCwid2lkZ2V0X2lkIjoiYTZiNzNhNjAtNDkxMC00YjhlLWFmODEtMjRmMGViOTdiMDNkIiwic2hvd19vbl9wb3J0YWwiOmZhbHNlLCJwb3J0YWxfbG9naW5fcmVxdWlyZWQiOmZhbHNlLCJsYW5ndWFnZSI6ImVuIiwidGltZXpvbmUiOiJFYXN0ZXJuIFRpbWUgKFVTICYgQ2FuYWRhKSIsImlkIjozMzAwMDA0NTM5MywibWFpbl93aWRnZXQiOjEsImZjX2lkIjoiODk5Yzk3NTY5MWE3MTViYzliYWU3ZGIyZmU3MzQ3NGQiLCJzaG93IjoxLCJyZXF1aXJlZCI6MiwiaGVscGRlc2tuYW1lIjoiTWFzc2VuZ2Vyc3dlYiIsIm5hbWVfbGFiZWwiOiJOYW1lIiwibWVzc2FnZV9sYWJlbCI6Ik1lc3NhZ2UiLCJwaG9uZV9sYWJlbCI6IlBob25lIiwidGV4dGZpZWxkX2xhYmVsIjoiVGV4dGZpZWxkIiwiZHJvcGRvd25fbGFiZWwiOiJEcm9wZG93biIsIndlYnVybCI6Im1hc3NlbmdlcnN3ZWIuZnJlc2hkZXNrLmNvbSIsIm5vZGV1cmwiOiJjaGF0LmZyZXNoZGVzay5jb20iLCJkZWJ1ZyI6MSwibWUiOiJNZSIsImV4cGlyeSI6MTUwNTk4OTgxOTAwMCwiZW52aXJvbm1lbnQiOiJwcm9kdWN0aW9uIiwiZW5kX2NoYXRfdGhhbmtfbXNnIjoiVGhhbmsgeW91ISEhIiwiZW5kX2NoYXRfZW5kX3RpdGxlIjoiRW5kIiwiZW5kX2NoYXRfY2FuY2VsX3RpdGxlIjoiQ2FuY2VsIiwic2l0ZV9pZCI6Ijg5OWM5NzU2OTFhNzE1YmM5YmFlN2RiMmZlNzM0NzRkIiwiYWN0aXZlIjoxLCJyb3V0aW5nIjpudWxsLCJwcmVjaGF0X2Zvcm0iOjEsImJ1c2luZXNzX2NhbGVuZGFyIjpudWxsLCJwcm9hY3RpdmVfY2hhdCI6MCwicHJvYWN0aXZlX3RpbWUiOm51bGwsInNpdGVfdXJsIjoibWFzc2VuZ2Vyc3dlYi5mcmVzaGRlc2suY29tIiwiZXh0ZXJuYWxfaWQiOm51bGwsImRlbGV0ZWQiOjAsIm1vYmlsZSI6MSwiYWNjb3VudF9pZCI6bnVsbCwiY3JlYXRlZF9hdCI6IjIwMTctMDgtMjFUMTA6MzI6NDUuMDAwWiIsInVwZGF0ZWRfYXQiOiIyMDE3LTA4LTIxVDEwOjMyOjQ5LjAwMFoiLCJjYkRlZmF1bHRNZXNzYWdlcyI6eyJjb2Jyb3dzaW5nX3N0YXJ0X21zZyI6IllvdXIgc2NyZWVuc2hhcmUgc2Vzc2lvbiBoYXMgc3RhcnRlZCIsImNvYnJvd3Npbmdfc3RvcF9tc2ciOiJZb3VyIHNjcmVlbnNoYXJpbmcgc2Vzc2lvbiBoYXMgZW5kZWQiLCJjb2Jyb3dzaW5nX2RlbnlfbXNnIjoiWW91ciByZXF1ZXN0IHdhcyBkZWNsaW5lZCIsImNvYnJvd3NpbmdfYWdlbnRfYnVzeSI6IkFnZW50IGlzIGluIHNjcmVlbiBzaGFyZSBzZXNzaW9uIHdpdGggY3VzdG9tZXIiLCJjb2Jyb3dzaW5nX3ZpZXdpbmdfc2NyZWVuIjoiWW91IGFyZSB2aWV3aW5nIHRoZSB2aXNpdG9y4oCZcyBzY3JlZW4iLCJjb2Jyb3dzaW5nX2NvbnRyb2xsaW5nX3NjcmVlbiI6IllvdSBoYXZlIGFjY2VzcyB0byB2aXNpdG9y4oCZcyBzY3JlZW4uIiwiY29icm93c2luZ19yZXF1ZXN0X2NvbnRyb2wiOiJSZXF1ZXN0IHZpc2l0b3IgZm9yIHNjcmVlbiBhY2Nlc3MgIiwiY29icm93c2luZ19naXZlX3Zpc2l0b3JfY29udHJvbCI6IkdpdmUgYWNjZXNzIGJhY2sgdG8gdmlzaXRvciAiLCJjb2Jyb3dzaW5nX3N0b3BfcmVxdWVzdCI6IkVuZCB5b3VyIHNjcmVlbnNoYXJpbmcgc2Vzc2lvbiAiLCJjb2Jyb3dzaW5nX3JlcXVlc3RfY29udHJvbF9yZWplY3RlZCI6IllvdXIgcmVxdWVzdCB3YXMgZGVjbGluZWQgIiwiY29icm93c2luZ19jYW5jZWxfdmlzaXRvcl9tc2ciOiJTY3JlZW5zaGFyaW5nIGlzIGN1cnJlbnRseSB1bmF2YWlsYWJsZSAiLCJjb2Jyb3dzaW5nX2FnZW50X3JlcXVlc3RfY29udHJvbCI6IkFnZW50IGlzIHJlcXVlc3RpbmcgYWNjZXNzIHRvIHlvdXIgc2NyZWVuICIsImNiX3ZpZXdpbmdfc2NyZWVuX3ZpIjoiQWdlbnQgY2FuIHZpZXcgeW91ciBzY3JlZW4gIiwiY2JfY29udHJvbGxpbmdfc2NyZWVuX3ZpIjoiQWdlbnQgaGFzIGFjY2VzcyB0byB5b3VyIHNjcmVlbiAiLCJjYl92aWV3X21vZGVfc3VidGV4dCI6IllvdXIgYWNjZXNzIHRvIHRoZSBzY3JlZW4gaGFzIGJlZW4gd2l0aGRyYXduICIsImNiX2dpdmVfY29udHJvbF92aSI6IkFsbG93IGFnZW50IHRvIGFjY2VzcyB5b3VyIHNjcmVlbiAiLCJjYl92aXNpdG9yX3Nlc3Npb25fcmVxdWVzdCI6IkFnZW50IHNlZWtzIGFjY2VzcyB0byB5b3VyIHNjcmVlbiAifX0=';</script>
</body>
</html>