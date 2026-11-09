@extends('layouts.app')
@section('title','Đặt phòng của tôi')
@section('content')
<div class="container page-content"><div class="section-head"><div><span class="eyebrow dark">TÀI KHOẢN KHÁCH HÀNG</span><h1>Đặt phòng của tôi</h1></div><a class="button button-dark button-sm" href="{{ route('home') }}">+ Tìm phòng mới</a></div>
<div class="table-wrap"><table><thead><tr><th>Mã đơn</th><th>Nhận phòng</th><th>Trả phòng</th><th>Phòng</th><th>Tổng tiền</th><th>Trạng thái</th><th></th></tr></thead><tbody>
@forelse($bookings as $b)<tr><td><strong>{{ $b->booking_code }}</strong></td><td>{{ $b->check_in_date->format('d/m/Y') }}</td><td>{{ $b->check_out_date->format('d/m/Y') }}</td><td>{{ $b->details->pluck('room.room_number')->join(', ') }}</td><td>{{ number_format($b->total_amount,0,',','.') }}đ</td><td><span class="status status-{{ config('hotel.booking_status.'.$b->status, $b->status) }}">{{ config('hotel.booking_status.'.$b->status, $b->status) }}</span></td><td><a href="{{ route('bookings.show',$b) }}">Chi tiết ↗</a></td></tr>
@empty<tr><td colspan="7">Bạn chưa có đơn đặt phòng.</td></tr>@endforelse</tbody></table></div><div class="pagination">{{ $bookings->links() }}</div></div>
@endsection
