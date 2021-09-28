<?php

use App\Http\Controllers\Backend\CartController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LoginAdminController;
use App\Http\Controllers\Backend\OrderBackendController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LoginUserController;
use Illuminate\Support\Facades\Route;

// *** Admin route *** \\
Route::prefix('admin')->group(function () {

    // *** Login - Register Route *** \\
    Route::get('login', [
        LoginAdminController::class,
        'showLoginForm'
    ])->name('admin.show_login_form');

    // Login
    Route::post('login', [LoginAdminController::class, 'login'])->name('admin.handle_login');

    // Forgot Password
    Route::get('forgot-password', [LoginAdminController::class, 'showFormEnterMail'])->name('admin.forgot_password');

    // Send to email
    Route::post('forgot-password', [LoginAdminController::class, 'sendMailReset'])->name('admin.send_mail_reset');

    // Confirm reset
    Route::get('confirm-reset/{token}', [LoginAdminController::class, 'confirmToken'])->name('admin.confirm_reset');

    // Show form enter new pass
    Route::get('reset-password', [LoginAdminController::class, 'showFormReset'])->name('admin.reset_password');

    // Update password
    Route::post('reset-password', [LoginAdminController::class, 'handleReset'])->name('admin.handle_reset-password');

    // Admin Middleware (Auth::guard('admin')
    Route::middleware(['admin'])->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Route Logout
        Route::get('logout', [LoginAdminController::class, 'logout'])->name('admin.logout');

        // Categories
        Route::resource('categories', CategoryController::class);
        // Categories Trash
        Route::get('trash/categories', [CategoryController::class, 'trash'])->name('categories.trash');
        Route::post('trash/categories', [CategoryController::class, 'trashAction'])->name('categories.action');
        // Rooms
        Route::resource('rooms', RoomController::class)->where(['room', '[0-9]+']);

        // Rooms Trash
        Route::get('trash/rooms', [RoomController::class, 'trash'])->name('rooms.trash')->where(['room', '[a-z]+']);
        Route::post('trash/rooms', [RoomController::class, 'trashAction'])->name('rooms.action');

        // Orders
        Route::prefix('orders')->group(function () {

            Route::get('/show', [OrderBackendController::class, 'show'])->name('backend.order.show');

            Route::get('/detail/{id}', [OrderBackendController::class, 'detail'])->name('backend.order.detail');

            Route::put('/update/{id}', [OrderBackendController::class, 'update'])->name('backend.order.update_status');
        });

        // Users
        Route::prefix('users')->group(function () {
            Route::get('show', [UserController::class, 'show'])->name('backend.user.show');

            Route::put('update-status/{id}', [UserController::class, 'updateStatus'])->name('backend.user.update_status');
        });
    });
});

// *** User route *** \\
// Show register form
Route::get('register', [
    LoginUserController::class,
    'showRegisterForm'
])->name('user.show_register_form');

// Register
Route::post('register', [LoginUserController::class, 'register'])->name('user.handle_register');

Route::get('login', [
    LoginUserController::class,
    'showLoginForm'
])->name('user.show_login_form');

// Login
Route::post('login', [LoginUserController::class, 'login'])->name('user.handle_login');

// Route Logout
Route::get('logout', [LoginUserController::class, 'logout'])->name('user.logout');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('categories/{slug?}', [HomeController::class, 'category'])->name('user.category');

Route::get('categories-ajax', [HomeController::class, 'categoryAjax'])->name('user.category_ajax');

Route::get('rooms/{slug}', [HomeController::class, 'room'])->name('user.room');

// Room Rating
Route::post('/rooms/rating', [HomeController::class, 'rating'])->name('room_rating')->middleware('auth');
Route::get('sort-ratings', [HomeController::class, 'sortRating'])->name('sort_ratings');

// *** Route Cart *** \\
Route::prefix('cart')->group(function () {
    // Show all item
    Route::get('show', [CartController::class, 'show'])->name('cart.show');

    // Add to cart
    Route::post('add', [CartController::class, 'add'])->name('cart.add');

    // Update cart
    Route::put('update/{rowId}', [CartController::class, 'update'])->name('cart.update');

    // Remove cart
    Route::get('remove/{rowId}', [CartController::class, 'remove'])->name('cart.remove');

    // Destroy cart
    Route::get('destroy', [CartController::class, 'destroy'])->name('cart.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('checkout', [OrderController::class, 'showCheckoutForm'])->name('checkout.show');

    Route::post('checkout', [OrderController::class, 'checkout'])->name('checkout.handle');

    Route::get('checkout-complete', [OrderController::class, 'complete'])->name('checkout.complete');

    Route::post('checkout-change-date', [OrderController::class, 'changeDate'])->name('checkout.change_date');
});

// Route 404
Route::fallback(function () {
    return view('frontend.pages.404');
});
