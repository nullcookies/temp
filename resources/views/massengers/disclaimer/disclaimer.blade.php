@extends('massengers/layout/layout')

@section('content')
	
<div class="container-fluid pd-30">
	<div class="container">
		<ol class="breadcrumb ms-breadcrumb">
		  <li class="breadcrumb-item"><a href="index.html">Home</a></li>
		  <li class="breadcrumb-item active">Disclaimer</li>
		</ol>
	</div>
</div>
<div class="container-fluid pdb-50 hidden-xs">
	<div class="container cnt-80">
		<ul class="nav nav-tabs my-tabs">
			<li class="active"><a data-toggle="tab" href="#general">General Disclaimer</a></li>
			<li><a data-toggle="tab" href="#shopping">Shopping &amp; Delivery Disclaimer</a></li>
			<li><a data-toggle="tab" href="#valentine">Valentine's Day Disclaimer</a></li>
		</ul>

		<div class="tab-content tab-content2">
			<div id="general" class="tab-pane fade in active">
				<!--<p>Dear Customer</p>
				<p>Your order is valuable to us. We would like you to understand and appreciate how much we care for your orders. Please go through the disclaimers and stay informed.</p>
				<p>General Disclaimer</p>
				<p>Massengers retains the right to refuse any order unconditionally.</p>
				<p>All claims are subject to the jurisdiction of Court at Ghaziabad UP, India, only.</p>
				<p>If Massengers is unable to deliver your order, then complete refund will be made. We shall not be liable for any other charges, loss of profits, emotional stress or any other liability etc. caused due to non-delivery.</p>-->
				<p>Dear Customer<br/><br/>
				Your order is valuable to us. We would like you to understand and appreciate how much we care for your orders. Please go through the disclaimers and stay informed.<br/><br/>
				General Disclaimer<br/><br/>
				Massengers retains the right to refuse any order unconditionally.<br/><br/>
				All claims are subject to the jurisdiction of Court at Ghaziabad UP, India, only.<br/><br/>
				If Massengers is unable to deliver your order, then complete refund will be made. We shall not be liable for any other charges, loss of profits, emotional stress or any other liability etc. caused due to non-delivery.</p>
			</div>
			<div id="shopping" class="tab-pane fade">
				<p class="lh-24">The prices shown may change without prior notice due to Valentine’s rush. Pre-book your orders to enjoy attractive rates. In order to help service your orders in the best possible way, we request you to provide the correct address and contact details (phone number and email address) of the recipient.<br/><br/>
				If you wish we do not contact the recipient, please call our Customer Care at +91 8750662299 and notify them about the same.<br/><br/>
				Due to a huge rush in orders during Valentine, the delivery status confirmation by email and SMS may arrive a little later. Our team works very hard to let you know that your order is delivered – as soon as we can.<br/><br/>
				Our Customer Care team is on toes to ensure that you have a great experience with us. During the Valentine week, they may take a little more time to respond. Kindly be patient. If you have dropped us an email, we ensure it is being reviewed and will be positively answered back.<br/><br/>
				Please be aware of our Substitution Policy.<br/><br/>
				Do visit our&nbsp;<a href="termsconditions.html">Terms and Conditions</a>&nbsp;section to understand our services better.</p>
			</div>
			<div id="valentine" class="tab-pane fade">
				<h5>Valentine’s Special Standard Delivery Service</h5>
				<p class="lh-24">While we make best efforts to ensure we deliver your orders as soon as possible, due to huge rush during the Valentine week, we do not offer any fixed time guarantee. Orders are processed on first come first serve basis, delivery areas and other local conditions.</p>
				<h5>Valentine’s Special Midnight Delivery Service</h5>
				<p class="lh-24">For Midnight Delivery orders, please note that the order will be delivered between 11 p.m. to 1 a.m.</p>
				<h5>Valentine’s Special Courier Services</h5>
				<p class="lh-24">For products that are shipped using the services of our courier partners, we are unable to guarantee an exact date/time of delivery during the peak season.</p>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid pdb-50 hidden-sm hidden-lg hidden-md">
	<div class="container cnt-80">
        <div class="panel-group" id="accordion">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">General Disclaimer</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse in">
					<div class="panel-body">
    					<p class="lh-24">While we make best efforts to ensure we deliver your orders as soon as possible, due to huge rush during the Valentine week, we do not offer any fixed time guarantee. Orders are processed on first come first serve basis, delivery areas and other local conditions.</p>
        				<h5>Valentine’s Special Midnight Delivery Service</h5>
        				<p class="lh-24">For Midnight Delivery orders, please note that the order will be delivered between 11 p.m. to 1 a.m.</p>
        				<h5>Valentine’s Special Courier Services</h5>
        				<p class="lh-24">For products that are shipped using the services of our courier partners, we are unable to guarantee an exact date/time of delivery during the peak season.</p>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Shopping &amp; Delivery Disclaimer</a>
					</h4>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse">
					<div class="panel-body">
						<p class="lh-24">The prices shown may change without prior notice due to Valentine’s rush. Pre-book your orders to enjoy attractive rates. In order to help service your orders in the best possible way, we request you to provide the correct address and contact details (phone number and email address) of the recipient.<br/><br/>
        				If you wish we do not contact the recipient, please call our Customer Care at +91 8750662299 and notify them about the same.<br/><br/>
        				Due to a huge rush in orders during Valentine, the delivery status confirmation by email and SMS may arrive a little later. Our team works very hard to let you know that your order is delivered – as soon as we can.<br/><br/>
        				Our Customer Care team is on toes to ensure that you have a great experience with us. During the Valentine week, they may take a little more time to respond. Kindly be patient. If you have dropped us an email, we ensure it is being reviewed and will be positively answered back.<br/><br/>
        				Please be aware of our Substitution Policy.<br/><br/>
        				Do visit our&nbsp;<a href="termsconditions.html">Terms and Conditions</a>&nbsp;section to understand our services better.</p>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Valentine's Day Disclaimer</a>
					</h4>
				</div>
				<div id="collapseThree" class="panel-collapse collapse">
					<div class="panel-body">
						<h5>Valentine’s Special Standard Delivery Service</h5>
        				<p class="lh-24">While we make best efforts to ensure we deliver your orders as soon as possible, due to huge rush during the Valentine week, we do not offer any fixed time guarantee. Orders are processed on first come first serve basis, delivery areas and other local conditions.</p>
        				<h5>Valentine’s Special Midnight Delivery Service</h5>
        				<p class="lh-24">For Midnight Delivery orders, please note that the order will be delivered between 11 p.m. to 1 a.m.</p>
        				<h5>Valentine’s Special Courier Services</h5>
        				<p class="lh-24">For products that are shipped using the services of our courier partners, we are unable to guarantee an exact date/time of delivery during the peak season.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
@endsection