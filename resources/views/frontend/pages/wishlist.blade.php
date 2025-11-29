@extends('frontend.layouts.app')


@section('contents')
    <x-breadcrumb :items="[['label' => 'Home', 'url' => '/'], ['label' => 'Wishlist']]" />

    <div class="container mb-60 mt-60">
        <div class="row">
            <div class="col-xl-12">
                <div class="mb-50">
                    <h1 class="heading-2 mb-10">Your Wishlist</h1>
                    <h6 class="text-body">There are <span class="text-brand">5</span> products in this list</h6>
                </div>
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist mb-0">
                        <thead>
                            <tr class="main-heading">
                            <tr class="main-heading">
                                <th scope="col" colspan="2">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wishlistItems as $item)
                                <tr class="pt-30">
                                    <td class="image product-thumbnail pt-40">
                                        <img src="{{ asset($item->product?->primaryImage?->path) }}" alt="#" />
                                    </td>
                                    <td class="product-des product-name">
                                        <h6 class="mb-10">
                                            <a class="product-name mb-10"
                                                href="{{ route('products.show', $item->product->slug) }}">
                                                {{ $item->product?->name }}
                                            </a>
                                        </h6>
                                        <div class="product-rate-cover">
                                            @php
                                                $rating = $item->product?->rating();
                                                $percent = ($rating / 5) * 100;
                                            @endphp
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: {{ $percent }}%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted">({{ $rating }})</span>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        @php
                                            $price = $item->product?->getEffectivePriceAndStock();
                                        @endphp
                                        <h3 class="text-brand">
                                            {{ config('settings.site_currency_icon') }} {{ $price['price'] }}
                                        </h3>
                                    </td>
                                    <td class=" detail-info" data-title="Stock">
                                        @if ($price['in_stock'])
                                            <span class="stock-status in-stock mb-0">In Stock</span>
                                        @else
                                            <span class="stock-status in-stock mb-0">Out of Stock</span>
                                        @endif
                                    </td>
                                    <td class="action " data-title="Remove">
                                        <form action="{{ route('wishlist.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger delete-btn"
                                                data-name="{{ $item->product->name }}">
                                                Delete
                                            </button>
                                            <a href="{{ route('products.show', ["slug" => $item->product->slug]) }}" class="text-danger ml-3">
                                                Detail
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
