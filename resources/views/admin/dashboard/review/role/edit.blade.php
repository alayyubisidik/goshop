@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Role</h3>
                <div class="card-actions">
                    <a href="{{ route("admin.roles.index") }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route("admin.roles.update", $role) }}" method="post">
                    @csrf
                    @method("put")
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required">Role</label>
                                <input type="text" class="form-control" name="role" value="{{ old("role", $role->name) }}">
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <x-input-error :messages="$errors->get('permissions')" class="mt-2" />
                        @foreach ($permissions as $groupName => $permission)
                            <div class="col-md-4 mb-3">
                                <h3>{{ $groupName }}</h3>
                                @foreach ($permission as $item)
                                    <label for="" class="form-check">
                                        <input @checked($role->hasPermissionTo($item->name)) type="checkbox" class="form-check-input" value="{{ $item->name }}" name="permissions[]">
                                        <span class="form-check-label">{{ $item->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn btn-primary mt-3" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
