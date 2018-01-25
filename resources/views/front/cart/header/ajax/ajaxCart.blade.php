<!-- wishlist item start -->
@foreach($cartItems as $cartItem)
  <li class="item first">
    <div class="item-inner"> <a class="product-image" target="_blank" title="{{$cartProduct[$cartItem->id]['product_name']}}" href="{{url('/products/'.$productDetailPage[$cartItem->id].'?product_id='.$cartItem->product_id)}}"><img alt="{{$cartProduct[$cartItem->id]['product_name']}}" src="{{$productImage[$cartItem->id]}}"> </a>
      <div class="product-details">
        <div class="access"><a class="btn-remove1" title="Remove This Item" href="javascript:;" onclick="removeCart({{$cartItem->id}}) ">Remove</a></div>
          <strong>{{$cartItem->quantity}}</strong> x <span class="price"><i class="fa fa-inr"></i>{{$sellingPrice[$cartItem->id]}}</span>
        <p class="product-name"><a target="_blank" href="{{url('/products/'.$productDetailPage[$cartItem->id].'?product_id='.$cartItem->product_id)}}">{{substr($cartProduct[$cartItem->id]['product_name'],0,50)}}</a> </p>
      </div>
    </div>
  </li>
@endforeach

@if(sizeof($cartItems)< 1)
	No Item In  Cart
@endif
<!-- wishlist item end -->