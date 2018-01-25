@extends('massengers/layout/layout')

@section('content')
	
<div class="container-fluid pd-30 aboutuscrumb">
	<div class="container">
		<ol class="breadcrumb ms-breadcrumb">
		  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
		  <li class="breadcrumb-item active"><a>About Us</a></li>
		</ol>
	</div>
</div>
<div class="container-fluid pd-20">
	<div class="container">
		<div class="col-md-4">
			<img src="{{url('massengers/img/about-us.PNG')}}" class="img-responsive"/>
		</div>
		<div class="col-md-8 about-us">
			<h1>About Us</h1>
			<p>Gifts bring passions and sentiments. Gifts are connected with certain people or events and leaving behind strong impressions on the recipient's mind. It strengthens our recipient's memory by recollecting again and again, which contribute to this trend. Gifts play an essential role in sharing our feelings and making us love each other. They are the token of trust, life, and emotions. They are an expression of love and caring.</p>
			<p>We, Massengers.com, are well-renowned e-commerce gifting portal, which offers a huge variety of customized gifts online. We are one stop shop for different types of gifting requirements and are preferable by our customers because we offer quality gifting items at a cost effective rate.</p>
			<p>Our gifts are tenderly designed by keeping in mind the emotions of our customers. We categorized our gifts into occasions like Anniversary, Best Wishes, Wedding, Get Well Soon Birthdays, Same Day, etc. We have an outstanding variety of gifts for the whole Valentine week like Rose Day, Propose Day, Chocolate Day, Teddy Day, Promise Day, Hug Day, Kiss Day, and Valentine’s Day.</p>
			<br/>
			<a href="javascript:;" class="read-more2" title="Read More">Read More</a>
		</div>
	</div>
</div>
<div class="container-fluid pd-20">
	<div class="container meet-team">
		<h1>Meet our team</h1>
		<div class="row pd-20">
			<div class="team-box">
				<div class="col-md-3 col-sm-6 teamboximage">
    				<img src="{{asset('massengers/img/team1-1.jpg')}}" class="img-responsive center-block"/>
    				<br/>
    				<h3>Kendall Jenner</h3>
    				<p>Kendall Nicole Jenner is an American fashion model and television personality</p>
    			</div>
    			<div class="col-md-3 col-sm-6 teamboximage">
    				<img src="{{asset('massengers/img/team1-2.jpg')}}" class="img-responsive center-block"/>
    				<br/>
    				<h3>Kendall Jenner</h3>
    				<p>Kendall Nicole Jenner is an American fashion model and television personality</p>
    			</div>
    			<div class="col-md-3 col-sm-6 teamboximage">
    				<img src="{{asset('massengers/img/team1-3.jpg')}}" class="img-responsive center-block"/>
    				<br/>
    				<h3>Kendall Jenner</h3>
    				<p>Kendall Nicole Jenner is an American fashion model and television personality</p>
    			</div>
    			<div class="col-md-3 col-sm-6 teamboximage">
    				<img src="{{asset('massengers/img/team1-4.jpg')}}" class="img-responsive center-block"/>
    				<br/>
    				<h3>Kendall Jenner</h3>
    				<p>Kendall Nicole Jenner is an American fashion model and television personality</p>
    			</div>
			</div>
		</div>
	</div>
</div>

@endsection