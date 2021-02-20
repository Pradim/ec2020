<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">
                    Your Cart
                </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full">
                <?php if(session('cart')): ?>
                    <?php $__currentLoopData = session('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img">
                                <img src="<?php echo e($cart['image']); ?>" alt="IMG">
                            </div>

                            <div class="header-cart-item-txt p-t-8">
                                <a href="<?php echo e($cart['link']); ?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    <?php echo e($cart['title']); ?>

                                </a>

                                <span class="header-cart-item-info">
                                        <?php echo e($cart['quantity']); ?> x <?php echo e($cart['actual_price']); ?>

                                    </span>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ul>

            <div class="w-full">
                    <?php
                        $total_product = 0;
                        $total_amount = 0;
                        if(session('cart')){
                            foreach(session('cart') as $cart){
                                $total_amount += $cart['total_amount'];
                            }   
                        }
                    ?>
                <div class="header-cart-total w-full p-tb-40">
                    Total: NPR. <?php echo e(number_format($total_amount)); ?>

                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <?php if(session('cart')): ?>
                        <a href="<?php echo e(route('view-cart')); ?>"
                           class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            View Cart
                        </a>

                        <a href="<?php echo e(route('checkout')); ?>"
                           class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            Check Out
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/home/section/cart.blade.php ENDPATH**/ ?>