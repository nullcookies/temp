<?php echo Form::open(array('method' => 'post', 'id' => 'popupForm','action' => ['Admin\WebsiteSetting\HomepageNavController@editCategory'])); ?>

<input type="hidden" name="navid" value="<?php echo e($navid); ?>">
<div class="form-group">
	<label for="message-text" class="form-control-label">Search Product</label>
	<select required class="search-product select2_select" onchange="myfunc($('select option[value='+this.value+']').text())" name="categoryId" data-plugin="select2">
		<?php foreach($categories as $category): ?>
			<option value="<?php echo e($category->id); ?>" <?php if($category->id == $catid): ?> selected <?php endif; ?>><?php if(strlen($category->parentTop3)): ?> <?php echo e($category->parentTop3); ?> / <?php endif; ?> <?php if(strlen($category->parentTop2)): ?><?php echo e($category->parentTop2); ?>/ <?php endif; ?>  <?php if(strlen($category->parentTop1)): ?><?php echo e($category->parentTop1); ?>/ <?php endif; ?><?php echo e($category->category); ?></option>
		<?php endforeach; ?>
	</select>	
</div>
<div class="form-group">
	<label for="message-text" class="form-control-label">Category Name</label>
	<input type="text" required="" class="form-control" name="category_name" value="<?php echo e($catname); ?>" id="recipient-name">
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-primary btn-popup-submit">Update Category</button>
</div>
<?php echo Form::close(); ?>


<script>
	
function myfunc(str){
	var catName = str.split('/ ')[str.split('/ ').length-1];
	$('#recipient-name').val(catName);
}
</script>