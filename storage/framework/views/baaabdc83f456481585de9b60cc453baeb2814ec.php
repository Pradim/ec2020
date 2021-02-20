<?php $__env->startSection('title', 'Admin Category | Admin Ecom530'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Category Lists</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Is Parent</th>
                            <th>Parent Category</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($category_data): ?>
                            <?php $__currentLoopData = $category_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(ucfirst($value->title)); ?></td>
                                    <td>
                                        <?php if($value->image !=null && file_exists(public_path().'/uploads/category/'.$value->image)): ?>
                                            <img src="<?php echo e(asset('uploads/category/Thumb-'.$value->image)); ?>"
                                                 style="max-width: 150px;" alt="<?php echo e($value->title); ?>"
                                                 class="img img-fluid img-thumbnail">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo e($value->is_parent == 1 ? 'Yes' : 'No'); ?>

                                    </td>
                                    <td>
                                        <?php echo e(ucfirst($value->parent_info['title'])); ?>

                                    </td>
                                    <td>
                                        <span class="badge badge-<?php echo e($value->status =='active'?'success' : 'danger'); ?>">
                                            <?php echo e(ucfirst($value->status =='active'?'published' : 'un-Published')); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e($value->created_by['name']); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('category.edit', $value->id)); ?>" class="btn btn-success" style="border-radius: 50%;">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        <?php echo e(Form::open(['url'=>route('category.destroy', $value->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure you want to delete this category?")'])); ?>

                                        <?php echo method_field('delete'); ?>
                                        <?php echo e(Form::button('<i class="fa fa-trash"></i>', ['class'=>'btn btn-danger', 'style'=>'border-radius: 50%', 'type'=>'submit'])); ?>

                                        <?php echo e(Form::close()); ?>


                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <?php echo e($category_data->links()); ?>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/admin/category/index.blade.php ENDPATH**/ ?>