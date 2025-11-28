@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $heroBanner ? 'Update Hero Banner' : 'Create Hero Banner' }}
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.hero-banners.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        {{-- Banner One --}}
                        <div class="col-md-6 mb-4">
                            <div class="mb-3">
                                <label class="form-label">Banner One</label>
                                <div class="image-preview-box">
                                    <input type="file" name="banner_one" id="banner_one" accept="image/*"
                                        class="form-control" />
                                    <x-input-error :messages="$errors->get('banner_one')" class="mt-2" />

                                    {{-- tampilkan preview jika sudah ada --}}
                                    <img id="banner-one-preview" class="img-preview"
                                        src="{{ old('banner_one')
                                                ? asset('storage/' . old('banner_one'))
                                                : ($heroBanner? asset('storage/' . $heroBanner->banner_one) : '') }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; {{ $heroBanner && $heroBanner->banner_one ? '' : 'display:none;' }}" />
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label required" for="title_one">Title One</label>
                                <input type="text" class="form-control" name="title_one" id="title_one"
                                    value="{{ old('title_one', $heroBanner->title_one ?? '') }}">
                                <x-input-error :messages="$errors->get('title_one')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label required" for="btn_url_one">Button URL One</label>
                                <input type="text" class="form-control" name="btn_url_one" id="btn_url_one"
                                    value="{{ old('btn_url_one', $heroBanner->btn_url_one ?? '') }}">
                                <x-input-error :messages="$errors->get('btn_url_one')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Banner Two --}}
                        <div class="col-md-6 mb-4">
                            <div class="mb-3">
                                <label class="form-label">Banner Two</label>
                                <div class="image-preview-box">
                                    <input type="file" name="banner_two" id="banner_two" accept="image/*"
                                        class="form-control" />
                                    <x-input-error :messages="$errors->get('banner_two')" class="mt-2" />

                                    {{-- tampilkan preview jika sudah ada --}}
                                    <img id="banner-two-preview" class="img-preview"
                                        src="{{ old('banner_two')
                                                ? asset('storage/' . old('banner_two'))
                                                : ($heroBanner? asset('storage/' . $heroBanner->banner_two) : '') }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; {{ $heroBanner && $heroBanner->banner_two ? '' : 'display:none;' }}" />
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label required" for="title_two">Title Two</label>
                                <input type="text" class="form-control" name="title_two" id="title_two"
                                    value="{{ old('title_two', $heroBanner->title_two ?? '') }}">
                                <x-input-error :messages="$errors->get('title_two')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label required" for="btn_url_two">Button URL Two</label>
                                <input type="text" class="form-control" name="btn_url_two" id="btn_url_two"
                                    value="{{ old('btn_url_two', $heroBanner->btn_url_two ?? '') }}">
                                <x-input-error :messages="$errors->get('btn_url_two')" class="mt-2" />
                            </div>
                        </div>

                    </div>

                    <div class="card-footer text-end">
                        <button class="btn btn-primary mt-3" type="submit">
                            {{ $heroBanner ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function previewImage(inputId, previewId) {
                const input = document.getElementById(inputId);
                const preview = document.getElementById(previewId);

                input.addEventListener("change", function() {
                    const file = this.files[0];
                    if (!file) return;

                    if (!file.type.startsWith("image/")) {
                        alert("Please select an image file.");
                        this.value = "";
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = "block";
                    };
                    reader.readAsDataURL(file);
                });
            }

            previewImage("banner_one", "banner-one-preview");
            previewImage("banner_two", "banner-two-preview");
        });
    </script>
@endpush
