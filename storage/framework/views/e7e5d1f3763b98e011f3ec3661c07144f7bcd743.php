<table class="table profile-orders roboto-light">
	<tbody>
		<tr>
			<td>Ordre Id : <?php echo e($order->id); ?></td>
			<td>Order Amount : <i class="fa fa-inr"></i> <?php echo e($order->orderAmount); ?></td>
			<td>Estimeted Delivery Date : <?php echo e(Carbon\Carbon::parse($order->created_at)->format('D d-m-Y')); ?></td>
			<?php if($order->is_delivered == 'yes'): ?> <td>Delivered At : <?php echo e(Carbon\Carbon::parse($order->delivery_time)->format('D d-m-Y')); ?></td><?php endif; ?>
			<td>Order Status : <?php echo e($order->status); ?></td>
		</tr>
	</tbody>
</table>