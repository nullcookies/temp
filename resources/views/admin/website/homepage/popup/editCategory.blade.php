{!! Form::open(array('method' => 'post', 'id' => 'popupForm','action' => ['Admin\WebsiteSetting\HomepageNavController@editCategory'])) !!}
<input type="hidden" name="navid" value="{{$navid}}">
<div class="form-group">
	<label for="message-text" class="form-control-label">Search Product</label>
	<select required class="search-product select2_select" onchange="myfunc($('select option[value='+this.value+']').text())" name="categoryId" data-plugin="select2">
		@foreach($categories as $category)
			<option value="{{$category->id}}" @if($category->id == $catid) selected @endif>@if(strlen($category->parentTop3)) {{$category->parentTop3}} / @endif @if(strlen($category->parentTop2)){{$category->parentTop2}}/ @endif  @if(strlen($category->parentTop1)){{$category->parentTop1}}/ @endif{{$category->category}}</option>
		@endforeach
	</select>	
</div>
<div class="form-group">
	<label for="message-text" class="form-control-label">Category Name</label>
	<input type="text" required="" class="form-control" name="category_name" value="{{$catname}}" id="recipient-name">
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-primary btn-popup-submit">Update Category</button>
</div>
{!! Form::close() !!}

<script>
	
function myfunc(str){
	var catName = str.split('/ ')[str.split('/ ').length-1];
	$('#recipient-name').val(catName);
}
</script>