<!DOCTYPE html>
<html>
<head>
	<title>Return Product</title>
</head>
<body>
<table>
	{!! Form::open(array('method' => 'post', 'action' => ['Api\ApiController@place_return'])) !!}
		<tr>
			<td>access_token</td>
			<td><input type="text" value="A123456" name="access_token"></td>
		</tr>
		<tr>
			<td>order_id</td>
			<td><input type="text" value="1" name="order_id"></td>
		</tr>
		<tr>
			<td>reason_of_return</td>
			<td><input type="text" value="ghatiya product" name="reason_of_return"></td>
		</tr>
		<tr>
			<td><button type="submit">Submit</button></td>
		</tr>
	{!! Form::close() !!}
</table>
</body>
</html>