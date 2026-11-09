<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\SimulatedCardPaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function form(Request $request, Booking $booking)
{
    // Chỉ chủ đơn mới được thanh toán
    abort_unless(
        (int) $booking->user_id === (int) $request->user()->id,
        403
    );

    // Đơn phải đang chờ thanh toán
    if ($booking->status !== 'pending_payment') {
        return redirect()
            ->route('bookings.show', $booking)
            ->with('error', 'Đơn đặt phòng chưa đủ điều kiện thanh toán.');
    }

    // Kiểm tra thời hạn thanh toán
    if (!$booking->expires_at || $booking->expires_at->isPast()) {
        return redirect()
            ->route('bookings.show', $booking)
            ->with('error', 'Đơn đã hết hạn thanh toán. Vui lòng liên hệ lễ tân.');
    }

    return view('client.pay', compact('booking'));
    }
    public function pay(Request $request, Booking $booking, SimulatedCardPaymentService $service)
    {
        abort_unless(
        (int) $booking->user_id === (int) $request->user()->id,
        403
        );
        $data=$request->validate([
            'brand'=>'required|in:VISA,MASTERCARD,JCB',
            'last4'=>'required|digits:4',
            'cardholder'=>'required|string|max:120',
            'scenario'=>'required|in:approved,declined,insufficient_funds',
        ]);
        $payment=$service->pay($booking->id,$request->user()->id,$data['brand'],$data['last4'],$data['cardholder'],$data['scenario']);
        return redirect()->route('bookings.show',$booking)->with($payment->status==='success'?'success':'error',
            $payment->status==='success'?'Thanh toán giả lập thành công!':'Giao dịch giả lập thất bại. Bạn có thể thử lại.');
    }
}
