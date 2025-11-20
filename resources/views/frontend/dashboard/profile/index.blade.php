@extends('frontend.dashboard.dashboard-app')

@section('dashboard_contents')
    <div id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
        <div class="card">
            <div class="card-header p-0">
                <h5>Profile Details</h5>
            </div>
            <div class="card-body p-0">
                <p>You can edit your profile details here</p>
                <form method="POST" action="" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group col-md-12 mt-3">
                        <label>Avatar</label>
                        <div class="image-preview-box">
                            <input type="file" name="avatar" id="avatar-upload" accept="image/*" class="form-control" />
                            <img id="avatar-preview" alt="Avatar Preview" src="{{ asset(user()?->avatar) }}"
                                style="width: 200px; border-radius: 5px; margin-top: 20px; {{ user()?->avatar ? '' : 'display: none;' }}" />
                        </div>
                        <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                    </div>

                    <div class="form-group col-md-12 mt-3">
                        <label>Name <span class="required">*</span></label>
                        <input required class="form-control" name="name" type="text"
                            value="{{ old('name', user()->name) }}" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="form-group col-md-12">
                        <label>Email Address <span class="required">*</span></label>
                        <input required class="form-control" name="email" type="email"
                            value="{{ old('email', user()->email) }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-fill-out submit font-weight-bold">Save Change</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card" style="margin-top: 40px;">
            <div class="card-header p-0">
                <h5>Change Password</h5>
            </div>
            <div class="card-body p-0">
                <p>You can change your password here</p>
                <form method="post" action="{{ route('password.update') }}" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row mt-30">
                        <div class="form-group col-md-12">
                            <label>Current Password <span class="required">*</span></label>
                            <input required="" class="form-control" name="current_password" type="password" />
                            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-12">
                            <label>New Password <span class="required">*</span></label>
                            <input required="" class="form-control" name="password" type="password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="form-group col-md-12">
                            <label>Confirm Password <span class="required">*</span></label>
                            <input required="" class="form-control" name="password_confirmation" type="password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit"
                                value="Submit">Save Change</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
