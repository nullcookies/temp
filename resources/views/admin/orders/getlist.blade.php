						
			@foreach($orders as $order)
			<tr>
				<td>{!! $order->id !!}</td>
				<td>{!! $order->quantity !!} Items</td>
				<td>{!! $order->paymentType !!}</td>
				<td>{!! $order->product !!}</td>
				<td>{!! $order->varient !!}</td>
				<td>{!! $order->shippingCompleteAddress() !!}</td> 
				<td>{!! $order->orderAmount !!}</td>
				<td>
					<a target='_blank' href="{{url('admin/orders/shippinglabel/'.$order->id)}}" class='btn btn-primary btn-rounded btn-sm mb-0-25 waves-effect waves-light' onclick='enableManifiest(this)' >Shipping Label</a>
					<a target='_blank' href="{{url('admin/orders/manifestlabel/'.$order->id)}}" class='btn btn-info btn-rounded btn-sm mb-0-25 waves-effect waves-light manifest' onclick='enableManifiest(this)' style='display:none;' >Genrate Manifest</a>
					<a class='btn btn-outline-black btn-rounded disabled oldManifest btn-sm mb-0-25 waves-effect waves-light'>Genrate Manifest</a>							
				</td>
			</tr>
				@endforeach
			