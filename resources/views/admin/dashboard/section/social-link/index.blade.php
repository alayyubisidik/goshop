@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Social Links</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.social-links.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Icon</th>
                                <th>URL</th>
                                <th>Status</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($socialLinks as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset($item->icon) }}" style="background: #ff9010; border-radius: 100%;" alt="" width="40">
                                    </td>
                                    <td>{{ $item->url }}</td>
                                    <td>
                                        @if ($item->is_active == 1)
                                            <span class="badge bg-primary-lt">Active</span>
                                        @else
                                            <span class="badge bg-danger-lt">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.social-links.edit', $item) }}">Edit</a>
                                        <a class="text-danger delete-item"
                                            href="{{ route('admin.social-links.destroy', $item) }}">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">No Data Available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
                <div class="card-footer">
                    {{-- {{ $brands->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
