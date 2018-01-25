@foreach($results as $result)
	<li id="li_{{$result->category}}" onclick="addCategoryToProduct({{$result->id}})">{{$result->category}}</li>
@endforeach