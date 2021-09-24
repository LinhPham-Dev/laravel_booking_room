<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show()
    {
        $page = 'List Orders';

        $orders = Order::latest()->paginate(5);

        return view('backend.orders.index', compact('orders', 'page'));
    }

    public function detail($id)
    {

        $page = 'Order Detail';

        $order = Order::find($id);

        return view('backend.orders.detail', compact('order', 'page'));
    }

    public function update($id, Request $request)
    {

        $status = $request->status;

        $order_update = Order::find($id);

        if ($status < $order_update->status) {
            return response()->status(500);
        }

        $result = $order_update->update(['status' => $status]);

        if ($result) {
            // Send status class
            $status = orderStatusClassAdmin($status);

            // Response data
            return response()->json(['status' => $status, 'order_id' => $id, 'message' => "Update status order number $id success !"]);
        }
    }
}
