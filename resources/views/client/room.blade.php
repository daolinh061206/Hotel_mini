@extends('layouts.app')
@section('title','Phòng '.$room->room_number)
@section('content')
<div class="container page-content"><div class="breadcrumbs"><a href="{{ route('home') }}">Trang chủ</a> / Chi tiết phòng</div>
@php $art = str_contains(strtolower($room->roomType->name),'family') ? 'family.svg' : (str_contains(strtolower($room->roomType->name),'deluxe') ? 'deluxe.svg' : 'standard.svg'); @endphp
<div class="detail-grid"><div><img class="detail-image" src="{{ asset('images/'.$art) }}" alt="Minh họa phòng"><span class="eyebrow dark">PHÒNG {{ $room->room_number }} · TẦNG {{ $room->floor }}</span><h1>{{ $room->roomType->name }} Room</h1><p class="muted">{{ $room->roomType->description }}</p><div class="amenities"><span>♧ Tối đa {{ $room->roomType->capacity }} khách</span><span>⌁ Wi-Fi</span><span>❖ Điều hòa</span><span>◈ Phòng tắm riêng</span></div></div>
<aside class="booking-box"><span class="eyebrow dark">ĐẶT PHÒNG TRỰC TUYẾN</span><h2>{{ number_format($room->roomType->base_price,0,',','.') }}đ <small>/ đêm</small></h2>
@auth
@if(auth()->user()->role?->code === 'CLIENT')
<form method="POST" action="{{ route('bookings.store') }}">@csrf<input type="hidden" name="room_ids[]" value="{{ $room->id }}">
<div class="field"><label>Ngày nhận</label><input type="date" name="check_in" min="{{ date('Y-m-d') }}" required value="{{ old('check_in',request('check_in')) }}"></div>
<div class="field"><label>Ngày trả</label><input type="date" name="check_out" min="{{ date('Y-m-d',strtotime('+1 day')) }}" required value="{{ old('check_out',request('check_out')) }}"></div>
<div class="field"><label>Số khách (tối đa {{ $room->roomType->capacity }})</label><input type="number" name="guest_count" min="1" max="{{ $room->roomType->capacity }}" value="{{ old('guest_count',1) }}" required></div>
<div class="field"><label>Tên liên hệ</label><input name="contact_name" value="{{ old('contact_name',auth()->user()->name) }}" required></div>
<div class="field"><label>Số điện thoại</label><input name="contact_phone" value="{{ old('contact_phone',auth()->user()->phone) }}" required></div>
<button class="button button-gold button-block">Gửi yêu cầu đặt phòng ↗</button><small class="muted">Nhân viên duyệt đơn trước khi khách thanh toán thẻ demo.</small></form>
@else<p>Nhân viên có thể thao tác trong bảng quản trị.</p><a class="button button-dark" href="{{ route('panel.dashboard') }}">Đến trang quản trị</a>@endif
@else<p>Đăng nhập hoặc đăng ký để đặt phòng.</p><a class="button button-gold button-block" href="{{ route('login') }}">Đăng nhập để đặt phòng</a>@endauth
</aside></div></div>
@endsection
