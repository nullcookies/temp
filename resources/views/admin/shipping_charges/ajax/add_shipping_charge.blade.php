<div class="row">
	<div class="col-md-12 col-xs-12 col-lg-12">
		{!! Form::open(array('method'=>'post','files' => 'true','action'=>['Admin\ShippingCharges\ShippingChargesController@save_shipping_charges'])) !!}
			<div class="form-group">
					<label><strong>Zone Name</strong></label>
					<input type="text" name="zone_name" value="<?php echo $Old ? $Old['zone_name'] : ''; ?>" class="form-control">
					@if($errors->has('zone_name'))<span class="text-danger">{{$errors->first('zone_name')}}</span>@endif
			</div>

			@foreach($weights as $weight) 
			<div class="form-group">
				<label><strong>{!! $weight->weight !!} Price</strong></label>
				<input type="text" name="{{$weight->weight_in_gms}}_gms" value="<?php echo $Old ? $Old[$weight->weight_in_gms.'_gms'] : ''; ?>" class="form-control">
				@if($errors->has($weight->weight_in_gms.'_gms'))<span class="text-danger">{{$errors->first($weight->weight_in_gms.'_gms')}}</span>@endif
			</div>
			@endforeach

			<div class="form-group">
				<a href="javascript:;">{{(count($weights)) <1 ? ' not added weight yet. You need to add weight first. ' : ' add more weight '}} 
				</a>
			</div>

			<div class="form-group">
				<label><strong>Upload Pincode Excel (only csv or excel format supported)</strong></label>
				<input type="file" name="pincodes" class="form-control">
				<a href="{!! url('/sample_files/sample.csv') !!}" download>Download Sample.</a>
				@if($errors->has('pincodes'))<span class="text-danger">{{$errors->first('pincodes')}}</span>@endif
				@if($mime_error) <span class="text-danger">{{$mime_error}}</span> @endif
			</div>
			<input type="submit" class="btn btn-default" value="Save">
			<input type="reset" class="btn btn-warning" name="">
		{!! Form::close() !!}
	</div>
</div>