@foreach($pincodes as $pincode)
<li onmouseover="setpincode({{$pincode->pincode}},'{{$pincode->city_name}}')"><a href="javascript:;">{{$pincode->city_name}}<span class="pull-right">{{$pincode->pincode}}</span></a></li>
@endforeach

@if(!count($pincodes))
<li>No Matching Pincode found</li>
@endif
        							