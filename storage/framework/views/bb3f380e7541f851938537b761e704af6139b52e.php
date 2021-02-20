<?php $__env->startSection('title', 'Admin Product | Admin Ecom530'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Product Lists</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>S.N.</th>
                            <th>Product Name</th>
                            <th>Reviewed By</th>
                            <th>Review</th>
                            <th>Rate</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($data): ?>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$key); ?></td>
                                    <td><?php echo e($value->product['title']); ?></td>
                                    <td><?php echo e($value->user['name']); ?></td>
                                    <td><?php echo e($value->review); ?></td>
                                    <td><?php echo e($value->rate); ?></td>
                                    <td>
                                        <form class="form-validate" method="post" enctype="multipart/form-data" action="<?php echo e(route('review.status', $value->id)); ?>">
                                            <?php $prod_avail = isset($data) ? true :  false;?>
                                            <?php echo e(csrf_field()); ?>

                                            <?php echo method_field('put'); ?>
                                            <select class="status" name="status" onchange="this.form.submit()" class="form-control" required>
                                                <option value="" selected disabled="">
                                                    Choose Status...
                                                </option>
                                                <option value="active" <?php echo e($prod_avail && ( 'active'== $value->status) ? "selected = 'selected'" : ""); ?>>
                                                    Active
                                                </option>
                                                <option value="inactive" <?php echo e($prod_avail && ( 'inactive'== $value->status) ? "selected = 'selected'" : ""); ?>>
                                                    Inactive
                                                </option>
                                            </select>
                                        </form> 
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <?php echo e($data->links()); ?>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/admin/review/index.blade.php ENDPATH**/ ?>