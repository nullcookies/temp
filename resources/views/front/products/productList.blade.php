<article class="col-main"  style="display: block !important;">
            <h2 class="page-heading"> <span class="page-heading-title">{{$category_name}}</span> </h2>
            <div class="display-product-option">
              <div class="pager hidden-xs">
              </div>
              <div class="sorter">
                <div class="view-mode"> <a class="button button-grid" title="Grid" href="{{url('/products?viewType=grid&catid='.$_GET['catid'].'&category_name='.$category_name)}}">&nbsp;</a><span class="button button-active button-list" title="List">&nbsp;</span> </div>
              </div>
            </div>
            <div class="category-products">
              <ol class="products-list" id="products-list">
                @foreach($products as $product)
                <li class="item first">
                  <div class="product-image"> <a href="{{url('/products/product_detail?product_id='.$product->id.'&product_name='.urlencode($product->product_name).'&category_id='.$category_id.'&category_name='.urlencode($category_name))}}" title="ThinkPad X1 Ultrabook"> <img class="small-image" src="{{$productImage[$product->id]}}" alt="ThinkPad X1 Ultrabook"> </a> </div>
                  <div class="product-shop">
                    <h2 class="product-name"><a href="{{url('/products/product_detail?product_id='.$product->id.'&product_name='.urlencode($product->product_name).'&category_id='.$category_id.'&category_name='.urlencode($category_name))}}" title="HTC Rhyme Sense">{{$product->product_name}}</a></h2>
                    <div class="ratings">
                      <div class="rating-box">
                        <div style="width:50%" class="rating"></div>
                      </div>
                      <p class="rating-links"> <a href="#">1 Reviews</a> <span class="separator">|</span> <a href="#review-form">Add Your Review</a> </p>
                    </div>
                    <div class="desc std">
                      {!! $product->product_description !!}

                      @if(strlen($product->product_description) > 200)
                        <a href="{{url('/products/product_detail?product_id='.$product->id.'&product_name='.urlencode($product->product_name).'&category_id='.$category_id.'&category_name='.urlencode($category_name))}}">Show More Detail</a>
                      @endif
                    </div>
                    <div class="price-box">
                      <p class="old-price"> <span class="price-label"></span> <span class="price"> <i class="fa fa-inr"></i> {{$product->product_mrp}} </span> </p>
                      <p class="special-price"> <span class="price-label"></span> <span class="price"> <i class="fa fa-inr"></i> {{$product->product_selling_price}} </span> </p>
                    </div>
                    <div class="actions">
                      <button class="button btn-cart ajx-cart" title="Add to Cart" type="button"><span>Add to Cart</span></button>
                       </div>
                  </div>
                </li>
                @endforeach

                @if( count($products)< 1 )               
                  <!-- <li class="item first">
                    No Product available in this category and its sub categories
                  </li> -->
                @endif
              </ol>
              
            </div>
          </article>