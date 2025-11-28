@extends('admin.dashboard.layouts.app')


@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Slider</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sliders.update', $slider) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <div class="image-preview-box">
                                    <input type="file" name="image" id="hero-slider-upload" accept="image/*"
                                        class="form-control" />
                                    <img id="hero-slider-preview" class="img-preview" alt="Logo Preview" src="{{ $slider->image ? asset($slider->image) : '' }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; {{ $slider->image ? '' : 'display: none;' }} " />
                                </div>
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="mb-3">
                                <label class="form-label required" for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{ old('title', $slider->title) }}">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label required" for="sub_title">Sub Title</label>
                                <input type="text" class="form-control" name="sub_title" id="sub_title"
                                    value="{{ old('sub_title', $slider->sub_title) }}">
                                <x-input-error :messages="$errors->get('sub_title')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label required" for="btn_url">Button URL</label>
                                <input type="text" class="form-control" name="btn_url" id="btn_url"
                                    value="{{ old('btn_url', $slider->btn_url) }}">
                                <x-input-error :messages="$errors->get('btn_url')" class="mt-2" />
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" value="1" name="is_active"
                                        @checked($slider->is_active)>
                                    <span class="form-check-label">Is Active</span>
                                    <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
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
