<?php $__env->startSection('title', 'Page Form| Admin Ecom530'); ?>
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/SummerNote/summernote-bs4.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('plugins/SummerNote/summernote-bs4.js')); ?>"></script>
    <script>
        $('#description').summernote({
            height: 150
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Page <?php echo e(isset($page_data) ? 'Update' : 'Add'); ?></div>
                </div>
                <div class="ibox-body">
                    <?php if(isset($page_data)): ?>
                        <?php echo e(Form::open(['url'=>route('page.update', $page_data->id), 'files'=>true, 'class'=>'form'])); ?>

                        <?php echo method_field('put'); ?>
                    <?php else: ?>
                    <?php echo e(Form::open(['url'=>route('page.store'), 'files'=>true, 'class'=>'form'])); ?>

                    <?php endif; ?>
                    <div class="form-group row">
                        <?php echo e(Form::label('title', 'Title:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::text('title',@$page_data->title,['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter page Title', 'required'=>true])); ?>

                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="alert-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <?php echo e(Form::label('summary', 'Summary:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::textarea('summary',@$page_data->summary,['class'=>'form-control form-control-sm', 'id'=>'summary', 'placeholder'=>'Enter Page summary', 'required'=>true, 'rows'=>5, 'style'=>'resize:none'])); ?>

                            <?php $__errorArgs = ['summary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="alert-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <?php echo e(Form::label('description', 'Description:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::textarea('description',@$page_data->description,['class'=>'form-control form-control-sm', 'id'=>'description', 'placeholder'=>'Enter Page description', 'required'=>false, 'rows'=>5, 'style'=>'resize:none'])); ?>

                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="alert-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>


                    <div class="form-group row">
                        <?php echo e(Form::label('status', 'Status:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$page_data->status,['id'=>'status','required'=>true, 'class'=>'form-control form-control-sm'])); ?>

                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="alert-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <?php echo e(Form::label('image', 'Image:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-4">
                            <?php echo e(Form::file('image', ['id'=>'image','required'=>(isset($page_data) ? false : true), 'accept'=>'image/*'])); ?>

                            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="alert-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-sm-4">
                            <?php if(isset($page_data)): ?>
                                <?php if(file_exists(public_path().'/uploads/page/Thumb-'.$page_data->image)): ?>
                                    <img src="<?php echo e(asset('/uploads/page/Thumb-'.$page_data->image)); ?>" alt="" class="img img-thumbnail img-fluid">
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <?php echo e(Form::label('', '', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::button("<i class='fa fa-thrash'></i> Reset",['class'=>'btn btn-danger', 'type'=>'reset'])); ?>

                            <?php echo e(Form::button("<i class='fa fa-paper-plane'></i> Submit",['class'=>'btn btn-success', 'type'=>'submit'])); ?>

                        </div>
                    </div>

                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/admin/page/page-form.blade.php ENDPATH**/ ?>