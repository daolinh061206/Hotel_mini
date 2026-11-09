@extends('layouts.app')
@section('title','Đăng ký')
@section('content')
<div class="auth-bg"><div class="auth-card"><span class="eyebrow dark">TRỞ THÀNH KHÁCH HÀNG</span><h1>Tạo tài khoản</h1><p class="muted">Dành riêng cho tài khoản khách hàng. Nhân viên do Admin cấp tài khoản.</p>
<form method="POST" action="{{ route('register.submit') }}">@csrf
<div class="field"><label>Họ và tên</label><input name="name" value="{{ old('name') }}" maxlength="120" required></div>
<div class="field"><label>Email</label><input type="email" name="email" value="{{ old('email') }}" required></div>
<div class="field"><label>Số điện thoại</label><input name="phone" value="{{ old('phone') }}" required></div>
<div class="field"><label>Mật khẩu (tối thiểu 8 ký tự)</label><input type="password" name="password" required></div>
<div class="field"><label>Nhập lại mật khẩu</label><input type="password" name="password_confirmation" required></div>
<button class="button button-dark button-block">Tạo tài khoản ↗</button></form><p class="auth-note">Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p></div></div>
@endsection
