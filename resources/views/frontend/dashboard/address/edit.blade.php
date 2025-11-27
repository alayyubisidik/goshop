@extends('frontend.dashboard.dashboard-app')

@section('dashboard_contents')
    <div class="wsus__shipping_address mb_40">
        <h4>Billing Address
            <a href="{{ route('address.index') }}" class="btn btn-primary">Back</a>
        </h4>
        <div class=" login_form" id="loginform">
            <div class="panel-body">
                <h4>Add New Address</h4>
                <form action="{{ route('address.update', $address) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row mt-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="First Name" name="first_name"
                                    value="{{ old('first_name', $address->first_name) }}">
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Last Name" name="last_name"
                                    value="{{ old('last_name', $address->last_name) }}">
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Phone" name="phone"
                                    value="{{ old('phone', $address->phone) }}">
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Email" name="email"
                                    value="{{ old('email', $address->email) }}">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" placeholder="City" name="city"
                                    value="{{ old('city', $address->city) }}">
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" placeholder="State" name="state"
                                    value="{{ old('state', $address->state) }}">
                                <x-input-error :messages="$errors->get('state')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" placeholder="Zip" name="zip"
                                    value="{{ old('zip', $address->zip) }}">
                                <x-input-error :messages="$errors->get('zip')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="country" class="form-control select2">
                                    @foreach (config('countries') as $country)
                                        <option value="{{ $country }}"
                                            {{ old('country', $address->country) == $country ? 'selected' : '' }}>
                                            {{ $country }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('country')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" placeholder="Address" name="address"
                                    value="{{ old('address', $address->address) }}">
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="is_default" class="form-control">
                                    <option value="">Is Default</option>
                                    <option value="0"
                                        {{ old('is_default', $address->is_default) == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1"
                                        {{ old('is_default', $address->is_default) == 1 ? 'selected' : '' }}>Yes</option>
                                </select>
                                <x-input-error :messages="$errors->get('is_default')" class="mt-2" />
                            </div>
                        </div>


                    </div>
                    <div class="form-group mb-0">
                        <button class="btn btn-md">Save</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
