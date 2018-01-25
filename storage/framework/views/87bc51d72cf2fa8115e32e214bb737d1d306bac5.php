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
<div class="container-fluid nt-header1">
</div>
<div class="container-fluid">
	<div class="container">
		<ol class="breadcrumb ms-breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
			<?php foreach($breadCrumbCategories as $breadCrumbCategory): ?>
			  <li class="breadcrumb-item"><a href="<?php echo e(url('/category/'.$breadCrumbCategory['alias'])); ?>"><?php echo e($breadCrumbCategory['category_name']); ?></a></li>
			<?php endforeach; ?>
		</ol>
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
</div>
<div class="container-fluid bg-black">
	<div class="container">
		<div class="row">
			<ul class="need-today-list">
				<li><?php echo e($category_name); ?>

					<?php if(count($categories)): ?>
					<select id="subcategoryselect" class="nt-select">
						<option value="">Select</option>
						<?php foreach($categories as $childcategory): ?>
							<option value="<?php echo e($childcategory['alias']); ?>"><?php echo e($childcategory['category']); ?></option>
						<?php endforeach; ?>
					</select>
					<?php endif; ?>
				</li>
			</ul>
			<ul class="price-list">
				<select id="priceselect" class="nt-select">
					<option>Price</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="500">500</option>
					<option value="1000">1000</option>
					<option value="2000">2000</option>
				</select>
			</ul>
		</div>		
	</div>
</div>
<div class="container-fluid">
	<div class="container">
		<div class="row nt-row">
		<?php foreach($products as $product): ?>
			<div class="col-md-3 col-sm-6 nt-pro-box">
				<a href="<?php echo e(url('category/'.$cat_alias.'/product/'.$product->id)); ?>">
					<img src="<?php echo e($productImage[$product->id]); ?>"/>
					<h5><?php echo e($product->product_name); ?></h5>
					<h4 class="c-red"><i class="fa fa-inr"></i> <?php echo e($product->product_selling_price); ?></h4>
					<span>Delivery Available: <span style="color:#d80003">Today</span></span>
				</a>	
			</div>
		<?php endforeach; ?>
		</div>
	</div>
</div>	

<?php if(count($products)): ?>
	<center><?php echo $products->render(); ?></center>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>