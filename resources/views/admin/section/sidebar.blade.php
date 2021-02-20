<!-- START SIDEBAR-->
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img style="border-radius: 50%" src="{{asset('img/dummy-user.png')}}" width="45px"/>
            </div>
            <div class="admin-info">
                <div class="font-strong">{{Auth::user()->name}}</div>
                <small>{{ucfirst(Auth::user()->role)}}</small></div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="{{route('home')}}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">FEATURES</li>
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-image"></i>
                    <span class="nav-label">Banner Manager</span>
                    <i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{route('banner.create')}}">Banner Add</a>
                    </li>
                    <li>
                        <a href="{{route('banner.index')}}">Banner List</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-sitemap"></i>
                    <span class="nav-label">Category Manager</span>
                    <i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('category.create') }}">Category Add</a>
                    </li>
                    <li>
                        <a href="{{ route('category.index') }}">Category List</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-product-hunt"></i>
                    <span class="nav-label">Product Manager</span>
                    <i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('product.create') }}">Product Add</a>
                    </li>
                    <li>
                        <a href="{{ route('product.index') }}">Product List</a>
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
                        <a href="{{ route('admin-order-list') }}">User Orders</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">Users Manager</span>
                    <i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('user.create') }}">User create</a>
                    </li>
                    <li>
                        <a href="{{ route('admin-list') }}">Admin User</a>
                    </li>
                    <li>
                        <a href="{{ route('seller-list') }}">Seller User</a>
                    </li>
                    <li>
                        <a href="{{ route('user-list') }}">Customer User</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-comments"></i>
                    <span class="nav-label">Reviews Manager</span>
                    <i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('all-reviews') }}">Review List</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-file"></i>
                    <span class="nav-label">Pages Manager</span>
                    <i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('page.index') }}">List Pages</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-gift"></i>
                    <span class="nav-label">Offers Manager</span>
                    <i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('offer.create') }}">Offer Add</a>
                    </li>
                    <li>
                        <a href="{{ route('offer.index') }}">Offer List</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->
