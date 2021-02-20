<?php $__env->startSection('content'); ?>
<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                Offered Products
            </h3>
        </div>
            <?php echo $__env->make('home.section.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row isotope-grid">

             <?php if(isset($products) && $products->count() > 0): ?>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?php echo e($items->product_info['cat_id']); ?>">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="<?php echo e(asset('uploads/product/Thumb-').$items->product_info->images[0]->image_name); ?>" alt="IMG-PRODUCT">
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="<?php echo e(route('product-detail', $items->product_info['slug'])); ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        <?php echo e($items->product_info['title']); ?>

                                    </a>

                                    <span class="stext-105 cl3">
                                        <?php
                                            $price = $items->product_info['price'];
                                            if($items->product_info['discount'] > 0){
                                                $price = $price - (($price * $items->product_info['discount'])/100);
                                            }
                                        ?>
                                        NPR. <?php echo e(number_format($price)); ?>

                                        <?php if($items->product_info['discount'] > 0): ?>
                                            <del style="color: #ff0000">NPR. <?php echo e(number_format($items->product_info['price'])); ?></del>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <p>Product Not Found</p>
            <?php endif; ?>


        </div>


    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/home/offered-products.blade.php ENDPATH**/ ?>