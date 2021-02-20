<!-- Header -->
<header class="header-v4">
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                </div>

                <div class="right-top-bar flex-w h-full">
                    <a href="<?php echo e(route('page-detail', 'help-and-faq')); ?>" class="flex-c-m trans-04 p-lr-25">
                        Help & FAQs
                    </a>

                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('user.profile', auth()->user()->id)); ?>" class="flex-c-m trans-04 p-lr-25">
                            <?php echo e(auth()->user()->name); ?>

                        </a>
                        <a href="<?php echo e(route('user-order-list')); ?>" class="flex-c-m trans-04 p-lr-25">
                            My Orders    
                        </a>
                    <a class="flex-c-m trans-04 p-lr-25" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  href="javascript:;"><i class="fa fa-sign-out"></i> Logout</a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="flex-c-m trans-04 p-lr-25">
                            Register & Login
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="<?php echo e(route('homePage')); ?>" class="logo">
                    <img src="<?php echo e(asset('images/icons/logo-01.png')); ?>" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu">
                            <a href="<?php echo e(route('homePage')); ?>">Home</a>
                        </li>

                        <li>
                            <a href="<?php echo e(route('all-products')); ?>">Shop</a>
                        </li>
                      
                        <?php echo e(getCategoryMenu()); ?>

                        
                        <li class="label1" data-label1="hot">
                            <a href="<?php echo e(route('featured-product')); ?>">Features</a>
                        </li>


                        <li>
                            <a href="<?php echo e(route('page-detail','about-us')); ?>">About</a>
                        </li>

                        <li>
                            <a href="<?php echo e(route('contact-us')); ?>">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <?php
                        $total_product = 0;
                        if(session('cart')){
                            foreach(session('cart') as $cart){
                                $total_product += $cart['quantity'];
                            }   
                        }
                    ?>
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                         data-notify="<?php echo e($total_product); ?>">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>


                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="index.html"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                 data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>


        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        Help & FAQs
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        My Account
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        EN
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        USD
                    </a>
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li>
                <a href="index.html">Home</a>

                <span class="arrow-main-menu-m">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
            </li>

            <li>
                <a href="product.html">Shop</a>
            </li>

            <li>
                <a href="shoping-cart.html" class="label1 rs1" data-label1="hot">Features</a>
            </li>


            <li>
                <a href="about.html">About</a>
            </li>

            <li>
                <a href="contact.html">Contact</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15" method="get" action="<?php echo e(route('search')); ?>">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search..." value="<?php echo e(@request()->search); ?>">
            </form>
        </div>
    </div>
</header><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/home/section/menu.blade.php ENDPATH**/ ?>