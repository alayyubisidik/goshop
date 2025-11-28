@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Withdraw Request</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.withdraw-requests.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Store</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Details</th>
                                <th>Created At</th>
                                <th class="w-8"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($withdrawRequests as $withdrawRequest)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $withdrawRequest->store->name }}</td>
                                    <td>{{ config('settings.site_currency') }} {{ $withdrawRequest->amount }}</td>
                                    <td>{{ $withdrawRequest->payment_method }}</td>
                                    <td>
                                        @if ($withdrawRequest->status == 'pending')
                                            <span class="badge bg-warning-lt">Pending</span>
                                        @elseif ($withdrawRequest->status == 'paid')
                                            <span class="badge bg-success-lt">Paid</span>
                                        @else
                                            <span class="badge bg-danger-lt">Rejected</span>
                                        @endif
                                    </td>
                                    <td>{!! $withdrawRequest->payment_details !!}</td>
                                    <td>{{ date('Y-m-d', strtotime($withdrawRequest->created_at)) }}</td>
                                    <td>
                                        <a class="text-primary"
                                            href="{{ route('admin.withdraw-requests.show', $withdrawRequest) }}">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No Withdraw Request</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{-- {{ $orders->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
