<?php foreach($renderResult as $result): ?>
<tr class="table-row-design">
	<td class="width-30"></td>
	<td class="width-190"><?php echo e($result->value); ?></td>
	<td class="width-25"><a href="javascript:;" onclick="selectTheVarientValue(<?php echo e($varientTypeid); ?>,<?php echo e($result->id); ?>, <?php echo e($productid); ?>)">+</a></td>
</tr>
<?php endforeach; ?>