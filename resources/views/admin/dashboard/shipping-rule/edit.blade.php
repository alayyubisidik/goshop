@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Shipping Rule</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.shipping-rules.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.shipping-rules.update', $shippingRule) }}" method="post" class="shipping-rule-form">
                    @csrf
                    @method("put")
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required">Name</label>
                                <input type="text" class="form-control" name="name" placeholder=""
                                    value="{{ old('name', $shippingRule->name) }}">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required">Type</label>
                                <select name="type" class="form-select" id="shipping_type">
                                    <option value="flat_amount" @selected($shippingRule->type == "flat_amount")>Flat
                                        Amount</option>
                                    <option value="minimum_order_amount"
                                        @selected($shippingRule->type == "minimum_order_amount")>Minimum Order Amount
                                    </option>
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-12 minimum_amount" style="{{ $shippingRule->type == "flat_amount" ? "display: none" : "" }}">
                            <div class="mb-3">
                                <label class="form-label required">Minimum Amount</label>
                                <input type="number" class="form-control" name="minimum_amount" placeholder=""
                                    value="{{ old('minimum_amount', $shippingRule->minimum_amount) }}">
                                <x-input-error :messages="$errors->get('minimum_amount')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required">Charge</label>
                                <input type="number" class="form-control" name="charge" placeholder=""
                                    value="{{ old('charge', $shippingRule->charge) }}">
                                <x-input-error :messages="$errors->get('charge')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-2">
                                <label class="form-check form-switch form-switch-3">
                                    <input class="form-check-input" type="checkbox" @checked($shippingRule->is_active) name="is_active"
                                        id="status" value="1">
                                    <span class="form-check-label">Active</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn btn-primary mt-3" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function() {
        // Fungsi untuk toggle field minimum_amount
        function toggleMinimumAmount() {
            if ($('#shipping_type').val() === 'minimum_order_amount') {
                $('.minimum_amount').show();
            } else {
                $('.minimum_amount').hide();
            }
        }

        // Jalankan saat user mengganti dropdown
        $('#shipping_type').on('change', toggleMinimumAmount);

        // Jalankan sekali saat halaman pertama kali dimuat
        toggleMinimumAmount();
    });
</script>
@endpush
