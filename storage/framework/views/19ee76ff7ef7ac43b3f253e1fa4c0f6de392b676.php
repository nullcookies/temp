<?php $__env->startSection('css'); ?>

<style>
.sort-list{
    margin-top:-35px;
}
    
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

	<script>
		$(document).ready(function(){
			$('#subcategoryselect').on('change', function(event){
				var location = "<?php echo e(url('/category/')); ?>"+ '/' + $(this).val();
				window.location.href = location;
			});

			$('#productsortby').on('change', function(event){
				var full_location = "<?php echo e(URL::current()); ?>";
				var queryVar = full_location.includes('?') ? '&' : '?';
				var location = full_location+queryVar+'sort_by=' + $(this).val();
				window.location.href = location;
			});

			$('#priceselect').on('change', function(event){
				var full_location = "<?php echo e(URL::current()); ?>";
				var queryVar = full_location.includes('?') ? '&' : '?';
				var location = full_location+queryVar+'price=' + $(this).val();
				window.location.href = location;
			});

		});
	</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!--<div class="container-fluid">
	<div class="container">
		<ol class="breadcrumb ms-breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
			<li class="breadcrumb-item active" >Search Product</li>
		</ol>
	</div>
</div>-->
<div class="container-fluid">
	<div class="container">
		<h4 class="roboto-light">All Search Results for ' <?php echo e($_GET['q']); ?> '</h4>
		<ul class="sort-list">
			<li>Sort by:</li>
			<select id="productsortby" class="pd-5">
				<option value="">Select</option>
				<option value="price_asc">Low Price First</option>
				<option value="price_desc">High Price First</option>
				<option value="product_desc">Latest Product First</option>
			</select>
		</ul>
	</div>
</div>
<!--<div class="container-fluid pd-10">
	<div class="container">
		<h3 class="roboto-light">All Search Results for ' <?php echo e($_GET['q']); ?> '</h3>
		<ul class="sort-list">
			<li>Sort :</li>
			<select id="productsortby" class="pd-5">
				<option value="">Select</option>
				<option value="price_asc">Low Price First</option>
				<option value="price_desc">High Price First</option>
				<option value="product_desc">Latest Product First</option>
			</select>
		</ul>
	</div>
</div>-->
<div class="container-fluid bg-black hidden-xs">
	<div class="container roboto-light">
		<customnav>
			<ul class="categorylist">
				<li class="gift-main">
					<a href="#">Available Delivery <i class="fa fa-chevron-down"></i><br/><span>Cities</span></a> 
					<div class="gift-type">
						<ul class="seclevel">
							<li>
								<a href="javascript:;">Delhi</a>
							</li>
							<li>
								<a href="javascript:;">Ghaziabaad</a>
							</li>
							<li>
								<a href="javascript:;">Noida</a>
							</li>
							<li>
								<a href="javascript:;">Faridabad</a>
							</li>
							<li>
								<a href="javascript:;">Gurgaon</a>
								
							</li>
						</ul>
					</div>
				</li>
			</ul>
		</customnav>
	</div>
</div>
<div class="container-fluid">
	<div class="container">
		<div class="row nt-row">
		    <div class="infinite-scroll clearfix" style="">
		<?php foreach($products as $product): ?>
			<div class="col-md-3 col-sm-6 col-xs-6 nt-pro-box">
		        <div class="newnt">
    				<a href="<?php echo e(url('category/'.$cat_alias->name_alias.'/product/'.$product->id)); ?>">
    					<img width="200" src="<?php echo e($productImage[$product->id]); ?>"/>
    				</a>	
					<h5><?php echo e(substr($product->product_name,0,30)); ?></h5>
					<h4 class="c-red"><i class="fa fa-inr"></i> <?php echo e($product->product_selling_price); ?></h4>
					<p>Delivery Available: <span style="color:#d80003">Today</span></p>
    			</div>	
			</div>
		<?php endforeach; ?>
		<?php if(count($products)): ?>
	<center><?php echo $products->render(); ?></center>
<?php endif; ?>
		</div>
		</div>
	</div>
</div>	


<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>