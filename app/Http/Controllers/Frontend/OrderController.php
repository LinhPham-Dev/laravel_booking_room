<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\CartHelper;
use App\Http\Controllers\Controller;
use App\Mail\OrderComplete;
use App\Models\Backend\Payment;
use App\Models\Frontend\Order;
use App\Models\Frontend\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function showCheckoutForm(CartHelper $cart)
    {
        $payments = Payment::all();

        return view('frontend.pages.checkout', compact('payments', 'cart'));
    }

    public function checkout(Request $request)
    {
        $order = Order::addOrder($request);

        if ($order) {

            // Insert order detail
            $order_detail = OrderDetail::addOrderDetail($order->id);

            // new Order
            $new_order = Order::findOrFail($order->id);

            // Send mail success.
            Mail::to($request->email)->send(new OrderComplete($new_order));

            if ($request->payment_id == 2) {
                $route_redirect = route('checkout.complete');

                return response()->json(['success' => $route_redirect]);
            }
            return redirect()->route('checkout.complete');
        } else {
            return redirect()->back()->with('error', 'Checkout failed !');
        }
    }

    public function complete()
    {
        $user_id = Auth::user()->id;

        $order = Order::where('user_id', $user_id)->latest()->first();

        return view('frontend.pages.order-complete', compact('order'));
    }
}
