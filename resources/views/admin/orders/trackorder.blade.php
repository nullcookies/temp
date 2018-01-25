@extends('admin/layouts/layout')

@section('title')
| {{$title}}
@endsection

@section('pageTopScripts')
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<style>
.timeline.timeline-center .tl-left{
	text-align:right;
}
</style>
@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	
</script>
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
<div class="container-fluid">
						<h4>Order Status</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Order Status</li>
						</ol>
						@if($order)
						<div class="box box-block bg-white">
							<h3 class="order-status">Order Details</h3>
							<div class="box box-order table-mobile">
							<table class="table table-striped table-order min-width-600">
									<thead>
										<tr class="bg-f5">
											<th>Order Date:</th>
											<td>{{Carbon\Carbon::parse($order->created_at)->format('D d-M-Y')}}</td>
											<th>Status:</th>
											<td>{{$order->status}}</td>
										</tr>
									</thead>
									<tbody>
										<tr class="bg-fff">
											<td>Order ID:</td>
											<td>{{$order->id}}</td>
											<td>Total Order Amount:</td>
											<td><i class="fa fa-inr"></i> {{$order->orderAmount}}</td>
											
										</tr>
										<tr class="bg-fff">
											<td>AWB No.</td>
											<td>{{$order->awb_number}}</td>
											<td>Shipping Price.</td>
											<td>{{$shippingCharge = DB::table('delivery_methods')->where('alias',$order->delivery_option)->first() ? DB::table('delivery_methods')->where('alias',$order->delivery_option)->first()->shipping_charge : 0}}</td>
										</tr>
										<tr class="bg-fff">
										    <td>Customer Email:</td>
											<td>{{$order->customerEmail}}</td>
											<td>Customer Mobile Number:</td>
											<td>{{$order->customerPhone}}</td>
										</tr>
									</tbody>
								</table>
								<table class="table table-striped table-order min-width-600">
									<thead>
										<tr class="bg-f5">
											<th>Product Name</th>
											<th>UPC</th>
											<th>Quantity</th>
											<th>Varient</th>
											<th>Price</th>
											<th>Delivery Date</th>
											<th>Delivery Option</th>
											<th>Shipping Time</th>
										</tr>
									</thead>
									<tbody>
									<?php $sumProductPrices = 0;$productTypeArr = array(); ?>
									@foreach($order->products as $product)
									<?php
									    $delivery_timing = DB::table('delivery_timings')->where('value',$product->shipping_time)->select('timing')->take(1)->first();
									?>

										<?php $sumProductPrices += ($product->selling_price*$product->quantity); ?>
										<?php $productTypeArr[] = $product->product_type; ?>
										<tr class="bg-fff">
											<td>{{$product->product_name}}</td>
											<td>{{$product->product_id}}</td>
											<td>{{$product->quantity}}</td>
											<td>{{DB::table('varient_type_values')->where('id',$product->varients)->select('value')->first() ? DB::table('varient_type_values')->where('id',$product->varients)->select('value')->first()->value : '' }}</td>
											<td>{{App\Http\Controllers\Massengers\Product\ProductController::getVarientPrice($product->product_id,$product->varients, $product->selling_price) * $product->quantity}}</td>
											<td>{{Carbon\Carbon::parse($product->selected_delivery_date)->format('D d-M-Y')}}</td>
											<td>{{$product->delivery_option}}</td>
											<td>{{$delivery_timing?$delivery_timing->timing:''}}</td>
										</tr>
										<tr class="bg-fff">
											<td colspan="8"><b>Additional Properties</b></td>
										</tr>
										<tr class="bg-fff">
										    <td colspan="2"><a target="_blank" href="{{$product->cover_photo}}"><img height="70" src="{{$product->cover_photo}}" /></a></td>
											<td colspan="1">Paper Color : {{strlen($product->paper_color)? $product->paper_color : 'none'}}</td>
											<td colspan="2">Ink Color : {{strlen($product->ink_colour)? $product->ink_colour : 'none'}}</td>
											<td colspan="1">Emotions : {{strlen($product->emotions)? $product->emotions : 'none'}}</td>
											<td colspan="1">Receipent Name : {{strlen($product->receipent_name)? $product->receipent_name : 'none'}}</td>
											<td colspan="1">Message : {{strlen($product->message)? $product->message : 'none'}}</td>
										</tr>
										@if($product->has_add_more_love == 'yes')
										<tr class="bg-fff">
											<td colspan="8"><b>Additional Products</b></td>
										</tr>
										
										<?php 
										    $add_some_more_love_products = DB::table('add_some_more_love_products')->whereIn('id', explode(',',$product->add_more_love_products_id))->get();
										?>
										
										@foreach($add_some_more_love_products as $add_some_more_love_product)
										<tr class="bg-fff">
										    <td colspan="2"><img src="{{url('/massengers/img/'.$add_some_more_love_product->image_url)}}" /></td>
											<td colspan="4"> {{$add_some_more_love_product->name}}</td>
											<td colspan="2"><i class="fa fa-inr"></i> {{$add_some_more_love_product->price}}</td>
										</tr>
										@endforeach
										@endif
									@endforeach
									</tbody>
								</table>
							
								@if(!in_array('api',$productTypeArr))
								<!--<div class="card-footer clearfix min-width-600">
									<a target="_blank" href="{{url('/admin/orders/shippinglabel/'.$order->id)}}" class="btn btn-danger label-left float-xs-right">
										<span class="btn-label"><i class="fa fa-print"></i></span>
										Print Shipping Label
									</a>
									<a target="_blank" href="{{url('/admin/orders/invoice/'.$order->id)}}" class="btn btn-info label-left float-xs-right mr-0-5">
										<span class="btn-label"><i class="fa fa-file-text-o"></i></span>
										Print Invoice
									</a>
								</div>-->
								@endif
							</div>
						</div>
						<div class="box box-block bg-white">
							<h3 class="shipping-details">Shipping Details</h3>
							<div class="timeline timeline-center mt-20">
								<div class="tl-item">
									<div class="tl-wrap b-a-success">
										<div class="tl-content box-block bg-white br-5">
											<span class="arrow left b-a-white"></span>
											Order Received
										</div>
										<p class="content-timeline">{{Carbon\Carbon::parse($order->created_at)->format('D d/m/Y')}}</p>
										<span class="time">{{Carbon\Carbon::parse($order->created_at)->format('h:i:s A')}}</p>
									</div>
								</div>
								@if($order->manifest)
								<div class="tl-item tl-left">
									<div class="tl-wrap b-a-success">
										<div class="tl-content box-block bg-warning br-5">
											<span class="arrow right b-a-warning"></span>
											Manifested
										</div>
										<p class="content-timeline">{{Carbon\Carbon::parse($order->manifest->dispatchDate)->format('D d/m/Y')}}</p>
										<span class="time">{{Carbon\Carbon::parse($order->manifest->dispatchDate)->format('h:i:s A')}}</p>
									</div>
								</div>
								@if($order->is_dispatched == 'yes')
								<div class="tl-item">
									<div class="tl-wrap b-a-success">
										<div class="tl-content box-block bg-primary br-5">
											<span class="arrow left b-a-primary"></span>
											<!--<h6>Title</h6>-->
											Dispatched
										</div>
										<p class="content-timeline">{{Carbon\Carbon::parse($order->dispatched_time)->format('D d/m/Y')}}</p>
										<span class="time">{{Carbon\Carbon::parse($order->dispatched_time)->format('h:i:s A')}}</p>
									</div>
								</div>
								@if($order->is_delivered == 'yes')
								<div class="tl-item tl-left">
									<div class="tl-wrap b-a-success">
										<div class="tl-content box-block bg-success br-5 ml-15">
											<span class="arrow right b-a-success"></span>
											Delivered
										</div>
										<p class="content-timeline">{{Carbon\Carbon::parse($order->delivery_time)->format('D d/m/Y')}}</p>
										<span class="time">{{Carbon\Carbon::parse($order->delivery_time)->format('h:i:s A')}}</p>
									</div>
								</div>
								@if($order->is_completed == 'yes')
								<div class="tl-item">
									<div class="tl-wrap b-a-success">
										<div class="tl-content box-block bg-white br-5">
											<span class="arrow left b-a-white"></span>
											Completed
										</div>
										<p class="content-timeline">{{Carbon\Carbon::parse($order->order_complete_time)->format('D d/m/Y')}}</p>
										<span class="time">{{Carbon\Carbon::parse($order->order_complete_time)->format('h:i:s A')}}</p>
									</div>
								</div>
								@endif <!-- completed if  -->

								@endif <!-- delivered if  -->

								@endif <!-- dispatchd if -->

								@endif <!-- manifest if -->
							</div>
						</div>
						@if($order->returnOrder)
						<div class="box box-block bg-white">
							<h3 class="returns-status">Returns Status :</h3>
							<div class="timeline timeline-center mt-20">
							<div class="tl-item">
								<div class="tl-wrap b-a-success">
									<div class="tl-content box-block bg-white br-5">
										<span class="arrow left b-a-white"></span>
										placed return
									</div>
									<p class="content-timeline">{{Carbon\Carbon::parse($order->returnOrder->recordInsertedDate)->format('D d/m/Y')}}</p>
									<span class="time">{{Carbon\Carbon::parse($order->returnOrder->recordInsertedDate)->format('h:i:s A')}}</p>
								</div>
							</div>
							@if($order->returnOrder->status == 'approve')
							<div class="tl-item tl-left">
								<div class="tl-wrap b-a-success">
									<div class="tl-content box-block bg-success br-5">
										<span class="arrow right b-a-success"></span>
										Return Accepted
									</div>
									<!-- <p class="content-timeline">Thu, 02/06/2017</p>
									<span class="time">03:38:40 PM</p> -->
								</div>
							</div>
							@endif

							@if($order->returnOrder->status == 'reject')
							<div class="tl-item tl-left">
								<div class="tl-wrap b-a-success">
									<div class="tl-content box-block bg-danger br-5">
										<span class="arrow right b-a-danger"></span>
										Return Rejected
									</div>
									<!-- <p class="content-timeline">Thu, 02/06/2017</p>
									<span class="time">03:38:40 PM</p> -->
								</div>
							</div>
							@endif
						</div>
						@endif

						@else
							<div class="box box-block bg-white">
							No order found
							</div>
						@endif
						</div>						
					</div>
@endsection