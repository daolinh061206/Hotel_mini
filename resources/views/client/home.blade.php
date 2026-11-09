@extends('layouts.app')
@section('title','Khám phá phòng')
@section('content')
<section class="hero"><div class="container hero-grid">
  <div class="hero-copy"><span class="eyebrow">KHÁCH SẠN MINI · TRẢI NGHIỆM TỐI GIẢN</span>
    <h1>Một kỳ nghỉ <em>thảnh thơi</em> bắt đầu từ đây.</h1>
    <p>Chọn phòng ưng ý, đặt lịch lưu trú và quản lý đơn đặt của bạn ngay trên website Lotus Stay.</p>
    <div class="hero-points"><span>✧ Phòng tiện nghi</span><span>✧ Giá minh bạch</span><span>✧ Đặt phòng trực tuyến</span></div>
  </div><div class="hero-visual"><div class="hero-window"><div class="window-sun"></div><div class="window-hill"></div></div><div class="hero-bed"><div></div></div><div class="hero-picture">YOUR PERFECT STAY</div><div class="hero-card">✦ &nbsp; A little more comfort<br><strong>Lotus Stay Collection</strong></div></div>
</div></section>
<section class="search-section"><div class="container"><form class="search-card" method="GET" action="{{ route('home') }}">
  <div class="field"><label>Ngày nhận phòng</label><input required type="date" name="check_in" min="{{ date('Y-m-d') }}" value="{{ $search['check_in'] ?? '' }}"></div>
  <div class="field"><label>Ngày trả phòng</label><input required type="date" name="check_out" min="{{ date('Y-m-d',strtotime('+1 day')) }}" value="{{ $search['check_out'] ?? '' }}"></div>
  <div class="field"><label>Số khách</label><input required type="number" name="guests" min="1" max="30" value="{{ $search['guests'] ?? 2 }}"></div>
  <div class="field"><label>Loại phòng</label><select name="type"><option value="">Tất cả loại phòng</option>@foreach($types as $type)<option value="{{ $type->id }}" @selected(($search['type']??'')==$type->id)>{{ $type->name }}</option>@endforeach</select></div>
  <button class="button button-gold search-submit" type="submit">⌕ &nbsp; Tìm phòng trống</button>
</form></div></section>
<section class="section"><div class="container"><div class="section-head"><div><span class="eyebrow dark">PHÒNG NGHỈ</span><h2>Khám phá không gian của bạn</h2><p>{{ $rooms->count() }} phòng phù hợp @if(!empty($search['check_in'])) · {{ $search['check_in'] }} đến {{ $search['check_out'] }} @endif</p></div><a href="{{ route('home') }}" class="inline-link">Xem tất cả phòng ↗</a></div>
@if($rooms->isEmpty())<div class="empty">Không tìm thấy phòng trống phù hợp. Hãy đổi ngày hoặc loại phòng.</div>@else
<div class="rooms-grid">@foreach($rooms as $room)
  @php $art = str_contains(strtolower($room->roomType->name),'family') ? 'family.svg' : (str_contains(strtolower($room->roomType->name),'deluxe') ? 'deluxe.svg' : 'standard.svg'); @endphp
  <article class="room-card"><div class="room-image"><img src="{{ asset('images/'.$art) }}" alt="Minh họa phòng {{ $room->room_number }}"><span class="room-tag">{{ $room->roomType->name }}</span></div>
    <div class="room-body"><div class="room-meta">PHÒNG {{ $room->room_number }} &nbsp;·&nbsp; TẦNG {{ $room->floor }}</div><h3>{{ $room->roomType->name }} Room</h3><div class="room-facts">♧ {{ $room->roomType->capacity }} khách &nbsp;&nbsp; · &nbsp;&nbsp; Wi-Fi miễn phí</div><div class="room-bottom"><div><strong>{{ number_format($room->roomType->base_price,0,',','.') }}đ</strong><small> / đêm</small></div><a class="button button-outline button-sm" href="{{ route('rooms.show',$room) }}">Xem chi tiết ↗</a></div></div>
  </article>@endforeach</div>
@endif</div></section>
<section class="feature-strip"><div class="container features"><div><strong>01</strong><h4>Đặt phòng dễ dàng</h4><p>Tra cứu phòng trống theo ngày lưu trú.</p></div><div><strong>02</strong><h4>Thông tin minh bạch</h4><p>Biết trước giá phòng và số khách tối đa.</p></div><div><strong>03</strong><h4>Theo dõi trực tuyến</h4><p>Kiểm tra duyệt đơn và giao dịch thẻ giả lập.</p></div></div></section>
@endsection
