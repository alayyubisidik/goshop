@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <form action="" class="product-form">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label required" for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ old('name') }}">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label required" for="slug">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug"
                                        value="{{ old('slug') }}">
                                    <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label required" for="short_description">Short Description</label>
                                    <textarea name="short_description" id="short-editor">{{ old('short_description') }}</textarea>
                                    <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label required" for="description">Content</label>
                                    <textarea name="description" id="editor">{{ old('description') }}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Overview</div>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                {{-- SKU --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label required" for="sku">SKU</label>
                                        <input type="text" class="form-control" name="sku" id="sku"
                                            value="{{ old('sku') }}">
                                        <x-input-error :messages="$errors->get('sku')" class="mt-2" />
                                    </div>
                                </div>

                                {{-- Price --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label required" for="price">Price</label>
                                        <input type="number" step="0.01" class="form-control" name="price"
                                            id="price" value="{{ old('price') }}">
                                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                    </div>
                                </div>

                                {{-- Special Price --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label required" for="special_price">Special Price</label>
                                        <input type="number" step="0.01" class="form-control" name="special_price"
                                            id="special_price" value="{{ old('special_price') }}">
                                        <x-input-error :messages="$errors->get('special_price')" class="mt-2" />
                                    </div>
                                </div>

                                {{-- From Date --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label required" for="special_price_start">From Date</label>
                                        <input type="text" class="form-control datepicker" name="special_price_start"
                                            autocomplete="off" value="{{ old('special_price_start') }}">
                                        <x-input-error :messages="$errors->get('special_price_start')" class="mt-2" />
                                    </div>
                                </div>

                                {{-- To Date --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label required" for="special_price_end">To Date</label>
                                        <input type="text" class="form-control datepicker" name="special_price_end"
                                            id="special_price_end" autocomplete="off"
                                            value="{{ old('special_price_end') }}">
                                        <x-input-error :messages="$errors->get('special_price_end')" class="mt-2" />
                                    </div>
                                </div>

                                {{-- Manage Stock --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-check">
                                                <input class="form-check-input manage-stock-check" name="manage_stock"
                                                    type="checkbox" {{ old('manage_stock') ? 'checked' : '' }}
                                                    value="1">
                                                <span class="form-check-label">Manage Stock</span>
                                            </label>
                                        </div>
                                    </div>

                                    {{-- Quantity (only if manage_stock checked) --}}
                                    <div class="col-md-12 manage-stock {{ old('manage_stock') ? '' : 'd-none' }}">
                                        <div class="mb-3">
                                            <label class="form-label required" for="qty">Quantity</label>
                                            <input type="number" class="form-control" name="qty" id="qty"
                                                value="{{ old('qty') }}">
                                            <x-input-error :messages="$errors->get('qty')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>

                                {{-- Stock Status (Radio) --}}
                                <div class="row">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">
                                                Stock Status
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <div class="mb-3">

                                                    {{-- In Stock --}}
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="radio" name="in_stock"
                                                            value="1"
                                                            {{ old('in_stock', 'in_stock') == 'in_stock' ? 'checked' : '' }}>
                                                        <span class="form-check-label">In Stock</span>
                                                    </label>

                                                    {{-- Out of Stock --}}
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="radio" name="in_stock"
                                                            value="0"
                                                            {{ old('in_stock') == 'out_of_stock' ? 'checked' : '' }}>
                                                        <span class="form-check-label">Out of Stock</span>
                                                    </label>

                                                    <x-input-error :messages="$errors->get('in_stock')" class="mt-2" />

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Status</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-select">
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft
                                        </option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Store</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="mb-3">
                                    <select name="store_id" id="store_id" class="form-select select2">
                                        <option value="">Select a store</option>
                                        @foreach ($stores as $store)
                                            <option value="{{ $store->id }}"
                                                {{ old('store') == $store->id ? 'selected' : '' }}>
                                                {{ $store->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('store_id')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Is Featured</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-check form-switch form-switch-3">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            name="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                                        <span class="form-check-label">Enable</span>
                                    </label>
                                    <x-input-error :messages="$errors->get('is_featured')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Category</h3>
                        </div>
                        <div class="card-body" style="height: 400px; overflow-y: scroll;">
                            <div class="col-12">
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="category-search"
                                            placeholder="Search category">
                                    </div>
                                    <ul class="list-unstyled" id="category-tree">
                                        @foreach ($categories as $category)
                                            <li>
                                                <label for="" class="form-check category-wrapper">
                                                    <input type="checkbox" class="form-check-input category-check"
                                                        name="categories[]" value="{{ $category->id }}">
                                                    <span
                                                        class="form-check-label category-label">{{ $category->name }}</span>
                                                </label>
                                                @if ($category->children_nested && $category->children_nested->count() > 0)
                                                    <ul class="list-unstyled ms-4 mt-2">
                                                        @foreach ($category->children_nested as $child)
                                                            <li>
                                                                <label for="" class="form-check category-wrapper">
                                                                    <input type="checkbox"
                                                                        class="form-check-input category-check"
                                                                        name="categories[]" value="{{ $child->id }}">
                                                                    <span
                                                                        class="form-check-label category-label">{{ $child->name }}</span>
                                                                </label>
                                                                @if ($child->children_nested && $child->children_nested->count() > 0)
                                                                    <ul class="list-unstyled ms-4 mt-2">
                                                                        @foreach ($child->children_nested as $subChild)
                                                                            <li>
                                                                                <label for=""
                                                                                    class="form-check category-wrapper">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input category-check"
                                                                                        name="categories[]"
                                                                                        value="{{ $subChild->id }}">
                                                                                    <span
                                                                                        class="form-check-label category-label">{{ $subChild->name }}</span>
                                                                                </label>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Brand</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="mb-3">
                                    <select name="brand_id" id="brand_id" class="form-select select2">
                                        <option value="">Select a brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ old('brand') == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('brand_id')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Label</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="mb-3">

                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_hot"
                                            {{ old('is_hot') ? 'checked' : '' }} value="1">
                                        <span class="form-check-label">Hot</span>
                                    </label>

                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_new"
                                            {{ old('is_new') ? 'checked' : '' }} value="1">
                                        <span class="form-check-label">New</span>
                                    </label>

                                    <x-input-error :messages="$errors->get('label')" class="mt-2" />

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Tags</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="mb-3">
                                    <select name="tags[]" id="tags" class="form-select select2"
                                        multiple="multiple">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="mb-3 row">
                                    <button class="btn btn-primary mt-3" type="submit">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on('change', '.category-check', function() {
            const isChecked = $(this).is(':checked');

            $(this).closest('li').find('input.category-check').each(function() {
                this.checked = isChecked;
                this.indeterminate = false;
            });

            function updateParents($input) {
                const $li = $input.closest('li').parent().closest('li');

                if ($li.length) {
                    const $siblings = $li.find('> ul > li input.category-check');
                    const checkedCount = $siblings.filter(':checked').length;
                    const $parent = $li.find('> label > input.category-check');

                    if (checkedCount === 0) {
                        $parent.prop('checked', false).prop('indeterminate', false);
                    } else {
                        // Parent selalu dianggap checked kalau minimal satu anak dicentang
                        $parent.prop('checked', true).prop('indeterminate', checkedCount !== $siblings.length);
                    }

                    updateParents($parent);
                }
            }

            updateParents($(this));
        });

        // submit form
        $(function() {
            $('.product-form').on('submit', function(e) {
                e.preventDefault();
                let form = $(this);
                let data = new FormData(form[0]);

                $.ajax({
                    method: 'POST',
                    url: "{{ route('admin.products.store', ['type' => ':type']) }}".replace(
                        ':type', '{{ request()->type }}'),
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == "success") {
                            window.location.href = response.redirect_url;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr);
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            notyf.error(errors[key][0]);
                        });
                    }
                });
            });

            // search Logic
            $('#category-search').on('input', function() {
                const query = $(this).val().toLowerCase();

                $('#category-tree li').each(function() {
                    const label = $(this).find('> label > .category-label').text().toLowerCase();
                    if (label.includes(query)) {
                        $(this).removeClass('d-none');
                        // show all ancestors
                        $(this).parents('li').removeClass('d-none');
                    } else {
                        $(this).addClass('d-none');
                    }
                });

                // if query is empty, show all
                if (query === '') {
                    $('#category-tree li').removeClass('d-none');
                }
            });

            $('.manage-stock-check').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.manage-stock').removeClass('d-none');
                } else {
                    $('.manage-stock').addClass('d-none');
                }
            });

        });
    </script>
@endpush
