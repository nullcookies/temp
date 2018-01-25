<?php $__env->startSection('content'); ?>


<!-- from here -->
	
<!--<div class="container-fluid section3">
	<div class="container section3-1">
		<h1>Happy Valentine's<br/>  Day</h1>
		<h3>Some things are better said with gifts</h3>
		<br/>
		<a href="#" class="shop-now">Shop Now</a>
	</div>
</div>-->
<div class="owl-carousel homepage-slider owl-theme">
	<a href="javascript:;">
		<img src="<?php echo e(asset('massengers/Homepage-banners/banner_1.jpg')); ?>">
	</a>
	<a href="javascript:;">
		<img src="<?php echo e(asset('massengers/Homepage-banners/banner_2.jpg')); ?>">
	</a>
	<a href="javascript:;">
		<img src="<?php echo e(asset('massengers/Homepage-banners/banner_3.jpg')); ?>">
	</a>
	<a href="javascript:;">
		<img src="<?php echo e(asset('massengers/Homepage-banners/banner_4.jpg')); ?>">
	</a>
	<a href="javascript:;">
		<img src="<?php echo e(asset('massengers/Homepage-banners/banner_5.jpg')); ?>">
	</a>
	<a href="javascript:;">
		<img src="<?php echo e(asset('massengers/Homepage-banners/banner_6.jpg')); ?>">
	</a>
	<a href="javascript:;">
		<img src="<?php echo e(asset('massengers/Homepage-banners/banner_7.jpg')); ?>">
	</a>
	<a href="javascript:;">
		<img src="<?php echo e(asset('massengers/Homepage-banners/banner_8.jpg')); ?>">
	</a>
</div>
<h2 class="love-rym">Love has no Rym, No Reason !! No Time,  No Season !!</h2>
<div class="container-fluid section4">
	<div class="container">
		<div class="strike">
			<span><h1>Categories</h1></span>
		</div>
		<!--<h1>Categories</h1>-->
		<div class="owl-carousel category-slider owl-2 owl-theme">
			<div class="cat-box">
				<a href="<?php echo e(url('category/love-letters')); ?>">
					<img src="<?php echo e(asset('massengers/img/loveletters.jpg')); ?>" class="img-responsive"/>
				</a>	
				<ul>
					<li class="catboxtitle">Love Letters</li>
					<li class="pull-right"><a href="<?php echo e(url('category/love-letters')); ?>" class="catbuybtn" title="Buy Now">Buy Now <i class="fa fa-angle-right"></i></a></li>
				</ul>
			</div>
			<div class="cat-box">
				<a href="<?php echo e(url('/category/fan-mails')); ?>">
					<img src="<?php echo e(asset('massengers/img/fan.jpg')); ?>" class="img-responsive"/>
				</a>	
				<ul>
					<li class="catboxtitle">Fan Mails</li>
					<li class="pull-right"><a href="<?php echo e(url('/category/fan-mails')); ?>" class="catbuybtn" title="Buy Now">Buy Now <i class="fa fa-angle-right"></i></a></li>
				</ul>	
			</div>
			<div class="cat-box">
				<a href="<?php echo e(url('/category/cakes')); ?>">
					<img src="<?php echo e(asset('massengers/img/cakes.jpg')); ?>" class="img-responsive"/>
				</a>	
				<ul>
					<li class="catboxtitle">Delicious Cake</li>
					<li class="pull-right"><a href="<?php echo e(url('/category/cakes')); ?>" class="catbuybtn" title="Buy Now">Buy Now <i class="fa fa-angle-right"></i></a></li>
				</ul>	
			</div>
			<div class="cat-box">
				<a href="<?php echo e(url('category/all-flowers')); ?>">
					<img src="<?php echo e(asset('massengers/img/flowers.jpg')); ?>" class="img-responsive"/>
				</a>	
				<ul>
					<li class="catboxtitle">Flowers</li>
					<li class="pull-right"><a href="<?php echo e(url('category/all-flowers')); ?>" class="catbuybtn" title="Buy Now">Buy Now <i class="fa fa-angle-right"></i></a></li>
				</ul>	
			</div>
			<div class="cat-box">
				<a href="<?php echo e(url('category/parker-pens')); ?>">
					<img src="<?php echo e(asset('massengers/img/chocolate.jpg')); ?>" class="img-responsive"/>
				</a>	
				<ul>
					<li class="catboxtitle">Chocolates</li>
					<li class="pull-right"><a href="<?php echo e(url('category/chocholates')); ?>" class="catbuybtn" title="Buy Now">Buy Now <i class="fa fa-angle-right"></i></a></li>
				</ul>	
			</div>
			<div class="cat-box">
				<a href="<?php echo e(url('category/parker-pens')); ?>">
					<img src="<?php echo e(asset('massengers/img/parkerpens.jpg')); ?>" class="img-responsive"/>
				</a>	
				<ul>
					<li class="catboxtitle">Parker Pens</li>
					<li class="pull-right"><a href="<?php echo e(url('category/parker-pens')); ?>" class="catbuybtn" title="Buy Now">Buy Now <i class="fa fa-angle-right"></i></a></li>
				</ul>	
			</div>
		</div>	
	</div>
</div>
<div class="container-fluid section5">
	<div class="container home-brands">
		<div class="strike">
			<span><h1>Birthday</h1></span>
		</div>
		
		<div class="owl-carousel owl-theme index-carousel">
            <?php foreach($products as $product): ?>
            <div class="item">
				<a href="<?php echo e(url('/category/'.$productCat[$product->id].'/product/'.$product->id)); ?>">
					<img src="<?php echo e($productImage[$product->id]); ?>"/>
				</a>	
				<h6><?php echo substr($product->product_name,0,30); ?></h6>
				<h5><i class="fa fa-inr"></i>&nbsp;<?php echo $product->product_selling_price; ?></h5>
            </div>
            <?php endforeach; ?>
        </div>
	</div>
</div>
<a href="<?php echo e(url('/category/all-flowers')); ?>">
	<img src="<?php echo e(asset('massengers/img/valentines.jpg')); ?>" class="img-responsive" style="margin:0 auto;">
</a>
<div class="container-fluid section7">
	<div class="container">
		<div class="strike">
			<span><h1>Valentine's Day Special</h1></span>
		</div>
		
		<div class="owl-carousel owl-theme index-carousel">
            <?php foreach($valentineproducts as $valentineProduct): ?>
            <div class="item">
				<a href="<?php echo e(url('/category/'.$valentineProductCat[$valentineProduct->id].'/product/'.$valentineProduct->id)); ?>">
					<img src="<?php echo e($valentineproductImage[$valentineProduct->id]); ?>"/>
				</a>	
				<h6><?php echo substr($valentineProduct->product_name,0,30); ?></h6>
				<h5><i class="fa fa-inr"></i>&nbsp;<?php echo $valentineProduct->product_selling_price; ?></h5>
			</a>
            </div>
            <?php endforeach; ?>
        </div>
	</div>
</div>
<div class="container-fluid section8">
	<div class="container">
		<div class="col-md-6">
			<span>Welcome</span>
			<p>Gifts bring passions and sentiments. Gifts are connected with certain people or events and leaving behind strong impressions on the recipient's mind. It strengthens our recipient's memory by recollecting again and again, which contribute to this trend. Gifts play an essential role in sharing our feelings and making us love each other. They are the token of trust, life, and emotions. They are an expression of love and caring.</p>
			<a href="<?php echo e(url('/about-us')); ?>" class="read-more" title="Read More">Read More</a>
		</div>
		<div class="col-md-6 mr-20 videobox">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/Ducs2oq1e_w" frameborder="0" allowfullscreen></iframe>
		</div>
	</div>
</div>
<div class="container-fluid section9">
	<div class="container">
		<div class="strike">
			<span><h1>Blog Corner</h1></span>
		</div>
		<div class="blog-box">
			<div class="owl-carousel blog-carousel owl-theme">
	            <div class="item">
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/"><img src="<?php echo e(asset('massengers/img/blog01.png')); ?>"/></a>
					<br/>
					<h5>Care for crispy honey cookies ?</h5>
					<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/" class="blog-btn" title="Read More">Read More</a>
	            </div>
	            <div class="item">
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/"><img src="<?php echo e(asset('massengers/img/blog02.png')); ?>"/></a>
					<br/>
					<h5>Care for crispy honey cookies ?</h5>
					<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/" class="blog-btn" title="Read More">Read More</a>
	            </div>
	            <div class="item">
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/"><img src="<?php echo e(asset('massengers/img/blog03.png')); ?>"/></a>
					<br/>
					<h5>Care for crispy honey cookies ?</h5>
					<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/" class="blog-btn" title="Read More">Read More</a>
	            </div>
	            <div class="item">
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/"><img src="<?php echo e(asset('massengers/img/blog01.png')); ?>"/></a>
					<br/>
					<h5>Care for crispy honey cookies ?</h5>
					<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies" class="blog-btn" title="Read More">Read More</a>
	            </div>
	            <div class="item">
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/"><img src="<?php echo e(asset('massengers/img/blog02.png')); ?>"/></a>
					<br/>
					<h5>Care for crispy honey cookies ?</h5>
					<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies" class="blog-btn" title="Read More">Read More</a>
	            </div>
	      	</div>
	    </div>
	</div>	
</div>
<div class="container-fluid section10">
	<div class="container">
		<div class="strike-white">
			<span><h1>Testimonials</h1></span>
		</div>
		
		<div id="myCarousel" class="carousel slide my-carousel" data-ride="carousel">
		  <!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<blockquote>
						<h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</h4>
					</blockquote>
				</div>

				<div class="item">
					<blockquote>
						<h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</h4>
					</blockquote>
				</div>

				<div class="item">
					<blockquote>
						<h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</h4>
					</blockquote>
				</div>

				<div class="item">
					<blockquote>
						<h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</h4>
					</blockquote>
				</div>
			</div>
			<!-- Indicators -->
			<ol class="carousel-indicators indicators2">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
				<li data-target="#myCarousel" data-slide-to="3"></li>
			</ol>
		</div>
	</div>
</div>

<div class="container-fluid section11">
	<div class="container">
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ergo ita: non posse honeste vivi, nisi honeste vivatur? Cur igitur, cum de re conveniat, non malumus usitate loqui? Duo Reges: constructio interrete. Mihi enim satis est, ipsis non satis. Tollenda est atque extrahenda radicitus. Apparet statim, quae sint officia, quae actiones. Quid de Pythagora?</p>
	</div>
</div>


<!-- to here -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>