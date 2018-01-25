<!DOCTYPE html>
<html>
<head>
	<title>Place order</title>
</head>
<body>
{!! Form::open(array('method' => 'post', 'action' => ['Api\ApiController@place_order'])) !!}
	<table>
		<tr>
			<td>access_token</td>
			<td><input type="text" value="A123456" name="access_token"></td>
		</tr>
		
		<tr>
			<td>customer_name</td>
			<td><input type="text" value="Tarun Dhiman" name="customer_name"></td>
		</tr>
		<tr>
			<td>customer_phone</td>
			<td><input type="text" value="9717403522" name="customer_phone"></td>
		</tr>
		<tr>
			<td>customer_email</td>
			<td><input type="text" value="tarun.dhiman.india@gmail.com" name="customer_email"></td>
		</tr>
		<tr>
			<td>customer_street_address</td>
			<td><input type="text" value="Rampuri 821/3" name="customer_street_address"></td>
		</tr>
		<tr>
			<td>customer_city</td>
			<td><input type="text" value="Muzaffarnagar" name="customer_city"></td>
		</tr>
		<tr>
			<td>customer_pincode</td>
			<td><input type="text" value="251001" name="customer_pincode"></td>
		</tr>
		<tr>
			<td>customer_state</td>
			<td><input type="text" value="Uttar Pardesh" name="customer_state"></td>
		</tr>
		<tr>
			<td>shipping_name</td>
			<td><input type="text" value="Tarun Dhiman" name="shipping_name"></td>
		</tr>
		<tr>
			<td>shipping_email</td>
			<td><input type="text" value="tarun.dhiman.india@gmail.com" name="shipping_email"></td>
		</tr>
		<tr>
			<td>shipping_phone</td>
			<td><input type="text" value="9717403522" name="shipping_phone"></td>
		</tr>
		<tr>
			<td>shipping_street_address</td>
			<td><input type="text" value="821/3 Rampuri" name="shipping_street_address"></td>
		</tr>
		<tr>
			<td>shipping_city</td>
			<td><input type="text" value="Muzaffarnagar" name="shipping_city"></td>
		</tr>
		<tr>
			<td>shipping_state</td>
			<td><input type="text" value="Uttar Pardesh" name="shipping_state"></td>
		</tr>
		<tr>
			<td>shipping_pincode</td>
			<td><input type="text" value="251001" name="shipping_pincode"></td>
		</tr>
		<tr>
			<td>order_amount</td>
			<td><input type="text" value="15000" name="order_amount"></td>
		</tr>
		<tr>
			<td>payment_type</td>
			<td><select name="payment_type"><option value="online" >online</option><option value="cod">cod</option></select></td>
		</tr>
		<tr>
			<td>txnid</td>
			<td><input type="text" value="t7sd5txaai" name="txnid"></td>
		</tr>
		<tr>
			<td colspan="2"><button type="submit">Submit</button></td>
		</tr>
	</table>
{!! Form::close() !!}
</body>
</html>