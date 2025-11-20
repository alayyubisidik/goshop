@extends('vendor.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Profile</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('vendor.store-profile.update', 1) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Logo</label>
                                <div class="image-preview-box">
                                    <input type="file" name="logo" id="logo-upload" accept="image/*"
                                        class="form-control" />
                                    <img id="logo-preview" alt="Logo Preview" src="{{ asset($store?->logo) }}"
                                        style="width: 300px; border-radius: 5px; margin-top: 20px; {{ $store?->logo ? '' : 'display: none;' }}" />
                                </div>
                            </div>
                        </div>

                        <!-- Banner -->
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Banner</label>
                                <div class="image-preview-box">
                                    <input type="file" name="banner" id="banner-upload" accept="image/*"
                                        class="form-control" />
                                    <img id="banner-preview" alt="Logo Preview" src="{{ asset($store?->banner) }}"
                                        style="width: 100%; border-radius: 5px; margin-top: 20px; {{ $store?->logo ? '' : 'display: none;' }}" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 ">
                            <div class="mb-3">
                                <label class="form-label required">Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $store?->name) }}">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Phone</label>
                                <input type="number" class="form-control" name="phone"
                                    value="{{ old('phone', $store?->phone) }}">
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required">Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email', $store?->email) }}">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required">Address</label>
                                <textarea name="address" class="form-control">{{ $store?->address }}</textarea>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required">Short Description</label>
                                <textarea name="short_description" class="form-control">{{ $store?->short_description }}</textarea>
                                <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required">Long Description</label>
                                <textarea name="long_description" id="editor" class="form-control">{{ $store?->long_description }}</textarea>
                                <x-input-error :messages="$errors->get('long_description')" class="mt-2" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fungsi umum untuk preview image
            function previewImage(inputId, previewId) {
                const input = document.getElementById(inputId);
                const preview = document.getElementById(previewId);

                input.addEventListener("change", function() {
                    const file = this.files[0];
                    if (!file) {
                        preview.style.display = "none";
                        preview.src = "";
                        return;
                    }

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

            // Jalankan untuk kedua input
            previewImage("logo-upload", "logo-preview");
            previewImage("banner-upload", "banner-preview");
        });
    </script>
@endpush
