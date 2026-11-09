@extends('layouts.app')
@section('title','Đơn '.$booking->booking_code)
@section('content')
<div class="container page-content"><div class="breadcrumbs"><a href="{{ route('bookings.mine') }}">Đơn đặt của tôi</a> / {{ $booking->booking_code }}</div>
<div class="section-head"><div><span class="eyebrow dark">CHI TIẾT ĐẶT PHÒNG</span><h1>{{ $booking->booking_code }}</h1><p>{{ $booking->contact_name }} · {{ $booking->contact_phone }}</p></div><span class="status status-{{ config('hotel.booking_status.'.$booking->status, $booking->status) }}">{{ config('hotel.booking_status.'.$booking->status, $booking->status) }}</span></div>
<div class="detail-two"><div class="surface-card"><h3>Thông tin lưu trú</h3><dl class="info-list"><div><dt>Ngày nhận</dt><dd>{{ $booking->check_in_date->format('d/m/Y') }}</dd></div><div><dt>Ngày trả</dt><dd>{{ $booking->check_out_date->format('d/m/Y') }}</dd></div><div><dt>Số khách</dt><dd>{{ $booking->guest_count }}</dd></div><div><dt>Đã chọn</dt><dd>@foreach($booking->details as $d)Phòng {{ $d->room->room_number }} · {{ number_format($d->price_per_night,0,',','.') }}đ/đêm<br>@endforeach</dd></div></dl><div class="total-row"><span>Tổng cộng</span><strong>{{ number_format($booking->total_amount,0,',','.') }}đ</strong></div></div>
<div class="surface-card"><h3>Thanh toán và xử lý</h3><p class="muted">Trạng thái: <strong>{{ config('hotel.booking_status.'.$booking->status, $booking->status) }}</strong></p>

@if($booking->status === 'pending_approval')
    <p>
        Đơn đã được gửi. Nhân viên sẽ xem xét và duyệt.
    </p>
@endif

@if($booking->status === 'pending_payment')
    <p>
        Đơn đã được duyệt. Thanh toán trong thời hạn
        cho phép để xác nhận.
    </p>

    <a
        class="button button-gold button-block"
        href="{{ route('payments.form', $booking) }}"
    >
        Thanh toán thẻ giả lập →
    </a>
@endif

@if(in_array($booking->status, ['pending_approval', 'pending_payment']))
    <form
        method="POST"
        action="{{ route('bookings.cancel', $booking) }}"
        onsubmit="return confirm('Bạn muốn hủy đơn chưa thanh toán này?')"
    >
        @csrf

        <button
            type="submit"
            class="button button-outline button-block"
            style="margin-top:12px"
        >
            Hủy đặt phòng
        </button>
    </form>
@endif

@if($booking->payments->count() > 0)
    <hr>
    <h4>Lịch sử giao dịch</h4>

    @foreach($booking->payments as $p)
        <div class="payment-row">
            <span>
                {{ $p->payment_code }}
                <br>
                <small>
                    {{ $p->cardPaymentDetail?->card_brand }}
                    ••••
                    {{ $p->cardPaymentDetail?->card_last4 }}
                </small>
            </span>

            <span class="status">
                {{ config('hotel.payment_status.' . $p->status, $p->status) }}
            </span>
        </div>
    @endforeach
@endif

</div>
</div>
</div>

@endsection

