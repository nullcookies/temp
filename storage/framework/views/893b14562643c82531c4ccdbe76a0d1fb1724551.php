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
                <?php echo Form::open(array('id' => 'product_detail_form', 'method' => 'post', 'action' => ['Front\Cart\CartController@addToCartAjax'])); ?>

                  <input type="hidden" name="product_from" value="normal">
                  <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                  <div class="product-img-box col-lg-4 col-sm-4 col-xs-12" style="text-align: center;">
                    <!--<div class="new-label new-top-left"> New </div>
                    <div class="product-image">
                      <div class="product-full"> <img id="product-zoom" src="<?php echo e($defaultImage); ?>" data-zoom-image="<?php echo e($defaultImage); ?>" alt="product-image"/> </div>
                      <div class="more-views">
                        <div class="slider-items-products">
                          <div id="gallery_01" class="product-flexslider hidden-buttons product-img-thumb">
                            <div class="slider-items slider-width-col4 block-content">
                            <?php foreach($productImages as $productImage): ?>
                              <div class="more-views-items"> <a href="javascript:;" data-image="<?php echo e($image[$productImage->id]); ?>" data-zoom-image="<?php echo e($image[$productImage->id]); ?>"> <img id="product-zoom"  src="<?php echo e($imageSmall[$productImage->id]); ?>" alt="product-image"/> </a></div>
                            <?php endforeach; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>-->
                    <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                      <div class="mainbox" style="/* max-width: 100%; *//* border:1px solid #000; */position: relative;text-align: center;overflow: hidden;">
                        <div class="newbox" style="/* width: 100%; *//* overflow: hidden; *//* position: relative; *//* height: 450px; */text-align: center;-webkit-transition: all 0.3s ease-out;-moz-transition: all 0.3s ease-out;-o-transition: all 0.3s ease-out;transition: all 0.3s ease-out;position: relative;">
                          <a href="<?php echo e($defaultImage); ?>" style="/* width: auto; *//* position: relative; *//* height: inherit; */width: 100%;overflow: hidden;display: inline-block;">
                            <img src="<?php echo e($defaultImage); ?>" alt="" width="100%" style="/* height:inherit; */height: auto;max-height: 450px;width: auto !important;max-width: 400px;min-height: 450px !important;" />
                          </a>
                        </div>  
                      </div>  
                    </div>
                    <div class="owl-carousel owl-theme">
                    <?php foreach($productImages as $productImage): ?>
                    <div class="item thumbnails">
                     
                      <li>
                        <a href="<?php echo e($image[$productImage->id]); ?>" data-standard="<?php echo e($image[$productImage->id]); ?>">
                          <img src="<?php echo e($imageSmall[$productImage->id]); ?>" alt="" />
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
                      <h1><?php echo e($product->product_name); ?></h1>
                    </div>
                    <div class="ratings">
                      <div class="rating-box">
                        <div style="width:60%" class="rating"></div>
                      </div>
                      <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Your Review</a> </p>
                    </div>
                    <div class="price-block">
                      <div class="price-box">
                        <p class="special-price"> <span class="price-label">Special Price</span> <span id="product-price-48" class="price"> <i class="fa fa-inr"></i> <?php echo e($product->product_selling_price); ?> </span> </p>
                        <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> <i class="fa fa-inr"></i> <?php echo e($product->product_mrp); ?> </span> </p>
                        <p class="availability in-stock pull-right"><span><?php echo e($stockStatus); ?></span></p>
                      </div>
                    </div>
                    <?php foreach($varientTypes as $varientType): ?>
                    <div class="row">
                    <div class="col-sm-12 mt-1">
                      <div class="col-xs-4 lh-fix">
                        <?php echo e($varientType->varient_type); ?>

                      </div>
                      <div class="col-xs-8"> 
                        <?php if(count($varientValues[$varientType->varient_type_id]) > 1): ?>
                        <select name="<?php echo e($varientType->varient_type); ?>">
                          <?php foreach($varientValues[$varientType->varient_type_id] as $varient_value): ?>
                            <option value="<?php echo e($varient_value->id); ?>"><?php echo e($varient_value->value); ?></option>
                          <?php endforeach; ?>
                        </select>
                        <?php else: ?>
                          <?php foreach($varientValues[$varientType->varient_type_id] as $varient_value): ?>
                            <input type="hidden" name="<?php echo e($varientType->varient_type); ?>" value="<?php echo e($varient_value->id); ?>" >     
                            <strong><?php echo e($varient_value->value); ?></strong>                     
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </div>
                    </div>
                    </div>
                    <?php endforeach; ?>
                    
                    <?php if(count($varientTypes) > 0): ?>
                    <hr/>
                    <?php endif; ?>

                    <div class="add-to-box">
                      <div class="add-to-cart">
                        <div class="pull-left">
                          <div class="custom pull-left">
                            <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="fa fa-minus">&nbsp;</i></button>
                            <input type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
                            <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="fa fa-plus">&nbsp;</i></button>
                          </div>
                        </div>
                        <button class="button btn-cart" title="Add to Cart" onclick="addToCart(<?php echo e($product->id); ?>)" type="button"></button>
                        <button type="submit" class="button btn-cart" title="Add to Cart">Buy Now</button>
                      </div>
                      <!--<div class="email-addto-box">
                        <ul class="add-to-links">
                          <li> <a class="link-wishlist" href="javascript:;" onclick="addtowishlist(<?php echo e($product->id); ?>)"><span>Add to Wishlist</span></a></li>
                          <!-- <li><span class="separator">|</span> <a class="link-compare" href="compare.html"><span>Add to Compare</span></a></li> -->
                        <!--</ul>
                       <!--  <p class="email-friend"><a href="#" class=""><span>Email to a Friend</span></a></p> -->
                      <!--</div>-->
                    </div>
                    <span id="wishlist_result"></span>
                    <!--<button class="button" title="Checkout" onclick="" type="submit">Checkout</button>-->
                  </div>
                <?php echo Form::close(); ?>

              </div>
            </div>
          </div>
          <div class="product-collateral col-lg-12 col-sm-12 col-xs-12">
            <div class="add_info">
              <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                <li class="active"> <a href="#product_tabs_description" data-toggle="tab"> Product Description </a> </li>
                <!-- <li><a href="#product_tabs_tags" data-toggle="tab">Tags</a></li>
                <li> <a href="#reviews_tabs" data-toggle="tab">Reviews</a> </li>
                <li> <a href="#product_tabs_custom" data-toggle="tab">Custom Tab</a> </li>
                <li> <a href="#product_tabs_custom1" data-toggle="tab">Custom Tab1</a> </li> -->
              </ul>
              <div id="productTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="product_tabs_description">
                  <div class="std">
                    <?php echo $product->product_description; ?>

                  </div>
                </div>
                <div class="tab-pane fade" id="product_tabs_tags">
                  <div class="box-collateral box-tags">
                    <div class="tags">
                      <form id="addTagForm" action="#" method="get">
                        <div class="form-add-tags">
                          <label for="productTagName">Add Tags:</label>
                          <div class="input-box">
                            <input class="input-text" name="productTagName" id="productTagName" type="text">
                            <button type="button" title="Add Tags" class=" button btn-add" onClick="submitTagForm()"> <span>Add Tags</span> </button>
                          </div>
                          <!--input-box--> 
                        </div>
                      </form>
                    </div>
                    <!--tags-->
                    <p class="note">Use spaces to separate tags. Use single quotes (') for phrases.</p>
                  </div>
                </div>
                <div class="tab-pane fade" id="reviews_tabs">
                  <div class="box-collateral box-reviews" id="customer-reviews">
                    <div class="box-reviews1">
                      <div class="form-add">
                        <form id="review-form" method="post" action="">
                          <h3>Write Your Own Review</h3>
                          <fieldset>
                            <h4>How do you rate this product? <em class="required">*</em></h4>
                            <span id="input-message-box"></span>
                            <table id="product-review-table" class="data-table">
                              <colgroup>
                              <col>
                              <col width="1">
                              <col width="1">
                              <col width="1">
                              <col width="1">
                              <col width="1">
                              </colgroup>
                              <thead>
                                <tr class="first last">
                                  <th>&nbsp;</th>
                                  <th><span class="nobr">1 *</span></th>
                                  <th><span class="nobr">2 *</span></th>
                                  <th><span class="nobr">3 *</span></th>
                                  <th><span class="nobr">4 *</span></th>
                                  <th><span class="nobr">5 *</span></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr class="first odd">
                                  <th>Price</th>
                                  <td class="value"><input type="radio" class="radio" value="11" id="Price_1" name="ratings[3]"></td>
                                  <td class="value"><input type="radio" class="radio" value="12" id="Price_2" name="ratings[3]"></td>
                                  <td class="value"><input type="radio" class="radio" value="13" id="Price_3" name="ratings[3]"></td>
                                  <td class="value"><input type="radio" class="radio" value="14" id="Price_4" name="ratings[3]"></td>
                                  <td class="value last"><input type="radio" class="radio" value="15" id="Price_5" name="ratings[3]"></td>
                                </tr>
                                <tr class="even">
                                  <th>Value</th>
                                  <td class="value"><input type="radio" class="radio" value="6" id="Value_1" name="ratings[2]"></td>
                                  <td class="value"><input type="radio" class="radio" value="7" id="Value_2" name="ratings[2]"></td>
                                  <td class="value"><input type="radio" class="radio" value="8" id="Value_3" name="ratings[2]"></td>
                                  <td class="value"><input type="radio" class="radio" value="9" id="Value_4" name="ratings[2]"></td>
                                  <td class="value last"><input type="radio" class="radio" value="10" id="Value_5" name="ratings[2]"></td>
                                </tr>
                                <tr class="last odd">
                                  <th>Quality</th>
                                  <td class="value"><input type="radio" class="radio" value="1" id="Quality_1" name="ratings[1]"></td>
                                  <td class="value"><input type="radio" class="radio" value="2" id="Quality_2" name="ratings[1]"></td>
                                  <td class="value"><input type="radio" class="radio" value="3" id="Quality_3" name="ratings[1]"></td>
                                  <td class="value"><input type="radio" class="radio" value="4" id="Quality_4" name="ratings[1]"></td>
                                  <td class="value last"><input type="radio" class="radio" value="5" id="Quality_5" name="ratings[1]"></td>
                                </tr>
                              </tbody>
                            </table>
                            <input type="hidden" value="" class="validate-rating" name="validate_rating">
                            <div class="review1">
                              <ul class="form-list">
                                <li>
                                  <label class="required" for="nickname_field">Nickname<em>*</em></label>
                                  <div class="input-box">
                                    <input type="text" class="input-text" id="nickname_field" name="nickname">
                                  </div>
                                </li>
                                <li>
                                  <label class="required" for="summary_field">Summary<em>*</em></label>
                                  <div class="input-box">
                                    <input type="text" class="input-text" id="summary_field" name="title">
                                  </div>
                                </li>
                              </ul>
                            </div>
                            <div class="review2">
                              <ul>
                                <li>
                                  <label class="required " for="review_field">Review<em>*</em></label>
                                  <div class="input-box">
                                    <textarea rows="3" cols="5" id="review_field" name="detail"></textarea>
                                  </div>
                                </li>
                              </ul>
                              <div class="buttons-set">
                                <button class="button submit" title="Submit Review" type="submit"><span>Submit Review</span></button>
                              </div>
                            </div>
                          </fieldset>
                        </form>
                      </div>
                    </div>
                    <div class="box-reviews2">
                      <h3>Customer Reviews</h3>
                      <div class="box visible">
                        <ul>
                          <li>
                            
                            <div class="review">
                              <h6><a href="#">Good Product</a></h6>
                              <small>Review by <span>John Doe </span>on 25/8/2016 </small>
                              <div class="rating-box">
                                      <div class="rating" style="width:100%;"></div>
                                    </div>
                              <div class="review-txt"> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</div>
                            </div>
                          </li>
                          <li class="even">
                            
                            <div class="review">
                              <h6><a href="#/catalog/product/view/id/60/">Superb!</a></h6>
                              <small>Review by <span>John Doe</span>on 12/3/2015 </small>
                              <div class="rating-box">
                                      <div class="rating" style="width:100%;"></div>
                                    </div>
                              <div class="review-txt"> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book </div>
                            </div>
                          </li>
                          <li>
                            
                            <div class="review">
                              <h6><a href="#/catalog/product/view/id/59/">Awesome Product</a></h6>
                              <small>Review by <span>John Doe</span>on 28/2/2015 </small>
                              <div class="rating-box">
                                      <div class="rating" style="width:100%;"></div>
                                    </div>
                              <div class="review-txt last"> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                      
                    </div>
                    <div class="clear"></div>
                  </div>
                </div>
                <div class="tab-pane fade" id="product_tabs_custom">
                  <div class="product-tabs-content-inner clearfix">
                    <p><strong>Lorem Ipsum</strong><span>&nbsp;is
                      simply dummy text of the printing and typesetting industry. Lorem Ipsum
                      has been the industry's standard dummy text ever since the 1500s, when 
                      an unknown printer took a galley of type and scrambled it to make a type
                      specimen book. It has survived not only five centuries, but also the 
                      leap into electronic typesetting, remaining essentially unchanged. It 
                      was popularised in the 1960s with the release of Letraset sheets 
                      containing Lorem Ipsum passages, and more recently with desktop 
                      publishing software like Aldus PageMaker including versions of Lorem 
                      Ipsum.</span></p>
                  </div>
                </div>
                <div class="tab-pane fade" id="product_tabs_custom1">
                  <div class="product-tabs-content-inner clearfix">
                    <p> <strong> Comfortable </strong><span>&nbsp;preshrunk shirts. Highest Quality Printing.  6.1 oz. 100% preshrunk heavyweight cotton Shoulder-to-shoulder taping Double-needle sleeves and bottom hem     
                      
                      Lorem Ipsumis
                      simply dummy text of the printing and typesetting industry. Lorem Ipsum
                      has been the industry's standard dummy text ever since the 1500s, when 
                      an unknown printer took a galley of type and scrambled it to make a type
                      specimen book. It has survived not only five centuries, but also the 
                      leap into electronic typesetting, remaining essentially unchanged. It 
                      was popularised in the 1960s with the release of Letraset sheets 
                      containing Lorem Ipsum passages, and more recently with desktop 
                      publishing software like Aldus PageMaker including versions of Lorem 
                      Ipsum.</span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Main Container End -->

<!-- 
<div class="container">
  <div class="related-pro">
      <div class="slider-items-products">
        <div class="related-block">
          <div id="related-products-slider" class="product-flexslider hidden-buttons">
            <div class="home-block-inner">
              <div class="block-title">
                <h2>Recent Viewed Products</h2>
              </div>
               <img alt="banner" src="<?php echo e(asset('images/banner-img.png')); ?>">
            </div>
            <div class="slider-items slider-width-col4 products-grid block-content">
                <div class="item">
                  <div class="item-inner">
                    <div class="item-img">
                      <div class="item-img-info">
                        <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="ThinkPad X1 Ultrabook" src="<?php echo e(asset('images/product-img.jpg')); ?>"> </a>
                        <div class="new-label new-top-right">new</div>
                        <div class="box-hover">
                          <ul class="add-to-links">
                            <li><a class="link-quickview" href="quick_view.html">Quick View</a>
                            </li>
                            <li><a class="link-wishlist" href="wishlist.html">Wishlist</a>
                            </li>
                            <li><a class="link-compare" href="compare.html">Compare</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="item-info">
                      <div class="info-inner">
                        <div class="item-title"> <a title="ThinkPad X1 Ultrabook" href="product_detail.html"> ThinkPad X1 Ultrabook </a> </div>
                        <div class="rating">
                          <div class="ratings">
                            <div class="rating-box">
                              <div style="width:80%" class="rating"></div>
                            </div>
                            <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                          </div>
                        </div>
                        <div class="item-content">
                          <div class="item-price">
                            <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span>
                            </div>
                          </div>
                          <div class="action">
                            <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
  </div>
</div> -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.front_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>