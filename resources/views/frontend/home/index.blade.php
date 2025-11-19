@extends('frontend.layouts.app')

@section('contents')
    @include('frontend.home.sections.hero-section')

    @include('frontend.home.sections.top-categories-section')

    @include('frontend.home.sections.featured-banners-section')

    @include('frontend.home.sections.popular-products-section')

    @include('frontend.home.sections.promo-banners-section')

    @include('frontend.home.sections.flash-sale-section')

    @include('frontend.home.sections.category-you-may-like-section')

    @include('frontend.home.sections.cta-section')

    @include('frontend.home.sections.product-highlights-section')
@endsection
