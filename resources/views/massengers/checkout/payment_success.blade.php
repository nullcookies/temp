@extends('massengers/layout/layout')

@section('content')
	
<!--<div class="container-fluid pd-50">
	<div class="container cart">
		<div class="cart-div2">
			<div class="col-md-4">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 52 52" style="enable-background:new 0 0 52 52;" xml:space="preserve" width="128px" height="128px">
				<g>
					<path d="M26,0C11.664,0,0,11.663,0,26s11.664,26,26,26s26-11.663,26-26S40.336,0,26,0z M26,50C12.767,50,2,39.233,2,26   S12.767,2,26,2s24,10.767,24,24S39.233,50,26,50z" fill="#d80003"/>
					<path d="M38.252,15.336l-15.369,17.29l-9.259-7.407c-0.43-0.345-1.061-0.274-1.405,0.156c-0.345,0.432-0.275,1.061,0.156,1.406   l10,8C22.559,34.928,22.78,35,23,35c0.276,0,0.551-0.114,0.748-0.336l16-18c0.367-0.412,0.33-1.045-0.083-1.411   C39.251,14.885,38.62,14.922,38.252,15.336z" fill="#d80003"/>
				</g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
				</svg>
			</div>
			<div class="col-md-8 center">
				<h1>Thank You</h1>
				<center>
					<p class="order-status">Order #{!! $orderid !!}</p>
				</center>
				<h3>Order Completed Successfully</h3>
			</div>
			<div class="col-md-12 center">
				<h4 style="font-size:16px;line-height:30px;">Yayy! You went through a successful payment method. You really are the champ!</h4>
			</div>
		</div>
	</div>
</div>-->

<div class="container-fluid pd-50">
	<div class="container">
		<div class="row row80">
			<div class="col-md-12">
				<div class="successbox">
					<div class="success-image">
						<img src="{{asset('massengers/img/success.png')}}" class="img-responsive center-block">
					</div>
					<div class="success-text center">
						<h4>Thank you</h4>
						<h3>Order #{!! $orderid !!}</h3>
						<p>Order completed successfully!</p>
					</div>
				</div>
				<div class="success-textbox center">
					<p>Yayy! You went through a successful payment method. You really are the champ!</p>
				</div>
			</div>
		</div>
	</div>
</div>

	
@endsection