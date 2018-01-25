<div class="scroll-pane">
	<ul>
		<?php foreach($delivery_options as $delivery_option): ?>
		<li>
			<a data-shippingmethod="EXPRESS_DELIVERY" class="timeslotdetails" data-ga-title="Standard Delivery" tabindex="0">
				<input type="radio" value="<?php echo e($delivery_option->alias); ?>" onchange="getcalender(this.value)" class="input-group-field applycoupon shippingtime" name="shippingtime" id="delivery_option<?php echo e($delivery_option->id); ?>" tabindex="0">
				<label for="delivery_option<?php echo e($delivery_option->id); ?>">
				<span class="rdo-span"></span>
				<span class="timesloter"><?php echo e($delivery_option->name); ?></span>
				</label>
				<div class="input-group-button button del-method-btn">
					<span class="delcost"><?php if($delivery_option->shipping_charge>0): ?><i class="fa fa-inr"></i> <?php endif; ?> <?php echo e($delivery_option->shipping_charge>0 ?$delivery_option->shipping_charge: 'Free'); ?></span>
				</div>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>
</div>
				