<div class="row">
						<div class="tabs-panel time-slot">
							<div style="display:none;" class="shippingMethodName">Standard Delivery</div>
							<div style="display:none;" class="shippingMethodId">EXPRESS_DELIVERY</div>
							<div class="scroll-pane" data-ga-category="SelectDate &amp; Timeslot_Standard Delivery">
								<ul>
									<li><span class="timeslottitle"><?php echo e($delivery_option->name); ?> - <?php echo e($shipping_price); ?></span>
										<ul class="slot" id="time-slot-ul">
										    <?php foreach($delivery_timings as $timing): ?>
        											<li class="timeslottable <?php echo e($delivery_option->alias); ?>_class">
        												<a href="javascript:void(0);" data-ga-title="12:00 - 15:00 hrs" tabindex="0" >
        													<input type="radio" value="<?php echo e($timing->value); ?>" class="input-group-field " name="delivery_option" id="EXPRESS_DELIVERY-<?php echo e($timing->id); ?>" tabindex="0">
        													<label for="EXPRESS_DELIVERY-<?php echo e($timing->id); ?>">
        													<span class="rdo-span"></span>
        													<span class="timeSlotId" style="display:none;">10020</span>
        													<span class="timerange"><?php echo e($timing->timing); ?></span>
        													<span class="priceblock" style="display:none;"><span class="timeslotprice">Free</span>
        													</span>
        													</label>
        												</a>
        											</li>
											<?php endforeach; ?>
											
											<?php if(!count($delivery_timings)): ?>
											    <li class="timeslottable">
											        <span style="padding: 0px 5px;font-family: roboto;font-size: 15px;">No Delivery Time Available for today, Please select Another Delivery option or Date. </span>
											    </li>
											<?php endif; ?>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>