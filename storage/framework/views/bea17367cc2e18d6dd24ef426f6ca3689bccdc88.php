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
                            <th>Title</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Price (NPR)</th>
                            <th>Discount (%)</th>
                            <th>Is Featured</th>
                            <th>Stock</th>
                            <th>Seller</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($data): ?>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($value->title); ?></td>
                                    <td>
                                            <img src="<?php echo e(asset('uploads/product/Thumb-'.@$value->images[0]->image_name)); ?>"
                                                 style="max-width: 50px;" alt="<?php echo e($value->title); ?>"
                                                 class="img img-fluid img-thumbnail">
                                    </td>
                                    <td>
                                        <?php echo e($value->cat_info['title']); ?><br/>
                                        <sub>
                                            <?php echo e($value->sub_cat_info['title']); ?>

                                        </sub>
                                    </td>
                                    <td>NPR. <?php echo e(number_format($value->price)); ?></td>
                                    <td><?php echo e($value->discount); ?></td>
                                    <td><?php echo e(($value->is_featured == 1) ? 'Yes' : 'No'); ?></td>
                                    <td><?php echo e((int)($value->stock)); ?></td>
                                    <td><?php echo e($value->vendor_info['name']); ?></td>
                                    <td>
                                        <span class="badge badge-<?php echo e($value->status =='active'?'success' : 'danger'); ?>">
                                            <?php echo e(ucfirst($value->status =='active'?'published' : 'un-Published')); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('product.edit', $value->id)); ?>" class="btn btn-success" style="border-radius: 50%;">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        <?php echo e(Form::open(['url'=>route('product.destroy', $value->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure you want to delete this product?")'])); ?>

                                        <?php echo method_field('delete'); ?>
                                        <?php echo e(Form::button('<i class="fa fa-trash"></i>', ['class'=>'btn btn-danger', 'style'=>'border-radius: 50%', 'type'=>'submit'])); ?>

                                        <?php echo e(Form::close()); ?>


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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/admin/product/index.blade.php ENDPATH**/ ?>