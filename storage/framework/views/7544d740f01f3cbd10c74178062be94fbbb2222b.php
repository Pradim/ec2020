<?php if(session('success')): ?>
    <p class="alert alert-success"><?php echo e(session('success')); ?></p>
<?php endif; ?>
<?php if(session('error')): ?>
    <p class="alert alert-danger"><?php echo e(session('error')); ?></p>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/admin/section/notify.blade.php ENDPATH**/ ?>