<?php foreach($renderResult as $result): ?>
<tr class="table-row-selected">
	<td class="width-30"></td>
	<td class="width-190"><?php echo e($result->value); ?></td>
	<td class="width-25"><a href="javascript:;" onclick="removeSelectedVarientValue(<?php echo e($result->id); ?>, <?php echo e($productid); ?>, <?php echo e($varientTypeId); ?> )">-</a></td>
</tr>
<?php endforeach; ?>