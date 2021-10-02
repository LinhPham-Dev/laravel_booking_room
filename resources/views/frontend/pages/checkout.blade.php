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
            @if (!count($cart->content()) > 0)
            <div class="cart-empty text-center">
                <h3>Your basket is empty! Please choose your room first.</h3>
                <a href="{{ route('user.category') }}" class="btn btn-primary p-2 my-3"><i
                        class="fas fa-arrow-left"></i> Choose Room
                </a>
            </div>
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
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Email Address <sup>*</sup>
                                            </label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') ?? Auth::user()->email }}">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Phone <sup>*</sup>
                                            </label>
                                            <input type="text" value="{{ old('phone') ?? Auth::user()->phone }}"
                                                name="phone" class="form-control">
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Address <sup>*</sup>
                                            </label>
                                            <input type="text" value="{{ old('address') ?? Auth::user()->address }}"
                                                name="address" class="form-control">
                                            @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Depart Date <sup>*</sup>
                                            </label>
                                            <input type="text" name="depart_date" id="depart-date-picker"
                                                class="form-control"
                                                value="{{ old('depart_date') ??  Session::get('depart_date')[0] ?? '' }}">
                                            @error('depart_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Arrive Date <sup>*</sup>
                                            </label>
                                            <input type="text" name="arrive_date" id="arrive-date-picker"
                                                class="form-control"
                                                value="{{ old('arrive_date') ?? Session::get('arrive_date')[0] ?? '' }}">
                                            @error('arrive_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="children">Children<sup>*</sup></label>
                                            <select name="children" id="children" class="form-control">
                                                <option value="children">Children</option>
                                                @foreach (range(0, 10) as $item)
                                                <option
                                                    {{ Session::get('children')[0] ?? old('children') == $item ? 'selected' : '' }}
                                                    value="{{ $item }}">{{ $item }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('children')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="adult">Adult<sup>*</sup></label>
                                            <select name="adult" id="adult" class="form-control">
                                                <option value="adult">Adult</option>
                                                @foreach (range(0, 10) as $item)
                                                <option
                                                    {{ Session::get('adult')[0] ?? old('adult') == $item ? 'selected' : '' }}
                                                    value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @error('adult')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Order note</label>
                                            <textarea id="note" name="note" class="form-control"></textarea>
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
                                        Hours
                                    </div>
                                    <input type="hidden" name="hours" id="hours" value="{{ $hours }}">
                                    <div class="col hours">
                                        {{ $hours }} Hours
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <div class="col" style="text-transform:none;">
                                        <b>SubTotal</b>
                                    </div>
                                    <div class="col second">
                                        ${{ $cart->getTotalAmount() }} /h
                                    </div>
                                </li>
                                <li class="clearfix total">
                                    <div class="col">
                                        <strong>Order Total</strong>
                                    </div>
                                    <div class="col second">
                                        <input type="hidden" name="total_amount" id="total_amount"
                                            value="{{ $cart->getTotalAmount() * $hours }}">
                                        <strong id="total">${{ moneyFormat($cart->getTotalAmount() * $hours) }}</strong>
                                    </div>
                                </li>
                            </ul>
                            <div class="coupon-code">
                                <div class="form-group">
                                    <div class="field-group">
                                        <div class="form-group w-75">
                                            <input type="text" name="coupon_id" class="form-control"
                                                placeholder="Enter your coupon ...">
                                        </div>
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
                                                value="{{ $payment->id }}" {{ $payment->id == 1 ? 'checked' : '' }}>
                                            <label for="payment-{{ $payment->id }}">{{ $payment->name }}</label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="pay-pal my-3">
                                <p class="my-2">Account: sb-wt6bp7807118@business.example.com</p>
                                <div id="paypal-button"></div>
                            </div>
                            <button id="checkout-button" type="submit" class="btn filled-btn p-3">Place Order <i
                                    class="icon-left"></i>
                            </button>
                        </div>
                        <!--End Place Order-->
                    </div>
                </div>
            </form>
            @endif
            @endif
        </div>
    </div>
    <!-- End Container -->
</main>
@endsection

@section('script-option')
<script>
    $(document).ready(function() {
            $('#children').niceSelect('destroy');
            $('#adult').niceSelect('destroy');
            $('select').niceSelect('destroy');

            $(function() {
                $('.pay-pal').hide();

                $("#payment-1").click(function() {
                    $('.pay-pal').hide();
                    $("#checkout-button").show();
                });

                $("#payment-2").click(function() {
                    $('.pay-pal').show();
                    $("#checkout-button").hide();
                });
            });

            // Date Picker
            $(function() {
                var startDepart = moment();
                var startArrive = moment().add(2, "days");

                $("#depart-date-picker").daterangepicker({
                    timePicker: true,
                    singleDatePicker: true,
                    timePickerSeconds: false,
                    startDate: startDepart,
                    locale: {
                        format: "M/DD/Y hh:mm A",
                    },
                });

                $("#arrive-date-picker").daterangepicker({
                    timePicker: true,
                    singleDatePicker: true,
                    timePickerSeconds: false,
                    startDate: startArrive,
                    locale: {
                        format: "M/DD/Y hh:mm A",
                    },
                });
            });
        });
</script>

{{-- Checkout Paypal --}}
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    $('#depart-date-picker').change(function(e) {
            dateChange();
        });

        $('#arrive-date-picker').change(function(e) {
            dateChange();
        });


        function dateChange() {
            const depart_date = $('#depart-date-picker').val();

            const arrive_date = $('#arrive-date-picker').val();

            const url = "{{ route('checkout.change_date') }}";

            const _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    depart_date: depart_date,
                    arrive_date: arrive_date,
                    _token: _token
                },
                success: function(res) {
                    if (res.hours) {
                        $('#hours').val(res.hours);
                        $('.hours').html(res.hours + ' Hours');
                        $('#total_amount').val((parseFloat(res.hours * "{{ $cart->getTotalAmount() }}").toFixed(2)));

                        $('#total').html('$' + (parseFloat(res.hours *
                            "{{ $cart->getTotalAmount() }}").toFixed(2)));
                    }

                }
            });
        }

        paypal.Button.render({
            // Configure environment
            env: 'sandbox',
            client: {
                sandbox: 'Ad4-Hp9VFeiA_XcRBt-cCu136Oc8YE1bJ2UQOk2jhxgwTxW6ma-TvHWq1vph-J-Ih_gYPZKeSqAbrxDX',
                production: 'demo_production_client_id'
            },
            // Customize button (optional)
            locale: 'en_US',
            style: {
                size: 'medium',
                color: 'gold',
                shape: 'pill',
            },

            // Enable Pay Now checkout flow (optional)
            commit: true,

            // Set up a payment
            payment: function(data, actions) {

                // Get total amount

                const total = $('#total_amount').val();

                return actions.payment.create({
                    transactions: [{
                        amount: {
                            total: total,
                            currency: 'USD'
                        }
                    }]
                });
            },
            // Execute the payment
            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function(data) {
                    // Show a confirmation message to the buyer
                    window.alert('Thank you for your purchase!');

                    const name = $('input[name="name"]').val();
                    const email = $('input[name="email"]').val();
                    const phone = $('input[name="phone"]').val();
                    const address = $('input[name="address"]').val();
                    const arrive_date = $('input[name="arrive_date"]').val();
                    const depart_date = $('input[name="depart_date"]').val();
                    const children = $("#children").val();
                    const adult = $('#adult').val();
                    const payment_id = 2;
                    const status = 1;
                    const hours = $('#hours').val();
                    const coupon_id = $('input[name="coupon_id"]').val();
                    const total_amount = $('#total_amount').val();
                    const note = $('#note').val();

                    const url = "{{ route('checkout.handle') }}";

                    const _token = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            'name': name,
                            'email': email,
                            'phone': phone,
                            'address': address,
                            'arrive_date': arrive_date,
                            'depart_date': depart_date,
                            'children': children,
                            'adult': adult,
                            'hours': hours,
                            'note': note,
                            'status': 1,
                            'coupon_id': coupon_id,
                            'payment_id': payment_id,
                            'total_amount': total_amount,
                            _token: _token
                        },
                        success: function(response) {
                            // Redirect route success
                            window.location.replace(response.success);
                        }
                    });
                });
            }
        }, '#paypal-button');
</script>

@endsection
