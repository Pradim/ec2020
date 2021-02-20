@include('admin.section.header')
@include('admin.section.top-nav')
@include('seller.section.sidebar')

<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        @include('admin.section.notify')
        @yield('content')
    </div>
    <!-- END PAGE CONTENT-->
    @include('admin.section.copy')
</div>
@include('admin.section.footer')
