@extends('frontend.layouts.app')


@section('contents')
    <x-breadcrumb :items="[['label' => 'Home', 'url' => '/'], ['label' => 'Vendors']]" />

    <div class="page-content pt-70">
        <div class="container">
            <div class="row mb-10">
                <div class="col-12">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p>We have <strong class="text-brand">{{ count($vendors) }}</strong> vendors now</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row vendor-grid">
                @foreach ($vendors as $vendor)

                    <div class="col-xxl-3 col-xl-4 col-md-6 col-12">
                        <div class="vendor-wrap mb-40">
                            <div class="vendor-img-action-wrap">
                                <div class="vendor-img">
                                    <a href="vendor-details-1.html">
                                        <img class="default-img" src="{{ $vendor?->store?->logo }}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="vendor-content-wrap">
                                <div class="d-flex justify-content-between align-items-end mb-30">
                                    <div>
                                        <div class="product-category">
                                            <span class="text-muted">Since
                                                {{ date('Y', strtotime($vendor?->store?->created_at)) }}</span>
                                        </div>
                                        <h4 class="mb-5"><a href="vendor-details-1.html">{{ $vendor?->store?->name }}</a>
                                        </h4>
                                        <div class="product-rate-cover">
                                            @php
                                                $ratingPercent = $vendor?->store?->reviews_avg_rating
                                                    ? ($vendor->store->reviews_avg_rating / 5) * 100
                                                    : 0;
                                            @endphp
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: {{ $ratingPercent }}%"></div>
                                            </div>
                                            <span
                                                class="font-small ml-5 text-muted">{{ round($vendor?->store?->reviews_avg_rating, 2) }}</span>
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <span class="font-small total-product">{{ $vendor?->products_count }} products</span>
                                    </div>
                                </div>
                                <div class="vendor-info mb-30">
                                    <ul class="contact-infor text-muted">
                                        <li><img src="assets/imgs/theme/icons/icon-location.svg"
                                                alt=""><strong>Address:
                                            </strong> <span>{{ $vendor?->store?->address }}</span></li>
                                        <li><img src="assets/imgs/theme/icons/icon-contact.svg" alt=""><strong>Call
                                                Us:</strong><span>+{{ $vendor?->store?->phone }}</span></li>
                                    </ul>
                                </div>
                                <a href="{{ route('vendors.show', $vendor) }}" class="btn btn-xs">Visit Store <i
                                        class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination-area">
               {{ $vendors->links() }}
            </div>
        </div>
    </div>
@endsection
