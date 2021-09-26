<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Room;
use App\Models\Frontend\Order;
use App\Models\Frontend\Rating;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->take(6)->get();

        $all_rooms = Room::all();

        return view('frontend.home', compact('rooms', 'all_rooms'));
    }

    public function category(Request $request, $slug = null)
    {

        $rooms = Room::filter($request)->roomByCategory($slug)->paginate(4);

        $categories = Category::all();

        return view('frontend.pages.category', compact('rooms', 'categories'));
    }

    public function categoryAjax(Request $request, $slug = null)
    {
        $rooms = Room::filter($request)->roomByCategory($slug)->paginate(1);

        $html = view('frontend.pages.category-ajax')->with('rooms', $rooms)->render();

        return response()->json(['success' => true, 'html' => $html]);
    }

    public function room($slug)
    {
        $room = Room::where('slug', $slug)->first();

        $ratings = Rating::where('room_id', $room->id)->get();

        $total_ratings = $ratings->count();

        $rating_avg = $ratings->avg('star');

        return view('frontend.pages.room-detail', compact('room', 'ratings', 'total_ratings', 'rating_avg'));
    }

    function checkUserBooking($orders, $request)
    {
        if ($orders) {
            foreach ($orders as $order) {
                if ($order) {
                    foreach ($order->orderDetails() as $item) {
                        if ($item) {
                            if ($item->room->id === $request->room_id) {
                                return true;
                            }
                        }
                    }
                }
            }
        }

        return false;
    }

    public function rating(Request $request)
    {

        $orders = Order::where('user_id', $request->user_id)->get();

        $check_user_booking = $this->checkUserBooking($orders, $request);

        dd($check_user_booking);

        // Check user was rating
        $check_review_exits = Rating::where($request->only('user_id', 'room_id'))->first();

        if ($check_review_exits) {
            // Update review
            $check_review_exits->update($request->only('star', 'message'));

            return redirect()->back()->with('success', 'Your rating has been updated !');
        } else {
            // Add new review
            $review = Rating::addRating($request);

            if ($review) {
                return redirect()->back()->with('success', 'Your rating  has been added !');
            } else {
                return redirect()->back()->with('error', 'Your rating have a problem !');
            }
        }
    }
}
