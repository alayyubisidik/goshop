@extends('frontend.layouts.app')


@section('contents')
    <div class="container mb-60 mt-60">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h1 class="heading-2 mb-10">Checkout</h1>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are <span class="text-brand">{{ cartCount() }}</span> products in your cart</h6>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8">
                <div class="wsus__shipping_address mb_40">
                    <h4>Billing Address</h4>

                    @if (user()->addresses->count() == 0)
                        <div class="alert alert-warning mt-20">You don't have any address. Please add your address. <a
                                href="{{ route('address.create') }}">Add your address</a>.</div>
                    @endif

                    <div class="row">
                        @foreach (user()->addresses as $address)
                            <div class="col-md-6 col-lg-4 col-xl-4">
                                <div class="wsus__shipping_address_item">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input billing_address" type="radio"
                                            name="billing_address" value="{{ $address->id }}">
                                        <label class="form-check-label" for="inlineRadio1">{{ $address->address }},
                                            {{ $address->city }}, {{ $address->state }}, {{ $address->zip }},
                                            {{ $address->country }}</label>
                                    </div>
                                    <div class="wsus__shipping_mail_address">
                                        <a href="#">{{ $address->email }}</a>
                                        <a href="#">{{ $address->phone }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row mt-30">
                    <form method="post">
                        <div class="ship_detail">
                            <div class="form-group">
                                <div class="chek-form">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input ship_to_different_address" type="checkbox"
                                            name="checkbox" id="differentaddress">
                                        <label class="form-check-label label_info" data-bs-toggle="collapse"
                                            data-target="#collapseAddress" href="#collapseAddress"
                                            aria-controls="collapseAddress" for="differentaddress"><span>Ship to a
                                                different address?</span></label>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseAddress" class="different_address collapse in">
                                <h4>Shipping Details</h4>
                                <div class="row mb-50">
                                    @foreach (user()->addresses as $address)
                                        <div class="col-md-6 col-lg-4 col-xl-4">
                                            <div class="wsus__shipping_address_item">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input shipping_address" type="radio"
                                                        name="shipping_address" value="{{ $address->id }}">
                                                    <label class="form-check-label"
                                                        for="inlineRadio1">{{ $address->address }},
                                                        {{ $address->city }}, {{ $address->state }}, {{ $address->zip }},
                                                        {{ $address->country }}</label>
                                                </div>
                                                <div class="wsus__shipping_mail_address">
                                                    <a href="#">{{ $address->email }}</a>
                                                    <a href="#">{{ $address->phone }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="col-xl-4">
                <div class="wsus__billing_summary">
                    <h4>Billing Summery</h4>
                    @foreach ($groupedCartItems as $key => $cartItems)
                        <h5 class="vendor_name">{{ $cartItems['store']->name }}</h5>
                        <ul class="wsus__billing_product">
                            @foreach ($cartItems['items'] as $cartItem)
                                @php
                                    $price = $cartItem->product->getVariantOrProductPriceAndStock(
                                        $cartItem->variant_id,
                                    );
                                @endphp
                                <li>
                                    <a href="{{ route('products.show', $cartItem->product->slug) }}" class="img">
                                        <img src="{{ asset($cartItem->product?->primaryImage?->path) }}" alt="product"
                                            class="img-fluid w-100">
                                    </a>
                                    <div class="text">
                                        <a style="font-size: 17px; font-weight: 700;"
                                            href="{{ route('products.show', $cartItem->product->slug) }}">
                                            {{ Str::limit($cartItem->product->name, 30) }}
                                        </a>

                                        <span>{{ $cartItem->product?->variants()->where('id', $cartItem->variant_id)->first()?->name ?? '' }}</span>
                                        <h6 style="color: #ff9010">${{ $price['price'] }} x {{ $cartItem->quantity }}</h6>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                    <div class="wsus__total_price">
                        <h4>Shipping Method</h4>
                        <div>
                            @foreach ($shippingMethods as $shippingMethod)
                                <div class="card mb-1">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input shipping_method" type="radio"
                                                name="shipping_method" id="{{ $shippingMethod->id }}"
                                                value="{{ $shippingMethod->id }}">
                                            <label class="form-check-label" for="{{ $shippingMethod->id }}">
                                                {{ $shippingMethod->name }} (${{ $shippingMethod->charge }})
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @php
                            $cartSubTotal = cartTotal();
                            $cartDiscount = cartDiscount();
                        @endphp

                        <h3>Sub Total <span>$ {{ $cartSubTotal }}</span></h3>
                        <p>Shipping Charge <span>$ <span class="shipping_charge">00.00</span></span></p>
                        <p>Discount <span>$ {{ $cartDiscount }}</span></p>
                    </div>

                    <h5>Sub Total <span>$ <span class="grand_total">{{ $cartSubTotal - $cartDiscount }}</span></span></h5>

                    <div class="my-4">
                        <button class="btn w-100 hover-up make-payment-button">Payment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.shipping_method').on('change', function() {
                let id = $(this).val();

                $.ajax({
                    url: "{{ route('checkout.shipping', ':id') }}".replace(':id', id),
                    method: "GET",
                    success: function(response) {
                        $('.shipping_charge').text(response.charge);
                        $('.grand_total').text(response.total);
                    }
                });
            });

            $('.make-payment-button').on('click', function() {
                // check shipping method is selected
                if (!$('.shipping_method:checked').length) {
                    notyf.error('Please select a shipping method');
                    return;
                }

                // check billing address is selected
                if (!$('.billing_address:checked').length) {
                    notyf.error('Please select a billing address');
                    return;
                }

                // if "Ship to different address" is checked, then shipping_address must be selected
                if ($('.ship_to_different_address').is(':checked')) {
                    if (!$('.shipping_address:checked').length) {
                        notyf.error('Please select a shipping address');
                        return;
                    }

                    // ✅ New check: make sure shipping and billing IDs are not the same
                    let billingId = $('.billing_address:checked').val();
                    let shippingId = $('.shipping_address:checked').val();

                    if (billingId === shippingId) {
                        notyf.error('Billing and shipping address cannot be the same');
                        return;
                    }
                }

                // ✅ If all checks passed, proceed with AJAX
                $.ajax({
                    url: "{{ route('checkout.billing-info.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        shipping_method_id: $('.shipping_method:checked').val(),
                        billing_address_id: $('.billing_address:checked').val(),
                        shipping_address_id: $('.ship_to_different_address').is(':checked') ?
                            $('.shipping_address:checked').val() : null
                    },
                    beforeSend: function() {
                        $('.make-payment-button').html('<i class="fa fa-spinner fa-spin"></i>');
                    },
                    success: function(response) {
                        window.location.href = response.redirect_url;
                    },
                    error: function(response) {
                        $('.make-payment-button').html('Payment');
                    },
                });
            });


        });
    </script>
@endpush
