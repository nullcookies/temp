
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	.main{
		width:300px;
        float: left;
        font-family: 'Roboto', sans-serif;
	}
    .container {
        max-width: 300px;
        width: 100%;
    }
    .topback {
        background: #CCC;
        float: left;
    }
    .forcenter {
        text-align: center;
    }
    .sizeheading {
        font-size: 14px;
    }
    .sizeheadingnew {
        font-size: 10px;
    }
    .contentsize {
        font-size: 14px;
    }
    .colorheidding {
        color: #30F;
    }
    .forbold {
        font-weight: 900;
    }
    .fontweight {
        font-weight: bolder;
    }
    .topading {
        padding-top: 20px;
    }
    .forleft {
        text-align: left;
    }
    .forright {
        text-align: right;
    }
    .bothsidepadding tr {
        padding-let: 10px;
        padding-right: 10px;
    }
    .paddingleft {
        padding-left: 10px;
    }
    .paddingright {
        padding-right: 32px;
    }
    .paddboth {
        padding-left: 10px;
        padding-right: 10px;
    }
    .floatrt {
        float: right;
    }
    .borderbottom {
        border-bottom: solid 1px;
    }
    .borderright {
        border-right: 2px solid;
    }
    .borderblack {
        border: solid 1px #000;
    }
    .main1 {
        width: 30%;
        float: left;
    }
    .main2 {
        width: 70%;
        float: right;
    }
    .tbborder {
        border-top: 1px solid;
		border-bottom: 1px solid;
    }
    .bordeb1 {
        border-bottom: 1px solid;
    }
    .rightlectricbord {
        border-right: solid 1px;
    }
    .borboth1 {
        border: 1px solid #000;
    }
    .borboth {
        border-right: 1px solid #000;
        border-bottom: 1px solid #000;
    }
    .blackbotomborer {
        border-bottom: 1px solid #000;
    }
    .rightblack {
        border-right: 1px solid #000;
    }
    .topblack {
        border-top: solid 1px #000;
    }
    .lefttopbottom {
        border-left: solid 1px #000;
        border-top: solid 1px #000;
        border-bottom: 1px solid #000;
    }
    .leftrighttop {
        border-left: solid 1px #000;
        border-right: 1px solid #000;
        border-top: solid 1px #000;
    }
    .rightleftbottom {
        border-left: solid 1px #000;
        border-right: 1px solid #000;
        border-bottom: 1px solid #000;
    }
    .one {
        width: 50%;
        float: left;
        text-align: left;
    }
    .one1 {
        width: 50%;
        float: right;
        text-align: left;
    }
    .space {
        margin-left: 5px;
    }
    .margintopnote {
        margin-top: 15px;
    }
    .margin-bottom {
        margin-bottom: 30px;
    }
    .leftright {
        border-left: solid 1px #000;
        border-right: 1px solid #000;
    }
    p {
        font-size: 10px;
        margin: 5px 0 0;
    }
    h6 {
        font-weight: normal;
        margin: 0 0 10px;
    }
    .sizeheadingnew > p {
        font-weight: bold;
        margin-top: 0;
        text-decoration: underline;
    }
	.sizeheadingnew-14 {
		font-size: 14px;
	}
	.borboth:nth-child(5),.rightblack:nth-child(5){
		border-right:none;
	}
	.detail{
		font-family: 'Roboto', sans-serif;
	}
</style>
</head>
<body>
<div class="container">
	<div class="main">
		<table style="border-bottom:2px solid;" class="main">
			<tbody>
				<tr>
					<center>
						<th style="text-align: center;font-family: 'Raleway', sans-serif;" class="main forcenter sizeheading ">Massengers.com<br/>
						<img src="http://kibakibi.com/barcode/'{{$orders->awb_number}}" width="100"><br/>{{$orders->awb_number}}
						</th>
					</center>
				</tr>
			</tbody>
		</table>
		<table cellspacing="0" cellpadding="2" class=" main" style="margin-top:10px; padding-bottom:10px;border-spacing: 0px;border-bottom:2px solid;">
        	<tbody>
                <tr>
                    <th colspan="4" class=" forcenter forbold sizeheading " style="text-align:left;">
	                <h6 class="forbold">Delivery Address</h6>
	                <p class="detail">{{ucwords(strtolower($orders->shippingName))}}</p>
	                <p class="detail">{!! $orders->shippingAddress !!}</p>
	                <p class="detail">{{$orders->shippingCity}}, {{$orders->shippingState}}</p>
	                <p class="detail">Pin - {{$orders->shippingPostCode}}</p>
	                <p class="detail">Mob. {{$orders->shippingPhone}}</p>
	                </th>
	                <!--<td colspan="1" style="text-align: center; border:2px solid" class="forright  sizeheading">Prepaid
	                    <!-- <span><i class="fa fa-inr"></i> 800</span> 
	                </td>-->
					<td colspan="1" style="text-align: center; border:2px solid; font-weight:bold;" class="forright  sizeheading">{{$orders->paymentType == 'cod' ? 'Cash On Delivery' : 'Prepaid' }}<br/>
					@if($orders->paymentType == 'cod')
                        <p>Please Collect</p>
    					<p>Rs. {{$orders->orderAmount + $orders->shippingCharge}}</p>
	                @endif
	                </td>
                </tr>
            </tbody>
        </table>
        <table cellspacing="0" cellpadding="2" class=" main" style="margin-top:10px;border-spacing: 0px;font-size:10px;">
            <thead>
                <tr>
                    <th style="text-align:left;padding: 5px 0;border-bottom: 2px dashed #000;">Product</th>
                    <th style="padding: 5px 10px;border-bottom: 2px dashed #000;">Qty</th>
					<th style="padding: 5px;border-bottom: 2px dashed #000;">Unit Price</th>
					<th style="padding: 5px 10px;border-bottom: 2px dashed #000;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $sn = 1; ?>
                    @foreach($orders->products as $product) 
                        <tr style="border-bottom:2px solid;">
        					<td style="padding:5px 0;">{!! ucwords(strtolower($product->product_name)) !!}</td>
        					<td style="vertical-align:top;text-align:center;padding:5px;">{{$product->quantity}}</td>
        					<td style="vertical-align:top;text-align:center;padding:5px 10px;">Rs.{{$product->selling_price}}</td>
        					<td style="vertical-align:top;text-align:center;padding:5px 10px;">Rs.{{$product->selling_price * $product->quantity}}</td>
        				</tr>
                    @endforeach
				
            </tbody>
			<tfoot>
				<tr>
					<td colspan="2"></td>
					<td style="vertical-align:top;text-align:center;padding:5px 10px;font-weight:bold;">Subtotal</td>
					<td style="vertical-align:top;text-align:right;padding:5px 10px;font-weight:bold;">Rs.{{$orders->orderAmount}}</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td style="vertical-align:top;text-align:center;padding:5px 10px;font-weight:bold;border-bottom: 2px solid #000;">Shipping Fee</td>
					<td style="vertical-align:top;text-align:right;padding:5px 10px;font-weight:bold;border-bottom: 2px solid #000;">Rs.{{$orders->shippingCharge}}</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td style="vertical-align:top;text-align:center;padding:5px 10px;font-weight:bold;">Total Cost</td>
					<td style="vertical-align:top;text-align:right;padding:5px 10px;font-weight:bold;">Rs.{{$orders->orderAmount + $orders->shippingCharge}}</td>
				</tr>
			</tfoot>
        </table>
		<table cellspacing="0" cellpadding="2" class=" main" style="margin-top:10px;margin-bottom:10px; padding-bottom:10px;border-spacing: 0px;border-bottom:1px dashed;">
        	<tbody>
                <tr>
                    <th colspan="4" class=" forcenter forbold sizeheading " style="text-align:left;">
						<h6 class="forbold">Return Address</h6>
						<p class="detail">B-12, First Floor,</p>
						<p class="detail">Parasvanath Majestic Arcade,</p>
						<p class="detail">Ghaziabad,</p>
						<p class="detail">UP - 201014</p>
						<p class="detail">Phone : 91-7838576144</p>
	                </th>
					<!--<td colspan="1" style="text-align: center;" class="forright  sizeheading">-->
						<th colspan="1" style="text-align: center;margin-bottom:10px;font-size:12px;" class="forright  sizeheading">Order no.<br/>
							<img src="http://kibakibi.com/barcode/'{{$orders->id}}" width="100"><br/><p>{{$orders->id}}</p>
							<p style="font-size:12px;">IF UNDELIVERED, RETURN TO SHIPPER</p>
						</th>
	                <!--</td>-->
                </tr>
            </tbody>
        </table>
		<table cellspacing="0" cellpadding="2" class=" main" style="margin-top:10px; padding-bottom:10px;padding-top:10px;border-spacing: 0px;">
        	<tbody>
				<p style="font-size:8px; font-weight:bold;padding-top:10px;">It is hereby declared that the Goods accompanying this Sale Invoice has been ordered for personal use by the
Purchaser.Hence, no Road Permit is mandatory as per Provisions to Section 50 (1) of the UPVAT Act.</p>
			</tbody>
        </table>
	</div>
</div>
</body>
</html>