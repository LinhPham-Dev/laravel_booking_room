<?php

namespace App\Models\Frontend;

use App\Helper\CartHelper;
use App\Models\Backend\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'payment_id',
        'coupon_id',
        'note',
        'arrive_date',
        'depart_date',
        'status',
        'total_amount'
    ];


    public function scopeAddOrder($query, $request)
    {
        $cart = new CartHelper;

        $arrive_date = date("Y-m-d H-i-s", strtotime($request->arrive_date));

        $depart_date = date("Y-m-d H-i-s", strtotime($request->depart_date));

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'payment_id' => $request->payment_id,
            'arrive_date' => $arrive_date,
            'depart_date' => $depart_date,
            'coupon_id' => $request->coupon_id,
            'note' => $request->note,
            'total_amount' => $cart->getTotalAmount(),
        ]);

        return $order;
    }

    /**
     * Get all of the orderDetail for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
