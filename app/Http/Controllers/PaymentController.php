<?php

namespace App\Http\Controllers;

use AvoRed\Framework\Database\Models\Order;
use Illuminate\Http\Request;
use AvoRed\Framework\Support\Facades\Payment;
use AvoRed\Framework\Support\Facades\Cart;

class PaymentController extends Controller
{
    public function index($order){
        return view('payment.index',
            ['orderId'=>$order]);
    }


    public function place(Request $request){
        $order = Order::find($request->orderId);
        $order->update([
            'payment_option' => $request->get('payment_option'),
        ]);
        Cart::clear();

        return redirect()
            ->route('order.successful', $order->id)
            ->with('success', 'Order Placed Successfully!');
    }
}
