
@foreach($apiresults as $product)
<style>
#product_square_{{$product['id']}}{
  border: 1px solid #fff !important;
}

#product_square_{{$product['id']}}:hover{
 border: 1px solid #E5E5E5 !important;
}
</style>
<li class="item col-lg-4 col-md-4 col-sm-4 col-xs-6">
  <div class="item-inner">
    <div class="item-img" id="product_square_{{$product['id']}}" >
      <div class="item-img-info"><a href="{{url('/products/api_product_detail?product_id='.$product['id'].'&catid='.$product['categoryId'])}}" title="{{substr($product['productTitle'],0,50)}}" class="product-image"><img class="image_auto_size" src="{{strlen($product_img[$product['id']])>0 ? $product_img[$product['id']] : url('no_image.png') }}" alt="{{substr($product['productTitle'],0,50)}}"></a>
      </div>
    </div>
    <div class="item-info">
      <div class="info-inner">
      <div class="item-title"> <a title="{{substr($product['productTitle'],0,50)}}" href="javascript:;">{{substr($product['productTitle'],0,50)}} </a> </div>
        <div class="item-content">
          <div class="rating">
            <div class="ratings">
              <div class="rating-box">
                <div style="width:80%" class="rating"></div>
              </div>
              <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
            </div>
          </div>
          <div class="item-price">
            <div class="price-box">
              <p class="old-price"><span class="price-label">Regular Price:</span> <span class="price"> <i class="fa fa-inr"></i> {{$product['mrp']}}  </span> </p>
              <p class="special-price"><span class="price-label">Special Price</span> <span class="price"> <i class="fa fa-inr"></i>  {{$product['sellingPrice']}} </span> </p>
            </div>
          </div>
          <!-- <div class="action">
            <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span></button>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</li>
@endforeach


@if(count($apiresults)<1)
 No products available
@endif

<ul class="pagination" id="mypagination" style="display: block;">
  @if($previousPage != 0)<li><a href="{{url('products?catid='.$catid.'&page='.$previousPage)}}">Previous</a></li>@endif
  @if(count($apiresults) == 100)<li><a href="{{url('products?catid='.$catid.'&page='.$nextPage)}}">Next</a></li>@endif
</ul>