<html>
<html>
<title>Invoice</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<head>
<style>
body{
	padding:10px;
	margin:0;
	font-family: 'Open Sans', sans-serif;
	font-size:10px;
}

.m-5{
	margin:5px 0;
}
.m0{
	margin:0;
}
.table{
	margin:15px 0;
	width:100%;
	font-size:10px;
}
.intable{
	padding:10px 0;
	border-top:1px solid #000;
	border-bottom:1px solid #000;
}
.intable tr{
	text-align:left;
}
.caps{
	text-transform:uppercase;
}
.caps p{
	margin:0;
}
.vtop{
	vertical-align:text-top;
}
.left{
	text-align:left;
}
.bottom{
	width:100%;
}
.table-head{
	border-bottom:1px solid #000;
}
.signbox{
	border:1px solid #000;
	margin:20px;
	width:60%;
	margin:0 auto;
	height:100px;
}
.regadd{
	padding:15px 0;
	border-top:1px solid #000;
	border-bottom:1px solid #000;
}
.regadd h4{
	margin:0;
	font-weight:normal;
}
.table-total{
	border-top:1px solid #000;
	border-bottom:1px solid #000;
}
.bt-0{
	border-top:0;
}
.logo-image{
	position:absolute;
	margin-top:-10px;
}
</style>
</head>
<body>
<div class="header">
<p class="m-5">Page 1 of 1, I-1/1</p>
<p class="m-5">Invoice for S/<?php echo e($user->id); ?>/<?php echo e($order->id); ?> <?php echo e(date('D d-M-Y')); ?></p>
<h3 class="m-5">Retail/TaxInvoice/Cash Memorandum</h3>
<br/>
<h3 class="m-5">Sold By</h3>
<p class="m-5"><?php echo e($user->subdomain); ?>.techturtle.in</p>
<!-- <p class="m-5">Prathamesh Complex, Building No. H, Opp. Vatika Restaurant</p> -->
<p class="m-5"><?php echo e($user->city); ?></p>
<p class="m-5"><?php echo e($user->state); ?>, India</p>
<!-- <p class="m-5">Maharashtra, India</p> -->
<br/><br/>
<p class="m-5">VAT/TIN Number: <?php echo e(DB::table('user_business_detail')->where('user_id', $user->id)->select('tin')->first() ? DB::table('user_business_detail')->where('user_id', $user->id)->select('tin')->first()->tin : ''); ?></p>
<p class="m-5">CST Number: --</p>
<!-- <p class="m-5">Invoice Number: MH-BOM1-138666511-82310</p> -->
</div>
<table class="table intable">
	<tbody>
		<tr>
			<th>Billing Address</th>
			<th>Shipping Address</th>
		</tr>
		<tr>
			<td class="caps">
				<p><?php echo e($order->customerName); ?></p>
				<p><?php echo e($order->customerAddress); ?></p>
				<p><?php echo e($order->customerCity); ?>-<?php echo e($order->customerPostCode); ?></p>
				<p><?php echo e($order->customerState); ?></p>
			</td>
			<td class="caps">
				<p><?php echo e($order->shippingName); ?></p>
				<p><?php echo e($order->shippingEmail); ?></p>
				<p><?php echo e($order->shippingCity); ?>-<?php echo e($order->shippingPostCode); ?></p>
				<p><?php echo e($order->shippingPostCode); ?></p>
			</td>
		</tr>
		<tr>
			<td>Nature of Transaction: Sale</td>
		</tr>
		<tr>
			<th>Order ID: S/<?php echo e($user->id); ?>/<?php echo e($order->id); ?></th>
			<th>This is a computer generated invoice</th>
		</tr>
	</tbody>
</table>
<div class="table-head">
	<table class="table">
		<tbody>
			<tr class="caps">
				<td width="2.5%" style="text-align:left;">QTY</td>
				<td width="30%" style="text-align:left;">description</td>
				<td width="8%" style="text-align:left;">gross amount</td>
				<td width="8%" style="text-align:left;">discount</td>
				<td width="8%" style="text-align:left;">net amount<br/><span style="text-transform:lowercase;"> (tax inclusive)</span></td>
				<td width="8%" style="text-align:left;">tax type</td>
				<td width="8%" style="text-align:left;">tax rate</td>
				<td width="10%" style="text-align:left;">tax amount<br/><span style="text-transform:lowercase;"> (included in net)</span></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="table-body">
<table class="table">
	<tbody>	
	<?php foreach($order->products as $product): ?>
		<tr class="vtop">
			<td width="2.5%" style="text-align:left;">1</td>
			<th width="30%" style="text-align:left;"><?php echo e($product->product_name); ?></th>
			<td width="8%" style="text-align:left;">Rs. <?php echo e($order->orderAmount - ($order->orderAmount*15)/100); ?></td>
			<td width="8%" style="text-align:left;"></td>
			<td width="8%" style="text-align:left;">Rs. <?php echo e($order->orderAmount); ?></td>
			<td width="8%" style="text-align:left;">Service Tax</td>
			<td width="8%" style="text-align:left;">15%</td>
			<td width="10%" style="text-align:left;">Rs. <?php echo e(($order->orderAmount*15)/100); ?></td>
		</tr>
		<tr>
			<td width="2.5%" style="text-align:left;"></td>
			<td width="30%" style="text-align:left;">Shipping</td>
			<td>Rs. <?php echo e($order->shippingCharge - ($order->shippingCharge*15)/100); ?></td>
			<td></td>
			<td>Rs. <?php echo e($order->shippingCharge); ?></td>
			<td>Service Tax</td>
			<td>15%</td>
			<td>Rs. <?php echo e(($order->shippingCharge*15)/100); ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<div class="table-total">
	<table class="table">
		<tbody>	
			<tr class="caps left">
				<th colspan="2" width="32.5%"></th>
				<th width="8%" style="text-align:left;">total gross amount</th>
				<th width="8%" style="text-align:left;">total discount</th>
				<th width="8%" style="text-align:left;">final net amount</th>
				<th width="8%" style="text-align:left;">tax type</th>
				<th width="8%" style="text-align:left;">tax rate</th>
				<th width="10%" style="text-align:left;">tax amount</th>
			</tr>
		</tbody>
	</table>
</div>
<div class="table-total bt-0">
	<table class="table">
		<tbody>		
			<tr class="vtop">
				<td colspan="2" width="31.5%"></td>
				<td width="8%" style="text-align:left;">Rs. <?php echo e($order->orderAmount - ($order->orderAmount*15)/100 + $order->shippingCharge - ($order->shippingCharge*15)/100); ?></td>
				<td width="8%" style="text-align:left;"></td>
				<td width="8%" style="text-align:left;">Rs. <?php echo e($order->orderAmount + $order->shippingCharge); ?></td>
				<td width="8%" style="text-align:left;">Service Tax</td>
				<td width="8%" style="text-align:left;">15%</td>
				<td width="8%" style="text-align:left;">Rs. <?php echo e(($order->orderAmount*15)/100 + ($order->shippingCharge*15)/100); ?></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="bottom">
	<table class="table">
		<tbody>
			<tr>
				<td width="60%"><p>"I/We hereby certify that my/our registration certificate  under the Maharashtra Value Added Tax Act, 2002 is in force on the date on which the sale of the goods specified in this tax invoice is made by me/us and that the transaction of sale covered by this tax invoice has been effected by me/us and it shall be accounted for in the turnover of sales while filing of return  and the due tax, if any, payable on the sale has been paid or shall be paid"</p></td>
				<td>
					<h4 style="text-align:center;">For Techguru</h4>
					<div class="signbox"><img width="300" height="100" src="<?php echo e(strlen($user->signature) ? $user->signature : url('/no_image.png')); ?>"></div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="regadd">
	<h4>Registered Address for <?php echo e($user->subdomain); ?>.techturtle.in, <?php echo e($user->city); ?>, <?php echo e($user->state); ?>, India</h4>
</div>

<div class="bottom">
	<table class="table">
		<tbody>
			<tr>
				<td width="60%"><!-- <p>To return an item, visit http://www.amazon.in/returns<br/>For more information on your orders, visit http://www.amazon.in/my-account</p> --></td>
				<td>
					<h4 style="text-align:center;">Purchase made on <b><?php echo e($user->subdomain); ?>.techturtle.in</b><!-- <img src="http://media.corporate-ir.net/media_files/IROL/17/176060/img/logos/amazon_logo_RGB.jpg" class="logo-image" width="100">--></h4> 
					
				</td>
			</tr>
		</tbody>
	</table>
</div>
</body>
</html>