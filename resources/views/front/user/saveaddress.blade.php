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
      <h2>Enter Address</h2>
      <hr>
      <form class="form-horizontal newaddressform">
        <div class="form-group">
          <label class="control-label mylabel col-sm-4" for="name">Name</label>
          <div class="col-sm-8">
            <input type="text" class="form-control fccmine" id="name">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label mylabel col-sm-4" for="address">Address</label>
          <div class="col-sm-8">
            <textarea class="form-control fccmine" rows="3" id="address"></textarea>  
          </div>
        </div>
        <div class="form-group">
          <label class="control-label mylabel col-sm-4" for="pincode">Pincode</label>
          <div class="col-sm-8"> 
            <input type="text" maxlength="6" class="form-control fccmine" id="pincode">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label mylabel col-sm-4" for="locality">Locality</label>
          <div class="col-sm-8"> 
            <input type="text" class="form-control fccmine" id="locality">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label mylabel col-sm-4" for="landmark">Landmark</label>
          <div class="col-sm-8"> 
            <input type="text" class="form-control fccmine" id="landmark">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label mylabel col-sm-4" for="city">City</label>
          <div class="col-sm-8"> 
            <input type="text" class="form-control fccmine" id="city">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label mylabel col-sm-4" for="city">State</label>
          <div class="col-sm-8"> 
            <select>
              <option>Select Your State</option>
              <option>AP</option>
              <option>AP</option>
              <option>AP</option>
              <option>AP</option>
              <option>AP</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label mylabel col-sm-4" for="mobile">Mobile Number</label>
          <div class="col-sm-8"> 
            <input type="text" class="form-control fccmine" id="mobile">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label mylabel col-sm-4" for="altmobile">Alternate Mobile Number</label>
          <div class="col-sm-8"> 
            <input type="text" class="form-control fccmine" id="altmobile">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label mylabel col-sm-4" for="altmobile">Address Type</label>
          <div class="col-sm-8"> 
            <label class="radio-inline radiocnt"><input type="radio" name="home">Home</label>
            <label class="radio-inline radiocnt"><input type="radio" name="office">Office</label>
            <br/>
            <label class="radio-inline radiocnt"><input type="radio" name="default">Makes this as default address</label>
          </div>
        </div>
        <div class="form-group"> 
          <div class="col-sm-12">
            <center>
              <button type="submit" title="Submit" class="button submit"> <span> Submit </span> </button>
            </center>
          </div>
        </div>
      </form>
          <!--  ///*///======    End article  ========= //*/// --> 
        </div>
        <div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
          @include('front/common/user/sidebar')
        </div>
      </div>
    </div>
  </section>
@endsection