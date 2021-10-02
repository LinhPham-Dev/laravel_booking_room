<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.dashboard');
    }

    public function events()
    {
        $events = Order::join('users', 'users.id', '=', 'orders.user_id')
            ->select('users.name as title', 'orders.depart_date as start', 'orders.arrive_date as end')
            ->get();

        foreach ($events as $event) {
            $event->start = date("Y-m-d\TH:i:s", strtotime($event->start));
            $event->end = date("Y-m-d\TH:i:s", strtotime($event->end));
        }

        $events->toArray();

        $pages_array = array(
            array(
                "title" => "Long Event",
                "start" => "2021-07-07",
                "end" => "2021-07-10"
            ),

            array(
                "title" => "Conference",
                "start" => "2021-07-12",
                "end" => "2021-07-15"
            )
        );

        return response()->json(['status' => 'success', 'events' => $events]);
    }
}
