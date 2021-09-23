<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\CartHelper;
use App\Models\Backend\Room;

class CartController extends Controller
{

    /**
     * protected $cart;
     * CartHelper $cart
     */

    // protected $cart;

    // public function __construct(CartHelper $cart)
    // {
    //     $cart = $cart;
    // }

    public function show(CartHelper $cart)
    {
        return view('frontend.pages.cart', compact('cart'));
    }

    public function add(Request $request, CartHelper $cart)
    {
        $room = Room::find($request->room_id);

        $child = $request->child;

        $adult = $request->adult;

        $quantity = $request->quantity;

        $cart->add($room, $child, $adult, $quantity);

        return redirect()->route('cart.show')->with('success', 'The room has been added to cart !');

        // return response()->json(['success' => true]);
    }

    public function update($rowId, Request $request, CartHelper $cart)
    {

        $adult    = $request->adult;
        $child    = $request->child;
        $quantity = $request->quantity;

        // Call method update
        $cart->update($rowId, $child, $adult, $quantity);

        return redirect()->back()->with('success', 'The room has been updated !');
    }


    public function remove($rowId, CartHelper $cart)
    {
        $cart->remove($rowId);

        return redirect()->back()->with('success', 'Remove cart item successfully !');
    }

    public function destroy(CartHelper $cart)
    {
        $cart->destroy();

        return redirect()->back()->with('success', 'Remove all item successfully !');
    }
}
