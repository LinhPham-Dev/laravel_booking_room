<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Blog;
use App\Models\Backend\BlogCategory;
use App\Models\Backend\Category;
use App\Models\Backend\Comment;
use App\Models\Backend\Room;
use App\Models\Frontend\Order;
use App\Models\Frontend\Rating;
use App\Models\User;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $params = $request->all();

        $all_rooms = Room::select('price')->get()->toArray();

        // Get max and min price
        $max_price = max($all_rooms);

        $max_price = $max_price['price'];

        $min_price = min($all_rooms);

        $min_price = $min_price['price'];

        $rooms = Room::filter($params)->filterPrice()->paginate(4);

        $categories = Category::all();

        return view('frontend.pages.category', compact('rooms', 'categories', 'max_price', 'min_price'));
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

        $ratings = Rating::where('room_id', $room->id)->latest()->get();

        $total_ratings = $ratings->count();

        $rating_avg = $ratings->avg('star');

        return view('frontend.pages.room-detail', compact('room', 'ratings', 'total_ratings', 'rating_avg'));
    }

    function checkUserBooking($orders, $request)
    {
        if ($orders) {
            foreach ($orders as $order) {
                if ($order) {
                    foreach ($order->orderDetails as $item) {
                        if ($item->room_id == $request->room_id) {
                            return true;
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

        // Check user was booking room
        if ($check_user_booking) {
            // Check user was rating
            $check_review_exits = Rating::where($request->only('user_id', 'room_id'))->first();

            if ($check_review_exits) {
                // Update review
                $check_review_exits->update($request->only('star', 'message'));

                // return response()->json(['status' => true, 'message' => 'Your rating has been updated !']);

                return redirect()->back()->with('success', 'Your rating has been updated !');
            } else {
                // Add new review
                $review = Rating::addRating($request);

                if ($review) {
                    // return response()->json(['status' => true, 'message' => 'Your rating  has been added !']);

                    return redirect()->back()->with('success', 'Your rating  has been added !');
                } else {
                    return redirect()->back()->with('error', 'Your rating have a problem !');
                }
            }
        }

        // User wasn't booking room
        return redirect()->back()->with('error', 'You must booking room first to rate !');

        // return response()->json(['status' => false, 'message' => 'You must booking room first to rate']);
    }

    public function sortRating(Request $request)
    {

        $ratings = Rating::sort($request->sort_by)->get();

        $html = view('frontend.pages.sort-ratings')->with('ratings', $ratings)->render();

        return response()->json(['success' => true, 'html' => $html]);
    }

    // Blog method
    public function blog(Request $request)
    {
        $params = $request->all();

        $blogs = Blog::latest()->filter($params)->paginate(4);

        $new_blogs = Blog::latest()->take(3)->get();

        $new_blog_categories = BlogCategory::latest()->take(3)->get();

        return view('frontend.pages.blogs', compact('blogs', 'new_blogs', 'new_blog_categories'));
    }

    // Blog detail method
    public function blogDetail($slug, Request $request)
    {
        $params = $request->all();

        $blog = Blog::where('slug', $slug)->first();

        $comments = $blog->comment()->latest()->get();

        $total_comments = $comments->count();

        $new_blogs = Blog::latest()->take(3)->where('slug', '<>', $slug)->get();

        $new_blog_categories = BlogCategory::latest()->take(3)->get();

        return view('frontend.pages.blog-details', compact('blog', 'new_blogs', 'new_blog_categories', 'comments', 'total_comments'));
    }

    // Comment method
    public function comment()
    {
        // Add new comment
        $comment = Comment::addComment();

        if ($comment) {
            return redirect()->back()->with('success', 'Your rating  has been added !');
        } else {
            return redirect()->back()->with('error', 'Your rating have a problem !');
        }
    }

    public function sortComment(Request $request)
    {
        $comments = Comment::sort($request->sort_by)->get();

        $html = view('frontend.pages.sort-comments')->with('comments', $comments)->render();

        return response()->json(['success' => true, 'html' => $html]);
    }

    public function profile()
    {
        $user = Auth::user();

        return view('frontend.pages.profile', compact('user'));
    }

    public function updateProfile(Request $request, UploadService $uploadService, User $user)
    {
        $user_id = Auth::user()->id;

        $user_update = $user->find($user_id);

        if ($request->hasFile('image_avt')) {
            $category_name = $request->name;

            $file = $request->file('image_avt');

            // Method Upload
            $path = 'uploads/avatars';
            $image_name = $uploadService->uploadImageHandler($file, $category_name, $path);

            // Merge field image -> request
            $request->merge(['avatar' => $image_name]);
        }


        // dd($user_update);

        $user_update = $user_update->update($request->all());

        if ($user_update) {
            return redirect()->back()->with('success', 'Update profile successfully !');
        } else {
            return redirect()->back()->with('success', 'Update profile failed !');
        }
    }
}
