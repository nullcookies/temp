<?php foreach($pincodes as $pincode): ?>
<li onmouseover="setpincode(<?php echo e($pincode->pincode); ?>,'<?php echo e($pincode->city_name); ?>')"><a href="javascript:;"><?php echo e($pincode->city_name); ?><span class="pull-right"><?php echo e($pincode->pincode); ?></span></a></li>
<?php endforeach; ?>

<?php if(!count($pincodes)): ?>
<li>No Matching Pincode found</li>
<?php endif; ?>
        							