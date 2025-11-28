@extends('admin.dashboard.payment-setting.index')

@section('settings_content')
    <div class="card-body">
        <h2 class="mb-4">Stripe Settings</h2>

        <form action="{{ route('admin.stripe-settings.store') }}" method="post">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-label">Stripe Status</div>
                    <select name="stripe_status" class="form-control">
                        <option value="active" {{ config('settings.stripe_status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ config('settings.stripe_status') == 'inactive' ? 'selected' : '' }}>Inactive
                        </option>
                    </select>
                    <x-input-error :messages="$errors->get('stripe_status')" class="mt-2" />
                </div>

                <div class="col-md-6">
                    <div class="form-label">Stripe Mode</div>
                    <select name="stripe_mode" class="form-control">
                        <option value="sandbox" {{ config('settings.stripe_mode') == 'sandbox' ? 'selected' : '' }}>Sandbox</option>
                        <option value="live" {{ config('settings.stripe_mode') == 'live' ? 'selected' : '' }}>Live</option>
                    </select>
                    <x-input-error :messages="$errors->get('stripe_mode')" class="mt-2" />
                </div>

                <div class="col-md-6">
                    <div class="form-label">Stripe Currency</div>
                    <select name="stripe_currency" class="form-control select2">
                        @foreach (config('currencies') as $key => $currency)
                            <option value="{{ $key }}" {{ config('settings.stripe_currency') == $key ? 'selected' : '' }}>
                                {{ $currency }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('stripe_currency')" class="mt-2" />
                </div>

                <div class="col-md-6">
                    <div class="form-label">Stripe Client ID</div>
                    <input type="text" class="form-control" name="stripe_client_id"
                        value="{{ config('settings.stripe_client_id') }}">
                    <x-input-error :messages="$errors->get('stripe_client_id')" class="mt-2" />
                </div>
                <div class="col-md-6">
                    <div class="form-label">Stripe Secret Key</div>
                    <input type="text" class="form-control" name="stripe_secret_key"
                        value="{{ config('settings.stripe_secret_key') }}">
                    <x-input-error :messages="$errors->get('stripe_secret_key')" class="mt-2" />
                </div>
            </div>
            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-primary btn-2 mt-5"> Submit </button>
            </div>
        </form>
    </div>
@endsection
