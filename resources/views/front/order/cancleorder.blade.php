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
    <div class="col-md-12 cpd-50">
      <div class="panel-group" id="accordion">
        <div class="panel panel-default my-panel">
          <div class="panel-heading ph2">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><img src="{{asset('images/cancel-order.png')}}"/> 1. Reason for cancellation</a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse in">
            <div class="panel-body">
              {!! Form::open(array('method' => 'post', 'class' => 'cancel-form col-md-4' ,'action' => ['Front\Order\OrderController@cancleOrder', $orderid])) !!}
                <div class="form-group">
                  <label for="reason">Reason:</label>
                  <select name="reason" class="fcmine">
                    <option value="">Select Option</option>
                    <option value="i_m_getting_better_product_elsewhere">I'm getting better price elsewhere</option>
                    <option value="i_getting_better_price_elesewhere">I'm getting better price in Snapdeal</option>
                    <option value="i_buy_letter">I'll buy later</option>
                    <option value="getting_better_product_offline">I'm getting a better product offline</option>
                    <option value="not_available_for delivery">I'll not be available to take delivery</option>
                    <option value="any_other_reason">Any other reason</option>
                  </select>
                  @if($errors->has('reason')) <span>{{$errors->first('reason')}}</span> @endif
                </div>
                <div class="form-group">
                  <label for="pwd">Comments:</label>
                  <textarea rows="4" name="comments" class="form-control fcmine"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
        
      </div>
    </div>
  </section>
@endsection