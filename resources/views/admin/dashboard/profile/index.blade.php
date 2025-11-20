@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Profile</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Avatar</label>
                                <div class="image-preview-box">
                                    <input type="file" name="avatar" id="avatar-upload" accept="image/*"
                                        class="form-control" />
                                    <img id="avatar-preview" alt="Avatar Preview" src="{{ asset(user()->avatar) }}"
                                        style="width: 300px; border-radius: 5px; margin-top: 20px; {{ user()->avatar }}" />
                                </div>
                                <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-9 ">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label required">Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name', user()->name) }}">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label required">Email</label>
                                    <input type="text" class="form-control" name="email"
                                        value="{{ old('email', user()->email) }}">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Account</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <h3 class="card-title">Update Password</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('admin.password.update') }}" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row mt-30">

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required">Current Password</label>
                                <input type="password" class="form-control" name="current_password">
                                <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required">New Password</label>
                                <input type="password" class="form-control" name="password">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>

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
