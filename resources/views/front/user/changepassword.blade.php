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
      <h2>Change Password</h2>
      <hr>
      <form class="form-horizontal chngpwd-form">
        <div class="form-group">
          <label class="control-label mylabel col-sm-4" for="crtpwd">Current Password*</label>
          <div class="col-sm-8">
            <input type="text" class="form-control fccmine" id="email" placeholder="Enter Current Password">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label mylabel col-sm-4" for="newpwd">New Password*</label>
          <div class="col-sm-8"> 
            <input type="text" class="form-control fccmine" id="newpwd" placeholder="Enter New Password">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label mylabel col-sm-4" for="connewpwd">Confirm New Password*</label>
          <div class="col-sm-8"> 
            <input type="text" class="form-control fccmine" id="connewpwd" placeholder="Enter password">
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