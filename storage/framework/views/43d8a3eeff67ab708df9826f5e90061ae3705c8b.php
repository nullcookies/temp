<html>
<head>
<title>Manifest</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<style>
.table-main,.table-item{
	width:100%;
	margin:0 auto;
	font-family: 'Open Sans', sans-serif;
}
.table-main{
	padding: 20px 0;
}
.table-main tr td{
	text-align: center;
	font-weight: bold;
	font-size: 14px;
}
.table-item{
	border-top:2px solid #000;
	border-bottom:1px solid #000;
	border-spacing: 0px;
	font-size:10px;
}
.table-item thead tr{
	background-color: #ccc;
}
.table-item thead tr th{
	border-right: 1px solid #000;
}
.table-item thead tr th:nth-last-child(1){
	border-right: 0px;
}
.table-item tr th{
	padding: 10px;
}
.table-item tr td{
	text-align:center;
	text-transform: uppercase;
}
.table-item tbody tr td{
	padding: 10px 0;
	border-right: 1px solid #000;
	border-bottom: 1px solid #000;
}
.table-item tbody tr td:nth-last-child(1){
	border-right:0px;
}
.table-item tbody tr:nth-last-child(1){
	border-bottom: 0px;
}
button{
	background-color:#228B22;
	border:none;
	padding:5px;
	float:right;
	cursor:pointer;
	color:#fff;
}

@media  print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>
</head>
<body>
<button class="no-print" onclick="myFunction()">Print this page</button>

<script>
function myFunction() {
    window.print();
}
</script>

<table class="table-main">
	<tbody>
		<tr>
			<td style="text-align: left;"><?php echo e($website_name); ?> (Merchant ID : <?php echo e(Auth::user()->id); ?>)</td>
			<td>BLUE DART Pickup List</td>
			<td style="text-align: right;">Print Date: <?php echo e($date); ?> hours</td>
		</tr>
	</tbody>
</table>
<table class="table-item">
	<thead>
		<tr>
			<th>S.No.</th>
			<th>Manifest ID</th>
			<th>Shipment ID</th>
			<th>Order ID</th>
			<th>Item Name</th>
			<th>Qty</th>
			<th>Consignee Pincode</th>
			<th>Phone No</th>
			<th>AWB</th>
			<th>State Forms</th>
		</tr>
	</thead>
	<tbody>
	    <?php $sn = 1; ?>
		<?php foreach($orders as $order): ?>

			<?php foreach($order->products as $product): ?>
			    
				<tr>
					<td><?php echo e($sn); ?></td>
					<td><?php echo e($order->manifestid); ?></td>
					<td>--</td>
					<td><?php echo e($order->id); ?></td>
					<td style="max-width: 300px;"><?php echo e(substr($product->product_name,0,50)); ?></td>
					<td><?php echo e($product->quantity); ?></td>
					<td><?php echo e($order->shippingPostCode); ?></td>
					<td><?php echo e($order->shippingPhone); ?></td>
					<td><?php echo e($order->awb_number); ?></td>
					<td>--</td>
				</tr>
				<?php $sn++; ?>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</tbody>
</table>
<table class="table-main">
	<tbody>
		<tr>
			<td style="text-align: left;font-size:12px;">Merchant Signature:</td>
			<td style="text-align: left;font-size:12px;">Courier Signature:</td>
			<td style="text-align: right;font-size:12px;">Total Shipments: <?php echo e(count($orders)); ?> orders</td>
		</tr>
	</tbody>
</table>
<table class="table-main" style="padding:0px;">
	<tbody>
		<tr>
			<td colspan="1" style="text-align: left;font-size:12px;">Merchant SPOC Name:</td>
			<td colspan="2" style="text-align: left;font-size:12px;">Courier SPOC Name:</td>
		</tr>
	</tbody>
</table>
</body>
</html>