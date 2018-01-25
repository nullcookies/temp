<?php
/*
	this script will given to customer, which help to place order.
	Also return some order related data back to user.
*/
$tocken 	=	"A123456"; // Enter the given token

$url 		=	"localhost:8080/api/return_api";   // replace with given url

$parametersArray 	=	[ //  below all the parameters are manditory.
	'access_token'			=> $tocken,
	'order_id' 				=> 1,
	'reason_of_return' 		=> 'reason of return',
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