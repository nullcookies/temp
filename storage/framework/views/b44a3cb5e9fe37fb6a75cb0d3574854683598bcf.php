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
		<div class="owl-carousel owl-2 owl-theme">
			<div class="cat-box">
				<a href="<?php echo e(url('category/love-letters')); ?>">
					<img src="<?php echo e(asset('massengers/img/loveletters.jpg')); ?>" class="img-responsive"/>
					<ul>
						<li>Love Letters</li>
						<li class="pull-right"><a href="<?php echo e(url('category/love-letters')); ?>">Buy Now <i class="fa fa-chevron-right"></i></a></li>
					</ul>
				</a>
			</div>
			<div class="cat-box">
				<a href="#">
					<img src="<?php echo e(asset('massengers/img/fan.jpg')); ?>" class="img-responsive"/>
					<ul>
						<li>Fan Mails</li>
						<li class="pull-right"><a href="#">Buy Now <i class="fa fa-chevron-right"></i></a></li>
					</ul>
				</a>	
			</div>
			<div class="cat-box">
				<a href="<?php echo e(url('/category/cakes')); ?>">
					<img src="<?php echo e(asset('massengers/img/cakes.jpg')); ?>" class="img-responsive"/>
					<ul>
						<li>Delicious Cake</li>
						<li class="pull-right"><a href="<?php echo e(url('/category/cakes')); ?>">Buy Now <i class="fa fa-chevron-right"></i></a></li>
					</ul>
				</a>	
			</div>
			<div class="cat-box">
				<a href="<?php echo e(url('category/home-decorative')); ?>">
					<img src="<?php echo e(asset('massengers/img/flowers.jpg')); ?>" class="img-responsive"/>
					<ul>
						<li>Flowers</li>
						<li class="pull-right"><a href="<?php echo e(url('category/home-decorative')); ?>">Buy Now <i class="fa fa-chevron-right"></i></a></li>
					</ul>
				</a>	
			</div>
			<div class="cat-box">
				<a href="<?php echo e(url('category/chocholates')); ?>">
					<img src="<?php echo e(asset('massengers/img/parkerpens.jpg')); ?>" class="img-responsive"/>
					<ul>
						<li>Parker Pens</li>
						<li class="pull-right"><a href="<?php echo e(url('category/chocholates')); ?>">Buy Now <i class="fa fa-chevron-right"></i></a></li>
					</ul>
				</a>	
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
				<a href="#">
					<img src="<?php echo e($productImage[$product->id]); ?>"/>
					<h6><?php echo substr($product->product_name,0,30); ?></h6>
					<h5><i class="fa fa-inr"></i>&nbsp;<?php echo $product->product_selling_price; ?></h5>
				</a>
            </div>
            <?php endforeach; ?>
        </div>
	</div>
</div>
<div class="container-fluid section6">
	<div class="container">
		<div class="col-md-6">
			<center>
				<img src="<?php echo e(asset('massengers/img/heart-gift.png')); ?>" class="img-responsive"/>
			</center>
			</div>
		<div class="col-md-6 section6-1 hidden-xs">
			<span class="flowers">Flowers</span>
			<p>For</p>
			<span class="valentine">Valentine's Day</span>
			<br/>
			<a href="javascript:;" class="gift-now" data-toggle="modal" data-target="#formnewsletter">Gift Now</a>
		</div>
		<div class="col-md-6 section6-1 hidden-lg hidden-md hidden-sm">
			<h2>Flowers for Valentine's Day</h2>
			<a href="javascript:;" class="gift-now" data-toggle="modal" data-target="#formnewsletter">Gift Now</a>
		</div>
	</div>
</div>

<div class="container-fluid section7">
	<div class="container">
		<div class="strike">
			<span><h1>Valentine's Day Special</h1></span>
		</div>
		
		<div class="owl-carousel owl-theme index-carousel">
            <?php foreach($valentineproducts as $valentineProduct): ?>
            <div class="item">
				<a href="#">
					<img src="<?php echo e($valentineproductImage[$valentineProduct->id]); ?>"/>
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
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
			<br/>
			<a href="#" class="read-more">Read More</a>
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
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/" class="blog-btn">Read More</a>
	            </div>
	            <div class="item">
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/"><img src="<?php echo e(asset('massengers/img/blog02.png')); ?>"/></a>
					<br/>
					<h5>Care for crispy honey cookies ?</h5>
					<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/" class="blog-btn">Read More</a>
	            </div>
	            <div class="item">
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/"><img src="<?php echo e(asset('massengers/img/blog03.png')); ?>"/></a>
					<br/>
					<h5>Care for crispy honey cookies ?</h5>
					<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/" class="blog-btn">Read More</a>
	            </div>
	            <div class="item">
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/"><img src="<?php echo e(asset('massengers/img/blog01.png')); ?>"/></a>
					<br/>
					<h5>Care for crispy honey cookies ?</h5>
					<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies" class="blog-btn">Read More</a>
	            </div>
	            <div class="item">
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/"><img src="<?php echo e(asset('massengers/img/blog02.png')); ?>"/></a>
					<br/>
					<h5>Care for crispy honey cookies ?</h5>
					<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies" class="blog-btn">Read More</a>
	            </div>
	      	</div>
	    </div>
		<!--<div class="owl-carousel owl-theme">
            <div class="item">
				<img src="<?php echo e(asset('massengers/img/blog01.png')); ?>"/>
				<br/>
				<h5>Care for crispy honey cookies ?</h5>
				<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
				<a href="#" class="blog-btn">Read More</a>
            </div>
            <div class="item">
				<img src="<?php echo e(asset('massengers/img/blog02.png')); ?>"/>
				<br/>
				<h5>Care for crispy honey cookies ?</h5>
				<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
				<a href="#" class="blog-btn">Read More</a>
            </div>
            <div class="item">
				<img src="<?php echo e(asset('massengers/img/blog03.png')); ?>"/>
				<br/>
				<h5>Care for crispy honey cookies ?</h5>
				<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
				<a href="#" class="blog-btn">Read More</a>
            </div>
            <div class="item">
				<img src="<?php echo e(asset('massengers/img/blog01.png')); ?>"/>
				<br/>
				<h5>Care for crispy honey cookies ?</h5>
				<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
				<a href="#" class="blog-btn">Read More</a>
            </div>
            <div class="item">
				<img src="<?php echo e(asset('massengers/img/blog02.png')); ?>"/>
				<br/>
				<h5>Care for crispy honey cookies ?</h5>
				<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
				<a href="#" class="blog-btn">Read More</a>
            </div>
          </div>-->
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
						<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Equidem, sed audistine modo de Carneade? Qui convenit? Duo Reges: constructio interrete. Sin aliud quid voles, postea. Hinc ceteri particulas arripere conati suam quisque videro voluit afferre sententiam</h4>
					</blockquote>
				</div>

				<div class="item">
					<blockquote>
						<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Equidem, sed audistine modo de Carneade? Qui convenit? Duo Reges: constructio interrete. Sin aliud quid voles, postea. Hinc ceteri particulas arripere conati suam quisque videro voluit afferre sententiam</h4>
					</blockquote>
				</div>

				<div class="item">
					<blockquote>
						<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Equidem, sed audistine modo de Carneade? Qui convenit? Duo Reges: constructio interrete. Sin aliud quid voles, postea. Hinc ceteri particulas arripere conati suam quisque videro voluit afferre sententiam</h4>
					</blockquote>
				</div>

				<div class="item">
					<blockquote>
						<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Equidem, sed audistine modo de Carneade? Qui convenit? Duo Reges: constructio interrete. Sin aliud quid voles, postea. Hinc ceteri particulas arripere conati suam quisque videro voluit afferre sententiam</h4>
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
		<p>Lorem ipsum dolor sit amet, ferri libris periculis his no, cu cum maiorum aliquando. Est no putent regione, quo clita accusam patrioque ex. In vim quot aliquip ullamcorper, ne has alii sanctus, no verterem assueverit mea. Eos te posse phaedrum, pro ad convenire patrioque, te denique constituto vix. Quodsi suscipit petentium ne eam, cu vix ipsum altera bonorum.</p>
	</div>
</div>


<!-- to here -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>