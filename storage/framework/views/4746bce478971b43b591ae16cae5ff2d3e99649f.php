<?php $__env->startSection('title'); ?>
| <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
<!-- Vendor CSS -->
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap4/css/bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/themify-icons/themify-icons.css')); ?>">
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/animate.css/animate.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/jscrollpane/jquery.jscrollpane.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/waves/waves.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/switchery/dist/switchery.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/nestable/nestable.css')); ?>">

<!-- Neptune CSS -->
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/style46.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/owl.carousel.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/owl.theme.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/jquery.bxslider.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/jquery.mobile-menu.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/revslider.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/simple-line-icons.css')); ?>" media="all">
<style>
	.social-links{
		list-style:none;
	}
	.social-links li{
		display:inline-block;
		padding:5px;;
	}
	.social-links li a{
		font-size:18px;
	}
	.full-width{width:100% !important;}
	.purnawidth{
      width: 100%
    }
    @media  only screen and (max-width: 1110px){
      .footer-add{
        margin-top: 20px;
      }
    }
</style>

<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">	
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>

<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>	
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/revslider.js')); ?>"></script> 
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/common.js')); ?>"></script> 
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/owl.carousel.min.js')); ?>"></script> 
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/jquery.mobile-menu.min.js')); ?>"></script> 
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/countdown.js')); ?>"></script> 

<!-- Vendor JS -->
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/tether/js/tether.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/detectmobilebrowser/detectmobilebrowser.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/jscrollpane/jquery.mousewheel.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/jscrollpane/mwheelIntent.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/jscrollpane/jquery.jscrollpane.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/jquery-fullscreen-plugin/jquery.fullscreen-min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/waves/waves.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/switchery/dist/switchery.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/nestable/jquery.nestable.js')); ?>"></script>
<script type='text/javascript'>
	jQuery(document).ready(function() {
		jQuery('#rev_slider_4').show().revolution({
			dottedOverlay: 'none',
			delay: 5000,
			startwidth: 600,
			startheight: 461,
			hideThumbs: 200,
			thumbWidth: 200,
			thumbHeight: 50,
			thumbAmount: 2,
			navigationType: 'thumb',
			navigationArrows: 'solo',
			navigationStyle: 'round',
			touchenabled: 'on',
			onHoverStop: 'on',
			swipe_velocity: 0.7,
			swipe_min_touches: 1,
			swipe_max_touches: 1,
			drag_block_vertical: false,
			spinner: 'spinner0',
			keyboardNavigation: 'off',
			navigationHAlign: 'center',
			navigationVAlign: 'bottom',
			navigationHOffset: 0,
			navigationVOffset: 20,
			soloArrowLeftHalign: 'left',
			soloArrowLeftValign: 'center',
			soloArrowLeftHOffset: 20,
			soloArrowLeftVOffset: 0,
			soloArrowRightHalign: 'right',
			soloArrowRightValign: 'center',
			soloArrowRightHOffset: 20,
			soloArrowRightVOffset: 0,
			shadow: 0,
			fullWidth: 'on',
			fullScreen: 'off',
			stopLoop: 'off',
			stopAfterLoops: -1,
			stopAtSlide: -1,
			shuffle: 'off',
			autoHeight: 'off',
			forceFullWidth: 'on',
			fullScreenAlignForce: 'off',
			minFullScreenHeight: 0,
			hideNavDelayOnMobile: 1500,
			hideThumbsOnMobile: 'off',
			hideBulletsOnMobile: 'off',
			hideArrowsOnMobile: 'off',
			hideThumbsUnderResolution: 0,
			hideSliderAtLimit: 0,
			hideCaptionAtLimit: 0,
			hideAllCaptionAtLilmit: 0,
			startWithSlide: 0,
			fullScreenOffsetContainer: ''
		});
});
</script> 
<!-- Hot Deals Timer 1--> 
<script type="text/javascript">
	
	$('#st_phone').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var recipient = button.data('whatever');
		var datakey = button.data('datakey');
		var modal = $(this);
		/*modal.find('.modal-title').text('New message to ' + recipient);*/
		modal.find('.modal-body input[name=data]').val(recipient);
		modal.find('.modal-body input[name=key]').val(datakey);
	});
	$('#quicklink').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var recipient = button.data('whatever');
		var datakey = button.data('datakey');
		var modal = $(this); 
		/*modal.find('.modal-title').text('New message to ' + recipient);*/
		modal.find('.modal-body input[name=data]').val(recipient);
		modal.find('.modal-body input[name=key]').val(datakey);
	});
</script>
<?php if(Session::has('error') || $errors->has('data')): ?>
	<script type="text/javascript"> 
	    $(document).ready(function(){
	        $("#st_phone").modal('show',{backdrop: 'static', keyboard: false});
	    });
	</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
<div id="page"> 
	<!-- Header -->
	<header>
		<div class="header-container">
			<div class="header-top">
				<div class="container">
					<div class="row"> 
						<!-- Header Language -->
						<div class="col-xs-12 col-sm-6">
							<!-- <div class="dropdown block-language-wrapper"> <a role="button" data-toggle="dropdown" data-target="#" class="block-language dropdown-toggle" href="#"> <img src="<?php echo e(url('images/english.png')); ?>" alt="language"> English <span class="caret"></span> </a>
								<ul class="dropdown-menu" role="menu">
									<li role="presentation"> <a href="#"><img src="<?php echo e(url('images/english.png')); ?>" alt="language"> English </a> </li>
									<li role="presentation"> <a href="#"><img src="<?php echo e(url('images/francais.png')); ?>" alt="language"> French </a> </li>
									<li role="presentation"> <a href="#"><img src="<?php echo e(url('images/german.png')); ?>" alt="language"> German </a> </li>
								</ul>
							</div> -->
							<!-- End Header Language --> 

							<!-- Header Currency -->
							<!-- <div class="dropdown block-currency-wrapper"> <a role="button" data-toggle="dropdown" data-target="#" class="block-currency dropdown-toggle" href="#"> USD <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li role="presentation"><a href="#"> $ - Dollar </a> </li>
									<li role="presentation"><a href="#"> £ - Pound </a> </li>
									<li role="presentation"><a href="#"> € - Euro </a> </li>
								</ul>
							</div> -->
							<!-- End Header Currency -->
							<div class="welcome-msg">Welcome <?php echo e(Auth::user() ? Auth::user()->name : 'Guest'); ?>! </div>
						</div>
						<div class="col-xs-6 hidden-xs"> 
							<!-- Header Top Links -->
							<div class="toplinks">
								<div class="links">
									<div class="myaccount"><a title="My Account" href="#"><span class="hidden-xs">My Account</span></a> </div>
									<div class="check"><a title="Checkout" href="#"><span class="hidden-xs">Checkout</span></a> </div>
									<div class="demo"><a title="Blog" href="#"><span class="hidden-xs">Blog</span></a> </div>
								</div>
							</div>
							<!-- End Header Top Links --> 
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 logo-block"> 
						<!-- Header Logo -->
						<div class="logo logodiv">
							<div class="logobox">
								<div class="col-md-6">
									<center>
										<img src="<?php echo url('product_images/banners/',[$logo->image]); ?>" class="img-responsive">
									</center>
								</div>
								<div class="col-md-6 logotext">
									<center>
										<a href="<?php echo e(url('admin/website-setting/add?cid=1')); ?>" class="btn mybtn w-min-xs mb-0-25 waves-effect waves-light">Edit</a>
									</center>
								</div>
							</div>
							 
						</div>
						<!-- End Header Logo --> 
					</div>
					<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 hidden-xs">
						<div class="search-box">
							<form action="cat" method="POST" id="search_mini_form" name="Categories">
								<input type="text" placeholder="Search entire store here..." value="Search entire store" maxlength="70" name="search" id="search">
								<button type="button" class="search-btn-bg"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
							</form>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> <a href="#" class="top-link-compare hidden-xs"><i class="compare"></i></a> <a href="#" title="My Wishlist" class="top-link-wishlist hidden-xs"><i class="fa fa-heart"></i></a>
						<div class="top-cart-contain pull-right"> 
							<!-- Top Cart -->
							<div class="mini-cart">
								<div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"> <a href="shopping_cart.html"> <span class="cart_count">2</span><span class="price">Shopping Cart</span> </a> </div>

								<!-- Top Cart -->
								<div id="ajaxconfig_info" style="display:none"> <a href="#/"></a>
									<input value="" type="hidden">
									<input id="enable_module" value="1" type="hidden">
									<input class="effect_to_cart" value="1" type="hidden">
									<input class="title_shopping_cart" value="Go to shopping cart" type="hidden">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- end header --> 

			<!-- Navigation -->

			<nav class="nav2">
				<div class="container">
					<div class="mm-toggle-wrap">
						<div class="mm-toggle"><i class="fa fa-bars"></i><span class="mm-label">Menu</span> </div>
					</div>
					<div class="nav-inner"> 
						<!-- BEGIN NAV -->
						<ul id="nav" class="hidden-xs">
							<li class="level0 parent drop-menu" id="nav-home"><a href="index.html" class="level-top"><span>Home</span></a> 
							</li>
							<li class="level0 nav-6 level-top drop-menu"> <a class="level-top" href="#"> <span>Pages</span> </a>
							</li>
							<li class="mega-menu"> <a class="level-top" href="grid.html"><span>Audio & Video</span></a>
							</li>
							<li class="mega-menu"> <a class="level-top" href="grid.html"><span>Computer</span></a>
							</li>
							<li class="mega-menu"> <a class="level-top" href="grid.html"><span>Appliances</span></a> 
							</li>
							<li class="mega-menu"> <a class="level-top" href="grid.html"><span>Mobile Electronics</span></a>	
							</li>
							<li class="mega-menu"> <a class="level-top" href="grid.html"><span>Desktop</span></a> </li>
							<li class="nav-custom-link mega-menu"> <a href="#" class="level-top"> <span>Custom</span> </a></li>
						</ul>
						<!--nav--> 
					</div>
				</div>
			</nav>

			<!-- end nav --> 
		</header>
		<!-- Newsletter and social widget -->
		<div class="subscribe-area hidden-xs">
			<div class="container">
				<div class="subscribe-container">
					<div class="row">
						<div class="col-md-12">
							<div class="subscribe">
								<div class="subscribe-title">
									<label>Sign Up for Our Newsletter:</label>
								</div>
								<form id="subscribe-form" method="post" action="#" class="mt-10">
									<div class="subscribe-content">
										<input type="text" id="subscribe-input" name="email">
										<button class="button" type="button"><span>Subscribe</span></button>
									</div>
								</form>
							</div>
							<div class="subscribe-text-link">
								<div class="subscribe-link">
									<ul class="social-link">
										<?php if(isset($socialmedia)): ?>
						                <?php foreach($socialmedia as $social): ?>
						                  <li><a href="<?php echo e(url('admin/socialmedia/editsocial/'.$social->id)); ?>" title="<?php echo e($social->name); ?> "><i class="fa fa-<?php echo e($social->slug); ?>"></i></a></li>
						                <?php endforeach; ?>
						                <?php endif; ?>
									</ul>
									<p class="discount-text">
									<?php echo $homesetting->socialright; ?>										
										<div class="discounted">
											<center><a href="#" data-toggle="modal" data-target="#st_phone" data-whatever="<?php echo e($homesetting->socialright); ?>" data-datakey="socialright" class="btn mybtn w-min-xs mb-0-25 waves-effect waves-light">Edit</a></center>
										</div>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Newsletter and social widget end--> 
		<!--<button type="button" class="btn btn-info btn-lg" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#myModal">Open Modal</button>-->


		<!-- Slider -->
		<div id="thmsoft-slideshow" class="thmsoft-slideshow">
			<div class="container">
				<div class="row">
					<div class=" col-lg-3 col-md-3 col-sm-5 col-xs-12 col-mid"> 
          <!--<div class="col-inner ">
            <div class="img-block"> <a href="#" class="ves-btnlink img-animation" title="Image"> <img src="images/mid-banner1.png"  alt="Image"></a> </div>
            <div class="img-block1"> <a href="#" title="Image"> <img src="images/mid-banner2.png"  alt="Image"></a> </div>
        </div>-->
        <div class="top-products">
        
        	<div class="title"><?php echo e($topproduct[0]['tagname']); ?> - <a href="#" style="display:inline;"><span class="editpop">Edit</span></a></div>
        	<?php if(isset($topproduct) && count($topproduct[0]['products'])>0): ?>
        	<ul>
        	<?php foreach($topproduct[0]['products'] as $tag_product): ?>
        		<li>
        			<div class="row vrow">
        				<div class="orow">
        					<div class="col-md-6">
        						<center>
        							<img src="<?php echo e(url('images/img-sm.png')); ?>">
        						</center>
        					</div>
        					<div class="col-md-6 text2">
        						<center>
        							<a href="<?php echo e(url('admin/product/editTagProducts/'.$tag_product->id)); ?>" class="btn mybtn w-min-xs mb-0-25 waves-effect waves-light">Edit</a>
        						</center>
        					</div>
        				</div>
        				<div class="col-xs-4 col-sm-4 no-margin"> <img alt="product" src="<?php echo url('products-images/',[$tag_product->image]); ?>"> </div>
        				<div class="col-xs-8 col-sm-8 no-margin"> <a href="#"> <?php echo $tag_product->name; ?></a>
        					<div class="rating">
        						<div class="ratings">
        							<div class="rating-box">
        								<div style="width:80%" class="rating"></div>
        							</div>
        							<p class="rating-links"> <a href="#"><?php echo $tag_product->rating; ?> Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
        						</div>
        					</div>
        					<div class="price"><i class="fa fa-inr"></i><?php echo $tag_product->new_price; ?></div>
        				</div>

        			</div>
        		</li>
        	<?php endforeach; ?>
        	</ul>
        	<?php endif; ?>
        </div>
    </div>
    <div class="col-md-6 col-sm-7 col-xs-12">
    	<div class="small-strip">
    		<!--<img alt="banner" src="images/small-strip-banner.jpg" width="100%">-->
    		<div class="title"><?php echo e($homesetting->topbanner); ?> - <a href="#" data-toggle="modal" data-target="#st_phone" data-whatever="<?php echo e($homesetting->topbanner); ?>" data-datakey="topbanner"><span class="editpop">Edit</span></a></div>
    		<div class="title-text">Shop Now</div>
    	</div>
    	<div id='rev_slider_4_wrapper' class='rev_slider_wrapper fullwidthbanner-container slidediv'>
    		<div class="slidebox">
    			<center>
    				<img src="<?php echo e(url('images/img.png')); ?>">
    				<br/><br/>
    				<a href="<?php echo e(url('admin/website-setting/sliders')); ?>" class="btn mybtn w-min-sm mb-0-25 waves-effect waves-light">Edit</a>
    				<div class="row">
						<p class="c-white">Preferred Dimensions<br/><span class="gehara">600 X 461</span></p>
						<p class="c-white">Maximum File Size: 2 MB</p>
					</div>
    			</center>
    		</div>
    		<div id='rev_slider_4' class='rev_slider fullwidthabanner'>
    			<ul>
    			<?php foreach($mainslider as $slider): ?>	
    			<li data-transition='random' data-slotamount='7' data-masterspeed='1000' data-thumb="<?php echo url('product_images/banners/',[$slider->image]); ?>"><img src="<?php echo url('product_images/banners/',[$slider->image]); ?>" alt="<?php echo e($slider->image); ?> slide" data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat' />
					<?php /* ?><div class="info">
						<div class='tp-caption ExtraLargeTitle sft  tp-resizeme ' data-endspeed='500' data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2;max-width:auto;max-height:auto;white-space:nowrap;'><span>Crocus Deal</span> </div>
						<div class='tp-caption LargeTitle sfl  tp-resizeme ' data-endspeed='500' data-speed='500' data-start='1300' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:3;max-width:auto;max-height:auto;white-space:nowrap;'><span>digital Time</span> </div>
						<div class='tp-caption Title sft  tp-resizeme ' data-endspeed='500' data-speed='500' data-start='1450' data-easing='Power2.easeInOut' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;max-width:auto;max-height:auto;white-space:nowrap;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
						<div class='tp-caption sfb  tp-resizeme ' data-endspeed='500' data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;max-width:auto;max-height:auto;white-space:nowrap;'><a href='#' class="buy-btn">Shop Now</a> </div>
					</div><?php */ ?>
    			</li>
    			<?php endforeach; ?>	
    			</ul>
    		</div>
    	</div>
    </div>
    <div class=" col-lg-3 col-md-3 col-sm-7 col-xs-12">
    	<div class="image-item o-item">
    		<a href="#" title="Image">
    			<img src="<?php echo url('product_images/banners/',[$right1->image]); ?>" class="img-responsive" alt="Image" width="244px">
    		</a>
    		<div class="obox <?php echo is_file(public_path('product_images/banners/'.$right1->image)) ? '' : 'obox_nomargin' ?>">
    			<center>
    				<img src="<?php echo e(url('images/img.png')); ?>">
    				<br/><br/>
    				<a href="<?php echo e(url('admin/website-setting/add?cid=3')); ?>" class="btn mybtn w-min-sm mb-0-25 waves-effect waves-light">Edit</a>
    				<div class="row">
						<p class="c-white">Preferred Dimensions<br/><span class="gehara">285 X 500</span></p>
						<p class="c-white">Preferred File Size: 600 KB</p>
					</div>
    			</center>
    		</div>
    	</div>
    </div>
</div>
</div>
</div>

<!-- end Slider -->
<div class="our-features-box">
	<div class="container">
	<div class="row">      
        <div class="col-lg-3 col-xs-12 col-sm-6 space">
          <div class="feature-box first" style="padding:15px 10px;"> <span class="fa fa-truck"></span>
            <div class="content">
              <h3>Doorstep delivery</h3>
              <p>Speedy delivery at your doorstep</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-12 col-sm-6 space">
          <div class="feature-box"> <span class="fa fa-headphones"></span>
            <div class="content">
              <h3>24/7 Help Center</h3>
              <p>Round the clock assistance</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-12 col-sm-6 space">
          <div class="feature-box"> <span class="fa fa-share"></span>
            <div class="content">
              <h3>Free Returns</h3>
              <p>Hassle-free return policy</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-12 col-sm-6 space">
          <div class="feature-box last"> <span class="fa fa-phone"></span>
            <div class="content">
              <h3>Helpline <?php echo e(isset($homesetting->phone) ? $homesetting->phone : ''); ?></h3>
              <p>Call us when you need help</p>
            </div>
          </div>
        </div>
      
    </div>

	</div>
</div>
<div class="content-page">
	<div class="container">
		<div class="row"> 

			<!-- featured category fashion -->
			<div class="col-md-9">
				<div class="category-product">
				</div>
                <?php if(isset($tagproduct)): ?>
				<!-- bestsell Slider -->
				<?php foreach($tagproduct as $product): ?>
				<div class="bestsell-pro">
					<div class="slider-items-products">
						<div class="bestsell-block">
							<div class="block-title">
								<h2><?php echo e($product['tagname']); ?> - <a href="<?php echo e(url('admin/product/homepagetag/'.$product['id'].'/edit')); ?>"><span class="editpop">Edit</span></a></h2>
							</div>
							<div id="bestsell-slider" class="product-flexslider hidden-buttons">
								<div class="slider-items slider-width-col4 products-grid block-content">
									
									<?php foreach($product['products'] as $tag_product): ?>

									<!-- Item -->
									<div class="item oinfo">
										<div class="infobox">
											<center>
												<img src="<?php echo url('images/img.png'); ?>">
												<br/><br/>
												<a href="<?php echo e(url('admin/product/editTagProducts/'.$tag_product->id)); ?>" class="btn mybtn w-min-sm mb-0-25 waves-effect waves-light">Edit</a>
											</center>
											<div class="row">
												<p class="c-white">Preferred Dimensions<br/><span class="gehara">208 X 208</span></p>
												<p class="c-white">Preferred File Size: 600 KB</p>
											</div>
										</div>
										<div class="item-inner">
											<div class="item-img">
												<div class="item-img-info"> <a class="product-image" title="<?php echo e($tag_product->name); ?>" href="#"> <img alt="<?php echo e($tag_product->name); ?>" src="<?php echo url('products-images/',[$tag_product->image]); ?>"> </a>
												</div>
											</div>
											<div class="item-info">
												<div class="info-inner">
													<div class="item-title"> <a title="<?php echo e($tag_product->name); ?>" href="#product_detail.html"> <?php echo e($tag_product->name); ?> </a> </div>
													<div class="item-content">
														<div class="rating">
															<div class="ratings">
																<div class="rating-box">
																	<div style="width:80%" class="rating"></div>
																</div>
																<p class="rating-links"> <a href="#"><?php echo e($tag_product->rating); ?> Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
															</div>
														</div>
														<div class="item-price">
															<div class="price-box"> <span class="regular-price"> <span class="price"><?php echo e($tag_product->new_price); ?></span> </span> </div>
														</div>
														<div class="action">
															<button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- End Item --> 

									<?php endforeach; ?>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
                <?php endif; ?>
				<!--END bestsell Slider -->
			</div>
			<div class="col-md-3">
				<div class="hot-deal">
					<div class="title">Hot Deal  - <a href="#"><span class="editpop">Edit</span></a></div>
					<ul class="products-grid">
						<div class="opbox <?php echo $hotdeals && is_file(public_path('products-images/'.$hotdeals[0]['image'])) ? "" : "obox_nomargin"?>">
							<center>
								<img src="<?php echo e(url('images/img.png')); ?>"><br/><br/>
								<a href="<?php echo e(($hotdeals) ? url('admin/product/producthotdealedit/'.$hotdeals[0]['id']) : url('admin/product/product-hot-deal')); ?>" class="btn mybtn w-min-sm mb-0-25 waves-effect waves-light">Edit</a>
								<div class="row">
									<p class="c-white">Preferred Dimensions<br/><span class="gehara">200 X 50</span></p>
									<p class="c-white">Preferred File Size: 600 KB</p>
								</div>
							</center>
						</div>

						<?php if($hotdeals): ?> 						
						<?php foreach($hotdeals as $result): ?> 
						<li class="right-space two-height item">
							<div class="item-inner">
								<div class="item-img">
									<div class="item-img-info">
										<a href="#" title="$result['name']" class="product-image">
											<img src="<?php echo url('products-images/',[$result['image']]); ?>" alt="<?php echo $result['name']; ?>">
										</a>
										<div class="new-label new-top-right">New</div>
									</div>
								</div>
								<div class="item-info">
									<div class="info-inner">
										<div class="item-title"> <a href="#product_detail.html" title="Retis lapen casen"> <?php echo $result['name']; ?> </a> </div>
										<div class="item-content">
											<div class="rating">
												<div class="ratings">
													<div class="rating-box">
														<div class="rating" style="width:80%"></div>
													</div>
													<p class="rating-links"> <a href="#"><?php echo $result['rating']; ?> Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
												</div>
											</div>
											<div class="item-price">
												<div class="price-box"> <span class="regular-price"> <span class="price"><?php echo $result['new_price']; ?></span> </span> </div>
											</div>
											<div class="action">
												<button data-original-title="Add to Cart" title="" type="button" class="button btn-cart"><span>Add to Cart</span> </button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li> 
						<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>

				<!-- Testimonials -->
				<div class="testimonials std">
					<div class="slider-items-products">
						<div id="testimonials" class="product-flexslider hidden-buttons">
							<div class="slider-items slider-width-col1 owl-carousel owl-theme"> 

								<!-- Item -->
								<?php foreach($testimonials as $testimonial): ?>
								<div class="item">
									<div class="inner-block testitem">
										<div class="tesitem">
											<img src="<?php echo e(url('images/img.png')); ?>"><br/><br/>
											<a href="<?php echo e(url('admin/testimonials/'.$testimonial->id.'/edit')); ?>" class="btn mybtn w-min-sm mb-0-25 waves-effect waves-light">Edit</a>
										</div>
										<div class="auther-img"><img alt="" src="<?php echo is_file(public_path('testimonials/'.$testimonial->image)) ? url('testimonials/'.$testimonial->image) : url('images/photo.png') ?>"></div>
										<?php 
										$testi = strip_tags(urldecode($testimonial->content));
										$testi = substr($testi,0,70);
										?>
										<div class="testimonials-text">"<?php echo $testi; ?>" </div>
										<div class="auther-name"><?php echo $testimonial->name; ?> <span>Founder - <?php echo $testimonial->designation; ?></span> </div>
									</div>
								</div>
								<?php endforeach; ?>
								
								<!-- End Item -->
							</div>
						</div>
					</div>
				</div>

				<!-- home side banner -->
				<div class="home-side-banner">
					<div class="sideban <?php echo is_file(public_path('product_images/banners/'.$right2->image)) ? "" : "obox_nomargin"?>">
						<center>
							<img src="<?php echo e(url('images/img.png')); ?>"><br/><br/>
							<a href="<?php echo e(url('admin/website-setting/add?cid=4')); ?>" class="btn mybtn w-min-sm mb-0-25 waves-effect waves-light">Edit</a>
							<div class="row">
								<p class="c-white">Preferred Dimensions<br/><span class="gehara">200 X 50</span></p>
								<p class="c-white">Preferred File Size: 600 KB</p>
							</div>
						</center>
					</div>
					<img alt="banner" src="<?php echo url('product_images/banners/',[$right2->image]); ?>" class="full-width" alt="Image">
				</div>
				<div class="spacer" style="height:10px;"></div>
				<div class="side-banner-img">
					<div class="sideban2 <?php echo is_file(public_path('product_images/banners/'.$right3->image)) ? "" : "obox_nomargin"?>">
						<center>
							<img src="<?php echo e(asset('images/img.png')); ?>"><br/><br/>
							<a href="<?php echo e(url('admin/website-setting/add?cid=5')); ?>" class="btn mybtn w-min-sm mb-0-25 waves-effect waves-light">Edit</a>
							<div class="row">
								<p class="c-white">Preferred Dimensions<br/><span class="gehara">200 X 50</span></p>
								<p class="c-white">Preferred File Size: 600 KB</p>
							</div>
						</center>
					</div>
					<a href="#" title="Image">
						<img src="<?php echo url('product_images/banners/',[$right3->image]); ?>" class="full-width" alt="Image">
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="footer-add">
	<div class="footer-add-item">
		<div class="col-md-4">
				<center>
					<img src="<?php echo e(url('images/img.png')); ?>">
				</center>
			</div>
			<div class="col-md-4">
				<center>
					<div class="row" style="margin-top: 5%;">
						<p class="c-white">Preferred Dimensions<br/><span class="gehara">1280 X 117</span></p>
						<p class="c-white">Preferred File Size: 600 KB</p>
					</div>	
				</center>
			</div>
			<div class="col-md-4 edit-btn ">
				<center>
					<a href="<?php echo e(url('admin/website-setting/add?cid=6')); ?>" class="btn mybtn w-min-sm mb-0-25 waves-effect waves-light">Edit</a>
				</center>
			</div>
		
	</div>
	<a href="<?php echo e(url('admin/website-setting/add?cid=6')); ?>">
		<img src="<?php echo url('product_images/banners/',[$contentstrip->image]); ?>" class="purnawidth">
	</a>
</div>

<!-- Footer -->
<footer class="myfooter">
	<!-- <div class="footer-add">
		<div class="footer-add-item">
			<div class="col-md-6">
				<img src="<?php echo e(url('images/img.png')); ?>">
			</div>
			<div class="col-md-6 edit-btn ">
				<a href="<?php echo e(url('admin/website-setting/add?cid=6')); ?>" class="btn mybtn w-min-sm mb-0-25 waves-effect waves-light">Edit</a>
			</div>
			
		</div>
		<a href="<?php echo e(url('admin/website-setting/add?cid=6')); ?>">
			<img src="<?php echo url('product_images/banners/',[$contentstrip->image]); ?>" alt="img-responsive">
		</a>
	</div> -->
	
	<div class="footer-inner">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<h4>Support</h4>
					<ul> 
						<li style="margin:10px 0;"><a style="font-size:20px;margin:10px 0;" id="alt_phone" href="#" data-toggle="modal" data-target="#st_phone" data-whatever="<?php echo e($homesetting->phone); ?>" data-datakey="phone"><i class="fa fa-phone"></i> +91-<?php echo e($homesetting->phone); ?> - <span class="editpop">Edit</span></a></li>
						<li style="padding-bottom:10px;border-bottom:1px solid #f2d03b;"><a href="#" data-toggle="modal" data-target="#st_phone" data-whatever="<?php echo e($homesetting->email); ?>" data-datakey="email"><i class="fa fa-envelope-o"></i> <?php echo e($homesetting->email); ?> - <span class="editpop">Edit</span></a></li>
						<li style="margin:10px 0 0 0;"><a href="<?php echo e(url('admin/socialmedia')); ?>"><h4>SOCIALIZE WITH US - <span class="editpop">Edit</span></h4></a>
							<ul class="social-links">
								<?php foreach($socialmedia as $social): ?>
				                  <li><a href="<?php echo e(url('admin/socialmedia/editsocial/'.$social->id)); ?>" title="<?php echo e($social->name); ?> "><i class="fa fa-<?php echo e($social->slug); ?>"></i></a></li>
				                <?php endforeach; ?>
								
							</ul>
						</li>
					</ul>
				</div>
				<div class="col-sm-4">
					<a href="<?php echo e(url('admin/pages')); ?>"><h4>Quick Links</h4></a>
					<ul class="links">
					<?php foreach($pages as $page): ?>
						<li class="first"><a href="<?php echo e(url('admin/pages/'.$page->id.'/edit')); ?>" title="<?php echo e($page->alias); ?>"><?php echo e($page->name); ?> - <span class="editpop">Edit</span></a></li>
					<?php endforeach; ?>	

					</ul>
				</div>
				<div class="col-sm-4">
					<h4>Stay in touch</h4>
					<h4>Payments Accepted</h4>
					<div class="payment-accept">
						<div><img src="<?php echo e(url('images/payment-1.png')); ?>" alt="payment1"> <img src="<?php echo e(url('images/payment-2.png')); ?>" alt="payment2"> <img src="<?php echo e(url('images/payment-3.png')); ?>" alt="payment3"> <img src="<?php echo e(url('images/payment-4.png')); ?>" alt="payment4"> </div>
					</div>
				</div>
			</div>
        
  </div>
</div>
<div class="footer-bottom">
	<div class="container">
		<div class="row">
			<p style="text-align:center;color:#aaa;margin:0;">&copy; Copyright 2017 Your Logo.com | All Rights Reserved</p>
		</div>
	</div>
</div>
</footer>
</div>
<!-- End Footer --> 
<!-- Footer -->
<footer class="footer">
	<div class="container-fluid">
		<div class="row text-xs-center">
			<div class="col-sm-4 text-sm-left mb-0-5 mb-sm-0">
				2016 © Neptune
			</div>
			<div class="col-sm-8 text-sm-right">
				<ul class="nav nav-inline l-h-2">
					<li class="nav-item"><a class="nav-link text-black" href="#">Privacy</a></li>
					<li class="nav-item"><a class="nav-link text-black" href="#">Terms</a></li>
					<li class="nav-item"><a class="nav-link text-black" href="#">Help</a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>
</div>
<!-- Models -->
<div class="modal fade" id="st_phone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 id ="exampleModalLabel" class="modal-title" >Home Page Setting </h4>
			</div>
			<?php echo Form::open(['method'=>'post', 'action' => ['Admin\WebsiteSetting\HomepageSettingController@homesetting']]); ?>


			<div class="modal-body">	
			<input type="hidden" class="form-control" name="key">										
				<div class="form-group row">
					
					<div class="col-xs-9">
						<input type="text" class="form-control" name="data" maxlength="40">
						<?php if($errors->has('data')): ?> <span class="text-danger"><?php echo e($errors->first('data')); ?> </span> <?php endif; ?>
					</div>
				</div>																			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
</div>

<div class="modal fade" id="quicklink" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 id ="exampleModalLabel" class="modal-title" >Home Page Setting </h4>
			</div>
			<?php echo Form::open(['method'=>'post', 'action' => ['Admin\WebsiteSetting\HomepageSettingController@homesetting']]); ?>


			<div class="modal-body">	
			<input type="hidden" class="form-control" name="key">										
				<div class="form-group row">
					
					<div class="col-xs-9">
						<input type="text" class="form-control" name="data">
						<?php if($errors->has('data')): ?> <span class="text-danger"><?php echo e($errors->first('data')); ?> </span> <?php endif; ?>
					</div>
				</div>	
				<div class="form-group row">
				<div class="col-xs-6"><button type="button" class="btn btn-primary">Change</button></div>
				<div class="col-xs-6"><button type="button" class="btn btn-primary">Edit</button></div>
				</div>																		
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
</div>
<!-- End Models -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>