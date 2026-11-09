<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings=Booking::where('user_id',$request->user()->id)->with('details.room.roomType')->latest()->paginate(10);
        return view('client.bookings', compact('bookings'));
    }
    public function show(Request $request, Booking $booking)
    {
        abort_unless((int)$booking->user_id === (int)$request->user()->id,403);
        return view('client.booking_detail', ['booking'=>$booking->load('details.room.roomType','payments.cardPaymentDetail')]);
    }
    public function store(Request $request, BookingService $service)
    {
        $data=$request->validate([
            'room_ids'=>'required|array|min:1|max:10',
            'room_ids.*'=>'required|integer|distinct|exists:rooms,id',
            'check_in'=>'required|date|after_or_equal:today',
            'check_out'=>'required|date|after:check_in',
            'guest_count'=>'required|integer|min:1|max:30',
            'contact_name'=>'required|string|max:120',
            'contact_phone'=>'required|string|max:20',
        ]);
        $booking=$service->createPending($request->user()->id,$data['room_ids'],$data['check_in'],$data['check_out'],
            $data['guest_count'],$data['contact_name'],$data['contact_phone']);
        return redirect()->route('bookings.show',$booking)->with('success','Đã gửi đơn đặt phòng. Chờ nhân viên xác nhận.');
    }
    public function cancel(Request $request, Booking $booking)
    {
        abort_unless((int)$booking->user_id === (int)$request->user()->id,403);
        DB::transaction(function () use ($booking) {
            $row=Booking::whereKey($booking->id)->lockForUpdate()->firstOrFail();
            if (!in_array($row->status,['pending_approval','pending_payment'],true)) {
                throw ValidationException::withMessages(['booking'=>'Chỉ được tự hủy đơn chưa thanh toán.']);
            }
            if ($row->payments()->where('status','success')->exists()) {
                throw ValidationException::withMessages(['booking'=>'Đơn đã thanh toán, liên hệ lễ tân.']);
            }
            $row->update(['status'=>'cancelled','cancelled_at'=>now()]);
        });
        return back()->with('success','Đã hủy đơn thành công.');
    }
}
