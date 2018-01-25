<?php 
$footerObj = new App\Http\Controllers\Front\Homepage\HomeController;
$result = $footerObj->commonpage();
$ft = $result['homesetting'];
$socialmedia = $result['socialmedia'];
$pages = $result['pages'];
 ?>
<!-- Footer -->
  <footer>
    
    <!-- <div class="footer-inner">
      <div class="container">
      
        <div class="row">
          <div class="col-sm-8 col-xs-12 col-lg-9">
            <div class="footer-column pull-left">
              <h4>QUICK LINKS</h4>
              <ul class="links">
                <li class="first"><a href="/blog/" title="{!! $ft->aboutus !!}">{!! $ft->aboutus !!}</a></li>
                <li><a href="#" title="{!! $ft->terms !!}">{!! $ft->terms !!}</a></li>
                <li><a href="#" title="{!! $ft->shiping !!}">{!! $ft->shiping !!}</a></li>
                <li><a href="#" title="{!! $ft->privacy !!}">{!! $ft->privacy !!}</a></li>
                <li><a href="#" title="{!! $ft->disclaimer !!}">{!! $ft->disclaimer !!}</a></li>
                <li class="last"><a href="#" title="{!! $ft->cancellation !!}">{!! $ft->cancellation !!}</a></li>
              </ul>
            </div>
            <div class="footer-column pull-left">
              <h4>Style Advisor</h4>
              <ul class="links">
                <li class="first"><a href="#" title="Your Account">Your Account</a></li>
                <li><a href="#" title="Information">Information</a></li>
                <li><a href="#" title="Addresses">Addresses</a></li>
                <li><a href="#" title="Addresses">Discount</a></li>
                <li><a href="#" title="Orders History">Orders History</a></li>
                <li class="last"><a href="#" title=" Additional Information"> Additional Information</a></li>
              </ul>
            </div>
            <div class="footer-column pull-left">
              <h4>Information</h4>
              <ul class="links">
                <li class="first"><a href="#" title="Site Map">Site Map</a></li>
                <li><a href="#" title="Search Terms">Search Terms</a></li>
                <li><a href="#" title="Advanced Search">Advanced Search</a></li>
                <li><a href="#" title="History">About Us</a></li>
                <li><a href="#" title="History">Contact Us</a></li>
                <li><a href="#" title="Suppliers">Suppliers</a></li>
              </ul>
            </div>
          </div>
          <div class="col-xs-12 col-lg-3 col-sm-4">
            <div class="footer-column-last">
              <div class="newsletter-wrap">
                <h4>Apps Coming Soon</h4>
                <div class="app-img"><img src="{{asset('images/android-app.png')}}" alt="android"></div>
                <div class="app-img"><img src="{{asset('images/ios-app.png')}}" alt="android"></div>
                <div class="app-img"><img src="{{asset('images/windows-btn.png')}}" alt="android"></div>
              </div>
              <div class="payment-accept">
                <div><img src="{{asset('images/payment-1.png')}}" alt="payment1"> <img src="{{url('images/payment-2.png')}}" alt="payment2"> <img src="{{url('images/payment-3.png')}}" alt="payment3"> <img src="{{url('images/payment-4.png')}}" alt="payment4"> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>-->
    <div class="footer-inner">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<h4>Support</h4>
					<ul> 
						<li style="margin:10px 0;"><a style="font-size:20px;margin:10px 0;" id="alt_phone" href="#" data-toggle="modal" data-target="#st_phone" data-whatever="{{ $ft->phone }}" data-datakey="phone"><i class="fa fa-phone"></i> +91-{{ $ft->phone }}</a></li>
						<li style="padding-bottom:10px;border-bottom:1px solid #f2d03b;"><a href="#" data-toggle="modal" data-target="#st_phone" data-whatever="{{ $ft->email }}" data-datakey="email"><i class="fa fa-envelope-o"></i> {{ $ft->email }}</a></li>
						<li style="margin:10px 0 0 0;"><a href="{{url('admin/socialmedia')}}"><h4>SOCIALIZE WITH US</h4></a>
							<ul class="social-links">
								@foreach($socialmedia as $social)
				                  <li><a href="{!! $social->link !!}" title="{{ $social->name}} "><i class="fa fa-{{$social->slug}}"></i></a></li>
				                @endforeach
								
							</ul>
						</li>
					</ul>
				</div>
				<div class="col-sm-4">
				    <h4>Quick Links</h4>
					<ul class="links">
					@foreach($pages as $page)
						<li class="first"><a href="{{ url('pages/'.$page->alias) }}" title="{{ $page->name }}"> {{ $page->name }}</a></li>
					@endforeach	

					</ul>
					
				</div>
				<div class="col-sm-4">
					<h4>Stay in touch</h4>
					<h4>Payments Accepted</h4>
					<div class="payment-accept">
						<div><img src="{{url('images/payment-1.png')}}" alt="payment1"> <img src="{{url('images/payment-2.png')}}" alt="payment2"> <img src="{{url('images/payment-3.png')}}" alt="payment3"> <img src="{{url('images/payment-4.png')}}" alt="payment4"> </div>
					</div>
				</div>
			</div>
        
          </div>
        </div>
        <div class="footer-bottom">
	<div class="container">
		<div class="row">
			<p style="text-align:center;color:#aaa;margin:0;">&copy; Copyright 2017 techturtle.in | All Rights Reserved</p>
		</div>
	</div>
</div>
    
    <!-- Brand Logo -->
    <?php /*?>
    <div class="brand-logo">
      <div class="container">
        <div class="slider-items-products">
          <div id="brand-logo-slider" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col6"> 
              
              <!-- Item -->
              <div class="item"> <a href="#"><img src="{{url('images/b-logo3.png')}}" alt="Image"> </a> </div>
              <!-- End Item --> 
              
              <!-- Item -->
              <div class="item"> <a href="#"><img src="{{url('images/b-logo1.png')}}" alt="Image"> </a> </div>
              <!-- End Item --> 
              
              <!-- Item -->
              <div class="item"> <a href="#"><img src="{{url('images/b-logo2.png')}}" alt="Image"> </a> </div>
              <!-- End Item --> 
              
              <!-- Item -->
              <div class="item"> <a href="#"><img src="{{url('images/b-logo4.png')}}" alt="Image"> </a> </div>
              <!-- End Item --> 
              
              <!-- Item -->
              <div class="item"> <a href="#"><img src="{{url('images/b-logo5.png')}}" alt="Image"> </a> </div>
              <!-- End Item --> 
              
              <!-- Item -->
              <div class="item"> <a href="#"><img src="{{url('images/b-logo6.png')}}" alt="Image"> </a> </div>
              <!-- End Item --> 
              
              <!-- Item -->
              <div class="item"> <a href="#"><img src="{{url('images/b-logo2.png')}}" alt="Image"> </a> </div>
              <!-- End Item --> 
              
              <!-- Item -->
              <div class="item"> <a href="#"><img src="{{url('images/b-logo4.png')}}" alt="Image"> </a> </div>
              <!-- End Item --> 
              
            </div>
          </div>
        </div>
      </div>
    </div>
	<?php */?>
    
  </footer>