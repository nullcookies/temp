<article class="col-main" style="display: block !important;">
  <h2 class="page-heading"> <span class="page-heading-title">{{$category_name}}</span> </h2>
  <div class="display-product-option">
    <div class="pager hidden-xs">
    </div>
    <div class="sorter">
      <div class="view-mode"> <span title="Grid" class="button button-active button-grid">&nbsp;</span><a href="{{url('/products?viewType=list&catid='.$_GET['catid'].'&category_name='.$category_name)}}" title="List" class="button-list">&nbsp;</a> </div>
    </div>
  </div>
  <div class="category-products">
    <ul class="products-grid" id="products_ul">
    @foreach($products as $product)
      <style>
        #product_square_{{$product->id}}{
          border: 1px solid #fff !important;
        }

        #product_square_{{$product->id}}:hover{
         border: 1px solid #E5E5E5 !important;
        }
      </style>
      <li class="item col-lg-4 col-md-4 col-sm-4 col-xs-6">
        <div class="item-inner">
          <div class="item-img" id="product_square_{{$product->id}}">
            <div class="item-img-info"><a href="{{url('/products/product_detail?product_id='.$product->id.'&product_name='.urlencode($product->product_name).'&category_id='.$category_id.'&category_name='.urlencode($category_name))}}" title="Food Processor" class="product-image"><img src="{{$productImage[$product->id]}}" class="image_auto_size" alt="Retis lapen casen"></a>
            </div>
          </div>
          <div class="item-info">
            <div class="info-inner">
              <div class="item-title"> <a title="Food Processor" href="{{url('/products/product_detail?product_id='.$product->id.'&product_name='.urlencode($product->product_name).'&category_id='.$category_id.'&category_name='.urlencode($category_name))}}"> {{$product->product_name}} </a> </div>
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
                    <p class="old-price"><span class="price-label">Regular Price:</span> <span class="price"> <i class="fa fa-inr"></i>  {{$product->product_mrp}} </span> </p>
                    <p class="special-price"><span class="price-label">Special Price</span> <span class="price"> <i class="fa fa-inr"></i>  {{$product->product_selling_price}} </span> </p>
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
                  <p class="old-price"><span class="price-label">Regular Price:</span> <span class="price"> <i class="fa fa-inr"></i>  {{$product_mrp_price[$product['id']]}}</span> </p>
                  <p class="special-price"><span class="price-label">Special Price</span> <span class="price"> <i class="fa fa-inr"></i> {{$product_price[$product['id']]}}</span> </p>
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

    @if( count($products)< 1 )               
     
      <!-- <li class="item">
        No Product available in this category and its sub categories
      </li> -->
    @endif  
    </ul>
    
  </div>
  <div class="row">
      <ul class="pagination" id="mypagination" style="display: block;">
        <li class="@if($previousPage <1) disabled @endif"><a href="@if($previousPage >0){{url('products?catid='.$category_id.'&page='.$previousPage.'&price='.$price_filter)}}@else javascript:; @endif">Previous</a></li>
        <li class="@if(count($apiresults)<26 && count($products) < 9) disabled @endif"><a href="@if(count($apiresults)<26 && count($products) < 9) javascript:; @else {{url('products?catid='.$category_id.'&page='.$nextPage.'&price='.$price_filter)}} @endif">Next</a></li>
      </ul>
  </div>
  
</article>