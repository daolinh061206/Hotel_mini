<?php $__env->startSection('title','Thanh toán thử nghiệm'); ?>
<?php $__env->startSection('content'); ?>
<div class="auth-bg"><div class="auth-card payment-form"><span class="eyebrow dark">MÔ PHỎNG · KHÔNG THU TIỀN THẬT</span><h1>Thanh toán thẻ demo</h1>
<p class="muted">Đơn <?php echo e($booking->booking_code); ?> · <strong><?php echo e(number_format($booking->total_amount,0,',','.')); ?>đ</strong></p>
<div class="demo-warning">Chỉ nhập tên giả lập, loại thẻ và 4 số cuối. <strong>Không nhập số thẻ thật, CVV, PIN.</strong></div>
<form method="POST" action="<?php echo e(route('payments.pay',$booking)); ?>"><?php echo csrf_field(); ?>
<div class="field"><label>Loại thẻ mô phỏng</label><select name="brand" required><option value="VISA">Visa</option><option value="MASTERCARD">Mastercard</option><option value="JCB">JCB</option></select></div>
<div class="field"><label>Tên chủ thẻ demo</label><input name="cardholder" value="THE THU NGHIEM" required maxlength="120"></div>
<div class="field"><label>4 số cuối (giả)</label><input name="last4" value="4242" inputmode="numeric" pattern="[0-9]{4}" maxlength="4" required></div>
<div class="field"><label>Kết quả cần mô phỏng</label><select name="scenario"><option value="approved">Thành công</option><option value="declined">Thẻ bị từ chối</option><option value="insufficient_funds">Không đủ tiền</option></select></div>
<button class="button button-dark button-block">Thực hiện thanh toán demo →</button></form></div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel-mini\resources\views/client/pay.blade.php ENDPATH**/ ?>