@extends('frontend.layouts.app')

@section('contents')
    <x-breadcrumb :items="[['label' => 'Home', 'url' => '/'], ['label' => $page->title]]" />

    <div class="page-content pt-50 pb-50">
        <div class="container">
            <div class="row">
                <h1 class="mb-3">{{ $page->title }}</h1>
                <div>{!! $page->content !!}</div>
            </div>
        </div>
    </div>
@endsection
