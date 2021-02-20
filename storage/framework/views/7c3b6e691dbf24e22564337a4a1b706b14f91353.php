<?php $__env->startSection('title', 'Admin Cart | Admin Ecom530'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Cart Lists</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>Order Code</th>
                            <th>Customer Name</th>
                            <!-- <th>Seller</th> -->
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <!-- <th>Action</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($cart_data): ?>
                            <?php $__currentLoopData = $cart_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($value->order_code); ?></td>
                                    <td><?php echo e($value->user['name']); ?></td>
                                    <!-- <td><?php echo e($value->seller['name']); ?></td> -->
                                    <td><?php echo e($value->product['title']); ?></td>
                                    <td><?php echo e($value->quantity); ?></td>
                                    <td><?php echo e($value->price); ?></td>
                                    <td><?php echo e($value->total_amount); ?></td>
                                    <td>
                                       <form class="form-validate" method="post" enctype="multipart/form-data" action="<?php echo e(route('cart.update', $value->id)); ?>">
                                            <?php $cart_data_avail = isset($cart_data) ? true :  false;?>
                                            <?php echo e(csrf_field()); ?>

                                            <?php echo method_field('put'); ?>
                                            
                                            <select class="status" name="status" onchange="this.form.submit()" class="form-control" required>
                                                <option value="" selected disabled="">
                                                    Choose Status...
                                                </option>
                                                <option value="new" <?php echo e($cart_data_avail && ( 'new'== $value->status) ? "selected = 'selected'" : ""); ?>>
                                                    New
                                                </option>
                                                <option value="cancelled" <?php echo e($cart_data_avail && ( 'cancelled'== $value->status) ? "selected = 'selected'" : ""); ?>>
                                                    Cancelled
                                                </option>
                                                <option value="verified" <?php echo e($cart_data_avail && ( 'verified'== $value->status) ? "selected = 'selected'" : ""); ?>>
                                                    Verified
                                                </option>
                                                <option value="processing" <?php echo e($cart_data_avail && ( 'processing'== $value->status) ? "selected = 'selected'" : ""); ?>>
                                                    Processing
                                                </option>      
                                                <option value="delivered" <?php echo e($cart_data_avail && ( 'delivered'== $value->status) ? "selected = 'selected'" : ""); ?>>
                                                    Delivered
                                                </option>
                                            </select>
                                        </form> 
                                    </td>
<!--                                     <td>
                                        <a href="" class="btn btn-success" style="border-radius: 50%;">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        <?php echo e(Form::open(['url'=>route('order.destroy', $value->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure you want to delete this cart?")'])); ?>

                                        <?php echo method_field('delete'); ?>
                                            <?php echo e(Form::button('<i class="fa fa-trash"></i>', ['class'=>'btn btn-danger', 'style'=>'border-radius: 50%', 'type'=>'submit'])); ?>

                                        <?php echo e(Form::close()); ?>

                                    </td> -->
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <?php echo e($cart_data->links()); ?>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/admin/order/cart.blade.php ENDPATH**/ ?>