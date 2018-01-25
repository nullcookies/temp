<div class="scroll-pane">
	<ul>
		@foreach($delivery_options as $delivery_option)
		<li>
			<a data-shippingmethod="EXPRESS_DELIVERY" class="timeslotdetails" data-ga-title="Standard Delivery" tabindex="0">
				<input type="radio" value="{{$delivery_option->alias}}" onchange="getcalender(this.value)" class="input-group-field applycoupon shippingtime" name="shippingtime" id="delivery_option{{$delivery_option->id}}" tabindex="0">
				<label for="delivery_option{{$delivery_option->id}}">
				<span class="rdo-span"></span>
				<span class="timesloter">{{$delivery_option->name}}</span>
				</label>
				<div class="input-group-button button del-method-btn">
					<span class="delcost">@if($delivery_option->shipping_charge>0)<i class="fa fa-inr"></i> @endif {{$delivery_option->shipping_charge>0 ?$delivery_option->shipping_charge: 'Free'}}</span>
				</div>
			</a>
		</li>
		@endforeach
	</ul>
</div>
				