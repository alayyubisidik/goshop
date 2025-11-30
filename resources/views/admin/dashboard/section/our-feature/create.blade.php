@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Feature</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.our-features.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.our-features.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Icon</label>
                                <div class="image-preview-box">
                                    <input type="file" name="icon" id="feature-icon-upload" accept="image/*"
                                        class="form-control" />
                                    <img id="feature-icon-preview" class="img-preview" alt="Logo Preview" src=""
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; display: none" />
                                </div>
                                <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="title">Title</label>
                                <input type="text" value="{{ old('title') }}" class="form-control" name="title" id="title">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="subtitle">Sub Title</label>
                                <input type="text" value="{{ old('subtitle') }}" class="form-control" name="subtitle" id="subtitle">
                                <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox"  class="form-check-input" value="1" name="is_active">
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


@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "Choose File", // Default: Choose File
                label_selected: "Change File", // Default: Change File
                no_label: false // Default: false
            });
        });
    </script>
@endpush
