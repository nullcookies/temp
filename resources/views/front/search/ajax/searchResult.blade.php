@foreach($results as $result)
	<ul class="search-list-main">
		<a href="{{url('/products/product_detail?product_id='.$result->id.'&category_id='.$result->category_id)}}"><li class="search-list-box">{{$result->product_name}} <strong>in {{$result->category}}</strong> </li></a>
	</ul>
@endforeach

@if(sizeof($results) < 1)
	<ul class="search-list-main">
		<li class="search-list-box">No Record match to your search</strong> </li>
	</ul>
@endif