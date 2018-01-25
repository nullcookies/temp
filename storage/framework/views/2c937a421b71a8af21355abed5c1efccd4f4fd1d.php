<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="x-ua-compatible" content="ie=edge">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php echo $__env->yieldContent('meta'); ?>
<!-- Favicons Icon -->
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon" />
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<title><?php echo e(PROJECT_NAME); ?> <?php echo $__env->yieldContent('title'); ?> </title>
<?php echo $__env->make('front/common/headerScript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>

<body class="cms-index-index cms-home-page">
<div id="page"> 
  <!-- Header -->
  <?php echo $__env->make('front/common/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  
  <?php echo $__env->yieldContent('top_newsletter'); ?>
  <?php echo $__env->yieldContent('content'); ?>
  
  <?php echo $__env->make('front/common/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<!-- End Footer --> 

<?php echo $__env->make('front/common/footer_mobile_menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- JavaScript --> 
<script type="text/javascript" src="<?php echo e(asset('js/jquery.min.js')); ?>"></script> 
<script type="text/javascript" src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script> 
<script type="text/javascript" src="<?php echo e(asset('js/revslider.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/jquery.flexslider.js')); ?>"></script> 
<script type="text/javascript" src="<?php echo e(asset('js/common.js')); ?>"></script> 
<script type="text/javascript" src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script> 
<script type="text/javascript" src="<?php echo e(asset('js/jquery.mobile-menu.min.js')); ?>"></script> 
<script type="text/javascript" src="<?php echo e(asset('js/countdown.js')); ?>"></script> 
<script type="text/javascript" src="<?php echo e(asset('js/cloud-zoom.js')); ?>"></script>

<?php echo $__env->yieldContent('scripts'); ?>
<script type="text/javascript">
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
</script>

<script>

	$(document).ready(function(){
		fetchCart();

		function KeyPress(e) {
	      var evtobj = window.event? event : e
	      if (evtobj.keyCode == 83 && evtobj.ctrlKey){
	      	e.preventDefault();
	      	$('.searchProductTextBoxInput').focus();
	      };
		}

		document.onkeydown = KeyPress;
	});

	function removeCart(cartid){
		$.ajax({
			url: "<?php echo e(url('/removeCartAjax')); ?>",
			type: 'POST',
			data: {cartid:cartid},
			dataType: 'json',
			success: function(result){
				fetchCart();
			}
		});
	}

	function fetchCart(){
		
		$.ajax({
			url: "<?php echo e(url('/fetchCartAjax')); ?>",
			type: 'GET',
			dataType: 'html',
			beforeSend: function(){},
			success: function(result){
				$('.cartItemsHeaderNav').html(result);
			},
		});
	}


	function getSearch(value){
        if(!value){
        	$('#searchResult').html('');
        	throw new Error("Empty value for search");
        }
        
		$.ajax({
			url: "<?php echo e(url('/search')); ?>",
			type: 'POST',
			dataType: 'html',
			data: {value: value},
			beforeSend: function(){},
			success: function(result){
				console.log(result);
				$('#searchResult').html(result);
			},
		});
	}

</script>

<script>
	
    function addToCart(){
    	var formData = $('#product_detail_form').serialize();
    	$.ajax({
    		url: "<?php echo e(url('/addToCart')); ?>",
    		type: 'POST',
    		data: formData,
    		dataType: 'json',
    		success: function(result) {
    			if(result['fail']){
					$('#wishlist_result').removeClass('text-success');
					$('#wishlist_result').addClass('text-danger');
				}else if(result['success']){
					$('#wishlist_result').addClass('text-success');
					$('#wishlist_result').removeClass('text-danger');
				}
				$('#wishlist_result').html(result['message']);
				fetchCart();
    		}
    	});
    }
</script>

<script>
	  
	function addtowishlist(productid){
		
		$.ajax({
			url: "<?php echo e(url('/addToWishlistAjax')); ?>",
			type: 'POST',
			data: {productid:productid},
			dataType: 'json',
			beforeSend: function(){},
			success: function(result){
				console.log(result);
				if(result['fail']){
					$('#wishlist_result').removeClass('text-success');
					$('#wishlist_result').addClass('text-danger');
				}else if(result['success']){
					$('#wishlist_result').addClass('text-success');
					$('#wishlist_result').removeClass('text-danger');
				}
				$('#wishlist_result').html(result['message']);
			},
		});
	}
</script>
</body>
</html>