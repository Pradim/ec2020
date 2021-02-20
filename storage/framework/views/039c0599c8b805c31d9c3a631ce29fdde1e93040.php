<?php $__env->startSection('title', 'Category Form| Admin Ecom530'); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $('#is_parent').change(function(){
            let is_checked = $(this).prop('checked');
            if(is_checked){
                $('#parent_id').change();
                $('#div_parent').addClass('d-none');
            }else{
                $('#div_parent').removeClass('d-none');
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Category <?php echo e(isset($category_detail) ? 'Update' : 'Add'); ?></div>
                </div>
                <div class="ibox-body">
                    <?php if(isset($category_detail)): ?>
                        <?php echo e(Form::open(['url'=>route('category.update', $category_detail->id), 'files'=>true, 'class'=>'form'])); ?>

                        <?php echo method_field('put'); ?>
                    <?php else: ?>
                        <?php echo e(Form::open(['url'=>route('category.store'), 'files'=>true, 'class'=>'form'])); ?>

                    <?php endif; ?>
                    <div class="form-group row">
                        <?php echo e(Form::label('title', 'Title:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::text('title',@$category_detail->title,['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter Banner Title', 'required'=>true])); ?>

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
                            <?php echo e(Form::textarea('summary',@$category_detail->summary,['class'=>'form-control form-control-sm', 'id'=>'summary', 'placeholder'=>'Enter Banner Summary', 'required'=>false, 'style'=>'resize: none;','rows'=>'5'])); ?>

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
                        <?php echo e(Form::label('is_parent', 'Is Parent:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::checkbox('is_parent',1, (isset($category_detail) ? $category_detail->is_parent : true),['id'=>'is_parent'])); ?> Yes
                            <?php $__errorArgs = ['is_parent'];
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

                    <div class="form-group row <?php echo e(isset($category_detail) && $category_detail->is_parent == 0 ? '' : 'd-none'); ?>" id="div_parent">
                        <?php echo e(Form::label('parent_id', 'Parent Category:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::select('parent_id', $parent_cats ,@$category_detail->parent_id, ['id'=>'parent_id', 'class'=>'form-control form-control-sm', 'required'=>false, 'placeholder'=>'--Please select one--'])); ?>

                            <?php $__errorArgs = ['parent_id'];
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
                            <?php echo e(Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$category_detail->status,['id'=>'status','required'=>true, 'class'=>'form-control form-control-sm'])); ?>

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
                            <?php echo e(Form::file('image', ['id'=>'image','required'=>(isset($category_detail) ? false : true), 'accept'=>'image/*'])); ?>

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
                            <?php if(isset($category_detail)): ?>
                                <?php if(file_exists(public_path().'/uploads/category/Thumb-'.$category_detail->image)): ?>
                                    <img src="<?php echo e(asset('/uploads/category/Thumb-'.$category_detail->image)); ?>" alt="" class="img img-thumbnail img-fluid">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/admin/category/category-form.blade.php ENDPATH**/ ?>