@extends('massengers/layout/layout')

@section('content')


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
		<img src="{{asset('massengers/Homepage-banners/karwachauth-banner.jpg')}}">
	</a>
	<a href="javascript:;">
		<img src="{{asset('massengers/Homepage-banners/banner_2.jpg')}}">
	</a>
	<a href="javascript:;">
		<img src="{{asset('massengers/Homepage-banners/banner_3.jpg')}}">
	</a>
	<a href="javascript:;">
		<img src="{{asset('massengers/Homepage-banners/banner_4.jpg')}}">
	</a>
	<a href="javascript:;">
		<img src="{{asset('massengers/Homepage-banners/banner_5.jpg')}}">
	</a>
	<a href="javascript:;">
		<img src="{{asset('massengers/Homepage-banners/banner_6.jpg')}}">
	</a>
	<a href="javascript:;">
		<img src="{{asset('massengers/Homepage-banners/banner_7.jpg')}}">
	</a>
	<a href="javascript:;">
		<img src="{{asset('massengers/Homepage-banners/banner_8.jpg')}}">
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
			@foreach($homepage_categories as $homepage_category)
			<div class="cat-box">
				<a href="{{$homepage_category->link}}">
					<img src="{{asset('/images/homepage_category/'.$homepage_category->image)}}" class="img-responsive"/>
				</a>	
				<ul>
					<li class="catboxtitle">{{$homepage_category->title}}</li>
					<li class="pull-right"><a href="{{$homepage_category->link}}" class="catbuybtn" title="Buy Now">{{$homepage_category->link_title}} <i class="fa fa-angle-right"></i></a></li>
				</ul>
			</div>
			@endforeach
		</div>	
	</div>
</div>
<div class="container-fluid section5">
	<div class="container home-brands">
		<div class="strike">
			<span><h1>Birthday</h1></span>
		</div>
		
		<div class="owl-carousel owl-theme index-carousel">
            @foreach($products as $product)
            <div class="item">
				<a href="{{url('/category/'.$productCat[$product->id].'/product/'.$product->id)}}">
					<img src="{{$productImage[$product->id]}}"/>
				</a>	
				<h6>{!! substr($product->product_name,0,30) !!}</h6>
				<h5><i class="fa fa-inr"></i>&nbsp;{!! $product->product_selling_price !!}</h5>
            </div>
            @endforeach
        </div>
	</div>
</div>
<a href="{{url('/category/all-flowers')}}">
	<img src="{{asset('massengers/img/valentines.jpg')}}" class="img-responsive" style="margin:0 auto;">
</a>
<div class="container-fluid section7">
	<div class="container">
		<div class="strike">
			<span><h1>Valentine's Day Special</h1></span>
		</div>
		
		<div class="owl-carousel owl-theme index-carousel">
            @foreach($valentineproducts as $valentineProduct)
            <div class="item">
				<a href="{{url('/category/'.$valentineProductCat[$valentineProduct->id].'/product/'.$valentineProduct->id)}}">
					<img src="{{$valentineproductImage[$valentineProduct->id]}}"/>
				</a>	
				<h6>{!! substr($valentineProduct->product_name,0,30) !!}</h6>
				<h5><i class="fa fa-inr"></i>&nbsp;{!! $valentineProduct->product_selling_price !!}</h5>
			</a>
            </div>
            @endforeach
        </div>
	</div>
</div>
<div class="container-fluid section8">
	<div class="container">
		<div class="col-md-6">
			<span>Welcome</span>
			<p>Gifts bring passions and sentiments. Gifts are connected with certain people or events and leaving behind strong impressions on the recipient's mind. It strengthens our recipient's memory by recollecting again and again, which contribute to this trend. Gifts play an essential role in sharing our feelings and making us love each other. They are the token of trust, life, and emotions. They are an expression of love and caring.</p>
			<a href="{{url('/about-us')}}" class="read-more" title="Read More">Read More</a>
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
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/"><img src="{{asset('massengers/img/blog01.png')}}"/></a>
					<br/>
					<h5>Care for crispy honey cookies ?</h5>
					<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/" class="blog-btn" title="Read More">Read More</a>
	            </div>
	            <div class="item">
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/"><img src="{{asset('massengers/img/blog02.png')}}"/></a>
					<br/>
					<h5>Care for crispy honey cookies ?</h5>
					<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/" class="blog-btn" title="Read More">Read More</a>
	            </div>
	            <div class="item">
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/"><img src="{{asset('massengers/img/blog03.png')}}"/></a>
					<br/>
					<h5>Care for crispy honey cookies ?</h5>
					<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/" class="blog-btn" title="Read More">Read More</a>
	            </div>
	            <div class="item">
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/"><img src="{{asset('massengers/img/blog01.png')}}"/></a>
					<br/>
					<h5>Care for crispy honey cookies ?</h5>
					<h6>Combine ingredients to form a soft dough. Cut/form into desired shape or drop on greased cookie sheet 2 inches apart.</h6>
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies" class="blog-btn" title="Read More">Read More</a>
	            </div>
	            <div class="item">
					<a href="http://blog.massengers.com/2017/08/18/care-for-crispy-honey-cookies/"><img src="{{asset('massengers/img/blog02.png')}}"/></a>
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
						<h4>Choosing Massengers was the among the best decisions I have made so far. Their commitment to delivering the product in less than 3 hours is just amazing. Always choose them!</h4>
						<h4 class="center">Abhilasha Singh</h4>
					</blockquote>
				</div>

				<div class="item">
					<blockquote>
						<h4>I was about to lose my love but then Massengers came to the rescue. with no idea what to do, how to do and when to do, they got it all done for me in a jiffy.</h4>
						<h4 class="center">Akash Malhotra</h4>
					</blockquote>
				</div>

				<div class="item">
					<blockquote>
						<h4>When I first heard of them, I had less trust but when I received a delivery from them ordered by my husband, I was completely astonished. Now, I can’t wait to surprise my husband on his birthday. Yayy!</h4>
						<h4 class="center">Shefali Tandon</h4>
					</blockquote>
				</div>

				<div class="item">
					<blockquote>
						<h4>The support team of Massengers is really the saviors of the day. When I had thought that I won’t be able to have my husband gifted those little and beautiful carnations, their support team made it's sure! Thank you Massengers!</h4>
						<h4 class="center">Akansha Mittal</h4>
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
		<h6>“The sharing of perfect gifts is what makes the everlasting moments”</h6>
		<p>We all celebrate but without the presence of perfect gifts, the making of special moments isn’t possible. These special gifts are just the splendid form of simplicity such as the refreshing flowers or a freshly prepared decorated cake. To help you create those moments and help you cherish them for your entire life, a young and refreshing happening took place in 2016, the year when Massengers.com was born. A one stop shop for all kind of flowers, cards, hand written letters and many such gifts, this venture is a next level entry in the floral and bakery industry. Making the <a href="{{url('/category/all-flowers')}}
" title="Online Flower Delivery">Online Flower Delivery</a> and cakes possible on the same day or on the day of your choice is what this company is all about.</p> 
            <p>The company only aims at the creation of cherish-able moments for its customers. From the night when the company’s founder delivered its first order till now, they have not just delivered the gifts but smiles to their customers. Today the service of sending <span class="bold">flower bouquet and cake delivery online</span> by Massengers.com has started to reach the extreme heights of success. The reach has spread to five major cities of the country viz, Gurgaon, Faridabad, Ghaziabad, Delhi and Noida within a year. Along the increasing reach, the customer satisfaction is also moving high.
            </p>
            <h6>Make any auspicious occasion memorable with our deliverables -</h6>
            <p>Likewise your life is incomplete without a life partner, occasions happen to be incomplete without gifts. Not from today but from the beginning of times, it has been into our celebrations that we <a href="{{url('/category/cakes')}}" title="Send Cakes Online">Send Cake Online</a> to our near and dear ones with special gifts. Now that we have conquered so much with technology, we have made ourselves very busy but it hasn’t kept us away from gifting our people. Therefore, to make sure and to ensure your important time isn’t wasted, <a href="{{url('/category/cakes')}}" title="Send Cakes Online">Send cake online from Massengers</a>. As they are offering an exclusive pleasure of seamless opportunity of purchasing many memorable gifts for every occasion such as Raksha Bandhan, Holi, Diwali, Janmashtami, Ganesh Chaturthi, Bhai Dooj and many others. Also, you can get your wife an extravagant gift on the anniversary or your children on their birthdays. With a doorstep delivery option on the go, you can avail multiple options such as same day delivery options or the day of your choice. Because gifting your people don't wait for time.</p>
            <p>
                The <span class="bold">online gifting store of Massengers.com</span> has stored every gift item for every kind of relation and occasion and the options aren’t just limited but limitless. From beautiful flower bouquet to exotic chocolates, unique personalized gifts to special gift hampers, soft toys to amazing indoor plants and a lot more other gifts, you can always remain expressible. All the gifts rendered here come with amazing quality, variety and price. Therefore, with our <a href="{{url('/category/cake-bouquet')}}">cake and Flower Delivery online</a> purchase options never miss an opportunity to surprise your family members, friends, relatives and other loved ones.
            </p>
            <h6>Same Day Flower Delivery – now in 3 Hours or even less!</h6>
            <p>With the change of time, we haven’t just grown more creative but also fast and that’s what you will find here at the <span class="bold">online shop of Massengers.com</span>. With every passing second, we have made the floral arrangements &amp; gifts more creative making it possible for the emotions to pass without any hustle. The word “wow” is what we aim at to be heard from our customers when we <a href="{{url('/category/all-flowers')}}">Send Flower from our Online store</a>. To make that happen, we always believe in delivering smiles with an extra effort making our deliveries special. With a lightning delivery speed, we have reduced our same day delivery time to <span class="bold">3 hours</span> for the flowers and the flower baskets. This is not just the shortest delivery possible time but a representation of efforts where we aim at delivering fresh flowers at any time of the day. Every time pushing our deliveries to ASAP, our commitment remains towards rendering the best quality gifts. Therefore, whenever you order a <span class="bold">simple bouquet of flowers or a yummy cake</span>, it always gets delivered in the state and condition. Our understanding to preserve the surprise element and emotional connection, our products are delivered with extreme care. Hence, every time you are trying to get anything delivered in Delhi or cities around it, our <span class="bold">online flower delivery services</span> comes as the ideal choice as well as the most preferred one. With our so much great expansion in such a less time, we stand as a difference from any other flower or cake delivery service that actually rely upon third parties for their deliveries.</p>
            <p>The company has now tremendously built a huge network and has become <span class="bold">India’s No 1 Massenger of Love</span>. The online presence of the company has opened the gates for offline stores which are all set to open soon. The choices of the people from the cities are speaking the kind of quality for flowers and cakes served by us. Targeting the minimum possible time for delivery, the company has remained successful in delivering the gift items in <span class="bold">less than 4 hours</span> which is itself a milestone in all the floral and cake industry. In spite of cutting down the competition, Massegeres.com is focusing on a long term relationship with the customer because moments are not just a one-time affair. This amazing prospect of <a href="{{url('/category/all-flowers')}}">Buying Flowers online</a> has made us stand out in the whole industry. The minute by minute increasing numbers of customers, we are rapidly becoming the most trusted brand of the time and wi th our solo motto of rendering customer satisfaction, are becoming an important part of everyone’s life experiences.</p>
            <h6>Expert’s suggestion for every choice –</h6>
            <p>We have incorporated as well as upgraded the meaning of expert suggestion by filtering out the best picks for you on our website. Our website has got everything structured and filtered for you. Whatever be the occasion is, we have got it all covered. After all, when it comes to expressing, flowers and cakes say a lot.</p>
            <h6>Difference is when you get expert florists to create your perfect Flower Bouquets</h6>
            <p>
                Everyone wants to gift their closed ones with some of the unique and best flower bouquets but in order to make those gifting moments special, it is of utmost importance that your bouquets are created by the experts. To make things more memorable, the presence of flower isn’t enough, you also need expert’s selection and advice. Hence, a wide collection of flowers and deliverable cakes is what our online store has. With respect to what occasion you are looking at, you can actually shop for the gifts which are based on our expert’s selection, choice, and suggestions. The variety of flowers comes extended with a large collection of <a href="javascript:;">tulips</a>,<a href="{{url('/category/roses')}}">roses</a>, <a href="{{url('/category/carnations')}}">carnations</a>, <a href="javascript:;">orchids</a>, <a href="javascript:;">chrysanthemums</a>, <a href="javascript:;">sunflowers</a> and a lot more. Also, it comes with a promise that all the ordered items will be received by your people in the perfect state. To gift your unmatched relations with unmatched beauty and fragrance of flowers, our efforts go no less and make things happen in the desired time.
            </p>
            <p>
                Apart from such seamless efforts, our expert's stunning floral arrangement is always present while you are on the hunt for those special rose to gift your partner. Making these scintillating flowers available in multiple varieties, colors and arrangements are what make us extra creative.
            </p>
            <h6>Fresh cut flowers for every special time</h6>
            <p>Whenever we talk about the flowers, Roses is what most of us think. A complete image of a floral arrangement consisting of the same is what comes in our mind. Therefore, at <a href="#">Massengers.com</a> <a href="#">roses</a> are the top selling fresh cut flowers and also because of their sheer popularity. But that’s not the ending; we have extended our delivering capabilities to a wide variety of cut flowers, <a href="{{url('/category/lilies')}}">Lilies (the second most popular flower)</a>, <a href="{{url('/category/orchids')}}">Orchids</a>, <a href="{{url('/category/carnations')}}">Carnations</a>, <a href="javascript:;">Daisies</a> <a href="javascript:;">Gerberas</a> and <a href="javascript:;">other seasonal cut flowers</a>.</p>
            <p>
                Also, it comes at first priority for us that all our deliveries get delivered as per the form and design decided by the customers. With cut flowers in great forms and designs that include flower arrangements, bouquets &amp; bunch, we also make them available in various wrappings covering all kind of cello &amp; colorful paper wrappings. To make our surrounding and our customers more eco – friendly, we discourage the use of cello wrapping. On the other hand, we encourage basket arrangements, vase arrangements, potted or boxed arrangements. Also, these arrangements can be chosen from a wide variety of colors &amp; designs as per the varied requirements of our customers. So, don’t wait anymore and <span class="bold">Send Flower bouquet from Massengers</span> now.
            </p>
            <h6>Send more than flowers – a compiled hotspot for all your gifting demands</h6>
            <p>The company has already upgraded itself by adding more in all its gifting options. Now, you can have a <span class="bold">customized gift collection</span> sent to your loved ones. This is the dominating factor of <a href="{{url('/')}}">Massengers</a> and the industry shall feel this dominance very soon. Going beyond just being a florist, the company is all set to become the prime delivery of online cake. For special occasions like <span class="bold">Diwali</span>, <span class="bold">Bhai Dooj</span>, <span class="bold">Raksha Bandhan</span>, <span class="bold">Valentine gifts</span>, <span class="bold">Mother's Day</span>, the company has started to think beyond floral gifting needs. All these deliveries are the coupled with emotions and feelings which get delivered to loved ones in the best-packed form. Also, it comes to our primary understanding that we <span class="bold">send flower bouquet on same day</span> with on – time deliveryof these gifts to make these moments is a must. Therefore, no effort is left from making this on -time delivery possible. Custom delivery services like midnight delivery, fixed time delivery apart from the same day delivery are also provided by us for all occasions.</p>
	</div>
</div>


<!-- to here -->

@endsection