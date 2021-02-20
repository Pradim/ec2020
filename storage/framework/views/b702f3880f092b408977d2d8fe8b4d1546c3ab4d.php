<?php $__env->startSection('scripts'); ?>
		<?php if(count($errors) > 0): ?>
	<script type="text/javascript">
		    $('#exampleModalCenter').modal('show');
	</script>
		<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<?php
					$user_info = isset($user_data) ? $user_data->user_info['data'] : null;
					if($user_info){
					$user_info = json_decode($user_info);
					}
				?>
				<h3>User Information</h3>
				<hr>
				<p><strong>Name:</strong> <?php echo e($user_data->name); ?></p> 	
				<p><strong>Email:</strong> <?php echo e($user_data->email); ?></p> 	
				<p><strong>Phone Number:</strong> <?php echo e($user_data->user_info['phone']); ?></p> 	
				<p><strong>Address:</strong> <?php echo e($user_data->user_info['address']); ?></p> 	
				<p><strong>Additional Information</strong> <?php echo e($user_info->about); ?></p> 	
				<p><strong>DOB:</strong> <?php echo e($user_info->dob); ?></p> 	
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
					Update Profile
				</button>
				<!-- Modal -->
				<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index: 1111;">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Update Profile</h5>
							</div>
							<div class="modal-body">
			                    <?php echo e(Form::open(['url'=>route('update.profile', $user_data->id), 'files'=>true, 'class'=>'form'])); ?>

			                    <?php echo method_field('put'); ?>
			                    <div class="form-group row">
			                        <?php echo e(Form::label('name', 'Full Name:', ['class'=>'col-sm-3'])); ?>

			                        <div class="col-sm-9">
			                            <?php echo e(Form::text('name',@$user_data->name,['class'=>'form-control form-control-sm', 'id'=>'name', 'placeholder'=>'Enter User Name...', 'required'=>false])); ?>

			                            <?php $__errorArgs = ['name'];
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
			                        <?php echo e(Form::label('email', 'Email:', ['class'=>'col-sm-3'])); ?>

			                        <div class="col-sm-9">
			                            <?php echo e(Form::email('email',@$user_data->email,['class'=>'form-control form-control-sm', 'id'=>'email', 'placeholder'=>'Enter User Email...', 'required'=>false, 'disabled'=>(isset($user_data) ? true : false)])); ?>

			                            <?php $__errorArgs = ['email'];
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
			                        <?php echo e(Form::label('address', 'Address:', ['class'=>'col-sm-3'])); ?>

			                        <div class="col-sm-9">
			                            <?php echo e(Form::text('address',@$user_data->user_info['address'],['class'=>'form-control form-control-sm', 'id'=>'address', 'placeholder'=>'Enter User address...', 'required'=>false])); ?>

			                            <?php $__errorArgs = ['address'];
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
			                        <?php echo e(Form::label('phone', 'Phone Number:', ['class'=>'col-sm-3'])); ?>

			                        <div class="col-sm-9">
			                            <?php echo e(Form::tel('phone',@$user_data->user_info['phone'],['class'=>'form-control form-control-sm', 'id'=>'phone', 'placeholder'=>'Enter User Phone-number...', 'required'=>false])); ?>

			                            <?php $__errorArgs = ['phone'];
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
			                        <?php echo e(Form::label('data', 'Profile:', ['class'=>'col-sm-3'])); ?>

			                        <div class="col-sm-9">
			                            <?php echo e(Form::textarea('data[about]',@$user_info->about,['class'=>'form-control form-control-sm', 'id'=>'data_about', 'placeholder'=>'Enter your additional information', 'required'=>false,'rows'=>5,'style'=>'resize:none'])); ?>

			                            <?php $__errorArgs = ['data'];
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
			                        <?php echo e(Form::label('data_dob', 'Date of Birth :', ['class'=>'col-sm-3'])); ?>

			                        <div class="col-sm-9">
			                            <?php echo e(Form::date('data[dob]',@$user_info->dob,['class'=>'form-control form-control-sm', 'id'=>'data_dob', 'placeholder'=>'Enter your birth date', 'required'=>false])); ?>

			                            <?php $__errorArgs = ['data_dob'];
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
			                            <?php echo e(Form::file('image', ['id'=>'image','required'=>false, 'accept'=>'image/*'])); ?>

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
			                            <?php if(isset($user_data)): ?>
			                                <?php if(file_exists(public_path().'/uploads/user/Thumb-'.$user_data->image)): ?>
			                                    <img src="<?php echo e(asset('/uploads/user/Thumb-'.$user_data->image)); ?>" alt="" class="img img-thumbnail img-fluid">
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
			</div>
			<div class="col-lg-4">
				<?php if($user_data->user_info['image']): ?>
				<img src="<?php echo e(asset('uploads/user/'.$user_data->user_info->image)); ?>" alt="" width="200px">
				<?php else: ?>
				<img src="<?php echo e(asset('img/dummy-user.png')); ?>" alt="" class="img img-thumbnail" width="100px">
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/user/profile/index.blade.php ENDPATH**/ ?>