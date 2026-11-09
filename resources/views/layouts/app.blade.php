<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Lotus Stay') · Lotus Stay Hotel</title>
    <link rel="stylesheet" href="{{ asset('css/hotel.css') }}">
</head>
<body>
<header class="topbar"><div class="container nav-wrap">
    <a class="brand" href="{{ route('home') }}"><span class="brand-symbol">✦</span> LOTUS<span class="brand-light">STAY</span><small>HOTEL & COMFORT</small></a>
    <nav class="navlinks" aria-label="Menu chính">
        <a href="{{ route('home') }}">Khám phá phòng</a>
        @auth
            @if(auth()->user()->role?->code === 'CLIENT')<a href="{{ route('bookings.mine') }}">Đặt phòng của tôi</a>@endif
            @can('bookings.view_all')<a href="{{ route('panel.dashboard') }}">Quản trị</a>@endcan
            <span class="hello">Xin chào, {{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="post">@csrf<button class="button button-outline button-sm">Đăng xuất</button></form>
        @else
            <a href="{{ route('login') }}">Đăng nhập</a><a class="button button-dark button-sm" href="{{ route('register') }}">Đăng ký</a>
        @endauth
    </nav>
</div></header>
@if(session('success') || session('error') || $errors->any())
<div class="container flash-area">
@if(session('success'))<div class="flash flash-success">✓ {{ session('success') }}</div>@endif
@if(session('error'))<div class="flash flash-error">{{ session('error') }}</div>@endif
@if($errors->any())<div class="flash flash-error"><strong>Vui lòng kiểm tra:</strong><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
</div>@endif
<main>@yield('content')</main>
<footer class="footer"><div class="container footer-grid"><div><strong>✦ LOTUS STAY</strong><p>Ứng dụng quản lý khách sạn mini · Đồ án Laravel</p></div><div>Đặt phòng dễ dàng · Phân quyền minh bạch · Thanh toán demo an toàn</div></div></footer>
</body></html>
