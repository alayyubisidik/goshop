@extends('vendor.dashboard.layouts.app')


@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Withdraw Method</h3>
                <div class="card-actions">
                    <a href="{{ route('vendor.withdraw-methods.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('vendor.withdraw-methods.update', $withdraw_method) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row">
                        {{-- Gateway --}}
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required">Gateway</label>
                                <select name="gateway" class="form-control" id="gateway">
                                    <option value="">Select Method</option>
                                    @foreach ($withdrawMethods as $gateway)
                                        <option value="{{ $gateway->id }}"
                                            {{ old('gateway', $withdraw_method->withdraw_method_id) == $gateway->id ? 'selected' : '' }}>
                                            {{ $gateway->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('gateway')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Instruction preview --}}
                        <div>
                            @foreach ($withdrawMethods as $gateway)
                                <div class="alert alert-info method-{{ $gateway->id }}"
                                    style="{{ old('gateway', $withdraw_method->withdraw_method_id) == $gateway->id ? '' : 'display: none' }}">
                                    <div class="gateway-details">
                                        {!! $gateway->instruction !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Description --}}
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required">Description</label>
                                <textarea name="description" id="editor">{{ old('description', $withdraw_method->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- Submit --}}
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
            $('#gateway').on('change', function() {
                var methodId = $(this).val();
                $('.alert-info').hide();
                $('.method-' + methodId).show();
            });
        });
    </script>
@endpush
