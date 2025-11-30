@extends('admin.dashboard.advertisement-banner.index')

@php
    $productSidebarBanner = $banners['product_sidebar'] ?? null;
@endphp


@section('banner_content')
    <div class="card-body">
        <h2 class="" style="margin-bottom: 1px">Product Page Sidebar Banner</h2>
        <p class="text-muted mb-4">( On Product Sidebar )</p>

        <div class="card mb-3">
            <div class="card-header">
                <h3>Banner</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.advertisement-banner.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="banner_id" value="product_sidebar">

                    <div class="row ">
                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <div class="img-preview-box">
                                    <input type="file" name="image" accept="image/*"
                                        class="form-control image-upload" />
                                    <img class="img-preview" alt="Logo Preview"
                                        src="{{ asset($productSidebarBanner[0]['image'] ?? '') }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; {{ ($productSidebarBanner[0]['image'] ?? null) ? '' : 'display:none;' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required" for="url">URL</label>
                                <input type="text" class="form-control" name="url" id="url"
                                    value="{{ $productSidebarBanner[0]['url'] ?? '' }}">
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
