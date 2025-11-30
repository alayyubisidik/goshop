@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Social Link</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.social-links.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.social-links.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Icon</label>
                                <div class="image-preview-box">
                                    <input type="file" name="icon" id="social-icon-upload" accept="image/*"
                                        class="form-control" />
                                    <img id="social-icon-preview" class="img-preview" alt="Logo Preview" src=""
                                        style="width: 100px; border-radius: 100%; margin-top: 20px; display: none; background: #ff9010;" />
                                </div>
                                <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="url">URL</label>
                                <input type="text" class="form-control" name="url" id="url">
                                <x-input-error :messages="$errors->get('url')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" value="1" name="is_active">
                                    <span class="form-check-label">Active</span>
                                    <x-input-error :messages="$errors->get('is_active')" class="mt-2" />

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary mt-3" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
