@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Offer Slider</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.offer-sliders.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.offer-sliders.update', $offer_slider) }}" method="post">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{ old('title', $offer_slider->title) }}">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="url">URL</label>
                                <input type="text" class="form-control" name="url" id="url"
                                    value="{{ old('url', $offer_slider->url) }}">
                                <x-input-error :messages="$errors->get('url')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" value="1" name="is_active"
                                        @checked($offer_slider->is_active)>
                                    <span class="form-check-label">Active</span>
                                </label>
                                <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary mt-3" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
