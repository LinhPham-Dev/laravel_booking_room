<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Room;
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

        return view('frontend.pages.room-detail', compact('room'));
    }
}
