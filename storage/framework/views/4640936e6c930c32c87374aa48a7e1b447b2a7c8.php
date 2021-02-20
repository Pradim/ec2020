<!-- START SIDEBAR-->
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img style="border-radius: 50%" src="<?php echo e(asset('img/dummy-user.png')); ?>" width="45px"/>
            </div>
            <div class="admin-info">
                <div class="font-strong"><?php echo e(Auth::user()->name); ?></div>
                <small><?php echo e(ucfirst(Auth::user()->role)); ?></small></div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="<?php echo e(route('home')); ?>"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">FEATURES</li>
            
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-product-hunt"></i>
                    <span class="nav-label">Product Manager</span>
                    <i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="<?php echo e(route('seller.product.create')); ?>">Product Add</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('seller.product.index')); ?>">Product List</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-shopping-cart"></i>
                    <span class="nav-label">Order Manager</span>
                    <i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="<?php echo e(route('seller-order-cart-list')); ?>">Order List</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->
<?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/seller/section/sidebar.blade.php ENDPATH**/ ?>