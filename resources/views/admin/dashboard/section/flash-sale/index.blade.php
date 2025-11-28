@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $flashSale ? 'Update Flash Sale' : 'Create Flash Sale' }}
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.flash-sales.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required" for="sale_start">Sale Start</label>
                                <input type="text" class="form-control datepicker" name="sale_start" autocomplete="off"
                                    value="{{ old('sale_start', $flashSale?->sale_start) }}">
                                <x-input-error :messages="$errors->get('sale_start')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required" for="sale_end">Sale End</label>
                                <input type="text" class="form-control datepicker" name="sale_end" autocomplete="off"
                                    value="{{ old('sale_end', $flashSale?->sale_end) }}">
                                <x-input-error :messages="$errors->get('sale_end')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required">Sale Products</label>
                                <select name="products[]" class="form-control product-select" id="" multiple>
                                    @foreach ($products as $product)
                                        <option selected value="{{ $product->id }}"
                                            data-image="{{ asset($product->primaryImage->path) }}"="">{{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-check form-switch form-switch-3">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                        @checked($flashSale?->is_active)>
                                    <span class="form-check-label">Active</span>
                                </label>
                                <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                            </div>
                        </div>


                    </div>

                    <div class="card-footer text-end">
                        <button class="btn btn-primary mt-3" type="submit">
                            {{ $flashSale ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        setTimeout(() => {
            $(".product-select").select2({
                ajax: {
                    url: "{{ route('admin.flash-sales.get-products') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;

                        return {
                            results: data.results,
                            pagination: data.pagination
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a product',
                minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection,
                escapeMarkup: function(markup) {
                    return markup
                }
            });

            function formatRepo(repo) {
                if (repo.loading) {
                    return repo.text;
                }

                let image = repo.image;
                if (!image && repo.id) {
                    let option = $('.product-select option[value="' + repo.id + '"]');
                    image = option.data('image');
                }

                let markup = `
                    <div class="d-flex align-items-center p-t">
                        ${image ? `<img src="${image}" class="rounded me-2" style="width: 20px; height: 20px object-fit: cover">` : ''}
                        <div class="fw-semibold">${repo.text}</div>
                    </div>
                `;

                return markup;
            }

            function formatRepoSelection(repo) {
                let image = repo.image;
                if (!image && repo.id) {
                    let option = $('.product-select option[value="' + repo.id + '"]');
                    image = option.data('image');
                }

                let markup = `
                    <div class="d-flex align-items-center p-t">
                        ${image ? `<img src="${image}" class="rounded me-2" style="width: 20px; height: 20px object-fit: cover">` : ''}
                        <div class="fw-semibold">${repo.text}</div>
                    </div>
                `;

                return markup;
            }

        }, 500);
    </script>
@endpush
