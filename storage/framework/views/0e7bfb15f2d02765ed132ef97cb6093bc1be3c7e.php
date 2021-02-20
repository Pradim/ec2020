<?php $__env->startSection('content'); ?>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('<?php echo e(asset('uploads/page/Thumb-').$page_data->image); ?>');">
	<h2 class="ltext-105 cl0 txt-center">
		<?php echo e($page_data->title); ?>

	</h2>
</section>	


<!-- Content page -->
<section class="bg0 p-t-75 p-b-120">
	<div class="container">
		<div class="row p-b-148">
			<div class="col-md-12 col-lg-12">
				<div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
					<?php echo $page_data->description; ?>

				</div>
			</div>
		</div>
	</div>
</section>	

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/home/page-detail.blade.php ENDPATH**/ ?>