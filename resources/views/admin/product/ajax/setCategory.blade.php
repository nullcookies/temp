@foreach($results as $result)
	<li id="selected_catagoey_li_{{$result->id}}">{{$result->category}}<input type="hidden" name="category[]" value="{{$result->id}}"><a href="javascript:;" onclick="removeInput({{$result->id}});"><i class="fa fa-times"></i></a></li>
@endforeach