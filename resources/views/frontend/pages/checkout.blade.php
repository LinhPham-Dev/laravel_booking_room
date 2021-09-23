@extends('frontend.layouts.master')

@section('content')

<main>
    <div class="container margin_60">
        <div class="checkout-page">
            @if (!Auth::check())
            <ul class="default-links">
                <li>You need login to checkout !<a href="#">Click here to login.</a>
                </li>
            </ul>
            @else
            <form action="{{ route('checkout.handle') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <div class="billing-details">
                            <div class="shop-form">
                                <form method="post">
                                    <div class="default-title">
                                        <h2>Billing Details</h2>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Full name <sup>*</sup>
                                            </label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name') ?? Auth::user()->name }}">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Email Address <sup>*</sup>
                                            </label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') ?? Auth::user()->email }}">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Phone <sup>*</sup>
                                            </label>
                                            <input type="text" name="phone" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Address <sup>*</sup>
                                            </label>
                                            <input type="text" name="address" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Arrive Date <sup>*</sup>
                                            </label>
                                            <input type="text" name="arrive_date" id="arrive-date-picker"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Depart Date <sup>*</sup>
                                            </label>
                                            <input type="text" name="depart_date" id="depart-date-picker"
                                                class="form-control">
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Order note</label>
                                            <textarea name="note" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--End Billing Details-->
                    </div>
                    <!--End Col-->
                    <div class="col-lg-5">
                        <div class="your-order">
                            <div class="default-title">
                                <h2>Your Order</h2>
                            </div>
                            <ul class="orders-table">
                                <li class="table-header clearfix">
                                    <div class="col">
                                        <strong>Service</strong>
                                    </div>
                                    <div class="col">
                                        <strong>Total</strong>
                                    </div>
                                </li>
                                @foreach ($cart->content() as $item)
                                <li class="clearfix">
                                    <div class="col" style="text-transform:none;">
                                        <img src="{{ asset('uploads/rooms/room_avatar') . '/' . $item['image'] }}"
                                            width="50" height="50" alt="Room images"><span>{{ $item['name'] }}
                                            x
                                            {{ $item['quantity'] }}</span>
                                    </div>
                                    <div class="col second">
                                        ${{ $item['price'] * $item['quantity'] }}
                                    </div>
                                </li>
                                @endforeach
                                <li class="clearfix">
                                    <div class="col" style="text-transform:none;">
                                        WiFi
                                    </div>
                                    <div class="col second">
                                        free
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <div class="col" style="text-transform:none;">
                                        Massage
                                    </div>
                                    <div class="col second">
                                        $20.50
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <div class="col" style="text-transform:none;">
                                        <b>SubTotal</b>
                                    </div>
                                    <div class="col second">
                                        ${{ $cart->getTotalAmount() }}
                                    </div>
                                </li>
                                <li class="clearfix total">
                                    <div class="col">
                                        <strong>Order Total</strong>
                                    </div>
                                    <div class="col second">
                                        <strong>${{ $cart->getTotalAmount() }}</strong>
                                    </div>
                                </li>
                            </ul>
                            <div class="coupon-code">
                                <div class="form-group">
                                    <div class="field-group">
                                        <select name="coupon_id" class="form-control">
                                            @foreach (range(1,5) as $coupon)
                                            <option value="{{ $coupon }}">{{ $coupon }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="field-group btn-field">
                                        <button type="submit" class="btn filled-btn">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Your Order-->
                        <div class="place-order">
                            <div class="default-title">
                                <h2>Payment Method</h2>
                            </div>
                            <div class="payment-options">
                                <ul>
                                    @foreach ($payments as $payment)
                                    <li>
                                        <div class="radio-option">
                                            <input type="radio" name="payment_id" id="payment-{{ $payment->id }}"
                                                value="{{ $payment->id }}">
                                            <label for="payment-{{ $payment->id }}">{{ $payment->name }}</label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <button type="submit" class="btn filled-btn p-3">Place Order <i class="icon-left"></i>
                            </button>
                        </div>
                        <!--End Place Order-->
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
    <!-- End Container -->
    <!-- Chat popup -->
    <div class="chat-popup">
        <div class="page-content page-container" id="page-content">
            <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Chat Messages</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool remove-popup" data-close="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="direct-chat-messages">
                        <div class="direct-chat-msg">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-left">Alexander</span> <span
                                    class="direct-chat-timestamp pull-right">23 Jan
                                    2:00
                                    pm</span>
                            </div> <img class="direct-chat-img"
                                src="https://img.icons8.com/color/36/000000/administrator-male.png"
                                alt="message user image">
                            <div class="direct-chat-text"> For what reason would it be advisable for me
                                to think
                                about business content? </div>
                        </div>
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-right">Sarah
                                    Bullock</span>
                                <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                            </div> <img class="direct-chat-img"
                                src="https://img.icons8.com/office/36/000000/person-female.png"
                                alt="message user image">
                            <div class="direct-chat-text"> Thank you for your believe in our supports
                            </div>
                        </div>
                        <div class="direct-chat-msg">
                            <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-left">Timona
                                    Siera</span> <span class="direct-chat-timestamp pull-right">23 Jan
                                    5:37
                                    pm</span> </div> <img class="direct-chat-img"
                                src="https://img.icons8.com/color/36/000000/administrator-male.png"
                                alt="message user image">
                            <div class="direct-chat-text"> For what reason would it be advisable for me
                                to think
                                about business content? </div>
                        </div>
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-right">Sarah
                                    Bullock</span> <span class="direct-chat-timestamp pull-left">23 Jan
                                    6:10
                                    pm</span> </div> <img class="direct-chat-img"
                                src="https://img.icons8.com/office/36/000000/person-female.png"
                                alt="message user image">
                            <div class="direct-chat-text"> I would love to. </div>
                        </div>

                        <div class="direct-chat-msg right">
                            <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-right">Sarah
                                    Bullock</span> <span class="direct-chat-timestamp pull-left">23 Jan
                                    6:10
                                    pm</span> </div> <img class="direct-chat-img"
                                src="https://img.icons8.com/office/36/000000/person-female.png"
                                alt="message user image">
                            <div class="direct-chat-text"> Thanks a lot. </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer my-2">
                    <form action="#" method="post">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                            <span class="input-group-btn">
                                <button type="submit" class="btn filled-btn px-2 py-1 ml-3">Send</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script-option')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
    $(function() {
            $('#arrive-date-picker').daterangepicker({
                timePicker: true,
                "singleDatePicker": true,
                "timePickerSeconds": false,
                locale: {
                    format: 'M/DD/Y hh:mm A'
                }
            });
            $('#depart-date-picker').daterangepicker({
                timePicker: true,
                "singleDatePicker": true,
                "timePickerSeconds": false,
                locale: {
                    format: 'M/DD/Y hh:mm A'
                }
            });
        });
</script>

@endsection
