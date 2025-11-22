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

        .dz-preview {
            position: relative;
            padding: 12px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            background: #f8f8f8;
            border-radius: 6px;
            text-align: left;
            font-family: sans-serif;
        }

        .dz-filename {
            font-weight: 600;
            font-size: 14px;
        }

        .dz-progress {
            height: 6px;
            background: #e4e4e4;
            margin-top: 6px;
            border-radius: 4px;
            overflow: hidden;
        }

        .dz-upload {
            background: #28a745;
            height: 100%;
            width: 0;
            transition: width 0.3s ease;
        }

        .dz-percentage {
            font-size: 12px;
            margin-top: 4px;
            color: #555;
        }

        .dz-remove {
            position: absolute;
            top: 6px;
            right: 10px;
            font-size: 18px;
            color: #dc3545;
            cursor: pointer;
        }

        .dz-remove:hover {
            color: #a71d2a;
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
                                        value="{{ old('name', $product->name) }}">
                                    <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label required" for="short_description">Short Description</label>
                                    <textarea name="short_description" id="short-editor">{!! $product->short_description !!}</textarea>
                                    <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label required" for="description">Content</label>
                                    <textarea name="description" id="editor">{!! $product->description !!}</textarea>
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
                                        <label class="form-label required" for="from_date">From Date</label>
                                        <input type="text" class="form-control datepicker" name="from_date"
                                            value="{{ $product->special_price_start }}">
                                        <x-input-error :messages="$errors->get('from_date')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label required" for="to_date">To Date</label>
                                        <input type="text" class="form-control datepicker" name="to_date" id="to_date"
                                            value="{{ $product->special_price_end }}">
                                        <x-input-error :messages="$errors->get('to_date')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-check">
                                                <input class="form-check-input manage-stock-check" name="manage_stock"
                                                    type="checkbox" @checked($product->manage_stock == 'yes')>
                                                <span class="form-check-label">Manage Stock</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div
                                        class="col-md-12 manage-stock {{ $product->manage_stock == 'yes' ? '' : 'd-none' }}">
                                        <div class="mb-3">
                                            <label class="form-label required" for="quantity">Quantity</label>
                                            <input type="number" class="form-control" name="quantity" id="quantity"
                                                value="{{ old('qty', $product->qty) }}">
                                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
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
                                                        <input class="form-check-input" type="radio"
                                                            name="stock_status" @checked($product->in_stock == 1)
                                                            value="in_stock">
                                                        <span class="form-check-label">In Stock</span>
                                                    </label>
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="stock_status" @checked($product->in_stock == 0)
                                                            value="out_of_stock">
                                                        <span class="form-check-label">Out of Stock</span>
                                                    </label>
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

                    <div class="card mt-3" id="product-images">
                        <div class="card-header">
                            <h3 class="card-title">Product Files</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div id="fileUploader" class="dropzone"></div>
                                    <div id="filePreviewContainer" class="file-preview-container">
                                        @foreach ($product->files ?? [] as $file)
                                            <div class="dz-preview dz-file-preview">
                                                <div class="dz-filename"><span data-dz-name>{{ $file->filename }}</span>
                                                </div>
                                                <div class="dz-progress">
                                                    <div class="dz-upload" data-dz-uploadprogress style="width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="dz-percentage"><span class="progress-text"></span>uploaded
                                                </div>
                                                <div class="dz-remove" data-file-id="{{ $file->id }}" data-dz-remove>
                                                    &times;</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Approve Status</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <select name="approved_status" class="form-control" id="">
                                        <option @selected($product->approved_status == 'pending') value="pending">Pending</option>
                                        <option @selected($product->approved_status == 'approved') value="approved">Approved</option>
                                        <option @selected($product->approved_status == 'rejected') value="rejected">Rejected</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
                                        <option @selected($product->status == 'active') value="active">Active</option>
                                        <option @selected($product->status == 'inactive') value="inactive">Inactive</option>
                                        <option @selected($product->status == 'draft') value="draft">Draft</option>
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
                                    <select name="store" id="store" class="form-select select2">
                                        <option value="">Select a store</option>
                                        @foreach ($stores as $store)
                                            <option @selected($product->store_id == $store->id) value="{{ $store->id }}">
                                                {{ $store->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('store')" class="mt-2" />
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
                                        <input class="form-check-input" type="checkbox" name="is_featured"
                                            @checked($product->is_featured == 1)>
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
                                    <select name="brand" id="brand" class="form-select select2">
                                        <option value="">Select a brand</option>
                                        @foreach ($brands as $brand)
                                            <option @selected($product->brand_id == $brand->id) value="{{ $brand->id }}">
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('brand')" class="mt-2" />
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
                                            @checked($product->is_hot == 1)>
                                        <span class="form-check-label">Hot</span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_new"
                                            @checked($product->is_new == 1)>
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

        const fileUploader = new Dropzone("#fileUploader", {
            url: "{{ route('admin.digital-products.file.upload') }}",
            paramName: "file",
            maxFileSize: 1000,
            chunking: true,
            forceChunking: true,
            chunkSize: 1024 * 1024, // 1 MB per chunk,
            parallelUploads: 1,
            acceptedFiles: `
                image/*,
                application/pdf,
                application/msword,
                application/vnd.openxmlformats-officedocument.wordprocessingml.document,
                application/vnd.ms-excel,
                application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,
                application/vnd.ms-powerpoint,
                application/vnd.openxmlformats-officedocument.presentationml.presentation,
                text/plain,
                text/csv,
                application/rtf,
                audio/*,
                video/*,
                application/zip,
                application/x-zip-compressed,
                application/x-rar-compressed,
                application/x-7z-compressed,
                application/x-tar,
                application/gzip
                `,
            addRemoveLinks: false,
            autoProcessQueue: true,
            uploadMultiple: false,
            previewsContainer: '#filePreviewContainer',
            previewTemplate: `
                <div class="dz-preview dz-file-preview">
                    <div class="dz-filename"><span data-dz-name></span></div>
                    <div class="dz-progress"><div class="dz-upload" data-dz-uploadprogress></div></div>
                    <div class="dz-percentage"><span class="progress-text">0</span>% uploaded</div>
                    <div class="dz-remove" data-dz-remove>&times;</div>
                </div>
            `,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            init: function() {
                this.on("uploadprogress", function(file, progress) {
                        file.previewElement.querySelector(".progress-text").textContent = progress.toFixed(
                            0);
                    }),

                    this.on("sending", function(file, xhr, formData) {
                        formData.append("name", file.upload.filename);
                        formData.append("product_id", "{{ $product->id }}");
                    }),

                    this.on("success", function(file, response) {
                        location.reload();
                    }),

                    this.on("error", function(file, response) {
                        console.error(response);
                        if (response.status === 'error') {
                            notyf.error(response.message);
                        }
                    })
            }
        });

        $(document).on('click', '.dz-remove', function() {
            const id = $(this).attr('data-file-id');
            $.ajax({
                method: 'DELETE',
                url: '{{ route('admin.digital-products.file.destroy', ['product' => ':product', 'file' => ':file']) }}'
                    .replace(':product', '{{ $product->id }}')
                    .replace(':file', id),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                }
            });
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
