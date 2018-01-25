@extends('front/layouts/front_master')

@section('meta')

<style>
 .image_auto_size{
    height: auto;
    max-height: 215px;
    width: auto !important;
    max-width: 200px;
    min-height: 215px !important;
}
</style>

@endsection
@section('content')
	<section class="main-container col2-left-layout bounceInUp animated">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          
          <article class="col-main" style="display: block !important;">
            <h2 class="page-heading"> <span class="page-heading-title">Search result for <strong style="color: #5599CE;">{{$searchVal}}</strong></span> </h2>
            <div class="category-products">
              <ul class="products-grid">
              	@foreach($results as $result)
                <li class="item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                  <div class="item-inner">
                    <div class="item-img">
                      <div class="item-img-info"><a href="{{url('/products/product_detail?product_id='.$result->id.'&product_name='.urlencode($result->product_name).'&category_id='.$result->category_id.'&category_name='.urlencode($result->category))}}" title="Food Processor" class="product-image"><img src="{{$image[$result->id]}}" class="image_auto_size" alt="Retis lapen casen"></a>
                      </div>
                    </div>
                    <div class="item-info">
                      <div class="info-inner">
                        <div class="item-title"> <a title="Food Processor" href="{{url('/products/product_detail?product_id='.$result->id.'&product_name='.urlencode($result->product_name).'&category_id='.$result->category_id.'&category_name='.urlencode($result->category))}}"> {{$result->product_name}} </a> </div>
                        <div class="item-content">
                          <div class="item-price">
                            <div class="price-box">
                              <p class="old-price"><span class="price-label">Regular Price:</span> <span class="price"><i class="fa fa-inr"></i>{{$result->product_mrp}}</span> </p>
                              <p class="special-price"><span class="price-label">Special Price</span> <span class="price"><i class="fa fa-inr"></i>{{$result->product_selling_price}}</span> </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li> 
                @endforeach

                @foreach($apiProducts as $apiProduct)
                  <li class="item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                    <div class="item-inner">
                      <div class="item-img">
                        <div class="item-img-info"><a href="{{url('/products/api_product_detail?product_id='.$apiProduct['id'].'&product_name='.urlencode($apiProduct['productTitle']).'&category_id='.$apiProduct['categoryId'])}}" title="Food Processor" class="product-image"><img src="{{$api_product_img[$apiProduct['id']]}}" class="image_auto_size" alt="Retis lapen casen"></a>
                        </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Food Processor" href="{{url('/products/api_product_detail?product_id='.$apiProduct['id'].'&product_name='.urlencode($apiProduct['productTitle']).'&category_id='.$apiProduct['categoryId'])}}"> {{$apiProduct['productTitle']}} </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box">
                                <p class="old-price"><span class="price-label">Regular Price:</span> <span class="price"><i class="fa fa-inr"></i>{{$apiProduct['mrp']}}</span> </p>
                                <p class="special-price"><span class="price-label">Special Price</span> <span class="price"><i class="fa fa-inr"></i>{{$apiProduct['sellingPrice']}}</span> </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li> 
                @endforeach

                @if(!count($results) && !count($apiProducts))
                	<li> No Result Found </li>
                @endif	
              </ul>
            </div>
          </article>
          <!--	///*///======    End article  ========= //*/// --> 
        </div>
       <div class="row">
      <ul class="pagination" id="mypagination" style="display: block;">
        <li class="@if($previousPage <1) disabled @endif"><a href="@if($previousPage >0){{url('/search?q='.$searchVal.'&page='.$previousPage)}}@else javascript:; @endif">Previous</a></li>
        <li class="@if(count($apiProducts)<29 && count($results) < 11) disabled @endif"><a href="@if(count($apiProducts)<29 && count($results) < 11) javascript:; @else {{url('/search?q='.$searchVal.'&page='.$nextPage)}} @endif">Next</a></li>
      </ul>
  </div>
      </div>
    </div>
  </section>
@endsection