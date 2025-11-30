@extends('admin.dashboard.advertisement-banner.index')

@php
    $bannerOne = $banners['banner_one'] ?? null;
    $bannerTwo = $banners['banner_two'] ?? null;
    $bannerThree = $banners['banner_three'] ?? null;
@endphp


@section('banner_content')
    <div class="card-body">
        <h2 class="" style="margin-bottom: 1px">Home Banner Section One</h2>
        <p class="text-muted mb-4">( Under Top Category Section )</p>

        <div class="card mb-3">
            <div class="card-header">
                <h3>Banner One</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.advertisement-banner.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="banner_id" value="banner_one">

                    <div class="row ">
                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <div class="img-preview-box">
                                    <input type="file" name="image" accept="image/*"
                                        class="form-control image-upload" />
                                    <img class="img-preview" alt="Logo Preview"
                                        src="{{ asset($bannerOne[0]['image'] ?? '') }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; {{ $bannerOne[0]['image'] ?? null ? '' : 'display:none;' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required" for="url">URL</label>
                                <input type="text" class="form-control" name="url" id="url"
                                    value="{{ $bannerOne[0]['url'] ?? '' }}">
                                <x-input-error :messages="$errors->get('url')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <h3>Banner Two</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.advertisement-banner.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="banner_id" value="banner_two">

                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <div class="img-preview-box">
                                    <input type="file" name="image" accept="image/*"
                                        class="form-control image-upload" />
                                    <img class="img-preview" alt="Logo Preview"
                                        src="{{ asset($bannerTwo[0]['image'] ?? '') }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; {{ $bannerTwo[0]['image'] ?? null ? '' : 'display:none;' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required" for="url">URL</label>
                                <input type="text" class="form-control" name="url" id="url"
                                    value="{{ $bannerTwo[0]['url'] ?? '' }}">
                                <x-input-error :messages="$errors->get('url')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <h3>Banner Three</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.advertisement-banner.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="banner_id" value="banner_three">

                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <div class="img-preview-box">
                                    <input type="file" name="image" accept="image/*"
                                        class="form-control image-upload" />
                                    <img class="img-preview" alt="Logo Preview"
                                        src="{{ asset($bannerThree['0']['image'] ?? '') }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; {{ $bannerThree['0']['image'] ?? null ? '' : 'display:none;' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required" for="url">URL</label>
                                <input type="text" class="form-control" name="url" id="url"
                                    value="{{ $bannerThree['0']['url'] ?? '' }}">
                                <x-input-error :messages="$errors->get('url')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>

    </div>
@endsection
