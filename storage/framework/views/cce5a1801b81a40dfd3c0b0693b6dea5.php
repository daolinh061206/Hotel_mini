<?php $__env->startSection('title','Đơn '.$booking->booking_code); ?>
<?php $__env->startSection('content'); ?>
<div class="container page-content"><div class="breadcrumbs"><a href="<?php echo e(route('bookings.mine')); ?>">Đơn đặt của tôi</a> / <?php echo e($booking->booking_code); ?></div>
<div class="section-head"><div><span class="eyebrow dark">CHI TIẾT ĐẶT PHÒNG</span><h1><?php echo e($booking->booking_code); ?></h1><p><?php echo e($booking->contact_name); ?> · <?php echo e($booking->contact_phone); ?></p></div><span class="status status-<?php echo e(config('hotel.booking_status.'.$booking->status, $booking->status)); ?>"><?php echo e(config('hotel.booking_status.'.$booking->status, $booking->status)); ?></span></div>
<div class="detail-two"><div class="surface-card"><h3>Thông tin lưu trú</h3><dl class="info-list"><div><dt>Ngày nhận</dt><dd><?php echo e($booking->check_in_date->format('d/m/Y')); ?></dd></div><div><dt>Ngày trả</dt><dd><?php echo e($booking->check_out_date->format('d/m/Y')); ?></dd></div><div><dt>Số khách</dt><dd><?php echo e($booking->guest_count); ?></dd></div><div><dt>Đã chọn</dt><dd><?php $__currentLoopData = $booking->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>Phòng <?php echo e($d->room->room_number); ?> · <?php echo e(number_format($d->price_per_night,0,',','.')); ?>đ/đêm<br><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></dd></div></dl><div class="total-row"><span>Tổng cộng</span><strong><?php echo e(number_format($booking->total_amount,0,',','.')); ?>đ</strong></div></div>
<div class="surface-card"><h3>Thanh toán và xử lý</h3><p class="muted">Trạng thái: <strong><?php echo e(config('hotel.booking_status.'.$booking->status, $booking->status)); ?></strong></p>

<?php if($booking->status === 'pending_approval'): ?>
    <p>
        Đơn đã được gửi. Nhân viên sẽ xem xét và duyệt.
    </p>
<?php endif; ?>

<?php if($booking->status === 'pending_payment'): ?>
    <p>
        Đơn đã được duyệt. Thanh toán trong thời hạn
        cho phép để xác nhận.
    </p>

    <a
        class="button button-gold button-block"
        href="<?php echo e(route('payments.form', $booking)); ?>"
    >
        Thanh toán thẻ giả lập →
    </a>
<?php endif; ?>

<?php if(in_array($booking->status, ['pending_approval', 'pending_payment'])): ?>
    <form
        method="POST"
        action="<?php echo e(route('bookings.cancel', $booking)); ?>"
        onsubmit="return confirm('Bạn muốn hủy đơn chưa thanh toán này?')"
    >
        <?php echo csrf_field(); ?>

        <button
            type="submit"
            class="button button-outline button-block"
            style="margin-top:12px"
        >
            Hủy đặt phòng
        </button>
    </form>
<?php endif; ?>

<?php if($booking->payments->count() > 0): ?>
    <hr>
    <h4>Lịch sử giao dịch</h4>

    <?php $__currentLoopData = $booking->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="payment-row">
            <span>
                <?php echo e($p->payment_code); ?>

                <br>
                <small>
                    <?php echo e($p->cardPaymentDetail?->card_brand); ?>

                    ••••
                    <?php echo e($p->cardPaymentDetail?->card_last4); ?>

                </small>
            </span>

            <span class="status">
                <?php echo e(config('hotel.payment_status.' . $p->status, $p->status)); ?>

            </span>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

</div>
</div>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel-mini\resources\views/client/booking_detail.blade.php ENDPATH**/ ?>