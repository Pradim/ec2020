</div>
<!-- BEGIN PAGA BACKDROPS-->
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>
<!-- END PAGA BACKDROPS-->
<!-- CORE PLUGINS-->
<script src="<?php echo e(asset('js/manifest.js')); ?>"></script>
<script src="<?php echo e(asset('js/vendor.js')); ?>"></script>
<script src="<?php echo e(asset('js/admin.js')); ?>"></script>
<!-- CORE SCRIPTS-->

<!-- PAGE LEVEL SCRIPTS-->

<script>
    setTimeout(function(){
        $('.alert').slideUp();
    },3000);
</script>
<?php echo $__env->yieldContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/admin/section/footer.blade.php ENDPATH**/ ?>