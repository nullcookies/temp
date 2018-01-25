<script type="text/javascript">
    var date = "<?php echo e($date); ?>" ;
	$("input[name='selectedDate']").val(date);
	$('#shippingtimeholderinput').attr('name','delivery_option').val('13_14');
</script>
<div class="row">
<div class="tabs-panel time-slot">
	<div class="scroll-pane">
		<ul style="line-height:200px;">
			<li>
				<ul class="slot" id="time-slot-ul">
				    <li class="timeslottable">
				        <span style="font-size: 20px;font-family: Roboto;"><center>Your order will be delivered on
				            <span style="color: #d80003;font-size: 25px;font-weight: 700;text-shadow: 2px 1px 1px rgba(0, 0, 0, 0.76);">
				             <?php echo e($dateforuser); ?></span></center>
				            </span>
				    </li>
				</ul>
			</li>
		</ul>
	</div>
</div>
</div>