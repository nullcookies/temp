<table class="table profile-orders roboto-light">
	<tbody>
		<tr>
			<td>Ordre Id : {{$order->id}}</td>
			<td>Order Amount : <i class="fa fa-inr"></i> {{$order->orderAmount}}</td>
			<td>Estimeted Delivery Date : {{Carbon\Carbon::parse($order->created_at)->format('D d-m-Y')}}</td>
			@if($order->is_delivered == 'yes') <td>Delivered At : {{Carbon\Carbon::parse($order->delivery_time)->format('D d-m-Y')}}</td>@endif
			<td>Order Status : {{$order->status}}</td>
		</tr>
	</tbody>
</table>