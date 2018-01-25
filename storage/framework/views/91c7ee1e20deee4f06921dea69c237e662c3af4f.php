<?php $__env->startSection('meta'); ?>

<style>
 .image_auto_size{
    height: auto;
    max-height: 215px;
    width: auto !important;
    max-width: 200px;
    min-height: 215px !important;
}
</style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<section class="main-container col2-left-layout bounceInUp animated">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          
          <article class="col-main" style="display: block !important;">
            <h2 class="page-heading"> <span class="page-heading-title">Search result for <strong style="color: #5599CE;"><?php echo e($searchVal); ?></strong></span> </h2>
            <div class="category-products">
              <ul class="products-grid">
              	<?php foreach($results as $result): ?>
                <li class="item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                  <div class="item-inner">
                    <div class="item-img">
                      <div class="item-img-info"><a href="<?php echo e(url('/products/product_detail?product_id='.$result->id.'&product_name='.urlencode($result->product_name).'&category_id='.$result->category_id.'&category_name='.urlencode($result->category))); ?>" title="Food Processor" class="product-image"><img src="<?php echo e($image[$result->id]); ?>" class="image_auto_size" alt="Retis lapen casen"></a>
                      </div>
                    </div>
                    <div class="item-info">
                      <div class="info-inner">
                        <div class="item-title"> <a title="Food Processor" href="<?php echo e(url('/products/product_detail?product_id='.$result->id.'&product_name='.urlencode($result->product_name).'&category_id='.$result->category_id.'&category_name='.urlencode($result->category))); ?>"> <?php echo e($result->product_name); ?> </a> </div>
                        <div class="item-content">
                          <div class="item-price">
                            <div class="price-box">
                              <p class="old-price"><span class="price-label">Regular Price:</span> <span class="price"><i class="fa fa-inr"></i><?php echo e($result->product_mrp); ?></span> </p>
                              <p class="special-price"><span class="price-label">Special Price</span> <span class="price"><i class="fa fa-inr"></i><?php echo e($result->product_selling_price); ?></span> </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li> 
                <?php endforeach; ?>

                <?php foreach($apiProducts as $apiProduct): ?>
                  <li class="item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                    <div class="item-inner">
                      <div class="item-img">
                        <div class="item-img-info"><a href="<?php echo e(url('/products/api_product_detail?product_id='.$apiProduct['id'].'&product_name='.urlencode($apiProduct['productTitle']).'&category_id='.$apiProduct['categoryId'])); ?>" title="Food Processor" class="product-image"><img src="<?php echo e($api_product_img[$apiProduct['id']]); ?>" class="image_auto_size" alt="Retis lapen casen"></a>
                        </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Food Processor" href="<?php echo e(url('/products/api_product_detail?product_id='.$apiProduct['id'].'&product_name='.urlencode($apiProduct['productTitle']).'&category_id='.$apiProduct['categoryId'])); ?>"> <?php echo e($apiProduct['productTitle']); ?> </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box">
                                <p class="old-price"><span class="price-label">Regular Price:</span> <span class="price"><i class="fa fa-inr"></i><?php echo e($apiProduct['mrp']); ?></span> </p>
                                <p class="special-price"><span class="price-label">Special Price</span> <span class="price"><i class="fa fa-inr"></i><?php echo e($apiProduct['sellingPrice']); ?></span> </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li> 
                <?php endforeach; ?>

                <?php if(!count($results) && !count($apiProducts)): ?>
                	<li> No Result Found </li>
                <?php endif; ?>	
              </ul>
            </div>
          </article>
          <!--	///*///======    End article  ========= //*/// --> 
        </div>
       <div class="row">
      <ul class="pagination" id="mypagination" style="display: block;">
        <li class="<?php if($previousPage <1): ?> disabled <?php endif; ?>"><a href="<?php if($previousPage >0): ?><?php echo e(url('/search?q='.$searchVal.'&page='.$previousPage)); ?><?php else: ?> javascript:; <?php endif; ?>">Previous</a></li>
        <li class="<?php if(count($apiProducts)<29 && count($results) < 11): ?> disabled <?php endif; ?>"><a href="<?php if(count($apiProducts)<29 && count($results) < 11): ?> javascript:; <?php else: ?> <?php echo e(url('/search?q='.$searchVal.'&page='.$nextPage)); ?> <?php endif; ?>">Next</a></li>
      </ul>
  </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layouts/front_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>