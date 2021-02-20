</div>
<!-- BEGIN PAGA BACKDROPS-->
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>
<!-- END PAGA BACKDROPS-->
<!-- CORE PLUGINS-->
<script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{asset('js/admin.js')}}"></script>
<!-- CORE SCRIPTS-->
{{--<script src="assets/js/app.min.js" type="text/javascript"></script>--}}
<!-- PAGE LEVEL SCRIPTS-->
{{--<script src="./assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>--}}
<script>
    setTimeout(function(){
        $('.alert').slideUp();
    },3000);
</script>
@yield('scripts')
</body>

</html>
