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
<style type="text/css">
  .mt-24{
    margin-top: 24px;
  }
  .small-strip {
        background: #167bcb;
        color: #fff;
        font-weight: bold;
        text-align: left;
        padding: 9px 15px;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
    }
    .title-text {
        float: right;
        position: relative;
        margin-top: -23px;
        border-bottom: 1px solid #FFF;
    }
    .purnawidth{
      width: 100%
    }
    @media only screen and (max-width: 1110px){
      .footer-add{
        margin-top: 20px;
      }
    }
</style>
@endsection

@section('content')
<!-- Slider -->
<div id="thmsoft-slideshow" class="thmsoft-slideshow">
  <div class="container">
    <div class="row">  
      @if($topproduct[0]['id'])
      <div class=" col-lg-3 col-md-3 col-sm-5 col-xs-12 col-mid">
        <div class="top-products"> 
          <div class="title">{!! $topproduct[0]['tagname'] !!}</div>
          @if(count($topproduct[0]['products'])>0)
          <ul>
           @foreach($topproduct[0]['products'] as $tag_product)
           <li>
            <div class="row">
              <div class="col-xs-4 col-sm-4 no-margin"> <a href="{!! ($tag_product->link) ? $tag_product->link : '#' !!}"><img alt="product" src="{!! url('products-images/',[$tag_product->image]) !!}"> </a></div>
              <div class="col-xs-8 col-sm-8 no-margin"> <a href="{!! ($tag_product->link) ? $tag_product->link : '#' !!}"> {!! $tag_product->name !!}</a>
                <div class="rating">
                  <div class="ratings">
                    <div class="rating-box">
                      <div style="width:80%" class="rating"></div>
                    </div>
                    <p class="rating-links"> <a href="#">{!! $tag_product->rating !!} Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                  </div>
                </div>
                <div class="price"><i class="fa fa-inr"></i>
                  {!! $tag_product->new_price !!}</div>
                </div>
              </div>
            </li>
            @endforeach
          </ul>
          @endif
        </div>
      </div>
      @endif
      <div class="col-md-6 col-sm-7 col-xs-12">
        <div class="small-strip"><!--<img alt="banner" src="{{url('images/small-strip-banner.jpg')}}">-->
        <div class="title">{{ $homesetting->topbanner }}<a href="#" data-toggle="modal" data-target="#st_phone" data-whatever="{{ $homesetting->topbanner }}" data-datakey="topbanner"></a></div>
    		<div class="title-text">Shop Now</div>
		</div>
        <div id='rev_slider_4_wrapper' class='rev_slider_wrapper fullwidthbanner-container'>
          <div id='rev_slider_4' class='rev_slider fullwidthabanner'>
            <ul>
              @foreach($mainslider as $slider)
              <li data-transition='random' data-slotamount='7' data-masterspeed='1000' data-thumb="{!! url('product_images/banners/', [$slider->image]) !!}"><img src="{!! url('product_images/banners/', [$slider->image]) !!}" alt="{{$slider->image}}" data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat'></li>
              <div class="info">
                <div class='tp-caption sfb  tp-resizeme ' data-endspeed='500' data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;max-width:auto;max-height:auto;white-space:nowrap;'><a href='{!! ($slider->link != '') ? $slider->link : '#' !!}' class="buy-btn">Shop Now</a> </div>
              </div>
              @endforeach                        
            </ul>
          </div>
        </div>
      </div>
      <div class=" col-lg-3 col-md-3 col-sm-7 col-xs-12"> 
        <div class="image-item"> <a href="{!! ($right1->link != '') ? $right1->link : '#' !!}" title="Right 1 Image"> <img src="{!! url('product_images/banners/', [$right1->image]) !!}" class="img-responsive" alt="Image"></a> </div>
      </div>
    </div>
  </div>
</div>

<!-- end Slider -->
<div class="our-features-box">
  <div class="container">
    <div class="row">      
        <div class="col-lg-3 col-xs-12 col-sm-6 space">
          <div class="feature-box first"> <span class="fa fa-truck"></span>
            <div class="content">
              <h3>Doorstep delivery</h3>
              <p>Speedy delivery at your doorstep</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-12 col-sm-6 space">
          <div class="feature-box"> <span class="fa fa-headphones"></span>
            <div class="content">
              <h3>24/7 Help Center</h3>
              <p>Round the clock assistance</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-12 col-sm-6 space">
          <div class="feature-box"> <span class="fa fa-share"></span>
            <div class="content">
              <h3>Free Returns</h3>
              <p>Hassle-free return policy</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-12 col-sm-6 space">
          <div class="feature-box last"> <span class="fa fa-phone"></span>
            <div class="content">
              <h3>Helpline {{ isset($homesetting->phone) ? $homesetting->phone : ''}}</h3>
              <p>Call us when you need help</p>
            </div>
          </div>
        </div>
      
    </div>
  </div>
</div>

<div class="content-page">
  <div class="container">
    <div class="row"> 

      <!-- featured category fashion -->
      <div class="col-md-9">
          @foreach($tagproduct as $product)
            <div class="bestsell-pro mt-24">
              <div class="slider-items-products">
                <div class="bestsell-block">
                  <div class="block-title">
                    <h2>{!! $product['tagname'] !!}</h2>   <!-- Hot Product  -->
                  </div>
                  <div id="bestsell-slider" class="product-flexslider hidden-buttons">
                    @if(count($product['products'])>0)
                    <div class="slider-items slider-width-col4 products-grid block-content">
                      @foreach($product['products'] as $tag_product)
                      <!-- Item -->
                      <div class="item">
                        <div class="item-inner">
                          <div class="item-img">
                            <div class="item-img-info"> <a class="product-image" title="{{$tag_product->name}}" href="{!! ($tag_product->link) ? $tag_product->link : '#' !!}"> <img alt="{{$tag_product->name}}" src="{!! url('products-images/', [$tag_product->image]) !!}"> </a>
                              <!--<div class="box-hover">
                                <ul class="add-to-links">
                                  <li><a class="link-quickview" href="#"></a> </li>
                                  <li><a class="link-wishlist" href="#"></a> </li>
                                  <li><a class="link-compare" href="#"></a> </li>
                                </ul>
                              </div>-->
                            </div>
                          </div>
                          <div class="item-info">
                            <div class="info-inner">
                              <div class="item-title"> <a title="{{$tag_product->name}}" href="{!! ($tag_product->link) ? $tag_product->link : '#' !!}"> {{$tag_product->name}} </a> </div>
                              <div class="item-content">
                                <div class="rating">
                                  <div class="ratings">
                                    <div class="rating-box">
                                      <div style="width:80%" class="rating"></div>
                                    </div>
                                    <p class="rating-links"> <a href="#">{{$tag_product->rating}} Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                  </div>
                                </div>
                                <div class="item-price">
                                  <div class="price-box"> <span class="regular-price"> <span class="price"><i class="fa fa-inr"></i>
                                   {{$tag_product->new_price}}</span> </span> </div>
                                 </div>
                                 <!--<div class="action">
                                  <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                </div>-->
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Item --> 
                      @endforeach
                    </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
           @endforeach
      </div>
                  <div class="col-md-3">
                    <!-- Hot Deal -->
                    @if(count($hotdeals) > 0)
                    <div class="hot-deal">
                      <div class="title">Hot Deal</div>
                      <ul class="products-grid"> 
                        @foreach($hotdeals as $result)                                   
                        <li class="right-space two-height item">
                          <div class="item-inner">
                            <div class="item-img">
                              <div class="item-img-info"> 
                                  <a href="{!! $result['link'] !!}" title="{!! $result['name'] !!}" class="product-image"> 
                                    <img src="{!! url('products-images/',[$result['image']]) !!}" alt="{!! $result['name'] !!}"> 
                                  </a>
                                <div class="new-label new-top-right">{!! $result['totalsave'] !!}% Off</div>
                                <div class="box-hover">
                                  <ul class="add-to-links">
                                    <li><a class="link-quickview" href="#quick_view"></a> </li>
                                    <li><a class="link-wishlist" href="#wishlist"></a> </li>
                                    <li><a class="link-compare" href="#compare"></a> </li>
                                  </ul>
                                </div>
                                <div class="box-timer">
                                  <div class="countbox_1 timer-grid"></div>
                                </div>
                              </div>
                            </div>
                            <div class="item-info">
                              <div class="info-inner">
                                <div class="item-title"> <a href="{!! $result['link'] !!}" title="Retis lapen casen"> {!! $result['name'] !!} </a> </div>
                                <div class="item-content">
                                  <div class="rating">
                                    <div class="ratings">
                                      <div class="rating-box">
                                        <div class="rating" style="width:80%"></div>
                                      </div>
                                      <p class="rating-links"> <a href="#">{!! $result['rating'] !!} Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                    </div>
                                  </div>
                                  <div class="item-price">
                                    <div class="price-box"> <span class="regular-price"> <span class="price"><i class="fa fa-inr"></i>
                                      {!! $result['new_price'] !!}</span> </span> </div>
                                    </div>
                                    <div class="action" style="margin-top:-5px;">
                                      <button data-original-title="Add to Cart" title="" type="button" class="button btn-cart"><span>Add to Cart</span> </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </li> 
                        @endforeach                                       
                      </ul>
                    </div>  
                    @endif                               
                      <!-- Hot Deal End -->
                      <!-- Testimonials -->
                      <div class="testimonials std" style="margin-top:15px;">
                        <div class="slider-items-products">
                          <div id="testimonials" class="product-flexslider hidden-buttons">
                            <div class="slider-items slider-width-col1 owl-carousel owl-theme"> 

                             <!-- Item -->
                              @foreach($testimonials as $testimonial)
                              <div class="item">
                                <div class="inner-block">
                                  <div class="auther-img"><img alt="{!! $testimonial->name !!}" src="<?php echo is_file(public_path('testimonials/'.$testimonial->image)) ? url('testimonials/'.$testimonial->image) : url('images/photo.png') ?>"></div>
                                  <?php 
										$testi = strip_tags(urldecode($testimonial->content));
										$testi = substr($testi,0,70);
										?>
										<div class="testimonials-text">{!! $testi !!} </div>
                                  <div class="auther-name">{!! $testimonial->name !!} <span>Founder - {!! $testimonial->designation !!}</span> </div>
                                </div>                                
                              </div>  
                              @endforeach                            
                              <!-- End Item --> 
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- home side banner -->
                      <div class="home-side-banner image-item"> <a href="{!! ($right2->link != '') ? $right2->link : '#' !!}" title="Right 2 Image"> <img alt="banner" src="{!! url('product_images/banners/',[$right2->image]) !!}"></a> </div>
                      <div class="side-banner-img image-item"> <a href="{!! ($right3->link != '') ? $right3->link : '#' !!}" title="Right 3 Image"> <img src="{!! url('product_images/banners/',$right3->image) !!}"  alt="Image"></a> </div>
                    </div>
                  </div>
                </div>
              </div>
              @if(isset($logo))
              <div class="footer-add" align="center"> <a href="{{ ($contentstrip->link != '') ? $contentstrip->link : '#' }}"><img src="{!! url('product_images/banners/',[$contentstrip->image]) !!}" alt="download" class="purnawidth"> </a> </div>
              @endif
              @endsection

              @section('scripts')
              <script type='text/javascript'>
                jQuery(document).ready(function() {
                 jQuery('#rev_slider_4').show().revolution({
                   dottedOverlay: 'none',
                   delay: 5000,
                   startwidth: 600,
                   startheight: 461,
                   hideThumbs: 200,
                   thumbWidth: 200,
                   thumbHeight: 50,
                   thumbAmount: 2,
                   navigationType: 'thumb',
                   navigationArrows: 'solo',
                   navigationStyle: 'round',
                   touchenabled: 'on',
                   onHoverStop: 'on',
                   swipe_velocity: 0.7,
                   swipe_min_touches: 1,
                   swipe_max_touches: 1,
                   drag_block_vertical: false,
                   spinner: 'spinner0',
                   keyboardNavigation: 'off',
                   navigationHAlign: 'center',
                   navigationVAlign: 'bottom',
                   navigationHOffset: 0,
                   navigationVOffset: 20,
                   soloArrowLeftHalign: 'left',
                   soloArrowLeftValign: 'center',
                   soloArrowLeftHOffset: 20,
                   soloArrowLeftVOffset: 0,
                   soloArrowRightHalign: 'right',
                   soloArrowRightValign: 'center',
                   soloArrowRightHOffset: 20,
                   soloArrowRightVOffset: 0,
                   shadow: 0,
                   fullWidth: 'on',
                   fullScreen: 'off',
                   stopLoop: 'off',
                   stopAfterLoops: -1,
                   stopAtSlide: -1,
                   shuffle: 'off',
                   autoHeight: 'off',
                   forceFullWidth: 'on',
                   fullScreenAlignForce: 'off',
                   minFullScreenHeight: 0,
                   hideNavDelayOnMobile: 1500,
                   hideThumbsOnMobile: 'off',
                   hideBulletsOnMobile: 'off',
                   hideArrowsOnMobile: 'off',
                   hideThumbsUnderResolution: 0,
                   hideSliderAtLimit: 0,
                   hideCaptionAtLimit: 0,
                   hideAllCaptionAtLilmit: 0,
                   startWithSlide: 0,
                   fullScreenOffsetContainer: ''
                 });
});
</script> 
<!-- Hot Deals Timer 1--> 

@if(count($hotdeals) > 0)
<script type="text/javascript">
  var dthen1 = new Date("{!! $hotdeals[0]['end_date'] !!}");
  start = "{!! $hotdeals[0]['start_date'] !!}";
  start_date = Date.parse(start);
  var dnow1 = new Date(start_date);
  if (CountStepper > 0)
   ddiff = new Date((dnow1) - (dthen1));
 else
   ddiff = new Date((dthen1) - (dnow1));
 gsecs1 = Math.floor(ddiff.valueOf() / 1000);

 var iid1 = "countbox_1";
 CountBack_slider(gsecs1, "countbox_1", 1);
</script>
@endif
@endsection