<?php $__env->startSection('title'); ?>
	| Ecommerce website
<?php $__env->stopSection(); ?>

<?php $__env->startSection('top_newsletter'); ?>
	<?php echo $__env->make('front.common.top_newsletter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>

<meta name="title" content="kibakibi">
<meta name="description" content="ecommerece, products, online buy product">
<meta name="author" content="TechTurtle">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/example.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/easyzoom.css')); ?>">
<style type="text/css">
  .mt-1{
    margin-top: 10px;
  }
  .text-hide-box{
    text-overflow: ellipsis;
    overflow: hidden;
  }
  .lh-fix{
    line-height: 38px;
  }

  /*  modal css starts */
  .modal_dialoge_css{
    height: 215px;
    top: 100px;
  }

  .modal_body_css{
    text-align: center;
  }

  .modal_body_span_css{
    padding-left: 45%;
  }

  .modal_body_span_css i{
    font-size: 109px;
  }
  .owl-pagination{
    display: none;
  }
  .size-btn{
    width: 100px;
    height: 40px;
    background: #ef4749;
    color: #fff;
    font-size: 14px;
    margin-left: 10px;
    border: none;
  }
  /* modal css ends */
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('/js/easyzoom.js')); ?>"></script>
  <?php echo $__env->make('front/js/buynow', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  
  <script>
    // Instantiate EasyZoom instances
    var $easyzoom = $('.easyzoom').easyZoom();

    // Setup thumbnails example
    var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

    $('.thumbnails').on('click', 'a', function(e) {
      var $this = $(this);

      e.preventDefault();

      // Use EasyZoom's `swap` method
      api1.swap($this.data('standard'), $this.attr('href'));
    });

    // Setup toggles example
    var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

    $('.toggle').on('click', function() {
      var $this = $(this);

      if ($this.data("active") === true) {
        $this.text("Switch on").data("active", false);
        api2.teardown();
      } else {
        $this.text("Switch off").data("active", true);
        api2._init();
      }
    });
</script>
<script type="text/javascript">
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:4
        }
    }
})
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
     <!-- Main Container -->
  <?php echo $__env->make('front/extra/loading_modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <section class="main-container col1-layout">
    <div class="main">
      <div class="container">
        <div class="row">
          <div class="col-main">
            <div class="product-view">
              <div class="product-essential">
                <?php echo Form::open(array('id' => 'product_detail_form')); ?>

                  <input type="hidden" name="product_from" value="api">
                  <input type="hidden" name="product_id" value="<?php echo e($product->api_product_id); ?>">
                  <div class="product-img-box col-lg-4 col-sm-4 col-xs-12" style="text-align:center; ">
                    <!-- <div class="new-label new-top-left"> New </div>
                    <div class="product-image">
                      <div class="product-full"> <img id="product-zoom" src="<?php echo e($default_image); ?>" data-zoom-image="<?php echo e($default_image); ?>" alt="product-image"/> </div>
                      <div class="more-views">
                        <div class="slider-items-products">
                          <div id="gallery_01" class="product-flexslider hidden-buttons product-img-thumb">
                            <div class="slider-items slider-width-col4 block-content">
                              <?php foreach($images as $image): ?>
                              <div class="more-views-items"> <a href="javascript:;" data-image="<?php echo e($image); ?>" data-zoom-image="<?php echo e($image); ?>"> <img id="product-zoom"  src="<?php echo e($image); ?>" alt="product-image"/> </a></div>
                              <?php endforeach; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> -->

                    <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                      <div class="mainbox" style="/* max-width: 100%; *//* border:1px solid #000; */position: relative;text-align: center;overflow: hidden;">
                        <div class="newbox" style="/* width: 100%; *//* overflow: hidden; *//* position: relative; *//* height: 450px; */text-align: center;-webkit-transition: all 0.3s ease-out;-moz-transition: all 0.3s ease-out;-o-transition: all 0.3s ease-out;transition: all 0.3s ease-out;position: relative;">
                          <a href="<?php echo e($default_image); ?>" style="/* width: auto; *//* position: relative; *//* height: inherit; */width: 100%;overflow: hidden;display: inline-block;">
                            <img src="<?php echo e($default_image); ?>" alt="" width="100%" style="/* height:inherit; */height: auto;max-height: 450px;width: auto !important;max-width: 400px;min-height: 450px !important;" />
                          </a>
                        </div>  
                      </div>  
                    </div>
                    <div class="owl-carousel owl-theme">
                    <?php foreach($images as $image): ?>
                    <div class="item thumbnails">
                     
                      <li>
                        <a href="<?php echo e($image); ?>" data-standard="<?php echo e($image); ?>">
                          <img src="<?php echo e($image); ?>" alt="" />
                        </a>
                      </li>
                   
                    </div>
                     <?php endforeach; ?>
                  </div>
                  </div>
                  <div class="product-shop col-lg-5 col-sm-5 col-xs-12">
                    <div class="alert hidden" id="alert_message">
                    </div>
                    <div class="product-name">
                      <h1><?php echo e(substr($product->productTitle,0,50)); ?></h1>
                    </div>
                    <div class="ratings">
                      <div class="rating-box">
                        <div style="width:60%" class="rating"></div>
                      </div>
                      <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Your Review</a> </p>
                    </div>
                    <div class="price-block">
                      <div class="price-box">
                        <p class="special-price"> <span class="price-label">Special Price</span> <span id="product-price-48" class="price"> <i class="fa fa-inr"></i>  <?php echo e(round($product_price[$product->api_product_id])); ?> </span> </p>
                        <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> <i class="fa fa-inr"></i> <?php echo e(round($product_mrp_price[$product->api_product_id])); ?> </span> </p>
                        <p class="availability in-stock pull-right"><span><?php echo e(($product->committedQuantity > 0) ? 'In Stock' : 'Out of stock'); ?></span></p>
                      </div>
                    </div>
                    <div class="add-to-box">
                      <div class="add-to-cart">
                      <ul>
                        <li>
                          <div class="pull-left">
                            <div class="custom pull-left">
                              <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="fa fa-minus">&nbsp;</i></button>
                              <input type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
                              <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="fa fa-plus">&nbsp;</i></button>
                            </div>
                          </div>
                        </li>
                        <li>
                          <select name="varients" class="size-btn">
                          <?php if(!count($varients)): ?>    
                           <option value="none">none</option>
                           <?php endif; ?>
                              
                            <?php foreach($varients as $varient): ?> 
                            
                            <?php if($varient == ''): ?>
                            <option value="none">none</option>
                            <?php else: ?>
                            <option value="<?php echo e($varient); ?>"><?php echo e($varient); ?></option>
                            <?php endif; ?>
                            
                            <?php endforeach; ?>
                          </select>
                        </li>
                        <li>
                          <button class="button btn-cart" title="Add to Cart" onclick="addToCart(<?php echo e($product->id); ?>)" type="button"></button>
                        </li>
                        <li>
                          <button type="submit" class="button btn-cart" title="Add to Cart">Buy Now</button>
                        </li>
                      </ul>
                      </div>
                    </div>
                    <span id="wishlist_result"></span>
                  </div>
                <?php echo Form::close(); ?>

              </div>
            </div>
          </div>
          <div class="product-collateral col-lg-12 col-sm-12 col-xs-12">
            <div class="add_info">
              <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                <li class="active"> <a href="#product_tabs_description" data-toggle="tab"> Product Description </a> </li>
              </ul>
              <div id="productTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="product_tabs_description">
                  <div class="std">
                    <?php echo (strlen($product->description)>1) ? $product->description : 'no description exist'; ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.front_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>