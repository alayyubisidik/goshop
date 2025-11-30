@extends('admin.dashboard.advertisement-banner.index')


@php
    $bannerFour = $banners['banner_four'] ?? null;
    $bannerFive = $banners['banner_five'] ?? null;
    $bannerSix = $banners['banner_six'] ?? null;
    $bannerSeven = $banners['banner_seven'] ?? null;
@endphp

@section('banner_content')
    <div class="card-body">
        <h2 class="" style="margin-bottom: 1px">Home Banner Section Two</h2>
        <p class="text-muted mb-4">( Under Popular Product Section )</p>

        <div class="card mb-3">
            <div class="card-header">
                <h3>Banner Four</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.advertisement-banner.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="banner_id" value="banner_four">

                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <div class="img-preview-box">
                                    <input type="file" name="image" accept="image/*"
                                        class="form-control image-upload" />
                                    <img class="img-preview" alt="Logo Preview"
                                        src="{{ asset($bannerFour[0]['image'] ?? '') }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; {{ $bannerFour[0]['image'] ?? null ? '' : 'display:none;' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required" for="url">URL</label>
                                <input type="text" class="form-control" name="url" id="url"
                                    value="{{ $bannerFour[0]['url'] ?? '' }}">
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
                <h3>Banner Five</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.advertisement-banner.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="banner_id" value="banner_five">

                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <div class="img-preview-box">
                                    <input type="file" name="image" accept="image/*"
                                        class="form-control image-upload" />
                                    <img class="img-preview" alt="Logo Preview"
                                        src="{{ asset($bannerFive[0]['image'] ?? '') }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; {{ $bannerFive[0]['image'] ?? null ? '' : 'display:none;' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required" for="url">URL</label>
                                <input type="text" class="form-control" name="url" id="url"
                                    value="{{ $bannerFive[0]['url'] ?? '' }}">
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
                <h3>Banner Six</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.advertisement-banner.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="banner_id" value="banner_six">

                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <div class="img-preview-box">
                                    <input type="file" name="image" accept="image/*"
                                        class="form-control image-upload" />
                                    <img class="img-preview" alt="Logo Preview"
                                        src="{{ asset($bannerSix['0']['image'] ?? '') }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; {{ $bannerSix[0]['image'] ?? null ? '' : 'display:none;' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required" for="url">URL</label>
                                <input type="text" class="form-control" name="url" id="url"
                                    value="{{ $bannerSix['0']['url'] ?? '' }}">
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
                <h3>Banner Seven</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.advertisement-banner.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="banner_id" value="banner_seven">

                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <div class="img-preview-box">
                                    <input type="file" name="image" accept="image/*"
                                        class="form-control image-upload" />
                                    <img class="img-preview" alt="Logo Preview"
                                        src="{{ asset($bannerSeven['0']['image'] ?? '') }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; {{ $bannerSeven[0]['image'] ?? null ? '' : 'display:none;' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required" for="url">URL</label>
                                <input type="text" class="form-control" name="url" id="url"
                                    value="{{ $bannerSeven['0']['url'] ?? '' }}">
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
