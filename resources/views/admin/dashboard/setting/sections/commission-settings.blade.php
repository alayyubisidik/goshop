@extends('admin.dashboard.setting.index')

@section('settings_content')
    <div class="card-body">
        <h2 class="mb-4">Commission Settings</h2>

        <form action="{{ route("admin.settings.commission.store") }}" method="post">
            @csrf
            @method('put')
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="form-label">Admin Commission Per Order (%)</div>
                    <input type="number" class="form-control" name="admin_commission" value="{{ config('settings.admin_commission') }}">
                    <x-input-error :messages="$errors->get('admin_commission')" class="mt-2" />
                </div>
            </div>
            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-primary btn-2 mt-5"> Submit </button>
            </div>
        </form>
    </div>
@endsection
