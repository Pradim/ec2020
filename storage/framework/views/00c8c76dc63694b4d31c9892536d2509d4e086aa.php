<?php $__env->startSection('title', 'Product Form| Admin Ecom530'); ?>
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/SummerNote/summernote-bs4.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('plugins/SummerNote/summernote-bs4.js')); ?>"></script>
    <script>
        $('#description').summernote({
            height: 150
        });

        $('#cat_id').change(function(){
            let cat_id = $('#cat_id').val();
            let sub_cat_id = "<?php echo e(isset($product_detail) ? $product_detail->sub_cat_id : null); ?>";
            $.ajax({
                url: "<?php echo e(route('get-child-cats')); ?>",
                type: "post",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "cat_id": cat_id
                },
                success:function(response){
                    if(typeof (response) != 'object'){
                        response = $.parseJSON(response);
                    }
                    let html_option = "<option value='' selected>--Select Any One--</option>";
                    if (response.status){
                        $.each(response.data, function(key,value){
                            html_option += "<option value='"+value.id+"' ";
                            if(sub_cat_id != null && sub_cat_id == value.id){
                                html_option += ' selected ';
                            }
                            html_option += ">"+value.title+"</option>";
                        });
                        $('#sub_cat_div').removeClass('d-none');
                    }else{
                        $('#sub_cat_div').addClass('d-none');
                    }
                    $('#sub_cat_id').html(html_option);
                }
            });
        });
        $('#cat_id').change();

    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Product <?php echo e(isset($product_detail) ? 'Update' : 'Add'); ?></div>
                </div>
                <div class="ibox-body">
                    <?php if(isset($product_detail)): ?>
                        <?php echo e(Form::open(['url'=>route('product.update', $product_detail->id), 'files'=>true, 'class'=>'form'])); ?>

                        <?php echo method_field('put'); ?>
                    <?php else: ?>
                        <?php echo e(Form::open(['url'=>route('product.store'), 'files'=>true, 'class'=>'form'])); ?>

                    <?php endif; ?>
                    <div class="form-group row">
                        <?php echo e(Form::label('title', 'Title:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::text('title',@$product_detail->title,['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter Product Title', 'required'=>true])); ?>

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
                            <?php echo e(Form::textarea('summary',@$product_detail->summary,['class'=>'form-control form-control-sm', 'id'=>'summary', 'placeholder'=>'Enter Product summary', 'required'=>true, 'rows'=>5, 'style'=>'resize:none'])); ?>

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
                            <?php echo e(Form::textarea('description',@$product_detail->description,['class'=>'form-control form-control-sm', 'id'=>'description', 'placeholder'=>'Enter Product description', 'required'=>false, 'rows'=>5, 'style'=>'resize:none'])); ?>

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
                        <?php echo e(Form::label('cat_id', 'Category:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::select('cat_id',$parent_cats,@$product_detail->cat_id,['id'=>'cat_id','required'=>true, 'class'=>'form-control form-control-sm', 'placeholder'=>'--select any one--'])); ?>

                            <?php $__errorArgs = ['cat_id'];
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

                    <div class="form-group row d-none" id="sub_cat_div">
                        <?php echo e(Form::label('sub_cat_id', 'Child Category:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::select('sub_cat_id',[],@$product_detail->sub_cat_id,['id'=>'sub_cat_id','required'=>false, 'class'=>'form-control form-control-sm', 'placeholder'=>'--select any one--'])); ?>

                            <?php $__errorArgs = ['sub_cat_id'];
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
                        <?php echo e(Form::label('price', 'Price (NPR.):', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::number('price',@$product_detail->price,['min'=> 100, 'class'=>'form-control form-control-sm', 'id'=>'price', 'placeholder'=>'Enter Product price', 'required'=>true])); ?>

                            <?php $__errorArgs = ['price'];
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
                        <?php echo e(Form::label('discount', 'Discount (%):', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::number('discount',@$product_detail->discount,['min'=>0, 'max'=>70, 'class'=>'form-control form-control-sm', 'id'=>'discount', 'placeholder'=>'Enter Product discount', 'required'=>false])); ?>

                            <?php $__errorArgs = ['discount'];
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
                        <?php echo e(Form::label('stock', 'Stock:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::number('stock',@$product_detail->stock,['min'=> 0, 'class'=>'form-control form-control-sm', 'id'=>'stock', 'placeholder'=>'Enter Product stock', 'required'=>false])); ?>

                            <?php $__errorArgs = ['stock'];
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
                        <?php echo e(Form::label('brand', 'Brand Name:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::text('brand',@$product_detail->brand,['min'=>'100', 'class'=>'form-control form-control-sm', 'id'=>'brand', 'placeholder'=>'Enter Product brand', 'required'=>false])); ?>

                            <?php $__errorArgs = ['brand'];
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
                        <?php echo e(Form::label('vendor_id', 'Seller:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::select('vendor_id',$seller_info,@$product_detail->vendor_id,['id'=>'vendor_id','required'=>false, 'class'=>'form-control form-control-sm', 'placeholder'=>'--select any one--'])); ?>

                            <?php $__errorArgs = ['vendor_id'];
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
                        <?php echo e(Form::label('is_featured', 'Is Featured:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::checkbox('is_featured',1,@$product_detail->is_featured,['id'=>'is_featured'])); ?>

                            <?php $__errorArgs = ['is_featured'];
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
                            <?php echo e(Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$product_detail->status,['id'=>'status','required'=>true, 'class'=>'form-control form-control-sm'])); ?>

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
                            <?php echo e(Form::file('image[]', ['id'=>'image','required'=>(isset($product_detail) ? false : true), 'accept'=>'image/*', 'multiple'=>true])); ?>

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
                    </div>
                    <div class="row">
                        <?php if(isset($product_detail)): ?>
                            <?php if($product_detail->images->count() > 0): ?>
                                <?php $__currentLoopData = $product_detail->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(file_exists(public_path().'/uploads/product/Thumb-'.$product_image->image_name)): ?>
                                        <img src="<?php echo e(asset('/uploads/product/Thumb-'.$product_image->image_name)); ?>" alt="" class="img img-thumbnail img-fluid">
                                        <?php echo e(Form::checkbox('del_image[]', $product_image->image_name, false)); ?> Delete
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endif; ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/admin/product/product-form.blade.php ENDPATH**/ ?>