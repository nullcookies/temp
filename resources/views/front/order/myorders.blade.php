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
        <div class="col-sm-9 col-sm-push-3 myorders">
      <h2>My Orders</h2>
      <hr>
      
      <div class="panel-group" id="accordion">
      @foreach($orders as $order)
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$order->id}}">
            Order ID: {{$order->id}} ({{count($order->products)}} Item)<br/><br/>
            Placed On: {{date_format(date_create($order->created_at),"D d-M-Y H:i:s")}}
            <button class="pull-right hidden-xs view-btn">View Details</button></a>
            </h4>
          </div>

          <div id="collapse{{$order->id}}" class="panel-collapse collapse in">
            <div class="panel-body mpbody">
            @foreach($order->products as $orderProduct)
              <div class="row">
                <div class="col-md-2 col-sm-2 mob-center">
                  <img width="100" height="100" src="{{$productImage[$orderProduct->id]}}"/>
                </div>

                <div class="col-md-6 col-sm-6 mob-center">
                  <h4>{{substr($orderProduct->product_name,0,30)}}</h4>
                  <h6>{{$orderProduct->varients}}</h6>
                  <button class="btn needhelp-btn"><i class="fa fa-question-circle"></i> Need Help</button>
                </div>
                <div class="col-md-4 col-sm-4 mob-center center price-box">
                  <h4><i class="fa fa-inr"></i> {{$orderProduct->selling_price}}</h4>
                </div>
              </div>
              @endforeach
              <div class="row">
                <div class="col-md-12 {{$status_box_class[$order->id]}}" >
                  <ul class="status">
                    <li class="pull-left mob-center"><h4>Status: <span style="color:#277abf;">{{$orderstatus[$order->id]}}</span></h4>
                    </li>
                    <li class="pull-right mob-center">@if(!in_array($order->status,['delivered','completed','cancel'])) Estimated Delivery: {{$estimate_delivery_date[$order->id]}} @endif</li>
                  </ul>
                </div>
              </div>
                <!-- <div class="col-md-12 pad-20 pdb-50">
                  <div class="col-md-4 col-sm-4 pad-50 zind left mob-center">
                    <img src="{{asset('images/blue.png')}}"/>
                    <p>Placed</p>
                  </div>
                  <div class="col-md-4 col-sm-4 pad-50 zind center mob-center">
                    <img src="{{asset('images/blue.png')}}"/>
                    <p>Dispatched</p>
                  </div>
                  <div class="col-md-4 col-sm-4 pad-50 zind right mob-center">
                    <img src="{{asset('images/green.png')}}"/>
                    <p>Delivered</p>
                  </div>
                  <div class="line-strike2"></div>
                </div> -->
                <div class="col-md-12 pad-20 mob-center">
                @if($order->status == 'delivered')
                  {!! Form::open(array('method' => 'get', 'class' => 'display_inline_form', 'action' => ['Front\Order\MyOrderController@returnOrder',$order->id])) !!}
                    <button type="submit" class="track-btn">Return</button>
                  {!! Form::close() !!}
                @endif

                @if($order->status == 'open')
                  {!! Form::open(array('class' => 'display_inline_form','method' => 'get','action' => ['Front\Order\MyOrderController@cancleorder', $order->id])) !!}
                    <button type="submit" class="track-btn">Cancle</button>
                  {!! Form::close() !!}
                @endif
                </div>
                
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @if(count($orders)) {!! $orders->render() !!} @endif
          <!--  ///*///======    End article  ========= //*/// --> 
        </div>
        <div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
          @include('front/common/user/sidebar')
        </div>
      </div>
    </div>
  </section>
@endsection