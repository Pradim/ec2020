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
                            <!-- <th>Customer Name</th> -->
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($cart_data): ?>
                        <?php $__currentLoopData = $cart_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($value->order_code); ?></td>
                            <!-- <td><?php echo e($value->user['name']); ?></td> -->
                            <td><?php echo e($value->product['title']); ?></td>
                            <td><?php echo e($value->quantity); ?></td>
                            <td><?php echo e($value->price); ?></td>
                            <td><?php echo e($value->total_amount); ?></td>
                            <td><?php echo e($value->status); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <?php echo e($cart_data->links()); ?>

            </div>
        </div>
    </div>
</section>  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/user/order/cart-list.blade.php ENDPATH**/ ?>