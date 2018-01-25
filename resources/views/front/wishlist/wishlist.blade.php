@extends('front.layouts.front_master')

@section('title')
	| Ecommerce website
@endsection

@section('top_newsletter')
	@include('front.common.top_newsletter')
@endsection

@section('meta')

<meta name="title" content="kibakibi">
<meta name="description" content="ecommerece, products, online buy product">
<meta name="author" content="TechTurtle">


@endsection

@section('scripts')

@endsection

@section('content') 
<section class="main-container col1-layout">
  <div class="main container">
      <div class="col-main">
        <div class="cart wow bounceInUp animated">
          <div class="page-title">
            <h2>Shopping Cart</h2>
          </div>
          <div class="table-responsive">
              <fieldset>
                <table class="data-table cart-table" id="shopping-cart-table">
                  <colgroup>
                  <col width="1">
                  <col>
                  <col width="1">
                  <col width="1">
                  <col width="1">
                  <col width="1">
                  <col width="1">
                  </colgroup>
                  <thead>
                    <tr class="first last">
                      <th rowspan="1">&nbsp;</th>
                      <th rowspan="1"><span class="nobr">Product Name</span></th>
                      <th rowspan="1"></th>
                      <th colspan="1" class="a-center"><span class="nobr">Unit Price</span></th>
                      <th class="a-center" rowspan="1">&nbsp;</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class="first last">
                      <td class="a-right last" colspan="50"><a class="button btn-continue" title="Continue Shopping" href="{{url('/')}}"><span>Continue Shopping</span></a>
                        <button class="button btn-update" title="Update Cart" value="update_qty" name="update_cart_action" type="submit"><span>Add to cart</span></button>
                    </tr>
                  </tfoot>
                  <tbody>
                  @foreach($wishlists as $wishlist)
                    <tr class="first odd">
                      <td class="image"><a class="product-image" title="{{$wishlist->product_name}}" href="{{url('/products/product_detail?product_id='.$wishlist->product_id)}}"><img width="75" alt="{{$wishlist->product_name}}" src="{{$image[$wishlist->id]}}"></a></td>
                      <td><h2 class="product-name"> <a href="{{url('/products/product_detail?product_id='.$wishlist->product_id)}}">{{$wishlist->product_name}}</a> </h2></td>
                      <td class="a-center"><a title="Edit item parameters" class="edit-bnt" href="javascript:;"></a></td>
                      <td class="a-right"><span class="cart-price"> <span class="price"><i class="fa fa-inr"></i>{{$wishlist->product_selling_price}}</span> </span></td>
                      <td class="a-center last">
                        {!! Form::open(array('method' => 'post', 'id' => 'removeWishlist_'.$wishlist->id , 'action' => ['Front\Wishlist\WishlistController@deleteWishlistItem'])) !!}
                          <input type="hidden" name="wishlist_id" value="{{$wishlist->id}}">
                          <button class="button remove-item" type="submit" onclick="deleteWishlistItem({{$wishlist->id}})" title="Remove {{$wishlist->product_name}}">
                          <span><i class="fa fa-trash"></i></span>
                          </button>
                        {!! Form::close() !!}
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </fieldset>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection