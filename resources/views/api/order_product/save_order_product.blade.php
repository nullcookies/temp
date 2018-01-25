<!DOCTYPE html>
<html>
<head>
	<title>Place order</title>
</head>
<body>
{!! Form::open(array('method' => 'post', 'action' => ['Api\ApiController@save_order_product'])) !!}
	<table>
		<tr>
			<td>access_token</td>
			<td><input type="text" value="A123456" name="access_token"></td>
		</tr>
		<tr>
			<td>order_id</td>
			<td><input type="text" value="4" name="order_id"></td>
		</tr>
		<tr>
			<td>product_id</td>
			<td><input type="text" value="12" name="product_id"></td>
		</tr>
		<tr>
			<td>product_name</td>
			<td><input type="text" value="Demo Product" name="product_name"></td>
		</tr>
		<tr>
			<td>product_description</td>
			<td><input type="text" value="Demo Product" name="product_description"></td>
		</tr>
		<tr>
			<td>varients</td>
			<td><input type="text" value="red, xl" name="varients"></td>
		</tr>
		<tr>
			<td>selling_price</td>
			<td><input type="text" value="4800" name="selling_price"></td>
		</tr>
		<tr>
			<td>mrp</td>
			<td><input type="text" value="5000" name="mrp"></td>
		</tr>
		<tr>
			<td>product_weight</td>
			<td><input type="text" value="400" name="product_weight"></td>
		</tr>
		<tr>
			<td>quantity</td>
			<td><input type="text" value="2" name="quantity"></td>
		</tr>
		<tr>
			<td>product_type</td>
			<td><input type="text" value="api" name="product_type"></td>
		</tr>
		<tr>
			<td colspan="2"><button type="submit">Submit</button></td>
		</tr>
		
	</table>
{!! Form::close() !!}
</body>
</html>