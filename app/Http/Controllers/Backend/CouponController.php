<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'List Coupons';

        $coupons = Coupon::latest()->paginate(3);

        return view('backend.coupons.index', compact('coupons', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'Add New Coupon';

        $random_coupon = Str::random(10);
        $random_coupon = Str::upper($random_coupon);

        return view('backend.coupons.add', compact('page', 'random_coupon'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Coupon $coupon)
    {
        $new_coupon = $coupon->createNewCoupon();

        // Check Result
        return alertInsert($new_coupon, 'coupons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'Update Coupon';

        $coupon_edit = Coupon::find($id);

        $start_time = Carbon::create($coupon_edit->start_time);

        $end_time = Carbon::create($coupon_edit->end_time);

        $start_time = $start_time->format('d/m/Y H:i A');

        $end_time = $end_time->format('d/m/Y H:i A');

        return view('backend.coupons.edit', compact('page', 'coupon_edit', 'start_time', 'end_time'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }

    public function trash()
    {
        $page = 'Coupons Trash';

        $coupons_trash = Coupon::onlyTrashed()->get();

        return view('backend.coupons.trash', compact('page', 'coupons_trash'));
    }

    public function trashAction(Request $request)
    {
        // Action
        $action = $request->action;

        // Get id from request
        $action_id = $request->all();

        // Slice Token and Action
        $action_id = array_slice($action_id, 1, -1);

        // *** Action Restore *** \\
        if ($action === 'restore') {
            if ($action_id) {
                Coupon::withTrashed()->whereIn('id', $action_id)->restore();

                return redirect()->back()->with('success', 'Record recovery successful!');
            } else {
                return redirect()->back()->with('error', 'There aren\'t any records of successful restores!');
            };
            // Success
        } else {
            // *** Action Delete *** \\
            Coupon::withTrashed()->whereIn('id', $action_id)->forceDelete();

            return redirect()->back()->with('success', 'Delete record successfully !');
        }
    }
}
