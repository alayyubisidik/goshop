@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Roles</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <span class="badge bg-primary-lt">{{ $role->permissions_count }}</span>
                                    </td>
                                    <td>
                                        @if ($role->name !== 'Super Admin')
                                        <a href="{{ route('admin.roles.edit', $role) }}">Edit</a>
                                        <form action="{{ route('admin.roles.destroy', $role) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger delete-btn"
                                                data-name="{{ $role->name }}">
                                                Delete
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">No Roles</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
@endsection
