@extends('front.layouts.front_master')

@section('title')
	| Ecommerce website
@endsection

@section('top_newsletter')
	@include('front.common.top_newsletter')
@endsection

@section('scripts')
  <script>

    $(document).ready(function(){
      //fetchApiProducts({{$category_id}},{{$page}},'{{$price_filter}}');
    });

    function fetchApiProducts(categoryid, page, pricerange=null){

      $.ajax({
        url: "{{url('/products/api_products_ajax')}}",
        type: 'GET',
        dataType: 'html',
        data: {categoryid: categoryid, page: page, pricerange: pricerange},
        beforeSend: function(){
          $('#loader').removeClass('hidden');
        },
        success: function(result){
          console.log(result);
          $('#products_ul').append(result);
          $('#loader').addClass('hidden');
          $('#mypagination').removeClass('hidden');
        }
      });
    }

    function showApiProductDetail(product){
      console.log(product);
    }

  </script>
  
@endsection

@section('meta')

<meta name="title" content="kibakibi">
<meta name="description" content="ecommerece, products, online buy product">
<meta name="author" content="TechTurtle">
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
  
  <!-- Breadcrumbs -->
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="category1599"> <a href="{{url('/')}}" title="home">Home</a> <span>/ </span> </li>
            @foreach($breadCrumbCategories as $key => $bread)
              <li class="category1599"> <a href="{{url('/products?catid='.$bread['id'])}}" title="{{$bread['category_name']}}">{{$bread['category_name']}}</a> <span>/ </span> </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumbs End --> 
  
  <section class="main-container col2-left-layout bounceInUp animated">
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-sm-push-3">
          <!-- <div class="category-description std">
            <div class="slider-items-products">
              <div id="category-desc-slider" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col1 owl-carousel owl-theme"> 
                  <div class="item"> <a href="#"><img alt="" src="images/category-img.png"></a>
                  </div>
                  <div class="item"> <a href="#"><img alt="" src="images/category-img.png"></a>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
          @if(isset($_GET['viewType']) && $_GET['viewType'] == 'list' )
            @include('front/products/productList')
          @else
            @include('front/products/productGrid')
          @endif
          <div class="row">
            <div class="col-sm-12 text-center" >
              <span id="loader" class="hidden"><h2><img src="{{asset('images/loader/loader.gif')}}"></h2></span>
            </div>
          </div>

          <ul class="pagination hidden" id="mypagination">
            <li><a href="{{url('products?catid='.$_GET['catid'].'&page='.$previousPage)}}">Previous</a></li>
            <li><a href="{{url('products?catid='.$_GET['catid'].'&page='.$nextPage)}}">Next</a></li>
          </ul>
            
          <!--  ///*///======    End article  ========= //*/// --> 
        </div>
        <div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
          <aside class="col-left sidebar">
            <div class="side-nav-categories">
              <div class="block-title"> Categories </div>
              <!--block-title--> 
              <!-- BEGIN BOX-CATEGORY -->
              <div class="box-content box-category">
                @include('front/products/category')
              </div>
              <!--box-content box-category--> 
            </div>
            <!-- <div class="hot-banner"><img alt="banner" src="images/hot-trends-banner.png"></div> -->
            <div class="block block-layered-nav">
              <div class="block-title">Filter By</div>
              <div class="block-content">
                <dl id="narrow-by-list">
                  <dt class="odd">Price</dt>
                  <dd class="odd">
                    <ol>
                      <li> <a href="{{url('/products?catid='.$_GET['catid'].'&page='.$page.'&price=1_200')}}"><span class="price"><i class="fa fa-inr"></i> 0.00</span> - <span class="price"><i class="fa fa-inr"></i>200.00</span></a></li>
                      <li> <a href="{{url('/products?catid='.$_GET['catid'].'&page='.$page.'&price=200_500')}}"><span class="price"><i class="fa fa-inr"></i> 200.00</span> - <span class="price"><i class="fa fa-inr"></i>500.00</span></a></li>
                      <li> <a href="{{url('/products?catid='.$_GET['catid'].'&page='.$page.'&price=500_1000')}}"><span class="price"><i class="fa fa-inr"></i> 500.00</span> - <span class="price"><i class="fa fa-inr"></i>1000.00</span></a></li>
                      <li> <a href="{{url('/products?catid='.$_GET['catid'].'&page='.$page.'&price=1000_9999999')}}"><span class="price"><i class="fa fa-inr"></i> 1000.00</span> - <span class="price">above</span></a></li>
                    </ol>
                  </dd>
                  @foreach($filterVarients as $filterVarient)
                  <dt class="odd">{{$filterVarient->varient_type}}</dt>
                  <dd class="odd">
                    <ol>
                      @foreach($varientTypeValues[$filterVarient->varient_type_id] as $varientTypeValue)
                        <li> <a href="javascript:;">{{$varientTypeValue->value}}</a> </li>
                      @endforeach
                    </ol>
                  </dd>
                  @endforeach
                </dl>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>
  <!-- Main Container End --> 
@endsection