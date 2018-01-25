@foreach($renderResult as $result)
<tr class="table-row-selected">
	<td class="width-30"></td>
	<td class="width-190">{{$result->value}}</td>
	<td class="width-25"><a href="javascript:;" onclick="removeSelectedVarientValue({{$result->id}}, {{$productid}}, {{$varientTypeId}} )">-</a></td>
</tr>
@endforeach