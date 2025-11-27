@extends('frontend.layouts.app')


@section('contents')
    @php
        $cartSubTotal = 0;
    @endphp

    <x-breadcrumb :items="[['label' => 'Home', 'url' => '/'], ['label' => 'Payment Cancel']]" />

    <div class="container mb-60 mt-55">
        <div>
            <h1>Payment Cancel</h1>
        </div>
    </div>
@endsection
