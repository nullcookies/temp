<?php $__env->startSection('title'); ?>
	| Ecommerce website
<?php $__env->stopSection(); ?>

<?php $__env->startSection('top_newsletter'); ?>
	<?php echo $__env->make('front.common.top_newsletter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script>

    $(document).ready(function(){
      //fetchApiProducts(<?php echo e($category_id); ?>,<?php echo e($page); ?>,'<?php echo e($price_filter); ?>');
    });

    function fetchApiProducts(categoryid, page, pricerange=null){

      $.ajax({
        url: "<?php echo e(url('/products/api_products_ajax')); ?>",
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
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>

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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  
  <!-- Breadcrumbs -->
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="category1599"> <a href="<?php echo e(url('/')); ?>" title="home">Home</a> <span>/ </span> </li>
            <?php foreach($breadCrumbCategories as $key => $bread): ?>
              <li class="category1599"> <a href="<?php echo e(url('/products?catid='.$bread['id'])); ?>" title="<?php echo e($bread['category_name']); ?>"><?php echo e($bread['category_name']); ?></a> <span>/ </span> </li>
            <?php endforeach; ?>
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
          <?php if(isset($_GET['viewType']) && $_GET['viewType'] == 'list' ): ?>
            <?php echo $__env->make('front/products/productList', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php else: ?>
            <?php echo $__env->make('front/products/productGrid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php endif; ?>
          <div class="row">
            <div class="col-sm-12 text-center" >
              <span id="loader" class="hidden"><h2><img src="<?php echo e(asset('images/loader/loader.gif')); ?>"></h2></span>
            </div>
          </div>

          <ul class="pagination hidden" id="mypagination">
            <li><a href="<?php echo e(url('products?catid='.$_GET['catid'].'&page='.$previousPage)); ?>">Previous</a></li>
            <li><a href="<?php echo e(url('products?catid='.$_GET['catid'].'&page='.$nextPage)); ?>">Next</a></li>
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
                <?php echo $__env->make('front/products/category', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                      <li> <a href="<?php echo e(url('/products?catid='.$_GET['catid'].'&page='.$page.'&price=1_200')); ?>"><span class="price"><i class="fa fa-inr"></i> 0.00</span> - <span class="price"><i class="fa fa-inr"></i>200.00</span></a></li>
                      <li> <a href="<?php echo e(url('/products?catid='.$_GET['catid'].'&page='.$page.'&price=200_500')); ?>"><span class="price"><i class="fa fa-inr"></i> 200.00</span> - <span class="price"><i class="fa fa-inr"></i>500.00</span></a></li>
                      <li> <a href="<?php echo e(url('/products?catid='.$_GET['catid'].'&page='.$page.'&price=500_1000')); ?>"><span class="price"><i class="fa fa-inr"></i> 500.00</span> - <span class="price"><i class="fa fa-inr"></i>1000.00</span></a></li>
                      <li> <a href="<?php echo e(url('/products?catid='.$_GET['catid'].'&page='.$page.'&price=1000_9999999')); ?>"><span class="price"><i class="fa fa-inr"></i> 1000.00</span> - <span class="price">above</span></a></li>
                    </ol>
                  </dd>
                  <?php foreach($filterVarients as $filterVarient): ?>
                  <dt class="odd"><?php echo e($filterVarient->varient_type); ?></dt>
                  <dd class="odd">
                    <ol>
                      <?php foreach($varientTypeValues[$filterVarient->varient_type_id] as $varientTypeValue): ?>
                        <li> <a href="javascript:;"><?php echo e($varientTypeValue->value); ?></a> </li>
                      <?php endforeach; ?>
                    </ol>
                  </dd>
                  <?php endforeach; ?>
                </dl>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>
  <!-- Main Container End --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.front_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>