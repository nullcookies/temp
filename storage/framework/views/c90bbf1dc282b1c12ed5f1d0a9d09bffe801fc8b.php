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
							<a href="<?php echo url(ADMIN_URL_PATH.'/setting'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-user-secret"></i></span>
								<span class="s-text">Your Info</span>
							</a>
						</li>
						<li>
							<a href="<?php echo url(ADMIN_URL_PATH.'/homepage'); ?>" class="wave-effect waves-light">
								<span class="s-icon"><i class="fa fa-cogs"></i></span>
								<span class="s-text">Manage Homepage</span>
							</a>
						</li> 
						<li>
							<a href="<?php echo url(ADMIN_URL_PATH.'/homepage/nav'); ?>" class="wave-effect waves-light">
								<span class="s-icon"><i class="fa fa-bars"></i></span>
								<span class="s-text">Edit Navigation</span>
							</a>
						</li> 
 
					
						<!--
						<li>
							<a href="<?php echo url(ADMIN_URL_PATH.'/all-subscriptions'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-shopping-cart"></i></span>
								<span class="s-text">All Subscription</span>
							</a>
						</li>
						<li>
							<a href="<?php echo url(ADMIN_URL_PATH.'/create_subscription'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-shopping-cart"></i></span>
								<span class="s-text">Create New Subscription</span>
							</a>
						</li>

						<li class="menu-title">RM</li>
						<li>
							<a href="<?php echo url(ADMIN_URL_PATH.'/rm/create'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-shopping-cart"></i></span>
								<span class="s-text">Create RM</span>
							</a>
						</li>

						<li class="menu-title">Domain setup requests</li>
						<li>
							<a href="<?php echo url(ADMIN_URL_PATH.'/domain_request'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-shopping-cart"></i></span>
								<span class="s-text">Domain Setup Requests</span>
							</a>
						</li> -->

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
								<span class="s-text">Dispatch Orders</span>
							</a>
						</li>
						<!--<li>
							<a href="<?php echo url(ADMIN_URL_PATH.'/orders/orderShipped'); ?>" class="waves-effect  waves-light">
								<span class="s-icon mr-10"><i class="fa fa-handshake-o"></i></span>
								<span class="s-text">Mark Delivered</span>
							</a>
						</li>
						<li>
							<a href="<?php echo url(ADMIN_URL_PATH.'/orders/orderDelivered'); ?>" class="waves-effect  waves-light">
								<span class="s-icon mr-10"><i class="fa fa-check-circle-o"></i></span>
								<span class="s-text">Mark Completed</span>
							</a>
						</li>-->
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
							<a href="<?php echo url(ADMIN_URL_PATH.'/product/homepagetag'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-home"></i></span>
								<span class="s-text">Front Page Products Setting</span>
							</a>
						</li>
						<li class="">
							<a href="<?php echo url(ADMIN_URL_PATH.'/product/product-hot-deal'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-free-code-camp"></i></span>
								<span class="s-text">Product Hot Deal</span>
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
						<!--<li class="">
							<a href="<?php echo url(ADMIN_URL_PATH.'/categorysynch'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-list"></i></span>
								<span class="s-text">Categories Synchronization</span>
							</a>
						</li>-->
						<li class="menu-title">Payments</li>
						<li class="">
							<a href="<?php echo url(ADMIN_URL_PATH.'/payments'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-money"></i></span>
								<span class="s-text">Payment</span>
							</a>
						</li>
						<li class="menu-title" id="setting_tab">Settings</li>
						<li class="">
							<a href="<?php echo url(ADMIN_URL_PATH.'/shipping_charges#left_shipping_charges_tab'); ?>" id="left_shipping_charges_tab" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-inr"></i></span>
								<span class="s-text">Shipping Charges</span>
							</a>
						</li>
						<li class="">
							<a href="<?php echo url(ADMIN_URL_PATH.'/commission#left_commission_tab'); ?>" id="left_commission_tab" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-money"></i></span>
								<span class="s-text">Commission</span>
							</a>
						</li>
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
						<li class="menu-title">Mailing</li>
						<li class="">
							<a href="<?php echo url(ADMIN_URL_PATH.'/message'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-phone"></i></span>
								<span class="s-text">Contact Techturtle</span>
							</a>
						</li>
						<!--<li class="">
							<a href="<?php echo url(ADMIN_URL_PATH.'/message/mail-me'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-envelope"></i></span>
								<span class="s-text">customer support</span>
							</a>
						</li>
						<li class="">
							<a href="<?php echo url(ADMIN_URL_PATH.'/message/center'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-commenting"></i></span>
								<span class="s-text">Massage center</span>
							</a>
						</li>-->
						<!-- <li class="menu-title">Static Pages</li>
						<li class="compact-hide">
							<a href="<?php echo url(ADMIN_URL_PATH.'/notices'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-users"></i></span>
								<span class="s-text">Notices</span>
							</a>
						</li>
						<li class="compact-hide">
							<a href="<?php echo url(ADMIN_URL_PATH.'/service-agreements'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-users"></i></span>
								<span class="s-text">Service Agreements</span>
							</a>
						</li>
						<li class="compact-hide">
							<a href="<?php echo url(ADMIN_URL_PATH.'/review'); ?>" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-users"></i></span>
								<span class="s-text">Reviews</span>
							</a>
						</li> -->
					</ul>
				</div>
			</div>