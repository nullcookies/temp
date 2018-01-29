<div class="site-sidebar">
				<div class="custom-scroll custom-scroll-light">
					<ul class="sidebar-menu">
					    
					    <li>
							<a href="<?php echo e(url('/')); ?>" target="_blank" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-television"></i></span>
								<span class="s-text">Visit Website</span>
							</a>
						</li>
						<li>
							<a href="<?php echo e(url('/admin')); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-tachometer"></i></span>
								<span class="s-text">Dashboard</span>
							</a>
						</li>

						<li class="menu-title">Settings</li>
						<li>
							<a href="<?php echo url(ADMIN_URL_PATH.'/website-analytics'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-area-chart"></i></span>
								<span class="s-text">Website Analytics</span>
							</a>
						</li>

						<li>
							<a href="<?php echo url(ADMIN_URL_PATH.'/homepage/nav'); ?>" class="wave-effect waves-light">
								<span class="s-icon"><i class="fa fa-bars"></i></span>
								<span class="s-text">Edit Navigation</span>
							</a>
						</li> 

						<li>
							<a href="<?php echo e(url('/admin/banners')); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-tachometer"></i></span>
								<span class="s-text">Homepage Banners</span>
							</a>
						</li>

						<li>
							<a href="<?php echo e(url('/admin/homepage_category')); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-tachometer"></i></span>
								<span class="s-text">Homepage Categories</span>
							</a>
						</li>
 
					
						<li class="menu-title">Orders</li>
						<li>
									<a href="<?php echo url(ADMIN_URL_PATH.'/orders/view'); ?>" class="waves-effect  waves-light">
										<span class="s-icon mr-10"><i class="fa fa-shopping-cart"></i></span>
										<span class="s-text">View Orders</span>
									</a>
								</li>
								<li>
							<a href="<?php echo url(ADMIN_URL_PATH.'/orders/manifest'); ?>" class="waves-effect  waves-light">
								<span class="s-icon mr-10"><i class="fa fa-file-text"></i></span>
								<span class="s-text">Generate Menifest</span>
							</a>
						</li>
						<li>
							<a href="<?php echo url(ADMIN_URL_PATH.'/orders/orderDispatch'); ?>" class="waves-effect  waves-light">
								<span class="s-icon mr-10"><i class="fa fa-truck"></i></span>
								<span class="s-text">Complete Orders</span>
							</a>
						</li>
						
						<li>
							<a href="<?php echo url(ADMIN_URL_PATH.'/orders/returnorder'); ?>" class="waves-effect  waves-light">
								<span class="s-icon mr-10"><i class="fa fa-undo"></i></span>
								<span class="s-text"> Initiate Return</span>
							</a>
						</li>
						<li class="">
							<a href="<?php echo url(ADMIN_URL_PATH.'/orders/return'); ?>" class="waves-effect  waves-light">
								<span class="s-icon mr-10"><i class="fa fa-reply"></i></span>
								<span class="s-text">Accept/Reject Return</span>
							</a>
						</li>
						
                       
                        
						<li class="menu-title">Product</li>
						<li class="">
							<a href="<?php echo url(ADMIN_URL_PATH.'/product'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-dropbox"></i></span>
								<span class="s-text">Products</span>
							</a>
						</li>
						<li class="">
							<a href="<?php echo url(ADMIN_URL_PATH.'/product/upload'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-spinner"></i></span>
								<span class="s-text">Add Products</span>
							</a>
						</li>
						<li class="">
							<a href="<?php echo e(url(ADMIN_URL_PATH.'/product/inventory')); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-wrench"></i></span>
								<span class="s-text">Manage Inventory</span>
							</a>
						</li>
						
						<li class="">
							<a href="<?php echo url(ADMIN_URL_PATH.'/product/deleted'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-trash"></i></span>
								<span class="s-text">Trash Product</span>
							</a>
						</li>
						<li class="menu-title">Categories</li>
						<li class="">
							<a href="<?php echo url(ADMIN_URL_PATH.'/category'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-server"></i></span>
								<span class="s-text">Categories</span>
							</a>
						</li>
						
						<li class="menu-title" id="setting_tab">Settings</li>
						<li class="">
							<a href="<?php echo url(ADMIN_URL_PATH.'/coupon#left_coupon_tab'); ?>" id="left_coupon_tab" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-ticket"></i></span>
								<span class="s-text">Coupons</span>
							</a>
						</li>
						<li class="compact-hide">
							<a href="<?php echo url(ADMIN_URL_PATH.'/user_management'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-users"></i></span>
								<span class="s-text">Registered Users</span>
							</a>
						</li>
					</ul>
				</div>
			</div>