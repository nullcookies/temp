<?php 
	$homepagenav    =   new App\Http\Controllers\Admin\WebsiteSetting\HomepageNavController;
	$allCategories 	=	$homepagenav->fetchAllHomePageNav();
	$categories 	=	$homepagenav->getChildFromArray(0, $allCategories);
?>
<ul id="nav" class="hidden-xs">
	<?php foreach($categories as $categoryLevel1): ?>
	<li class="mega-menu"><a href="<?php echo e(url('products?catid='.$categoryLevel1['category_id'])); ?>" class="level-top"><span><?php echo e($categoryLevel1['name']); ?></span></a> 
		<div class="level0-wrapper dropdown-6col">
			<div class="container">
				<div class="level0-wrapper2">
					<div class="nav-block nav-block-center"> 						
						<ul class="level0">
							<?php foreach($categoryLevel1['childs'] as $categoryLevel2): ?>
							<li class="level3 nav-6-1 parent item"> <a href="<?php echo e(url('products?catid='.$categoryLevel2['category_id'])); ?>"><span><?php echo e($categoryLevel2['name']); ?></span></a>
								<ul class="level1">
									<?php foreach($categoryLevel2['childs'] as $categoryLevel3): ?>
									<li class="level2 nav-6-1-1"> <a href="<?php echo e(url('products?catid='.$categoryLevel3['category_id'])); ?>"><span><?php echo e($categoryLevel3['name']); ?></span></a> </li>
						            <?php endforeach; ?>
								</ul>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</li>
	<?php endforeach; ?>
</ul>