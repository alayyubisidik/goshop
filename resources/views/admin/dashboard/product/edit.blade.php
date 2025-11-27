@extends('admin.dashboard.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />

    <style>
        /* Add these new styles */
        .dropzone {
            border: 2px dashed #ccc;
            border-radius: 4px;
            padding: 20px;
            text-align: center;
            background: #f8f9fa;
            margin-bottom: 20px;
        }

        .dropzone.dz-drag-hover {
            border-color: #2196F3;
            background: #e3f2fd;
        }

        .image-preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .image-preview-item {
            position: relative;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: move;
        }

        .image-preview-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 4px;
        }

        .image-preview-item .remove-image {
            position: absolute;
            top: -10px;
            right: -10px;
            background: red;
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            text-align: center;
            line-height: 24px;
            cursor: pointer;
        }

        .image-preview-loader {
            position: relative;
            width: 100%;
            height: 150px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 1.5s infinite;
        }

        .image-preview-loader::after {
            content: "Uploading...";
            color: #666;
        }

        @keyframes pulse {
            0% {
                opacity: 0.6;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0.6;
            }
        }
    </style>
@endpush

@section('contents')
    <div class="container-xl" style="padding-bottom: 100px">
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
                                        value="{{ old('name', $product->name) }}">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label required" for="slug">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug"
                                        value="{{ old('slug ', $product->slug) }}">
                                    <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label required" for="short_description">Short Description</label>
                                    <textarea name="short_description" id="short-editor">{!! old('short_description', $product->short_description) !!}</textarea>
                                    <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label required" for="description">Content</label>
                                    <textarea name="description" id="short-editor">{!! old('description', $product->description) !!}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card ">
                        <div class="disabled-placeholder" style="{{ count($product->attributes) ? '' : 'display: none' }}">
                        </div>
                        <div class="card-header">
                            <div class="card-title">Overview</div>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label required" for="sku">SKU</label>
                                        <input type="text" class="form-control" name="sku" id="sku"
                                            value="{{ old('sku', $product->sku) }}">
                                        <x-input-error :messages="$errors->get('sku')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label required" for="price">Price</label>
                                        <input type="number" class="form-control" name="price" id="price"
                                            value="{{ old('price', $product->price) }}">
                                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label required" for="special_price">Special Price</label>
                                        <input type="number" class="form-control" name="special_price" id="special_price"
                                            value="{{ old('special_price', $product->special_price) }}">
                                        <x-input-error :messages="$errors->get('special_price')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label required" for="special_price_start">From Date</label>
                                        <input type="text" class="form-control datepicker" name="special_price_start"
                                            value="{{ old('special_price_start', $product->special_price_start) }}" autocomplete="off">
                                        <x-input-error :messages="$errors->get('special_price_start')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label required" for="special_price_end">To Date</label>
                                        <input type="text" class="form-control datepicker" name="special_price_end"
                                            id="special_price_end"
                                            value="{{ old('special_price_end', $product->special_price_end) }}" autocomplete="off">
                                        <x-input-error :messages="$errors->get('special_price_end')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-check">
                                                <input class="form-check-input manage-stock-check" type="checkbox"
                                                    name="manage_stock" value="1" @checked(old('manage_stock', $product->manage_stock) == 1) />

                                                <span class="form-check-label">Manage Stock</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div
                                        class="col-md-12 manage-stock {{ $product->manage_stock == 1 ? '' : 'd-none' }}">
                                        <div class="mb-3">
                                            <label class="form-label required" for="qty">Quantity</label>
                                            <input type="number" class="form-control" name="qty" id="qty"
                                                value="{{ old('qty', $product->qty) }}">
                                            <x-input-error :messages="$errors->get('qty')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>

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
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="radio" name="in_stock"
                                                            @checked($product->in_stock == 1) value="1">
                                                        <span class="form-check-label">In Stock</span>
                                                    </label>
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="radio" name="in_stock"
                                                            @checked($product->in_stock == 0) value="0">
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

                    <div class="card mt-3" id="product-images">
                        <div class="card-header">
                            <div class="card-title">
                                Product Image
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="dropzone" id="imageUploader"></div>
                                    <div id="imagePreviewContainer" class="image-preview-container">
                                        @foreach ($product?->images ?? [] as $image)
                                            <div class="image-preview-item" data-image-id="{{ $image->id }}">
                                                <img src="{{ asset($image->path) }}">
                                                <span class="remove-image"
                                                    data-image-id="{{ $image->id }}">&times;</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <div class="card-title">
                                Product Attribute
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="accordion mb-3" id="accordion-default">
                                    @foreach ($attributeWithValues as $attribute)
                                        @include('admin.dashboard.product.partials.attribute', [
                                            'attribute' => $attribute,
                                            'product' => $product,
                                        ])
                                    @endforeach
                                </div>

                                <button class="btn btn-primary" type="button" id="add-attribute-btn">Add
                                    Atribute</button>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3" id="product-images">
                        <div class="card-header">
                            <h3 class="card-title">Product Variants</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="accordion" id="accordion-variant">
                                    @foreach ($variants as $variant)
                                        @include('admin.dashboard.product.partials.variant', [
                                            'variant' => $variant,
                                        ])
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Approved Status</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <select name="approved_status" class="form-control">
                                        <option value="pending" @selected(old('approved_status', $product->approved_status) == 'pending')>
                                            Pending
                                        </option>

                                        <option value="approved" @selected(old('approved_status', $product->approved_status) == 'approved')>
                                            Approved
                                        </option>

                                        <option value="rejected" @selected(old('approved_status', $product->approved_status) == 'rejected')>
                                            Rejected
                                        </option>
                                    </select>

                                    <x-input-error :messages="$errors->get('approved_status')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Status</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-select">
                                        <option value="active" @selected(old('status', $product->status) == 'active')>
                                            Active
                                        </option>

                                        <option value="inactive" @selected(old('status', $product->status) == 'inactive')>
                                            Inactive
                                        </option>

                                        <option value="draft" @selected(old('status', $product->status) == 'draft')>
                                            Draft
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
                                            <option value="{{ $store->id }}" @selected(old('store_id', $product->store_id) == $store->id)>
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
                                        <input class="form-check-input" value="1" type="checkbox" name="is_featured"
                                            @checked(old('is_featured', $product->is_featured) == 1)>
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
                                                        name="categories[]" value="{{ $category->id }}"
                                                        @checked(in_array($category->id, $productCategoryIds))>
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
                                                                        name="categories[]" value="{{ $child->id }}"
                                                                        @checked(in_array($child->id, $productCategoryIds))>
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
                                                                                        value="{{ $subChild->id }}"
                                                                                        @checked(in_array($subChild->id, $productCategoryIds))>
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
                                            <option value="{{ $brand->id }}" @selected(old('brand_id', $product->brand_id) == $brand->id)>
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
                                        <input class="form-check-input" value="1" type="checkbox" name="is_hot"
                                            @checked(old('is_hot', $product->is_hot) == 1)>
                                        <span class="form-check-label">Hot</span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" value="1" type="checkbox" name="is_new"
                                            @checked(old('is_new', $product->is_new) == 1)>
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
                                            <option @selected(in_array($tag->id, $productTagIds)) value="{{ $tag->id }}">
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3" style="position: sticky; top: 0">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="mb-3 row">
                                    <button class="btn btn-primary mt-3" type="submit">Update</button>
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
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr"></script>

    <script>
        $(function() {

            const pickerInstances = {};

            let uniqueCounter = 0;

            function generateUniqueId(prefix = 'picker-') {
                uniqueCounter++;
                return prefix + uniqueCounter + '-' + Date.now();
            }

            function createPicker(pickerId, defaultColor, inputSelector) {
                if (pickerInstances[pickerId]) {
                    pickerInstances[pickerId].destroyAndRemove();
                }

                const picker = Pickr.create({
                    el: `#${pickerId}`,
                    theme: 'classic',
                    default: defaultColor,
                    components: {
                        preview: true,
                        opacity: true,
                        hue: true,
                        interaction: {
                            hex: true,
                            rgba: true,
                            input: true,
                            clear: true,
                            save: true
                        }
                    }
                });

                picker.on('change', (color) => {
                    const selectedColor = color.toHEXA().toString();
                    $(`#${pickerId}`).css('background-color', selectedColor);
                    $(inputSelector).val(selectedColor);
                });

                pickerInstances[pickerId] = picker;
            }

            function destroyPicker(pickerId) {
                if (pickerInstances[pickerId]) {
                    pickerInstances[pickerId].destroyAndRemove();
                    delete pickerInstances[pickerId];
                }
            }

            function initColorPickersInContainer($container) {
                $container.find('.color-preview').each(function() {
                    const $this = $(this);
                    const pickerId = $this.attr('id');
                    const currentColor = $this.css('background-color') || '#000000';
                    createPicker(pickerId, currentColor, `input[data-picker-id="${pickerId}"]`);
                });
            }

            let count = 0;
            $('#add-attribute-btn').on('click', function() {
                count++;
                const collapseId = 'collapse' + count;
                const headerId = 'header' + count;

                const accordionItem = `
                            <div class="accordion-item mb-3 cursor-pointer" data-index="${count}">
                                            <div class="accordion-header" id="${headerId}">
                                                <div class="accordion-button" data-bs-toggle="collapse"
                                                    data-bs-target="#${collapseId}" aria-controls="${collapseId}" aria-expanded="false">
                                                    New Attribute #${count}
                                                    <div class="accordion-button-toggle ">
                                                        <!-- Download SVG icon from http://tabler.io/icons/icon/chevron-down -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-1">
                                                            <path d="M6 9l6 6l6 -6"></path>
                                                        </svg>
                                                    </div>
                                                    <button type="button" class="btn btn-danger delete-btn" style="margin-left: 10px">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icon-tabler-trash m-0">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M4 7h16" />
                                                            <path d="M10 11v6" />
                                                            <path d="M14 11v6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="${collapseId}" class="accordion-collapse collapse"
                                                data-bs-parent="#accordion-default">
                                                <form action="" method="post">
                                                    @csrf
                                                    <div class="accordion-body">
                                                        <div class="row mb-2">
                                                            <div class="col-md-6">
                                                                <label for="" class="form-label">Name</label>
                                                                <input type="text" class="form-control" value=""
                                                                    name="attribute_name">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="" class="form-label">Type</label>
                                                                <select name="attribute_type" class="form-control main-type" id="">
                                                                    <option value="text">Text</option>
                                                                    <option value="color">Color</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <table class="table table-bordered section-table mt-3" style="display: none;">
                                                            <thead>
                                                                <tr>
                                                                    <th>Label</th>
                                                                    <th class="value-header">Value</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                        <div>
                                                            <button class="btn btn-sm btn-primary add-row-btn" type="button">Add Row</button>
                                                            <button class="btn btn-sm btn-success save-btn" type="button">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>`;

                $('#accordion-default').append(accordionItem);
            });

            $(document).on('click', '.add-row-btn', function() {
                const accordionBody = $(this).closest('.accordion-body');
                const type = accordionBody.find('.main-type').val();
                const table = accordionBody.find('.section-table');
                const tbody = table.find('tbody');
                table.show();

                const pickerId = generateUniqueId();
                let rowHtml = '';

                if (type === 'color') {
                    rowHtml = `
                                <tr>
                                    <td>
                                        <input type="text" name="label[]" id="" class="form-control label-input">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div id="${pickerId}" class="color-preview"></div>
                                            <input type="hidden" class="color-value" data-picker-id="${pickerId}" name="color_value[]">
                                            <span class="review-row-btn ms-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icon-tabler-trash m-0">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7h16" />
                                                    <path d="M10 11v6" />
                                                    <path d="M14 11v6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </span>
                                        </div>
                                    </td>
                                </tr>`;
                } else {
                    rowHtml = `
                        <tr>
                            <td colspan="2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <input type="text" class="form-control label-input" name="label[]" placeholder="Label">
                                    <span class="review-row-btn ms-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-trash m-0">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7h16" />
                                            <path d="M10 11v6" />
                                            <path d="M14 11v6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        `;
                }

                tbody.append(rowHtml);

                if (type === 'color') {
                    createPicker(pickerId, '#000000', `input[data-picker-id="${pickerId}"]`);
                }
            })

            $(document).on('click', '.review-row-btn', function() {
                const $row = $(this).closest('tr');
                const $colorPreview = $row.find('.color-preview');
                if ($colorPreview.length) {
                    destroyPicker($colorPreview.attr('id'));
                }

                const $table = $(this).closest('.section-table');
                $row.remove();
                const tbody = $table.find('tbody');
                if (tbody.children().length === 0) {
                    $table.hide();
                }
            });

            $(document).on('change', '.main-type', function() {
                const accordionBody = $(this).closest('.accordion-body');
                const type = $(this).val();
                const table = accordionBody.find('.section-table');
                const tbody = table.find('tbody');

                // collect row values and destroy any existing pickers
                const labels = [];

                tbody.find('tr').each(function() {
                    const $colorPreview = $(this).find('.color-preview');
                    if ($colorPreview.length) {
                        destroyPicker($colorPreview.attr('id'));
                    }
                    const labelVal = $(this).find('.label-input').val();
                    labels.push(labelVal || '');
                });

                tbody.empty();

                labels.forEach(label => {
                    const pickerId = generateUniqueId();
                    let rowHtml = '';

                    if (type === 'color') {
                        rowHtml = `
                                <tr>
                                    <td>
                                        <input type="text" name="label[]" id="" class="form-control label-input label" value="${label}" >
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div id="${pickerId}" class="color-preview"></div>
                                            <input type="hidden" class="color-value" data-picker-id="${pickerId}" name="color_value[]">
                                            <span class="review-row-btn ms-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icon-tabler-trash m-0">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7h16" />
                                                    <path d="M10 11v6" />
                                                    <path d="M14 11v6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </span>
                                        </div>
                                    </td>
                                </tr>`;
                    } else {
                        rowHtml = `
                        <tr>
                            <td colspan="2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <input type="text" class="form-control label-input" name="label[]" placeholder="Label"  value="${label}" >
                                    <span class="review-row-btn ms-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-trash m-0">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7h16" />
                                            <path d="M10 11v6" />
                                            <path d="M14 11v6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        `;
                    }

                    tbody.append(rowHtml);

                    if (type === 'color') {
                        createPicker(pickerId, '#000000', `input[data-picker-id="${pickerId}"]`);
                    }
                });

                if (labels.length > 0) {
                    table.show();
                } else {
                    table.hide();
                }
            });


            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault()
                const $accordionItem = $(this).closest('.accordion-item');
                $accordionItem.find('.color-preview').each(function() {
                    destroyPicker($(this).attr('id'));
                });


                const productId = $(this).data('product-id');
                const attributeId = $(this).data('attribute-id');

                if (!attributeId) {
                    $accordionItem.remove();
                    return
                }

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.products.attributes.destroy', [':id', ':attribute_id']) }}"
                                .replace(':id', productId).replace(':attribute_id',
                                    attributeId),
                            method: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}" // Laravel CSRF Token
                            },
                            success: function(response) {

                                $('#accordion-variant').html(response.variantHtml);
                                location.reload()
                                response.html ? $('.disabled-placeholder').show() : $(
                                    '.disabled-placeholder').hide();

                                notyf.success(response.message);
                            },
                            error: function(xhr, status, error) {
                                notyf.error(error);
                            }
                        });
                    }
                });
            });


            $(document).on('click', '.save-btn', function(e) {
                e.preventDefault();
                const $form = $(this).closest('form');
                const data = $form.serialize();

                $.ajax({
                    url: "{{ route('admin.products.attributes.store', ':id') }}".replace(':id',
                        '{{ $product->id }}'),
                    method: 'POST',
                    data: data,
                    success: function(response) {

                        $('#accordion-variant').html(response.variantHtml);
                        location.reload();

                        response.html ? $('.disabled-placeholder').show() : $(
                            '.disabled-placeholder').hide();
                        initColorPickersInContainer($('#accordion-default'));
                        notyf.success(response.message);
                    },
                    error: function(xhr, status, error) {

                    }
                })
            });

            // Initialize color pickers on load
            $(document).ready(function() {
                initColorPickersInContainer($('#accordion-default'));
            });

            $(document).on('change', '.variant-manage-stock', function() {
                const ischecked = $(this).is(':checked');
                const element = $(this).closest('.col-md-12').find('.variant-quantity').toggle(ischecked);
            });

            $(document).on('click', '.variant-save-btn', function(e) {
                e.preventDefault();
                const form = $(this).closest('.variant-form');

                const data = form.serializeArray();
                // pastikan token selalu ikut

                $.ajax({
                    url: "{{ route('admin.products.variants.update', ':productId') }}"
                        .replace(':productId', '{{ $product->id }}'),
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        location.reload();
                        notyf.success(response.message);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        notyf.error('Something went wrong');
                    }
                });
            });


        });

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

        // submit form
        $(function() {
            $('.product-form').on('submit', function(e) {
                e.preventDefault();
                let form = $(this);
                let data = new FormData(form[0]);

                $.ajax({
                    method: 'POST',
                    url: "{{ route('admin.products.update', ':id') }}".replace(':id',
                        '{{ $product->id }}'),
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
        });


        // dropzone image upload
        Dropzone.autoDiscover = false;
        const imageUploader = new Dropzone("#imageUploader", {
            url: "{{ route('admin.products.images.upload', ':id') }}".replace(':id', '{{ $product->id }}'),
            paramName: "image",
            maxFilesize: 10,
            acceptedFiles: "image/*",
            addRemoveLinks: false,
            autoProcessQueue: true,
            uploadMultiple: false,
            previewContainer: false,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            init: function() {
                this.on("addedfile", function(file) {
                    file.previewElement.remove();
                    const placeholderId = 'upload-' + Date.now();
                    addUploadPlaceholder(placeholderId);
                    file.placeholderId = placeholderId;
                })

                this.on("success", function(file, response) {
                    $(`#${file.placeholderId}`).remove();
                    addImagePreview(response.path, response.id);
                    this.removeFile(file);
                    notyf.success(response.message);
                })
            }
        });

        function addUploadPlaceholder(placeholderId) {
            const placeholderHtml = `
            <div id="${placeholderId}" class="image-preview-item">
                <div class="image-preview-loader"></div>
            </div>`;

            $('#imagePreviewContainer').append(placeholderHtml);
        }

        function addImagePreview(path, id) {
            const placeholderHtml = `
            <div class="image-preview-item" data-image-id="${id}">
                <img src="${path}">
                <span class="remove-image" data-image-id="${id}">&times;</span>
            </div>
        `;

            $('#imagePreviewContainer').append(placeholderHtml);
        }

        $(document).on('click', '.remove-image', function() {
            const imageId = $(this).attr('data-image-id');
            console.log(imageId);
        });

        $(document).on('click', '.remove-image', function() {
            const imageId = $(this).attr('data-image-id');
            const element = this;

            $.ajax({
                method: 'DELETE',
                url: "{{ route('admin.products.images.destroy', ':id') }}".replace(':id', imageId),
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(response) {
                    notyf.success(response.message);
                    $(element).closest('.image-preview-item').remove();
                },
                error: function(xhr, status, error) {
                    notyf.error(error);
                }
            });
        });

        // init sortable
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        new Sortable(imagePreviewContainer, {
            animation: 150,
            onEnd: function() {
                updateImageOrder()
            }
        });

        function updateImageOrder() {
            const imageOrder = [];

            $('.image-preview-item').each(function(index) {
                imageOrder.push({
                    id: $(this).data('image-id'),
                    order: index
                });
            });

            $.ajax({
                url: "{{ route('admin.products.images.reorder') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    images: imageOrder
                },
                success: function(response) {

                },
                error: function(xhr, status, error) {

                }
            });
        }
    </script>
@endpush
