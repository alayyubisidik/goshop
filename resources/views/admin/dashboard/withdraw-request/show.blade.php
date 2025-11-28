@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Withdraw Details</h3>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter">
                        <tbody>
                            <tr>
                                <td>Store</td>
                                <td>{{ $withdraw_request->store->name }}</td>
                            </tr>
                            <tr>
                                <td>Amount</td>
                                <td>{{ $withdraw_request->amount }}</td>
                            </tr>
                            <tr>
                                <td>Payment Method</td>
                                <td>{{ $withdraw_request->payment_method }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{ $withdraw_request->status }}</td>
                            </tr>
                            <tr>
                                <td>Method Details</td>
                                <td>{!! $withdraw_request->payment_details !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{-- {{ $orders->links() }} --}}
                </div>
            </div>
        </div>

        @if ($withdraw_request->status == 'pending')
            <div class="card col-md-4 mb-5 mt-4 ">
                <div class="card-body">
                    <form action="{{ route('admin.withdraw-requests.update', $withdraw_request) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label class="form-label ">Order Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending" @selected($withdraw_request->status == 'pending')>Pending</option>
                                <option value="paid" @selected($withdraw_request->status == 'paid')>Paid</option>
                                <option value="rejected" @selected($withdraw_request->status == 'rejected')>Rejected</option>
                            </select>
                            <x-input-error :messages="$errors->get('is_percent')" class="mt-2" />
                        </div>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
            </div>
        @endif

    </div>
@endsection
