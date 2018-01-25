<hr/>
<div class="row">
	<div class="col-md-2">
		<span><strong>Zone Name</strong></span>
	</div>
	<div class="col-md-2">
		<span><strong>Cod Available ?</strong></span>
	</div>
</div>
@foreach($records as $record)
<div class="row">
	<div class="col-md-2">
		<span>{{$record->zone_name}}</span>
	</div>
	<div class="col-md-2">
		<span>{{$record->cod_available}}</span>
	</div>
</div>
@endforeach

@if(sizeof($records)<1)
	<div class="row">
		<div class="col-md-4">
			<span>No Pincode Matched to our records.</span>
		</div>
	</div>
@endif
<hr/>