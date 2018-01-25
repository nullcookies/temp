<table class="table table-striped">
	<thead>
		<tr>
			<!-- <th>#</th> -->
			<th>Category</th>
			<th class="fr-1">
				<a href="javascript:;" onclick="saveCommission()" class="edit-button"><span style="color:#fff">Save</span>
				</a>
			</th>
		</tr>
	</thead>
	<tbody>
		@foreach($categories as $category)
			<tr>
				<!-- <td><input type="checkbox" value="{{$category->id}}" /></td> -->
				<td>{{$category->category}}</td>
				<td class="fr-td-1"><input type="text" name="cat_{{$category->id}}" value="{{$categoryPrice[$category->id]}}" /></td>
			</tr>
		@endforeach
	</tbody>
</table>