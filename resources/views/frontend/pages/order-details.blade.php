@extends('frontend.layouts.master')

@section('content')

<main>
    <div class="container margin_60">
        <div class="order-complete-page">
            <div class="complete-pane">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Your Order Details.</h4>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-around lh-condensed">
                                <div class="order-details text-center">
                                    <div class="order-title"><b>No.</b></div>
                                    <div class="order-info">#{{ $order->id }}</div>
                                </div>
                                <div class="order-details text-center">
                                    <div class="order-title"><b>Booking Date</b></div>
                                    <div class="order-info">{{ dateComment($order->created_at) }}</div>
                                </div>
                                <div class="order-details text-center">
                                    <div class="order-title"><b>Depart Date</b></div>
                                    <div class="order-info">
                                        {{ dateComment($order->depart_date) }}
                                    </div>
                                </div>
                                <div class="order-details text-center">
                                    <div class="order-title"><b>Arrive Date</b></div>
                                    <div class="order-info">
                                        {{ dateComment($order->arrive_date) }}
                                    </div>
                                </div>
                                <div class="order-details text-center">
                                    <div class="order-title"><b>Hours</b></div>
                                    <div class="order-info">
                                        {{ countHours($order->depart_date, $order->arrive_date) }} Hours
                                    </div>
                                </div>
                                <div class="order-details text-center">
                                    <div class="order-title"><b>Amount Paid</b></div>
                                    <div class="order-info">${{ moneyFormat($order->total_amount) }}</div>
                                </div>
                                <div class="order-details text-center">
                                    <div class="order-title"><b>Payment Method</b></div>
                                    <div class="order-info">{{ $order->payment->name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><strong>Order Details</strong></h4>
                    </div>
                </div>
                @foreach ($order->orderDetails as $order_detail)
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body py-0">
                            <div class="d-flex justify-content-between align-items-center lh-condensed">
                                <div class="order-details text-center">
                                    <div class="product-img d-flex align-items-center">
                                        <img width="150px" class="img-fluid p-2"
                                            src="{{ asset('uploads/rooms/room_avatar/') . '/' . $order_detail->room->image }}"
                                            alt="Card image cap">
                                    </div>
                                </div>
                                <div class="order-details">
                                    <h6 class="my-0">{{ $order_detail->room->name }} x
                                        {{ $order_detail->quantity }}
                                    </h6>
                                </div>
                                <div class="order-info">
                                    <h6 class="my-0">
                                        <b>Price: </b>
                                        ${{ moneyFormat($order_detail->price) }}
                                    </h6>
                                </div>
                                <div class="order-details">
                                    <h6 class="my-0">Total :
                                        ${{ moneyFormat($order_detail->price * $order_detail->quantity) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Container -->
</main>

@endsection
