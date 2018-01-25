<html>
<head>
<title>Massengers</title>
<link rel="icon" href="<?php echo e(asset('massengers/img/favicon.PNG')); ?>"/>
<link rel="stylesheet" href="<?php echo e(asset('massengers/css/bootstrap.min.css')); ?>"/>
<link rel="stylesheet" href="<?php echo e(asset('massengers/css/font-awesome.min.css')); ?>"/>
<link rel="stylesheet" href="<?php echo e(asset('massengers/css/style.css')); ?>"/>
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('massengers/css/owl.carousel.min.css')); ?>"/>
<link rel="stylesheet" href="<?php echo e(asset('massengers/css/owl.theme.default.min.css')); ?>"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link rel="stylesheet" href="<?php echo e(asset('css/sweetalert.css')); ?>"/>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<meta NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
			<ul class="nav navbar-nav navbar-left">
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
			</ul>
			<ul class="nav navbar-nav navbar-right">
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
				
				<li>
					<a href="<?php echo e(url('cart')); ?>" onclick="toggle_visibility('hideme')" class="new-image">
						<img src="<?php echo e(asset('massengers/img/cart.png')); ?>"/>
						<p>Cart</p>
					</a>
				</li>
				<?php if(Auth::user()): ?>
				<li>
					<a href="javascript:;" class="new-image">
						<i class="fa fa-user" style="font-size: 35px;color: #D80003;"></i>
						<p>Hi <?php echo e(substr(Auth::user()->name,0,15)); ?></p>
					</a>
				</li>
				<?php endif; ?>
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
			<form class="search-bar">
				<input type="text" placeholder="Search Products"/>
				<button><i class="fa fa-search"></i></button>
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
					<a href="<?php echo e(url('/lovers-mantra')); ?>">
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
		<img src="<?php echo e(asset('massengers/img/loversplace.png')); ?>"/>&nbsp;Lovers Place
	</a>
	<a href="<?php echo e(url('/lovers-mantra')); ?>">
		<img src="<?php echo e(asset('massengers/img/lovemantra.png')); ?>"/>&nbsp;Lovers Mantra
	</a>
	<a href="<?php echo e(url('/love-birds')); ?>">
		<img src="<?php echo e(asset('massengers/img/love-birds.png')); ?>"/>&nbsp;Lovers Birds
	</a>
	<a href="#">
		<img src="<?php echo e(asset('massengers/img/lcb.png')); ?>"/>&nbsp;Love Confession Board
	</a>
</div>

<div id="main">
  <span style="font-size:30px;cursor:pointer;font-family: 'Roboto Condensed', sans-serif;" onclick="openNav()">&#9776; Services</span>
</div>

<?php echo $__env->make('massengers/common/navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- Header Section Ends  -->

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
					<li><a href="#">Love Letters</a></li>
					<li><a href="#">Cakes</a></li>
					<li><a href="#">Flower Bouquet</a></li>
					<li><a href="#">Fan Mail</a></li>
					<li><a href="#">Parker Pen</a></li>
					<li><a href="#">Love Confession Board</a></li>
					<li><a href="#">Love Birds</a></li>
					<li><a href="#">Love Mantra</a></li>
					<li><a href="#">Track Order</a></li>
					<li><a href="<?php echo e(url('/career')); ?>">Careers</a></li>
					<li><a href="<?php echo e(url('/contact-us')); ?>">Contact Us</a></li>
					<li><a href="<?php echo e(url('/about-us')); ?>">About Us</a></li>
				</ul>
			</div>
			<div class="col-md-4">
				<h3 class="c-white">Get latest news delivered daily</h3>
				<p>We will send you breaking news right into your inbox</p>
				<form class="subscribe">
					<input type="text" placeholder="Enter your Email"/>
					<button>Subscribe</button>
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

<?php echo $__env->yieldContent('js'); ?>
</body>
</html>