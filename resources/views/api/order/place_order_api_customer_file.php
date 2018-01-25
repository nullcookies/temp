<?php
/*
	this script will given to customer, which help to place order.
	Also return some order related data back to user.
*/
$tocken 	=	"your coken"; // Enter the given token

$url 		=	"localhost:8080/api/order_api";   // replace with given url

$parametersArray 	=	[ //  below all the parameters are manditory.
	'access_token'				=> $tocken,
	'product_name' 				=> 'Enter Product Name',
	'varient_name' 				=> 'varient string values seperated by comma',
	'customer_name' 			=> 'Enter Customer Name',
	'customer_phone'			=> 'Enter Customer Mobile Number',
	'customer_email'    		=> 'Enter Customer Email',
	'customer_street_address' 	=> 'Enter Customer Address',
	'customer_city'				=> 'Enter Customer City',
	'customer_pincode'			=> 'Enter Customer Pincode',
	'customer_state'			=> 'Enter Customer State',
	'shipping_name'				=> 'Enter Shipping Name',
	'shipping_email'			=> 'tarun.dhiman.india@gmail.com',
	'shipping_phone'			=>	'shippingPhone',
	'shipping_street_address'	=>	'shippingAddress',
	'shipping_city'				=>	'shippingCity',
	'shipping_state'			=>	'shippingState',
	'shipping_pincode'			=>	'shippingPostCode',
	'api_product_id'			=>	'productId',
	'quantity'					=>	'quantity',
	'order_amount'				=>	'orderAmount',
	'product_amount'			=>	'productAmount',
	'payment_type'				=>	'paymentType',
	'txnid'						=>	'txnId',
	'weight'					=>	'product_weight',
] ;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parametersArray));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);

if(!$server_output){
	echo json_encode(array('error' => 1, 'message' => 'check your code there are some problems', 'data' => []));
}

echo($server_output);


?>