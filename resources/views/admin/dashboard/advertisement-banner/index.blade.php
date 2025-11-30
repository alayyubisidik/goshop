@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="row g-0">
                <div class="col-12 col-md-3 border-end">
                    <div class="card-body">
                        <h4 class="subheader">Advertisement Banner Setting</h4>
                        <div class="list-group list-group-transparent">
                            <a href="{{ route('admin.advertisement-banner.one.index') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center  {{ Route::is('admin.advertisement-banner.one.index') ? 'active' : '' }}">
                                Home Banner Section One</a>
                            <a href="{{ route('admin.advertisement-banner.two.index') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center  {{ Route::is('admin.advertisement-banner.two.index') ? 'active' : '' }}">
                                Home Banner Section Two</a>
                            <a href="{{ route('admin.advertisement-banner.cta.index') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center  {{ Route::is('admin.advertisement-banner.cta.index') ? 'active' : '' }}">
                                CTA Banner</a>
                            <a href="{{ route('admin.advertisement-banner.flash-sale.index') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center  {{ Route::is('admin.advertisement-banner.flash-sale.index') ? 'active' : '' }}">
                                Flash Sale Banner</a>
                            <a href="{{ route('admin.advertisement-banner.product-sidebar.index') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center  {{ Route::is('admin.advertisement-banner.product-sidebar.index') ? 'active' : '' }}">
                                Product Page Sidebar Banner</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9 d-flex flex-column">
                    @yield('banner_content')
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.querySelectorAll(".image-upload").forEach(function(input) {
                input.addEventListener("change", function() {
                    const preview = this.closest("form").querySelector(".img-preview");
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
    

