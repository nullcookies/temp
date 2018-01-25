<div class="order-review" id="checkout-review-load"> </div>
  <table class="table order-review-table">
          @foreach($products as $product)
            <tr>
              <td class="text-center align-mid"><img src="https://cdn3.iconfinder.com/data/icons/soccer-uniform/128/barcelona.png" width="64" height="64"</td>
              <td class="align-mid">
                <h3 class="bold">{{$product->product_name}}</h3>
                <span style="width:120px; word-wrap:break-word;">{{$product->varients}}</span>
              </td>
              <td class="align-mid">
                <h3 class="bold">Delivered By:</h3>
                <p>28th, March, 2017</p>
              </td>
              <td class="text-right align-mid">
                <p><i class="fa fa-inr"></i>&nbsp;{{$product->product_selling_price}}&nbsp;&nbsp; <span style="font-size:24px;text-decoration:line-through;"><i class="fa fa-inr"></i>{{$product->product_mrp}}</span></p>
              </td>
            </tr>
            @endforeach
            <tr>
              <td colspan="2"></td>
              <td class="align-mid">
                <strong><p>Shipping Charges</p></strong>
              </td>
              <td class="text-right align-mid">
                <p><i class="fa fa-inr"></i>&nbsp;{{$buynow->shipping_price ? intval($buynow->shipping_price) : 0 }}</p>
              </td>
            </tr>
            <tr>
              <td colspan="3" class="align-mid">
                <strong>Total Amount Payable</strong>
              </td>
              <td class="total-pay align-mid">
                <i class="fa fa-inr"></i>&nbsp;{{$totalCart}}
              </td>
            </tr>
          </table>
          <div class="mobile-list">
            <div class="image-box">
              <center>
                  <img src="https://cdn3.iconfinder.com/data/icons/soccer-uniform/128/barcelona.png" class="product-images">
              </center> 
            </div>
            <div class="product-details">
              <h3 class="bold">Barcelona T-shirt</h3>
              <h5><span class="bold">Color :</span> Red</h5>
              <h5><span class="bold">Size :</span>Medium</h5>
              <h5><span class="bold">Quantity :</span> 1</h5>
              <h6><span class="bold">Delivery By :</span> 28<sup>th</sup>,March 2017</h6>
            </div>
            <hr/>
            <div class="charges">
              <h2>Price</h2>
              <h3><i class="fa fa-inr"></i>&nbsp;5200&nbsp;&nbsp; <span style="font-size:24px;text-decoration:line-through;"><i class="fa fa-inr"></i>5500</span></h3>
            </div>
          </div>
          {!! Form::open(array('method' => 'post', 'action' => ['Front\Order\OrderController@showCheckout'])) !!}
          <input type="hidden" name="buynow" value="{{base64_encode($buynow->id)}}">
          <button class="button pull-right">Proceed To Pay</button>
          {!! Form::close() !!}
