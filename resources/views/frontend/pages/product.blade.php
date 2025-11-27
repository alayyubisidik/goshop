@extends('frontend.layouts.app')


@section('contents')
    <x-breadcrumb :items="[['label' => 'Home', 'url' => '/'], ['label' => 'Product']]" />

    <div class="container mt-70 mb-60">
        <div class="row">
            {{-- @include('frontend.pages.partials.product-page-sidebar') --}}
            <div class="col-lg-9 col-xxl-10">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{ count($products) }}</strong> products for you!</p>
                    </div>
                </div>
                <div class="row product-grid">
                    @forelse ($products as $product)
                        <x-product-card :product="$product" />
                    @empty
                        <p>No Product Found</p>
                    @endforelse
                </div>
                <!--product grid-->
                <div class="pagination-area">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

