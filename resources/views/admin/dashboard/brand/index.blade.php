@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Product Brands</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Logo</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brands as $brand)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset($brand->image) }}" alt="" width="40">
                                    </td>
                                    <td>{{ $brand->name }}</td>
                                    <td>
                                        @if ($brand->is_active == 1)
                                            <span class="badge bg-primary-lt">Active</span>
                                        @else
                                            <span class="badge bg-danger-lt">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.brands.edit', $brand) }}">Edit</a>
                                        <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger delete-btn"
                                                data-name="{{ $brand->name }}">
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
                    {{ $brands->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
