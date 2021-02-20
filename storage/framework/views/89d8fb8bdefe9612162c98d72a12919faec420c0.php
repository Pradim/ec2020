<?php $__env->startSection('content'); ?>
<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
						<tr>
							<th>Order Code</th>
							<th>Customer Name</th>
							<th>Sub Total</th>
							<th>VAT</th>
							<th>Service Charge</th>
							<th>Delivery Charge</th>
							<th>Total Amount</th>
							<th>Status</th>
							<th>Created At</th>
						</tr>
					</thead>
					<tbody>
						<?php if($order_data): ?>
						<?php $__currentLoopData = $order_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><a href="<?php echo e(route('user-order-cart-list',$value->order_code)); ?>"><?php echo e($value->order_code); ?></a></td>
							<td><?php echo e($value->user->name); ?></td>
							<td><?php echo e($value->sub_total); ?></td>
							<td><?php echo e($value->vat_amount); ?></td>
							<td><?php echo e($value->service_charge); ?></td>
							<td><?php echo e($value->delivery_charge); ?></td>
							<td><?php echo e($value->total_amount); ?></td>
							<td><?php echo e($value->status); ?></td>
							<td><?php echo e($value->created_at->format('Y-m-d')); ?></td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
					</tbody>
				</table>
				<?php echo e($order_data->links()); ?>

			</div>
		</div>
	</div>
</section>	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/user/order/index.blade.php ENDPATH**/ ?>