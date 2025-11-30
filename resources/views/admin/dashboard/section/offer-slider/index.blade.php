@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Offer Slider</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.offer-sliders.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>URL</th>
                                <th>Status</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sliders as $slider)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->url }}</td>
                                    <td>
                                        @if ($slider->is_active == 1)
                                            <span class="badge bg-primary-lt">Active</span>
                                        @else
                                            <span class="badge bg-danger-lt">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.offer-sliders.edit', $slider) }}">Edit</a>
                                        <a class="text-danger delete-item"
                                            href="{{ route('admin.offer-sliders.destroy', $slider) }}">Delete</a>
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
                    {{ $sliders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
