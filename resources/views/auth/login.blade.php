@extends('layouts.app')
@section('title','Đăng nhập')
@section('content')
<div class="auth-bg"><div class="auth-card"><span class="eyebrow dark">CHÀO MỪNG TRỞ LẠI</span><h1>Đăng nhập</h1><p class="muted">Truy cập tài khoản Lotus Stay của bạn.</p>
<form method="POST" action="{{ route('login.submit') }}">@csrf
<div class="field"><label>Email</label><input type="email" name="email" value="{{ old('email') }}" required autofocus></div>
<div class="field"><label>Mật khẩu</label><input type="password" name="password" required></div>
<button class="button button-dark button-block">Đăng nhập ↗</button></form><p class="auth-note">Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a></p></div></div>
@endsection
