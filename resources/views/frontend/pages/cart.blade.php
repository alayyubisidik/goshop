@extends('frontend.layouts.app')


@section('contents')

    @php
        $cartSubTotal = 0;
    @endphp

    <x-breadcrumb :items="[['label' => 'Home', 'url' => '/'], ['label' => 'Cart']]" />

    <div class="container mb-60 mt-55">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h1 class="heading-2 mb-10">Your Cart</h1>
                <div class="d-flex flex-wrap justify-content-between">
                    <h6 class="text-body">There are <span class="text-brand">{{ cartCount() }}</span> products in your cart
                    </h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                            <tr class="main-heading">
                                <th scope="col" colspan="2" class="text-center">Product</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col" class="end">Remove</th>
                            </tr>
                        </thead>
                        <tbody class="cart-item">
                            @forelse ($cartItems as $cartItem)
                                <tr class="pt-30">
                                    <td class="image product-thumbnail pt-40"><img
                                            src="{{ asset($cartItem->product?->primaryImage?->path) }}" alt="#"></td>
                                    <td class="product-des product-name">
                                        <h6 class="mb-5"><a class="product-name mb-10 text-heading"
                                                href="shop-product-right.html">{{ $cartItem->product->name }}</a></h6>
                                        <div class="product-rate-cover">
                                            <span>
                                                {{ $cartItem->product?->variants()->where('id', $cartItem->variant_id)->first()?->name ?? '' }}
                                            </span>
                                        </div>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </td>
                                    @php
                                        $price = $cartItem->product->getVariantOrProductPriceAndStock(
                                            $cartItem->variant_id,
                                        );
                                        $cartSubTotal += $price['price'] * $cartItem->quantity;
                                    @endphp

                                    @if ($price['in_stock'])
                                        <td class="price" data-title="Price">
                                            @if ($price['old_price'])
                                                <h4 class="text-body">Rp.{{ $price['price'] }}</h4>
                                                <h4 class="text-danger"
                                                    style="font-size: 18px;text-decoration: line-through;">
                                                    Rp.{{ $price['old_price'] }}
                                                </h4>
                                            @else
                                                <h4 class="text-body">Rp.{{ $price['price'] }}</h4>
                                            @endif
                                        </td>
                                        <td class="text-center detail-info" data-title="Stock">
                                            <div class="detail-extralink mr-15">
                                                <div class="detail-qty border radius">
                                                    <a href="#" class="qty-down"><i
                                                            class="fi-rs-angle-small-down"></i></a>
                                                    <input data-cart-item="{{ $cartItem->id }}" readonly type="text"
                                                        name="quantity" class="qty-val" value="{{ $cartItem->quantity }}"
                                                        min="1">
                                                    <a href="#" class="qty-up"><i
                                                            class="fi-rs-angle-small-up"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="price" data-title="Price">
                                            <h4 class="text-brand">Rp.{{ $price['price'] * $cartItem->quantity }}</h4>
                                        </td>
                                    @else
                                        <td></td>
                                        <td colspan="2">
                                            <h4 class="text-brand">Out of stock</h4>
                                        </td>
                                    @endif
                                    <td class="action text-center">
                                        <form action="{{ route('cart.destroy', $cartItem->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a type="submit" class=" delete-btn" data-name="{{ $cartItem->name }}">
                                                <i class="fi-rs-trash"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <td class="pt-30">
                                <td colspan="6">Cart is empty</td>
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="divider-2 mb-30"></div>
                <div class="cart-action d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn "><i class="fi-rs-arrow-left mr-10"></i>Continue
                        Shopping</a>
                </div>
            </div>
            <div class="col-lg-4">
                @if (cartCount() > 0)
                    <div class="p-40">
                        <h4 class="mb-10">Apply Coupon</h4>
                        <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</span></p>
                        <form action="#" class="coupon-form">
                            @csrf
                            <div class="d-flex justify-content-between">
                                <input class="font-medium mr-15 coupon" name="coupon_code" placeholder="Enter Your Coupon"
                                    value="{{ session('coupon.code', '') }}">
                                @if (session()->has('coupon'))
                                    <button class="btn bg-danger remove-coupon" type="button"><i
                                            class="fi-rs-cross mr-10"></i>Remove</button>
                                @else
                                    <button class="btn coupon-btn" type="submit"><i
                                            class="fi-rs-label mr-10"></i>Apply</button>
                                @endif
                            </div>
                        </form>
                    </div>
                @endif
                <div class="border p-md-4 cart-totals ml-30">
                    <div class="table-responsive">
                        <table class="table no-border">
                            <tbody>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Subtotal</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end cart-sub-total">Rp.{{ $cartSubTotal }}</h4>
                                    </td>
                                </tr>

                                @if (session()->has('coupon'))
                                    @php
                                        $discount =
                                            session('coupon')['coupon_type'] != 'fixed'
                                                ? $cartSubTotal * (session('coupon')['coupon_value'] / 100)
                                                : session('coupon')['coupon_value'];
                                    @endphp
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Discount <span class="coupon-info">
                                                    @if (session('coupon')['coupon_type'] == 'fixed')
                                                        (fixed)
                                                    @else
                                                        ({{ session('coupon')['coupon_value'] }}%)
                                                    @endif
                                                </span>
                                            </h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-heading text-end discount">Rp. {{ $discount }}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end "><span
                                                    class="total">Rp.{{ $cartSubTotal - $discount }}</span></h4>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted ">Discount <span class="coupon-info"></span></h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-heading text-end discount">Rp.0</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end "><span class="total">Rp.
                                                    {{ $cartSubTotal }}</span></h4>
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                    @if (cartCount() > 0)
                        <a href="" class="btn w-100">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $(document).on('change', '.qty-val', function() {
                $.ajax({
                    url: "{{ route('cart.update') }}",
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        qty: $(this).val(),
                        id: $(this).data('cart-item')
                    },
                    beforeSend: function() {
                        // ... kode saat permintaan dikirim
                    },
                    success: function(response) {
                        $('.cart-item').html(response.html)
                        $('.cart-sub-total').html('Rp.' + response.cart_sub_total)
                    },
                    error: function(xhr, status, error) {
                        let errors = xhr.responseJSON;
                        Object.values(errors).forEach((err) => notyf.error(err));
                    }
                })
            })

            $('.coupon-form').on('submit', function(e) {
                e.preventDefault();
                data = $(this).serialize();

                $.ajax({
                    url: "{{ route('cart.coupon') }}",
                    method: 'POST',
                    data: data,
                    beforeSend: function() {
                        $('.coupon-btn').html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                        );
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        const res = xhr.responseJSON;
                        const message = res?.message || "Something went wrong";
                        notyf.error(message);
                    },
                    complete: function() {
                        $('.coupon-btn').html('<i class="fi-rs-label mr-10"></i>Apply');
                    }
                });
            });

            $('.remove-coupon').on('click', function() {
                $.ajax({
                    url: "{{ route('cart.coupon.destroy') }}",
                    method: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    beforeSend: function() {
                        $('.remove-coupon').html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                        );
                    },
                    success: function(response) {
                        location.reload()
                    },
                    error: function(xhr, status, error) {
                        let errors = xhr.responseJSON;
                        Object.values(errors).forEach((err) => notyf.error(err));
                    },
                    complete: function() {
                        $('.coupon-btn').html('<i class="fi-rs-label mr-10"></i>Apply');
                    }
                });
            });
        })
    </script>
@endpush
