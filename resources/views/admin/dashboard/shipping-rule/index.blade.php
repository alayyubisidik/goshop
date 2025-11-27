@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Shipping Rules</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.shipping-rules.create') }}" class="btn btn-primary">Create Shipping Rule</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Min Order</th>
                                <th>Charge</th>
                                <th>Status</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($shippingRules as $shippingRule)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $shippingRule->name }}</td>
                                    @if ($shippingRule->type == 'minimum_order_amount')
                                        <td class="text-secondary"><span class="badge bg-info-lt">Minimum Order
                                                Amount</span></td>
                                    @else
                                        <td class="text-secondary"><span class="badge bg-info-lt">Flat About</span></td>
                                    @endif
                                    <td class="text-secondary">{{ $shippingRule->minimum_amount }}</td>
                                    <td class="text-secondary">{{ $shippingRule->charge }}</td>
                                    @if ($shippingRule->is_active == 1)
                                        <td class="text-secondary"><span class="badge bg-success-lt">Active</span></td>
                                    @else
                                        <td class="text-secondary"><span class="badge bg-danger-lt">Inactive</span></td>
                                    @endif
                                    <td>
                                        <a href="{{ route('admin.shipping-rules.edit', $shippingRule) }}">Edit</i></a>
                                        <form action="{{ route('admin.shipping-rules.destroy', $shippingRule) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger delete-btn"
                                                data-name="{{ $shippingRule->name }}">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">No Data found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{-- {{ $kycRequests->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
