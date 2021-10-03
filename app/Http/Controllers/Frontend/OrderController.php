<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\CartHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CheckoutRequest;
use App\Mail\OrderComplete;
use App\Models\Backend\Payment;
use App\Models\Frontend\Order;
use App\Models\Frontend\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function showCheckoutForm(CartHelper $cart)
    {
        $payments = Payment::all();

        $hours = 0;

        if (session('depart_date') && session('arrive_date')) {
            $depart_date = Carbon::create(session('depart_date')[0]);

            $arrive_date = Carbon::create(session('arrive_date')[0]);

            $depart_date->toDateTimeString();

            $arrive_date->toDateTimeString();

            $hours = $arrive_date->diffInHours($depart_date);
        }

        return view('frontend.pages.checkout', compact('payments', 'cart'))->with('hours', $hours);
    }

    public function changeDate(Request $request)
    {
        $depart_date = $request->depart_date;

        $arrive_date = $request->arrive_date;

        if ($arrive_date && $depart_date) {
            $depart_date = Carbon::create($depart_date);

            $arrive_date = Carbon::create($arrive_date);

            $depart_date->toDateTimeString();

            $arrive_date->toDateTimeString();

            $hours = $arrive_date->diffInHours($depart_date);

            return response()->json(['hours' => $hours]);
        }
    }

    public function checkout(CheckoutRequest $request)
    {
        $order = Order::addOrder($request);

        if ($order) {

            // Insert order detail
            OrderDetail::addOrderDetail($order->id);

            // new Order
            $new_order = Order::findOrFail($order->id);

            // Send mail success.
            Mail::to($request->email)->send(new OrderComplete($new_order));

            // Remove session coupon
            $request->session()->forget('coupon');

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

        $depart_date = $order->depart_date;

        $arrive_date = $order->arrive_date;

        $hours = countHours($depart_date, $arrive_date);

        return view('frontend.pages.order-complete', compact('order', 'hours'));
    }

    public function orderHistory()
    {
        $user_id = Auth::user()->id;

        $orders = Order::where('user_id', $user_id)->latest()->get();

        return view('frontend.pages.order-history', compact('orders'));
    }

    public function orderDetails($id)
    {
        $order = Order::find($id);

        return view('frontend.pages.order-details', compact('order'));
    }
}
