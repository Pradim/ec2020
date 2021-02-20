<?php $__env->startSection('content'); ?>
<!-- Slider -->
<?php if($banner_data): ?>

    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">
                <?php $__currentLoopData = $banner_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item-slick1">
                        <a href="<?php echo e($banner->link); ?>"><img src="<?php echo e(asset('uploads/banner/Thumb-'.$banner->image)); ?>" class="img img-fluid" width="100%" alt=""></a>    
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>


<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            <?php if($category_data): ?>
                <?php $__currentLoopData = $category_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 col-xl-3 p-b-30 m-lr-auto">
                        <!-- Block1 -->
                        <div class="block1 wrap-pic-w">
                            <img src="<?php echo e(asset('uploads/category/Thumb-'.$cat_info->image)); ?>" alt="IMG-BANNER">

                            <a href="<?php echo e(route('cat-product', $cat_info->slug)); ?>"
                               class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                <div class="block1-txt-child1 flex-col-l">
                                        <span class="block1-name ltext-101 trans-04 p-b-8">
                                            <?php echo e($cat_info->title); ?>

                                        </span>
                                </div>

                                <div class="block1-txt-child2 p-b-4 trans-05">
                                    <div class="block1-link stext-101 cl0 trans-09">
                                        Shop Now
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Offer -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            <?php if($offer_info): ?>
                <?php $__currentLoopData = $offer_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 col-xl-6 p-b-30 m-lr-auto">
                        <!-- Block1 -->
                        <div class="block1 wrap-pic-w">
                            <img src="<?php echo e(asset('uploads/offer/Thumb-'.$offer_data->image)); ?>" alt="IMG-BANNER">

                            <a href="<?php echo e(route('offer-product', $offer_data->slug)); ?>"
                               class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                <div class="block1-txt-child1 flex-col-l">
                                        <span class="block1-name ltext-101 trans-04 p-b-8">
                                            <?php echo e($offer_data->title); ?>

                                        </span>
                                </div>

                                <div class="block1-txt-child2 p-b-4 trans-05">
                                    <div class="block1-link stext-101 cl0 trans-09">
                                        Shop Now
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                Product Overview
            </h3>
        </div>

            <?php echo $__env->make('home.section.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="row isotope-grid">
           <?php echo $__env->make('home._product_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>


    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/home/index.blade.php ENDPATH**/ ?>