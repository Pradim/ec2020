<?php $__env->startSection('title', 'Offer Form| Admin Ecom530'); ?>
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/datetimepicker/jquery.datetimepicker.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('plugins/datetimepicker/build/jquery.datetimepicker.full.js')); ?>"></script>
    <script>
        $('#start_time').datetimepicker({
            format: 'Y-m-d H:i:s'
        });
        $('#end_time').datetimepicker({
            format: 'Y-m-d H:i:s'
        });

        $('#add_more').click(function(e){
            e.preventDefault();
            let html_to_clone = $('#template').html();
            $('#content').append(html_to_clone);
        });

        function deleteThis(elem){
            let offered_id = $(elem).data('offered_product_id');
            let ajax_req = true;
            if (offered_id == '') {
                ajax_req = false;
            }
            if (ajax_req) {
                $.ajax({
                    url: "<?php echo e(route('delete-offer-product')); ?>",
                    type: "post",
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>",
                        off_prod_id: offered_id
                    },
                    success: function(response){
                        if (typeof(response) != "object") {
                            response = JSON.parse(response);
                        }
                        if (response.success) {
                           $(elem).parent().parent().parent().parent().remove();
                        }
                    }
                });
            }else{
                $(elem).parent().parent().parent().parent().remove();
            }
        }
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Offer <?php echo e(isset($offer_detail) ? 'Update' : 'Add'); ?></div>
                </div>
                <div class="ibox-body">
                    <div class="d-none" id="template"> 
                        <div class="offered_prods">  
                            <div class="form-group row">
                                <?php echo e(Form::label('product_id', 'Product:', ['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::select('product_id[]',$products, null,['required'=>true, 'class'=>'form-control form-control-sm'])); ?>

                                </div>
                            </div> 
                            <div class="form-group row">
                                <?php echo e(Form::label('discount', 'Discount:', ['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::number('discount[]', null,['required'=>true, 'class'=>'form-control form-control-sm'])); ?>

                                </div>
                            </div> 
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="float-right">
                                        <?php echo e(Form::button('<i class="fa fa-trash"></i> Delete', ['class'=>'btn btn-danger btn-sm','type'=>'button','data-offered_product_id'=>'','name'=>'offered_id[]', 'onClick'=>'deleteThis(this)'])); ?>

                                    </div>
                                </div>
                            </div> 
                            <hr>      
                        </div> 
                    </div>
                    <?php if(isset($offer_detail)): ?>
                        <?php echo e(Form::open(['url'=>route('offer.update', $offer_detail->id), 'files'=>true, 'class'=>'form'])); ?>

                        <?php echo method_field('put'); ?>
                    <?php else: ?>
                        <?php echo e(Form::open(['url'=>route('offer.store'), 'files'=>true, 'class'=>'form'])); ?>

                    <?php endif; ?>
                    <div class="form-group row">
                        <?php echo e(Form::label('title', 'Title:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::text('title',@$offer_detail->title,['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter Offer Title', 'required'=>true])); ?>

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
                            <?php echo e(Form::textarea('summary',@$offer_detail->summary,['class'=>'form-control form-control-sm', 'id'=>'summary', 'placeholder'=>'Enter Offer Summary', 'required'=>false, 'style'=>'resize: none;','rows'=>'5'])); ?>

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
                        <?php echo e(Form::label('start_time', 'Offer From:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::text('start_time',@$offer_detail->start_time,['class'=>'form-control form-control-sm', 'id'=>'start_time', 'placeholder'=>'Enter Offer Start Time', 'required'=>true])); ?>

                            <?php $__errorArgs = ['start_time'];
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
                        <?php echo e(Form::label('end_time', 'Offer To:', ['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::text('end_time',@$offer_detail->end_time,['class'=>'form-control form-control-sm', 'id'=>'end_time', 'placeholder'=>'Enter Offer End Time', 'required'=>true])); ?>

                            <?php $__errorArgs = ['end_time'];
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
                            <?php echo e(Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$offer_detail->status,['id'=>'status','required'=>true, 'class'=>'form-control form-control-sm'])); ?>

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
                            <?php echo e(Form::file('image', ['id'=>'image','required'=>(isset($offer_detail) ? false : true), 'accept'=>'image/*'])); ?>

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
                            <?php if(isset($offer_detail)): ?>
                                <?php if(file_exists(public_path().'/uploads/offer/Thumb-'.$offer_detail->image)): ?>
                                    <img src="<?php echo e(asset('/uploads/offer/Thumb-'.$offer_detail->image)); ?>" alt="" class="img img-thumbnail img-fluid">
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <hr>
                    <p>Offered Products</p>
                    <hr>

                    <div id="content">
                        <?php if(isset($offer_detail)): ?>
                            <?php $__currentLoopData = $offer_detail->offeredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offered_prods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="offered_prods">  
                                    <div class="form-group row">
                                        <?php echo e(Form::label('product_id', 'Product:', ['class'=>'col-sm-3'])); ?>

                                        <div class="col-sm-9">
                                            <?php echo e(Form::select('product_id[]',$products, $offered_prods->product_id,['required'=>true, 'class'=>'form-control form-control-sm'])); ?>

                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <?php echo e(Form::label('discount', 'Discount:', ['class'=>'col-sm-3'])); ?>

                                        <div class="col-sm-9">
                                            <?php echo e(Form::number('discount[]', $offered_prods->discount,['required'=>true, 'class'=>'form-control form-control-sm'])); ?>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="float-right">
                                                <?php echo e(Form::button('<i class="fa fa-trash"></i> Delete', ['class'=>'btn btn-danger btn-sm','type'=>'button','data-offered_product_id'=>$offered_prods->id,'name'=>'offered_id[]', 'onClick'=>'deleteThis(this)'])); ?>

                                            </div>
                                        </div>
                                    </div> 
                                </div>   
                                <hr>  
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <a href="javascript:;" id="add_more" class="btn btn-success float-right">
                                <i class="fa fa-plus"></i> Add Product to Offer
                            </a>
                        </div>
                    <hr>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/admin/offer/offer-form.blade.php ENDPATH**/ ?>