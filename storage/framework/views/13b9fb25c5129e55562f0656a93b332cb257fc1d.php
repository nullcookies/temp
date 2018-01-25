<html>
<head>
<title>Massengers</title>

<!-- Meta --->

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<meta NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#d80003">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- Meta Ends --->

<link rel="icon" href="<?php echo e(asset('massengers/img/favicon.PNG')); ?>"/>
<link rel="apple-touch-startup-image" href="<?php echo e(asset('massengers/img/favicon.PNG')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('massengers/css/bootstrap.min.css')); ?>"/>
<link rel="stylesheet" href="<?php echo e(asset('massengers/css/font-awesome.min.css')); ?>"/>
<link rel="stylesheet" href="<?php echo e(asset('massengers/css/style.css')); ?>"/>
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('massengers/css/owl.carousel.min.css')); ?>"/>
<link rel="stylesheet" href="<?php echo e(asset('massengers/css/owl.theme.default.min.css')); ?>"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link rel="stylesheet" href="<?php echo e(asset('css/sweetalert.css')); ?>"/>

<?php echo $__env->yieldContent('css'); ?>
</head>
<body>
<!-- Header Section Starts  -->
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mess">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>     
		</div>
		<a class="navbar-brand hidden-xs" href="<?php echo e(url('/')); ?>">
			<img src="<?php echo e(asset('massengers/img/logo.png')); ?>" class="logo-image"/>
		</a>
		<a class="navbar-brand hidden-lg hidden-md hidden-sm" href="<?php echo e(url('/')); ?>">
			<img src="<?php echo e(asset('massengers/img/logo2.png')); ?>" class="logo-image"/>
		</a>
		<div class="collapse navbar-collapse" id="mess">
			<ul class="nav navbar-nav navbar-left hidden-xs">
				<li>
					<a href="<?php echo e(url('/category/need-today')); ?>" class="new-image">
						<img src="<?php echo e(asset('massengers/img/time.png')); ?>"/>
						<p>Need Today</p>
					</a>
				</li>
				<li>
					<a href="<?php echo e(url('/contact-us')); ?>" class="new-image">
						<img src="<?php echo e(asset('massengers/img/help.png')); ?>"/>
						<p>Help</p>
					</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right hidden-xs">
				<li>
					<a href="<?php echo e(url('/track-order')); ?>" class="new-image">
						<img src="<?php echo e(asset('massengers/img/track.png')); ?>"/>
						<p>Track Order</p>
					</a>
				</li>
				<?php if(!Auth::user()): ?>
				<li>
					<a href="#" data-toggle="modal" data-target="#myModal" class="new-image">
						<img src="<?php echo e(asset('massengers/img/login.png')); ?>"/>
						<p>Login / Register</p>
					</a>
				</li>
				<?php endif; ?>
				<?php if(Auth::user()): ?>
				<li class="login-hover">
					<a href="javascript:;" class="new-image">
						<!--<i class="fa fa-user" style="font-size: 35px;color: #D80003;"></i>-->
						<img src="<?php echo e(asset('massengers/img/login-user.png')); ?>" height="36"/>
						<p>Hi <?php echo e(substr(Auth::user()->name,0,15)); ?></p>
					</a>
					<ul class="hover">
						<li><a href="<?php echo e(url('/profile')); ?>">View Profile</a></li>
						<li><a href="<?php echo e(url('/logout')); ?>">Logout</a></li>
					</ul>
				</li>
				<?php endif; ?>
				<li>
					<a href="javascript:;" id="cart" class="new-image">
						<img src="<?php echo e(asset('massengers/img/cart.png')); ?>"/>
						<p>Cart</p>
					</a>
				</li>
				
			</ul>
			<ul class="nav navbar-nav navbar-right hidden-sm hidden-md hidden-lg">
			    <li>
					<a href="<?php echo e(url('/need-today')); ?>" class="new-image">
						<img src="<?php echo e(asset('massengers/img/time.png')); ?>"/>
						<p>Need Today</p>
					</a>
				</li>
				<li>
					<a href="<?php echo e(url('/help')); ?>" class="new-image">
						<img src="<?php echo e(asset('massengers/img/help.png')); ?>"/>
						<p>Help</p>
					</a>
				</li>
				<li>
					<a href="<?php echo e(url('/track-order')); ?>" class="new-image">
						<img src="<?php echo e(asset('massengers/img/track.png')); ?>"/>
						<p>Track Order</p>
					</a>
				</li>
				<?php if(!Auth::user()): ?>
				<li>
					<a href="#" data-toggle="modal" data-target="#myModal" class="new-image">
						<img src="<?php echo e(asset('massengers/img/login.png')); ?>"/>
						<p>Login / Register</p>
					</a>
				</li>
				<?php endif; ?>
				<?php if(Auth::user()): ?>
				<li>
					<a href="javascript:;" class="new-image">
						<!--<i class="fa fa-user" style="font-size: 35px;color: #D80003;"></i>-->
						<img src="<?php echo e(asset('massengers/img/login-user.png')); ?>" height="36"/>
						<p>Hi <?php echo e(substr(Auth::user()->name,0,15)); ?></p>
					</a>
				</li>
				<?php endif; ?>
				
				<li>
					<a href="<?php echo e(url('cart')); ?>" onclick="toggle_visibility('hideme')" class="new-image">
						<img src="<?php echo e(asset('massengers/img/cart.png')); ?>"/>
						<p>Cart</p>
					</a>
				</li>
				
			</ul>
		</div>
	</div>	
</nav>

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
				<form class="login-form" id="login-form" method="post" action="<?php echo e(url('/ajaxLogin')); ?>">
				<?php echo csrf_field(); ?>

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
				<form class="signup-form" id="signup-form" method="post" action="<?php echo e(url('/register')); ?>">
				<?php echo e(csrf_field()); ?>

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
			        <a href="<?php echo e(route('social.redirect', ['provider' => 'google'])); ?>" class="btn btn-lg waves-effect waves-light btn-block google">Google+</a>
			    </div>
			    <div class="col-md-6 col-sm-6 col-xs-6">
			        <a href="<?php echo e(route('social.redirect', ['provider' => 'facebook'])); ?>" class="btn btn-lg waves-effect waves-light btn-block github">Facebook</a>
			    </div>
			</div>-->

				 <center>
					<ul class="login-social">
					    <li>
							<a href="<?php echo e(route('social.redirect', ['provider' => 'google'])); ?>"><img src="<?php echo e(asset('massengers/img/g+.png')); ?>

							"/></a>
						</li>
						<li>
							<a href="<?php echo e(route('social.redirect', ['provider' => 'facebook'])); ?>"><img src="<?php echo e(asset('massengers/img/fb.png')); ?>"/></a>
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
			<form action="<?php echo e(url('/search')); ?>" class="search-bar">
				<input type="text" name="q" placeholder="Search Products"/>
				<button type="submit"><i class="fa fa-search"></i></button>
			</form>
			<!--<input type="text" placeholder="Search Products"/>
			<a href="#" class="search-btn"><i class="fa fa-search"></i></a>-->
		</div>
		<div class="service-box">
			<ul>
				<li>
					<a href="<?php echo e(url('about-us')); ?>">
						<img src="<?php echo e(asset('massengers/img/loversplace.png')); ?>"/>
						<p>Lovers Place</p>
					</a>
				</li>
				<li>
					<a href="http://blog.massengers.com/">
						<img src="<?php echo e(asset('massengers/img/lovemantra.png')); ?>"/>
						<p>Lovers Mantra</p>
					</a>
				</li>
				<li>
					<a href="<?php echo e(url('/love-birds')); ?>">
						<img src="<?php echo e(asset('massengers/img/love-birds.png')); ?>"/>
						<p>Lovers Birds</p>
					</a>
				</li>
				<li>
					<a href="<?php echo e(url('/love-confession-board')); ?>">
						<img src="<?php echo e(asset('massengers/img/lcb.png')); ?>"/>
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
	<form class="search-bar small-search-bar">
		<input type="text" placeholder="Search Products"/>
		<button><i class="fa fa-search"></i></button>
	</form>
	<a href="#">
		<i class="fa fa-heart"></i> Same Day
	</a>
	<a href="<?php echo e(url('/lovers-mantra')); ?>">
		<i class="fa fa-heart"></i> Birthday
	</a>
	<a href="<?php echo e(url('/love-birds')); ?>">
		<i class="fa fa-heart"></i> Anniversary
	</a>
	<a href="<?php echo e(url('/love-confession-board')); ?>">
		<i class="fa fa-heart"></i> Occasions
	</a>
</div>

<div id="main">
  <span class="mobile-services" onclick="openNav()">&#9776; Services</span>
</div>

<?php echo $__env->make('massengers/common/navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- Header Section Ends  -->
<div class="minicartview">
	<h4 class="center">Items in Cart</h4>
	<ul>
		<li>
			<table class="table">
				<tbody>
					<td width="20%"><img src="<?php echo e(asset('massengers/img/cake1.png')); ?>" width="50"></td>
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
					<td width="20%"><img src="<?php echo e(asset('massengers/img/cake1.png')); ?>" width="50"></td>
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
					<td width="20%"><img src="<?php echo e(asset('massengers/img/cake1.png')); ?>" width="50"></td>
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

<?php echo $__env->yieldContent('content'); ?>

<!-- Footer Section Starts  -->


<div class="container-fluid footer-section">
	<div class="container">
		<div class="row footer-details">
			<div class="col-md-4">
				<h4>Massengers</h4>
				<p>Our online portal meets your everlasting desires for a perfect relationships. We help you maintain and cherish every moment with your loved ones. It&#39;s time to melt their heart and live life like never before.</p>
				<ul class="social">
					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
					<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
					<li><a href="#"><i class="fa fa-instagram"></i></a></li>
				</ul>
			</div>
			<div class="col-md-4">
				<ul class="service-list">
					<li><a href="<?php echo e(url('category/love-letters')); ?>">Love Letters</a></li>
					<li><a href="<?php echo e(url('/category/cakes')); ?>">Cakes</a></li>
					<li><a href="<?php echo e(url('category/home-decorative')); ?>">Flower Bouquet</a></li>
					<li><a href="#">Fan Mail</a></li>
					<li><a href="#">Parker Pen</a></li>
					<li><a href="<?php echo e(url('/love-confession-board')); ?>">Love Confession Board</a></li>
					<li><a href="#">Love Birds</a></li>
					<li><a href="#">Love Mantra</a></li>
					<li><a href="<?php echo e(url('/track-order')); ?>">Track Order</a></li>
					<li><a href="<?php echo e(url('/career')); ?>">Careers</a></li>
					<li><a href="<?php echo e(url('/contact-us')); ?>">Contact Us</a></li>
					<li><a href="<?php echo e(url('/about-us')); ?>">About Us</a></li>
				</ul>
			</div>
			<div class="col-md-4 latest-news">
				<h3 class="c-white roboto-light ">Get latest news delivered daily</h3>
				<p>We will send you breaking news right into your inbox</p>
				<form class="subscribe" id="newsletter-form">
					<input type="text" placeholder="Enter your Email" name="email" />
					<button id="newsletter-btn" type="submit">Subscribe</button>
					<span id="loader-subs" style="color: #fff;"></span>
					<p id="subscription-msg" class="text-warning hidden">newsletter msg</p>
				</form>
				<br/>
				<img src="<?php echo e(asset('massengers/img/bank.png')); ?>"/>
			</div>
		</div>
		<div class="row row-footer">
			<center>
				<ul class="footer-terms">
					<li><a href="<?php echo e(url('/terms-and-conditions')); ?>">Terms &amp; Conditions</a></li>
					<li><a href="<?php echo e(url('/disclaimer')); ?>">Disclaimer </a></li>
					<li><a href="<?php echo e(url('/privacy-policy')); ?>">Privacy Policy</a></li>
					<li><a href="#">Sitemap</a></li>
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
<a href="#" class="scrollToTop"></a>

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
<!--<a href="#" class="scrollup" style="display: none;"></a>-->
<!--<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>-->
<!-- Footer Section Ends  -->		
<script src="<?php echo e(asset('massengers/js/jquery-3.1.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('massengers/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('massengers/js/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('massengers/js/custom.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('massengers/js/common.js')); ?>"></script> 
<script type="text/javascript" src="<?php echo e(asset('massengers/js/jquery.mobile-menu.min.js')); ?>"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> 
<script src="<?php echo e(asset('js/sweetalert.min.js')); ?>"></script>
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
	$(document).ready(function(){
		$('#signup-form').on('submit', function(event){
			event.preventDefault();
			var formData = $(this).serialize();
			$.ajax({
				url : "<?php echo e(url('/ajaxRegister')); ?>",
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
				url : "<?php echo e(url('/ajaxLogin')); ?>",
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
				url : "<?php echo e(url('/savenewsletter')); ?>",
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
				url : "<?php echo e(url('/savenewsletter')); ?>",
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

<?php if(!Session::has('newsletter-shown') && !Auth::user()): ?>
    
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
    <?php echo e(Session::put('newsletter-shown',1)); ?>

<?php endif; ?>

<?php echo $__env->yieldContent('js'); ?>

<script type='text/javascript'>var fc_CSS=document.createElement('link');fc_CSS.setAttribute('rel','stylesheet');var fc_isSecured = (window.location && window.location.protocol == 'https:');var fc_lang = document.getElementsByTagName('html')[0].getAttribute('lang'); var fc_rtlLanguages = ['ar','he']; var fc_rtlSuffix = (fc_rtlLanguages.indexOf(fc_lang) >= 0) ? '-rtl' : '';fc_CSS.setAttribute('type','text/css');fc_CSS.setAttribute('href',((fc_isSecured)? 'https://d36mpcpuzc4ztk.cloudfront.net':'http://assets1.chat.freshdesk.com')+'/css/visitor'+fc_rtlSuffix+'.css');document.getElementsByTagName('head')[0].appendChild(fc_CSS);var fc_JS=document.createElement('script'); fc_JS.type='text/javascript'; fc_JS.defer=true;fc_JS.src=((fc_isSecured)?'https://d36mpcpuzc4ztk.cloudfront.net':'http://assets.chat.freshdesk.com')+'/js/visitor.js';(document.body?document.body:document.getElementsByTagName('head')[0]).appendChild(fc_JS);window.livechat_setting= 'eyJ3aWRnZXRfc2l0ZV91cmwiOiJtYXNzZW5nZXJzd2ViLmZyZXNoZGVzay5jb20iLCJwcm9kdWN0X2lkIjpudWxsLCJuYW1lIjoiTWFzc2VuZ2Vyc3dlYiIsIndpZGdldF9leHRlcm5hbF9pZCI6bnVsbCwid2lkZ2V0X2lkIjoiYTZiNzNhNjAtNDkxMC00YjhlLWFmODEtMjRmMGViOTdiMDNkIiwic2hvd19vbl9wb3J0YWwiOmZhbHNlLCJwb3J0YWxfbG9naW5fcmVxdWlyZWQiOmZhbHNlLCJsYW5ndWFnZSI6ImVuIiwidGltZXpvbmUiOiJFYXN0ZXJuIFRpbWUgKFVTICYgQ2FuYWRhKSIsImlkIjozMzAwMDA0NTM5MywibWFpbl93aWRnZXQiOjEsImZjX2lkIjoiODk5Yzk3NTY5MWE3MTViYzliYWU3ZGIyZmU3MzQ3NGQiLCJzaG93IjoxLCJyZXF1aXJlZCI6MiwiaGVscGRlc2tuYW1lIjoiTWFzc2VuZ2Vyc3dlYiIsIm5hbWVfbGFiZWwiOiJOYW1lIiwibWVzc2FnZV9sYWJlbCI6Ik1lc3NhZ2UiLCJwaG9uZV9sYWJlbCI6IlBob25lIiwidGV4dGZpZWxkX2xhYmVsIjoiVGV4dGZpZWxkIiwiZHJvcGRvd25fbGFiZWwiOiJEcm9wZG93biIsIndlYnVybCI6Im1hc3NlbmdlcnN3ZWIuZnJlc2hkZXNrLmNvbSIsIm5vZGV1cmwiOiJjaGF0LmZyZXNoZGVzay5jb20iLCJkZWJ1ZyI6MSwibWUiOiJNZSIsImV4cGlyeSI6MTUwNTk4OTgxOTAwMCwiZW52aXJvbm1lbnQiOiJwcm9kdWN0aW9uIiwiZW5kX2NoYXRfdGhhbmtfbXNnIjoiVGhhbmsgeW91ISEhIiwiZW5kX2NoYXRfZW5kX3RpdGxlIjoiRW5kIiwiZW5kX2NoYXRfY2FuY2VsX3RpdGxlIjoiQ2FuY2VsIiwic2l0ZV9pZCI6Ijg5OWM5NzU2OTFhNzE1YmM5YmFlN2RiMmZlNzM0NzRkIiwiYWN0aXZlIjoxLCJyb3V0aW5nIjpudWxsLCJwcmVjaGF0X2Zvcm0iOjEsImJ1c2luZXNzX2NhbGVuZGFyIjpudWxsLCJwcm9hY3RpdmVfY2hhdCI6MCwicHJvYWN0aXZlX3RpbWUiOm51bGwsInNpdGVfdXJsIjoibWFzc2VuZ2Vyc3dlYi5mcmVzaGRlc2suY29tIiwiZXh0ZXJuYWxfaWQiOm51bGwsImRlbGV0ZWQiOjAsIm1vYmlsZSI6MSwiYWNjb3VudF9pZCI6bnVsbCwiY3JlYXRlZF9hdCI6IjIwMTctMDgtMjFUMTA6MzI6NDUuMDAwWiIsInVwZGF0ZWRfYXQiOiIyMDE3LTA4LTIxVDEwOjMyOjQ5LjAwMFoiLCJjYkRlZmF1bHRNZXNzYWdlcyI6eyJjb2Jyb3dzaW5nX3N0YXJ0X21zZyI6IllvdXIgc2NyZWVuc2hhcmUgc2Vzc2lvbiBoYXMgc3RhcnRlZCIsImNvYnJvd3Npbmdfc3RvcF9tc2ciOiJZb3VyIHNjcmVlbnNoYXJpbmcgc2Vzc2lvbiBoYXMgZW5kZWQiLCJjb2Jyb3dzaW5nX2RlbnlfbXNnIjoiWW91ciByZXF1ZXN0IHdhcyBkZWNsaW5lZCIsImNvYnJvd3NpbmdfYWdlbnRfYnVzeSI6IkFnZW50IGlzIGluIHNjcmVlbiBzaGFyZSBzZXNzaW9uIHdpdGggY3VzdG9tZXIiLCJjb2Jyb3dzaW5nX3ZpZXdpbmdfc2NyZWVuIjoiWW91IGFyZSB2aWV3aW5nIHRoZSB2aXNpdG9y4oCZcyBzY3JlZW4iLCJjb2Jyb3dzaW5nX2NvbnRyb2xsaW5nX3NjcmVlbiI6IllvdSBoYXZlIGFjY2VzcyB0byB2aXNpdG9y4oCZcyBzY3JlZW4uIiwiY29icm93c2luZ19yZXF1ZXN0X2NvbnRyb2wiOiJSZXF1ZXN0IHZpc2l0b3IgZm9yIHNjcmVlbiBhY2Nlc3MgIiwiY29icm93c2luZ19naXZlX3Zpc2l0b3JfY29udHJvbCI6IkdpdmUgYWNjZXNzIGJhY2sgdG8gdmlzaXRvciAiLCJjb2Jyb3dzaW5nX3N0b3BfcmVxdWVzdCI6IkVuZCB5b3VyIHNjcmVlbnNoYXJpbmcgc2Vzc2lvbiAiLCJjb2Jyb3dzaW5nX3JlcXVlc3RfY29udHJvbF9yZWplY3RlZCI6IllvdXIgcmVxdWVzdCB3YXMgZGVjbGluZWQgIiwiY29icm93c2luZ19jYW5jZWxfdmlzaXRvcl9tc2ciOiJTY3JlZW5zaGFyaW5nIGlzIGN1cnJlbnRseSB1bmF2YWlsYWJsZSAiLCJjb2Jyb3dzaW5nX2FnZW50X3JlcXVlc3RfY29udHJvbCI6IkFnZW50IGlzIHJlcXVlc3RpbmcgYWNjZXNzIHRvIHlvdXIgc2NyZWVuICIsImNiX3ZpZXdpbmdfc2NyZWVuX3ZpIjoiQWdlbnQgY2FuIHZpZXcgeW91ciBzY3JlZW4gIiwiY2JfY29udHJvbGxpbmdfc2NyZWVuX3ZpIjoiQWdlbnQgaGFzIGFjY2VzcyB0byB5b3VyIHNjcmVlbiAiLCJjYl92aWV3X21vZGVfc3VidGV4dCI6IllvdXIgYWNjZXNzIHRvIHRoZSBzY3JlZW4gaGFzIGJlZW4gd2l0aGRyYXduICIsImNiX2dpdmVfY29udHJvbF92aSI6IkFsbG93IGFnZW50IHRvIGFjY2VzcyB5b3VyIHNjcmVlbiAiLCJjYl92aXNpdG9yX3Nlc3Npb25fcmVxdWVzdCI6IkFnZW50IHNlZWtzIGFjY2VzcyB0byB5b3VyIHNjcmVlbiAifX0=';</script>
</body>
</html>