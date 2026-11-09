<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title','Lotus Stay'); ?> · Lotus Stay Hotel</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/hotel.css')); ?>">
</head>
<body>
<header class="topbar"><div class="container nav-wrap">
    <a class="brand" href="<?php echo e(route('home')); ?>"><span class="brand-symbol">✦</span> LOTUS<span class="brand-light">STAY</span><small>HOTEL & COMFORT</small></a>
    <nav class="navlinks" aria-label="Menu chính">
        <a href="<?php echo e(route('home')); ?>">Khám phá phòng</a>
        <?php if(auth()->guard()->check()): ?>
            <?php if(auth()->user()->role?->code === 'CLIENT'): ?><a href="<?php echo e(route('bookings.mine')); ?>">Đặt phòng của tôi</a><?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bookings.view_all')): ?><a href="<?php echo e(route('panel.dashboard')); ?>">Quản trị</a><?php endif; ?>
            <span class="hello">Xin chào, <?php echo e(auth()->user()->name); ?></span>
            <form action="<?php echo e(route('logout')); ?>" method="post"><?php echo csrf_field(); ?><button class="button button-outline button-sm">Đăng xuất</button></form>
        <?php else: ?>
            <a href="<?php echo e(route('login')); ?>">Đăng nhập</a><a class="button button-dark button-sm" href="<?php echo e(route('register')); ?>">Đăng ký</a>
        <?php endif; ?>
    </nav>
</div></header>
<?php if(session('success') || session('error') || $errors->any()): ?>
<div class="container flash-area">
<?php if(session('success')): ?><div class="flash flash-success">✓ <?php echo e(session('success')); ?></div><?php endif; ?>
<?php if(session('error')): ?><div class="flash flash-error"><?php echo e(session('error')); ?></div><?php endif; ?>
<?php if($errors->any()): ?><div class="flash flash-error"><strong>Vui lòng kiểm tra:</strong><ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div><?php endif; ?>
</div><?php endif; ?>
<main><?php echo $__env->yieldContent('content'); ?></main>
<footer class="footer"><div class="container footer-grid"><div><strong>✦ LOTUS STAY</strong><p>Ứng dụng quản lý khách sạn mini · Đồ án Laravel</p></div><div>Đặt phòng dễ dàng · Phân quyền minh bạch · Thanh toán demo an toàn</div></div></footer>
</body></html>
<?php /**PATH C:\xampp\htdocs\hotel-mini\resources\views/layouts/app.blade.php ENDPATH**/ ?>