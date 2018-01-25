<tr>
<?php foreach($availableVarients as $varients): ?>
	<td><input type="hidden" name="productid" value="<?php echo e($productid); ?>">
		<select class="form-control mb-1" name="varient_type[]">
		<?php foreach($selectValues[$varients->id] as $selectedVar): ?>
			<option value="<?php echo e($selectedVar->varient_type_value_id); ?>"><?php echo e($selectedVar->value); ?></option>
		<?php endforeach; ?>
		</select>

	</td>
	<td>
		+
	</td>
<?php endforeach; ?>
	<td><input type="number" name="productPrice" class="set_price" id="fromInput" placeholder="Set Price"/></td>
	<td><input type="submit" name="btnSave" value="Save" class="btn btn-success save-button24"/></td>
</tr>
