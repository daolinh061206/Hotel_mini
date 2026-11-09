@extends('layouts.app')
@section('content')
<div class="panel-shell"><aside class="sidebar"><div class="sidebar-label">QUẢN LÝ KHÁCH SẠN</div>
<a href="{{ route('panel.dashboard') }}" @class(['active'=>request()->routeIs('panel.dashboard')])>◫ &nbsp; Tổng quan</a>
<a href="{{ route('panel.bookings.index') }}" @class(['active'=>request()->routeIs('panel.bookings.*')])>▤ &nbsp; Đơn đặt phòng</a>
@can('rooms.manage')<a href="{{ route('panel.rooms.index') }}" @class(['active'=>request()->routeIs('panel.rooms.*')])>▦ &nbsp; Quản lý phòng</a>@endcan
@can('room_types.manage')<a href="{{ route('panel.types.index') }}" @class(['active'=>request()->routeIs('panel.types.*')])>♧ &nbsp; Loại phòng</a>@endcan
@can('users.manage')<a href="{{ route('panel.users.index') }}" @class(['active'=>request()->routeIs('panel.users.*')])>♙ &nbsp; Tài khoản & quyền</a>@endcan
<div class="sidebar-bottom"><div>{{ auth()->user()->name }}</div><small>{{ auth()->user()->role?->name }}</small></div></aside>
<div class="panel-main"><div class="panel-topline"><span>LOTUS STAY / BẢNG QUẢN TRỊ</span><a href="{{ route('home') }}">Xem trang khách hàng ↗</a></div>
@yield('panel-content')</div></div>
@endsection
