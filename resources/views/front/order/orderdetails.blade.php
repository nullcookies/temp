@extends('front.layouts.front_master')

@section('title')
| Ecommerce website
@endsection

@section('meta')
<meta name="title" content="kibakibi">
 <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}" />
@endsection

@section('content')
  <section class="main-container col2-left-layout bounceInUp animated">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
      <h2>Order Details</h2>
      <hr>
      <h5>Order ID:123456789, Placed on 11th April, 2017</h5>
      <div class="container pad-30 new-cont mb-50 mob-center">
        <div class="col-md-4 col-sm-4">
          <h5>Customer Information</h5>
          <h5 class="bold">Email: ekthageedhad@gagan.com</h5>
        </div>
        <div class="col-md-4 col-sm-4">
          <h5>Payment Method</h5>
          <h5 class="bold">Cash on Delivery</h5>
        </div>
        <div class="col-md-4 col-sm-4">
          <h5>Total <span style="margin-left:90px;"><i class="fa fa-inr"></i> 3,699</span></h5>
          <h5>Delivery Charge <span style="margin-left:30px;"><i class="fa fa-inr"></i> 3,699</span></h5>
          <div class="line-new"></div>
          <h5>Payable Amount <span style="margin-left:30px;"><i class="fa fa-inr"></i> 3,699</span></h5>
        </div>
      </div>
      <div class="container pad-30 border-all">
        <h5 class="mob-center">Suborder ID: 23307895476</h5>
        <div class="row">
        <div class="col-md-2 col-sm-2 mob-center">
          <img src="{{asset('images/mobile.png')}}"/>
        </div>
        <div class="col-md-6 col-sm-6 mob-center">
          <h4>Samsung Galaxy S6</h4>
          <h6>Colour: Metallic Gray</h6>
          <button class="btn cancel-btn">Cancel</button>
          <button class="btn needhelp-btn"><i class="fa fa-question-circle"></i> Need Help</button>
        </div>
        <div class="col-md-4 col-sm-4 mob-center center price-box">
          <h4><i class="fa fa-inr"></i> 3,699</h4>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12 status-box pad-20">
          <ul class="status">
            <li class="pull-left mob-center"><h4>Status: <span style="color:#277abf;">Preparing for Dispatch</span></h4>
            <p>Last updated at 3:42:59 PM, Today</p>
            
            </li>
            <li class="pull-right mob-center">Estimated Delivery: 13 Apr, 2017 - 16 Apr, 2017</li>
          </ul>
        </div>
        </div>
        <div class="col-md-12 pad-20 pdb-50">
          <div class="col-md-4 col-sm-4 pad-50 zind left mob-center">
            
            <p>Placed</p>
          </div>
          <div class="col-md-4 col-sm-4 pad-50 zind center mob-center"">
            <img src="{{asset('images/black.png')}}"/>
            <p>Dispatched</p>
          </div>
          <div class="col-md-4 col-sm-4 pad-50 zind right mob-center"">
            <img src="{{asset('images/black.png')}}"/>
            <p>Delivered</p>
          </div>
          <div class="line-strike2"></div>
        </div>
        <div class="col-md-12 pad-20 mob-center">
          <a href="#" class="track-btn">Track Order</a>
        </div>
        <div class="col-md-12 pad-20 mob-center">
          <h5>Shipping Information</h5>
          <p>Gagan<p>
          <p>B-27, Sector - 65, Noida</p>
          <p>Uttar Pradesh - 201301</p>
          <p>Mobile No: 9650839753</p>
        </div>
      </div>
      
      
          <!--  ///*///======    End article  ========= //*/// --> 
        </div>
        
      </div>
    </div>
  </section>
@endsection