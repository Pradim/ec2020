<?php $__env->startSection('title', 'Admin Order | Admin Ecom530'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Order Lists</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>Order Code</th>
                            <th>Customer Name</th>
                            <!-- <th>Sub Total</th>
                            <th>VAT</th>
                            <th>Service Charge</th>
                            <th>Delivery Charge</th> -->
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <!-- <th>Action</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($order_data): ?>
                            <?php $__currentLoopData = $order_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a href="<?php echo e(route('admin-order-cart-list',$value->order_code)); ?>"><?php echo e($value->order_code); ?></a></td>
                                    <td><?php echo e($value->user->name); ?></td>
                                    <!-- <td><?php echo e($value->sub_total); ?></td>
                                    <td><?php echo e($value->vat_amount); ?></td>
                                    <td><?php echo e($value->service_charge); ?></td>
                                    <td><?php echo e($value->delivery_charge); ?></td> -->
                                    <td><?php echo e($value->total_amount); ?></td>
                                    <td>
                                       <form class="form-validate" method="post" enctype="multipart/form-data" action="<?php echo e(route('order.update', $value->id)); ?>">
                                            <?php $order_data_avail = isset($order_data) ? true :  false;?>
                                            <?php echo e(csrf_field()); ?>

                                            <?php echo method_field('put'); ?>
                                            
                                            <select class="status" name="status" onchange="this.form.submit()" class="form-control" required>
                                                <option value="" selected disabled="">
                                                    Choose Status...
                                                </option>
                                                <option value="new" <?php echo e($order_data_avail && ( 'new'== $value->status) ? "selected = 'selected'" : ""); ?>>
                                                    New
                                                </option>
                                                <option value="cancelled" <?php echo e($order_data_avail && ( 'cancelled'== $value->status) ? "selected = 'selected'" : ""); ?>>
                                                    Cancelled
                                                </option>
                                                <option value="verified" <?php echo e($order_data_avail && ( 'verified'== $value->status) ? "selected = 'selected'" : ""); ?>>
                                                    Verified
                                                </option>
                                                <option value="processing" <?php echo e($order_data_avail && ( 'processing'== $value->status) ? "selected = 'selected'" : ""); ?>>
                                                    Processing
                                                </option>      
                                                <option value="delivered" <?php echo e($order_data_avail && ( 'delivered'== $value->status) ? "selected = 'selected'" : ""); ?>>
                                                    Delivered
                                                </option>
                                            </select>
                                        </form> 
                                    </td>
                                    <td><?php echo e($value->created_at->format('Y-m-d')); ?></td>
<!--                                     <td>
                                        <a href="<?php echo e(route('order.edit', $value->id)); ?>" class="btn btn-success" style="border-radius: 50%;">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        <?php echo e(Form::open(['url'=>route('order.destroy', $value->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure you want to delete this order?")'])); ?>

                                        <?php echo method_field('delete'); ?>
                                            <?php echo e(Form::button('<i class="fa fa-trash"></i>', ['class'=>'btn btn-danger', 'style'=>'border-radius: 50%', 'type'=>'submit'])); ?>

                                        <?php echo e(Form::close()); ?>

                                    </td> -->
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <?php echo e($order_data->links()); ?>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/admin/order/index.blade.php ENDPATH**/ ?>