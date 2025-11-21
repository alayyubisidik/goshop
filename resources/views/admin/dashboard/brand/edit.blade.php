@extends('admin.dashboard.layouts.app')


@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Brand</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.brands.update', $brand) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Brand Logo</label>
                                <div class="image-preview-box">
                                    <input type="file" name="image" id="brand-logo-upload" accept="image/*"
                                        class="form-control" />
                                    <img id="brand-logo-preview" class="img-preview" alt="Logo Preview" src="{{ asset($brand?->image) }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; {{ $brand?->image ? '' : 'display: none;' }}" />
                                </div>
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name', $brand->name) }}">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" name="status"
                                        @checked($brand->is_active)>
                                    <span class="form-check-label">Active</span>
                                </label>
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
