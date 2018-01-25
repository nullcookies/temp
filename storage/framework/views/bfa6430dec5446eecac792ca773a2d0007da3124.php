<?php $__env->startSection('title'); ?>
| Ecommerce website Pages
<?php $__env->stopSection(); ?>




<?php $__env->startSection('content'); ?>
<div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="Go to Home Page" href="index.html">Home</a> <span>/</span> </li>
            <li class="category1601"> <strong><?php echo $pages->name; ?></strong> </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
   <!-- main-container -->
  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-sm-9 wow bounceInUp animated">
        <div class="col-main">
          <div class="page-title">
            <h2><?php echo $pages->name; ?></h2>
          </div>
          <div class="static-contain">
            <?php echo $pages->content; ?>

          </div>

          </div>
        </section>
        <aside class="col-right sidebar col-sm-3 wow bounceInUp animated">
          <div class="block block-company">
            <div class="block-title">Quick Link </div>
            <div class="block-content">
              <ol id="recently-viewed-items">
              <?php foreach($pagesTT as $value): ?>
              <?php if($pages->alias == $value->alias): ?>
                <li class="item odd"><strong><?php echo e($value->name); ?></strong></li>
              <?php else: ?>
                <li class="item even"><a href="<?php echo e(url('pages/'.$value->alias)); ?>"><?php echo e($value->name); ?></a></li>
              <?php endif; ?>
              <?php endforeach; ?>               
                
              </ol>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
  <!--End main-container --> 

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.front_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>