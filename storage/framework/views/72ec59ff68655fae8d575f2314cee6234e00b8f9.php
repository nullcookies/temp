<?php 
	$homepagenav    =   new App\Http\Controllers\Admin\WebsiteSetting\HomepageNavController;
	$allCategories 	=	$homepagenav->fetchAllHomePageNav();
	$categories 	=	$homepagenav->getChildFromArray(0, $allCategories);
?>

<div class="container-fluid section2 fixme2 hidden-xs">
	<div class="container section2-1">
			<!-- Navigation -->
			<nav>
			  <div class="container">
				<div class="nav-inner"> 
				  <!-- BEGIN NAV -->
				  <ul id="nav" class="hidden-xs">
				  <?php foreach($categories as $categoryLevel1): ?>
					<li class="mega-menu"> <a class="level-top" href="javascript:;"><span><i class="fa fa-heart"></i> <?php echo e($categoryLevel1['name']); ?></span></a>
					  <div class="level0-wrapper dropdown-6col">
						<div class="container">
						  <div class="level0-wrapper2">
							<div class="nav-block nav-block-center"> 
							  <ul class="level0">
							  <?php foreach($categoryLevel1['childs'] as $categoryLevel2): ?>
								<li class="level3 nav-6-1 parent item"> <a href="<?php echo e(url('/category/'.$categoryLevel2['alias'])); ?>"><span><?php echo e($categoryLevel2['name']); ?></span></a>
								  <ul class="level1">
								  	<?php foreach($categoryLevel2['childs'] as $categoryLevel3): ?>
										<li class="level2 nav-6-1-1"> <a href="<?php echo e(url('/category/'.$categoryLevel3['alias'])); ?>"><span><?php echo e($categoryLevel3['name']); ?></span></a> </li>
									<?php endforeach; ?>
								  </ul>
								</li>
								<?php endforeach; ?>
							  </ul>
							  <!--level0--> 
							</div>
							<!--nav-block nav-block-center--> 
						  </div>
						  <!--level0-wrapper2--> 
						</div>
						<!--container--> 
					  </div>
					</li>
					<?php endforeach; ?>
				  </ul>
				  <!--nav--> 
				</div>
			  </div>
			</nav>
	</div>
</div>