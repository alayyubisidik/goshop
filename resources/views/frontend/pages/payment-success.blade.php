@extends('frontend.layouts.app')


@section('contents')
    @php
        $cartSubTotal = 0;
    @endphp

    <x-breadcrumb :items="[['label' => 'Home', 'url' => '/'], ['label' => 'Payment Success']]" />

    <div class="container mb-60 mt-55">
        <div>
            <h1>Payment Success</h1>
            <p>Your payment has been successfully completed</p>
        </div>
    </div>
@endsection
