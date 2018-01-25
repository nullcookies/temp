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
        <div class="col-sm-9 col-sm-push-3">
      <h2>Saved Address</h2>
      <hr>
      <div class="col-md-4 col-sm-4 center addressbox">
        <ul>
          <li class="pull-left default-box">Default</li>
          <li class="pull-right"><i class="fa fa-home"></i></li>
        </ul>
        <br/>
        <h3>Gagan Chabra</h3>
        <p>1/159, Gali Number-16, Gandhi Colony, Muzzafarnagar - 251001, Uttar Pradesh</p>
        <p>Mob : 9650839753</p>
        <ul>
          <li class="pull-left"><a href="#"><i class="fa fa-trash"></i> Delete</a></li>
          <li class="pull-right"><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
        </ul>
      </div>
      <div class="col-md-4 col-sm-4 center addressbox">
        <ul>
          <li class="pull-right"><img src="{{asset('images/chair.png')}}"/></li>
        </ul>
        <br/>
        <h3>Gagan Chabra</h3>
        <p>1/159, Gali Number-16, Gandhi Colony, Muzzafarnagar - 251001, Uttar Pradesh</p>
        <p>Mob : 9650839753</p>
        <ul>
          <li class="pull-left"><a href="#"><i class="fa fa-trash"></i> Delete</a></li>
          <li class="pull-right"><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
        </ul>
      </div>
      
          <!--  ///*///======    End article  ========= //*/// --> 
        </div>
        <div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
          @include('front/common/user/sidebar')
        </div>
      </div>
    </div>
  </section>
@endsection