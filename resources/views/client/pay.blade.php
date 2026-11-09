@extends('layouts.app')
@section('title','Thanh toán thử nghiệm')
@section('content')
<div class="auth-bg"><div class="auth-card payment-form"><span class="eyebrow dark">MÔ PHỎNG · KHÔNG THU TIỀN THẬT</span><h1>Thanh toán thẻ demo</h1>
<p class="muted">Đơn {{ $booking->booking_code }} · <strong>{{ number_format($booking->total_amount,0,',','.') }}đ</strong></p>
<div class="demo-warning">Chỉ nhập tên giả lập, loại thẻ và 4 số cuối. <strong>Không nhập số thẻ thật, CVV, PIN.</strong></div>
<form method="POST" action="{{ route('payments.pay',$booking) }}">@csrf
<div class="field"><label>Loại thẻ mô phỏng</label><select name="brand" required><option value="VISA">Visa</option><option value="MASTERCARD">Mastercard</option><option value="JCB">JCB</option></select></div>
<div class="field"><label>Tên chủ thẻ demo</label><input name="cardholder" value="THE THU NGHIEM" required maxlength="120"></div>
<div class="field"><label>4 số cuối (giả)</label><input name="last4" value="4242" inputmode="numeric" pattern="[0-9]{4}" maxlength="4" required></div>
<div class="field"><label>Kết quả cần mô phỏng</label><select name="scenario"><option value="approved">Thành công</option><option value="declined">Thẻ bị từ chối</option><option value="insufficient_funds">Không đủ tiền</option></select></div>
<button class="button button-dark button-block">Thực hiện thanh toán demo →</button></form></div></div>
@endsection
