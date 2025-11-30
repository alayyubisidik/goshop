@extends('admin.dashboard.setting.index')

@section('settings_content')
    <div class="card-body">
        <h2 class="mb-4">Logo Settings</h2>

        <form action="{{ route('admin.settings.logo.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="col-md-12 " style="margin-bottom: 50px">
                <div class="mb-3">
                    <label class="form-label">Site Logo</label>
                    <div class="img-preview-box">
                        <input type="file" name="site_logo" accept="image/*" class="form-control image-upload" />
                        <img class="img-preview" alt="Logo Preview" src="{{ asset(config('settings.site_logo') ?? '') }}"
                            style="width: 200px; border-radius: 5px; margin-top: 20px; {{ config('settings.site_logo') ?? null ? '' : 'display:none;' }}" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 " style="margin-bottom: 50px">
                <div class="mb-3">
                    <label class="form-label">Site Favicon</label>
                    <div class="img-preview-box">
                        <input type="file" name="site_favicon" accept="image/*" class="form-control image-upload" />
                        <img class="img-preview" alt="Logo Preview" src="{{ asset(config('settings.site_favicon') ?? '') }}"
                            style="width: 200px; border-radius: 5px; margin-top: 20px; {{ config('settings.site_favicon') ?? null ? '' : 'display:none;' }}" />
                    </div>
                </div>
            </div>

            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-primary btn-2 mt-5"> Submit </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.querySelectorAll(".image-upload").forEach(function(input) {
                input.addEventListener("change", function() {
                    const preview = this.closest(".img-preview-box").querySelector(".img-preview");
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
            });

        });
    </script>
@endpush
