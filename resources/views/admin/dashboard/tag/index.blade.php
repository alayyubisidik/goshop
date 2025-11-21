@extends('admin.dashboard.layouts.app')


@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Product Tags</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tags as $tag)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tag->name }}</td>
                                    <td>
                                        @if ($tag->is_active == 1)
                                            <span class="badge bg-primary-lt">Active</span>
                                        @else
                                            <span class="badge bg-danger-lt">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.tags.edit', $tag) }}">Edit</a>
                                        <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger delete-btn"
                                                data-name="{{ $tag->name }}">
                                                Delete
                                            </button>
                                        </form>
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
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
