<?php $__env->startSection('title', 'Offer List | Admin Ecom530'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Offer Lists</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Offered products</th>
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
                                            <img src="<?php echo e(asset('uploads/offer/Thumb-'.$value->image)); ?>"
                                                 style="max-width: 100px;" alt="<?php echo e($value->title); ?>"
                                                 class="img img-fluid img-thumbnail">
                                    </td>
                                    <td><?php echo e($value->start_time); ?></td>
                                    <td><?php echo e($value->end_time); ?></td>
                                    <td>
                                    	<?php if($value->offeredProducts): ?>
											<ol>
												<?php $__currentLoopData = $value->offeredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offered_prods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<li><?php echo e($offered_prods->product_info['title']); ?> (<?php echo e($offered_prods->discount); ?> %)</li>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</ol>
                                    	<?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-<?php echo e($value->status =='active'?'success' : 'danger'); ?>">
                                            <?php echo e(ucfirst($value->status =='active'?'published' : 'un-Published')); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('offer.edit', $value->id)); ?>" class="btn btn-success" style="border-radius: 50%;">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        <?php echo e(Form::open(['url'=>route('offer.destroy', $value->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure you want to delete this offer?")'])); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/admin/offer/index.blade.php ENDPATH**/ ?>