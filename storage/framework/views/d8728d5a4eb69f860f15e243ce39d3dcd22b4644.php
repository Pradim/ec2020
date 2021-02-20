<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <?php echo $__env->yieldContent('meta'); ?>
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/icons/favicon.png')); ?>"/>

    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <!--===============================================================================================-->
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body class="animsition">
<?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/home/section/header.blade.php ENDPATH**/ ?>