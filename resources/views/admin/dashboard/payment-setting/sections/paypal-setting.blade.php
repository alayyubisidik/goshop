@extends('admin.dashboard.payment-setting.index')

@section('settings_content')
    <div class="card-body">
        <h2 class="mb-4">Paypal Settings</h2>

        <form action="{{ route('admin.paypal-settings.store') }}" method="post">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-label">Paypal Status</div>
                    <select name="paypal_status" class="form-control">
                        <option value="active" {{ config('settings.paypal_status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ config('settings.paypal_status') == 'inactive' ? 'selected' : '' }}>Inactive
                        </option>
                    </select>
                    <x-input-error :messages="$errors->get('paypal_status')" class="mt-2" />
                </div>

                <div class="col-md-6">
                    <div class="form-label">Paypal Mode</div>
                    <select name="paypal_mode" class="form-control">
                        <option value="sandbox" {{ config('settings.paypal_mode') == 'sandbox' ? 'selected' : '' }}>Sandbox</option>
                        <option value="live" {{ config('settings.paypal_mode') == 'live' ? 'selected' : '' }}>Live</option>
                    </select>
                    <x-input-error :messages="$errors->get('paypal_mode')" class="mt-2" />
                </div>

                <div class="col-md-6">
                    <div class="form-label">Paypal Currency</div>
                    <select name="paypal_currency" class="form-control select2">
                        @foreach (config('currencies') as $key => $currency)
                            <option value="{{ $key }}" {{ config('settings.paypal_currency') == $key ? 'selected' : '' }}>
                                {{ $currency }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('paypal_currency')" class="mt-2" />
                </div>

                <div class="col-md-6">
                    <div class="form-label">Paypal Rate</div>
                    <input type="text" class="form-control" name="paypal_rate"
                        value="{{ config('settings.paypal_rate') }}">
                    <x-input-error :messages="$errors->get('paypal_rate')" class="mt-2" />
                </div>
                <div class="col-md-6">
                    <div class="form-label">Paypal Client ID</div>
                    <input type="text" class="form-control" name="paypal_client_id"
                        value="{{ config('settings.paypal_client_id') }}">
                    <x-input-error :messages="$errors->get('paypal_client_id')" class="mt-2" />
                </div>
                <div class="col-md-6">
                    <div class="form-label">Paypal Secret Key</div>
                    <input type="text" class="form-control" name="paypal_secret_key"
                        value="{{ config('settings.paypal_secret_key') }}">
                    <x-input-error :messages="$errors->get('paypal_secret_key')" class="mt-2" />
                </div>
            </div>
            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-primary btn-2 mt-5"> Submit </button>
            </div>
        </form>
    </div>
@endsection
