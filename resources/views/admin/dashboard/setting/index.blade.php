@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="row g-0">
                <div class="col-12 col-md-3 border-end">
                    <div class="card-body">
                        <h4 class="subheader">Business settings</h4>
                        <div class="list-group list-group-transparent">
                            <a href="{{ route("admin.settings.index") }}"
                                class="list-group-item list-group-item-action d-flex align-items-center  {{ Route::is("admin.settings.index") ? 'active' : '' }}">
                                General Settings</a>
                            {{-- <a href="{{ route("admin.settings.commission.index") }}"
                                class="list-group-item list-group-item-action d-flex align-items-center  {{ Route::is("admin.settings.commission.index") ? 'active' : '' }}">
                                Commission Settings</a>
                            <a href="{{ route("admin.settings.site.index") }}"
                                class="list-group-item list-group-item-action d-flex align-items-center  {{ Route::is("admin.settings.site.index") ? 'active' : '' }}">
                                Site Settings</a>
                            <a href="{{ route("admin.settings.logo.index") }}"
                                class="list-group-item list-group-item-action d-flex align-items-center  {{ Route::is("admin.settings.logo.index") ? 'active' : '' }}">
                                Logo Settings</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9 d-flex flex-column">
                    @yield('settings_content')
                </div>
            </div>
        </div>
    </div>
@endsection
