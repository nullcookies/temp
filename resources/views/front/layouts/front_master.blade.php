<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="x-ua-compatible" content="ie=edge">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@yield('meta')
<!-- Favicons Icon -->
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>{{PROJECT_NAME}} @yield('title') </title>
@include('front/common/headerScript')
</head>

<body class="cms-index-index cms-home-page">
<div id="page"> 
  <!-- Header -->
  @include('front/common/header')
  
  @yield('top_newsletter')
  @yield('content')
  
  @include('front/common/footer')
</div>
<!-- End Footer --> 

@include('front/common/footer_mobile_menu')

<!-- JavaScript --> 
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('js/revslider.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.flexslider.js')}}"></script> 
<script type="text/javascript" src="{{asset('js/common.js')}}"></script> 
<script type="text/javascript" src="{{asset('js/owl.carousel.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('js/jquery.mobile-menu.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('js/countdown.js')}}"></script> 
<script type="text/javascript" src="{{asset('js/cloud-zoom.js')}}"></script>

@yield('scripts')
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
			url: "{{url('/removeCartAjax')}}",
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
			url: "{{url('/fetchCartAjax')}}",
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
			url: "{{url('/search')}}",
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
    		url: "{{url('/addToCart')}}",
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
			url: "{{url('/addToWishlistAjax')}}",
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