@extends('front.layouts.front_master')

@section('title')
    | Ecommerce website
@endsection

@section('meta')

<meta name="title" content="kibakibi">
<meta name="description" content="ecommerece, products, online buy product">
<meta name="author" content="TechTurtle">
<link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}" />
<style>
    .content-wrapper {
    margin: auto;
    text-align: center;
    background-color: #f2d03b !important;
    padding-top: 80px;
    padding-bottom: 120px;
}
footer{
    margin-top:0px !important;
}
</style>
@endsection

@section('content')
<div class="content-wrapper">
  <div class="container">
      <div class="col-md-offset-3 col-md-6">
    <center><img src="{{url('images/message/success.png')}}"/></center>
<h3>Payment Successful</h3>
<h4>Congratulations! Your order has been placed successfully.</h4>
<h5>Your <strong>transaction Id: {{$order->txnId}}</strong></h5>
<h5>Your <strong>Order No: {{$order->id}}</strong></h5>
<h5>
    
   
{{$order->paymentType == 'cod' ? 'You are required to pay Rs' : 'You have paid'}} <i class="fa fa-inr"></i> {{$order->orderAmount}}. {{$order->paymentType == 'cod' ? 'when you receive the product.' : 'for your purchase'}}  </h5>
<br/><br/>
<a href="{{url('/')}}" type="button" class="btn-home"><span>Back to Homepage</span></a>
</div>
    </div>
    </div>
@endsection
