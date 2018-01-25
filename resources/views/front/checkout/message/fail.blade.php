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
      <div class="col-md-offset-3 col-md-6 payment-failed">
		<center><img src="{{url('images/message/error.png')}}"/></center>
		<h3>Payment Failed</h3>
		<h5>Your Transaction Failed. You will receive your e-receipt in your email shortly. 
		</h5>
		<a href="{{url('/')}}" type="button" class="btn-home"><span>Back to Homepage</span></a>
	  </div>
    </div>
  </div>
@endsection
