@extends('massengers/layout/layout')

@section('js')
	<script type="text/javascript">
		
		function removeCart(cartid){
			swal({
			        title: "Are you sure?",
			        text: "You will not be able to recover Cart Item!",
			        type: "warning",
			        showCancelButton: true,
			        confirmButtonColor: "#d80003",
			        confirmButtonText: "Yes, delete it!",
			        cancelButtonText: "No, cancel please!",
			        closeOnConfirm: false,
			        closeOnCancel: false 
			    },
			    function(isConfirm) {
			        if (isConfirm) {
			            
			            $.ajax({
			            	url: "{{url('/delete_cart_item')}}",
			            	type: 'post',
			            	data: {cartid:cartid},
			            	dataType: 'json',
			            	beforeSend: function(){
								swal({
								  title: 'Processing..',
								  text: 'please do not referesh the page',
								  showCancelButton: false,
								  showConfirmButton: false
								});
							},
							success: function(result){
								if(result['message']){
									location.reload();
								}
							},
							error: function(data){
								errorsHtml = '';
								$.each(data.responseJSON, function(key, value) {
									if($.isArray(value)){
										errorsHtml += value[0];
									}else{
										errorsHtml += value;
									}
									return false;
						        });

								swal(errorsHtml, '', 'error');
							}
			            });
			        } else {
			            swal("Cancelled", "Your Cart Item is safe :)", "error");
			        }
			    }
			);
		}


		// checkout by cart

		$(document).ready(function(){
			$('#checkout_by_cart, #checkout_by_cart1').on('click', function(event){
			            $.ajax({
			            	url: "{{url('/checkout_by_cart')}}",
			            	type: 'post',
			            	dataType: 'json',
			            	beforeSend: function(){
								swal({
								  title: 'Processing..',
								  text: 'please do not referesh the page',
								  showCancelButton: false,
								  showConfirmButton: false
								});
							},
							success: function(result){
								if(result['message']){
									window.location.href = "{{url('/product/checkout')}}/"+result['buy_now_id'];
								}
							},
							error: function(data){
								errorsHtml = '';
								$.each(data.responseJSON, function(key, value) {
									if($.isArray(value)){
										errorsHtml += value[0];
									}else{
										errorsHtml += value;
									}
									return false;
						        });

								swal(errorsHtml, '', 'error');
							}
			            });
			        
			});
		})
	</script>
@endsection

@section('content')

@if(count($carts))
<div class="container-fluid mobpd10 pd-30">
	<div class="container">
		<ol class="breadcrumb ms-breadcrumb">
		<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
			<li class="breadcrumb-item active" >Search Product</li>
		</ol>
	</div>
</div>
<div class="container-fluid pd-50">
	<div class="container cart">
		<h1>Your Cart</h1>
		<br/>
		<div class="cart-div">
			<table class="table table-responsive cart-table">
				<thead>
					<tr>
						<th>Products</th>
						<th>Send To</th>
						<th>Quantity</th>
						<th>Amount</th>
					</tr>
				</thead>
				<tbody>
				@foreach($carts as $cart)
					<tr>
						<td>
							<div class="img-box">
								<img src="{{$productimage[$cart->id]}}"/>
							</div>
							<div class="content-box">
								<p>{{$cart->product_name}}</p>
								<a href="javascript:;" onclick="removeCart({{$cart->id}})">Remove</a>
							</div>
						</td>
						<td>
							<p class="c-red">{{$delivering_on[$cart->id]}}, {{$delivery_timing[$cart->id]}}</p>
							<p>{{$delivery_option[$cart->id]}}</p>
						</td>
						<td>
							<p class="c-red">{{$cart->quantity}}</p>
						</td>
						<td>
							<p class="c-red"><i class="fa fa-inr"></i> {{$cart->product_selling_price}}</p>
						</td>
					</tr>
				@endforeach	
				
					<tr>
						<td class="bdtop" colspan="2">
							<p class="c-red">&#042; Shipping charges to be displayed in the Order Summary Page.</p>
						</td>
						<td class="bdtop">
							<p>Subtotal</p>
						</td>
						<td class="bdtop">
							<p class="c-red"><i class="fa fa-inr"></i> {{$subtotal}}</p>
						</td>
					</tr>
					<tr>
						<td class="bdtop" colspan="2">
						</td>
						<td class="bdtop">
							<p>Total</p>
						</td>
						<td class="bdtop">
							<p class="c-red"><i class="fa fa-inr"></i> {{$subtotal}}</p>
						</td>
					</tr>
				</tbody>
			</table>
			<ul class="cart-list">
				<li><a href="{{url('/')}}" class="con-shop">Continue Shopping</a></li>
				<li><a href="javascript:;" id="checkout_by_cart" class="con-shop">Proceed to Pay</a></li>
			</ul>
		</div>
		<div class="pull-right hidden-md hidden-sm hidden-lg">
    		<ul class="cart-list2 hidden-md hidden-sm hidden-lg">
    			<li><a href="{{url('/')}}" class="con-shop">Continue Shopping</a></li>
    			<li><a href="javascript:;" id="checkout_by_cart1" class="con-shop">Proceed to Pay</a></li>
    		</ul>
    	</div>	
	</div>
</div>
<!--<div class="ySRtsT _15Eojs _2WC1yH">
    <div class="_20zWgK m4C_gQ">
        <span><a href="{{url('/')}}">Continue Shopping</a></span>
    </div>
    <div class="_20zWgK">
        <span><a href="javascript:;" id="checkout_by_cart">Proceed To pay</a></span>
    </div>
</div>-->
@else
<div class="container-fluid pd-50">
	<div class="container minicart">
		<h1>Your Cart</h1>
		<center>
			<img src="{{asset('massengers/img/frownface.png')}}"/>
		</center>
		<h3>Your cart is empty now.</h3>
		<h4></h4>
		<br/>
		<a href="{{url('/')}}" class="shop-now cart-btn" title="Shop Now">Shop Now</a>
	</div>
</div>
@endif
<div class="container-fluid bg-f9f9 pd-30">
	<div class="container cart2">
		<div class="col-md-6 col-xs-12">
			<h3 class="callus"><span class="c-red">Need Help?</span> Call us on +91-7838576144</h3>
		</div>
		<div class="col-md-6 col-xs-12">
			<h3 class="pushright people"><span class="c-red">4 Million</span>  People Trusted Us</h3>
		</div>
	</div>
</div>
@endsection