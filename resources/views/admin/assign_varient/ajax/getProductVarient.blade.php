<tr>
@foreach($availableVarients as $varients)
	<td><input type="hidden" name="productid" value="{{$productid}}">
		<select class="form-control mb-1" name="varient_type[]">
		@foreach($selectValues[$varients->id] as $selectedVar)
			<option value="{{$selectedVar->varient_type_value_id}}">{{$selectedVar->value}}</option>
		@endforeach
		</select>

	</td>
	<td>
		+
	</td>
@endforeach
	<td><input type="number" name="productPrice" class="set_price" id="fromInput" placeholder="Set Price"/></td>
	<td><input type="submit" name="btnSave" value="Save" class="btn btn-success save-button24"/></td>
</tr>
