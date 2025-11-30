@extends('frontend.layouts.app')


@section('contents')
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Vendors', 'url' => '/vendors'],
        ['label' => $vendor->name],
    ]" />

    <div class="container mb-30" style="transform: none;">
        <div class="archive-header-3 mt-70 mb-70" style="background-image: url({{ asset($vendor->banner) }})">
            <div class="archive-header-3-inner">
                <div class="vendor-logo mr-50">
                    <img src="{{ asset($vendor->logo) }}" alt="">
                </div>
                <div class="vendor-content">
                    <div class="product-category">
                        <span class="text-muted">Since {{ date('Y', strtotime($vendor->created_at)) }}</span>
                    </div>
                    <h3 class="mb-5 text-white"><a href="vendor-details-1.html" class="text-white">{{ $vendor->name }}</a>
                    </h3>
                    <div class="product-rate-cover mb-15">
                        @php
                            $ratingPercent = $vendor->reviews_avg_rating ? ($vendor->reviews_avg_rating / 5) * 100 : 0;
                        @endphp
                        <div class="product-rate d-inline-block">
                            <div class="product-rating" style="width: {{ $ratingPercent }}%"></div>
                        </div>
                        <span class="font-small ml-5 text-muted">{{ round($vendor->reviews_avg_rating, 2) }}</span>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="vendor-des mb-15">
                                <p class="font-sm text-white" style="color: white">{!! $vendor->short_description !!}</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="vendor-info text-white mb-15">
                                <ul class="font-sm">
                                    <li style="margin-bottom: 5px"><img class="mr-5"
                                            src="{{ asset('assets/frontend/dist/imgs/theme/icons/icon-location.svg') }}"
                                            alt=""><span><strong>Address:</strong></span>
                                        {{ $vendor->address }}</li>
                                    <li style="margin-bottom: 5px"><img class="mr-5"
                                            src="{{ asset('assets/frontend/dist/imgs/theme/icons/icon-contact.svg') }}"
                                            alt=""><span><strong>Call us:</strong></span>
                                        {{ $vendor->phone }}</li>
                                    <li style="margin-bottom: 5px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            style="color: #ff9010" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                            <path d="M3 7l9 6l9 -6" />
                                        </svg>
                                        <span><strong>Email:</strong></span>
                                        {{ $vendor->email }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-60" style="transform: none;">
            @foreach ($vendor->products as $product)
                <x-product-card :product="$product" class="col-6 col-lg-4 col-xl-3 col-xxl-2" />
            @endforeach
        </div>
    </div>
@endsection
