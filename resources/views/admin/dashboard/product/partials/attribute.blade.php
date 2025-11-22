<div class="accordion-item mb-3 cursor-pointer">
    <div class="accordion-header">
        <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $attribute->id }}"
            aria-expanded="false">
            {{ $attribute->name }}
            <div class="accordion-button-toggle ">
                <!-- Download SVG icon from http://tabler.io/icons/icon/chevron-down -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-1">
                    <path d="M6 9l6 6l6 -6"></path>
                </svg>
            </div>
            <button class="btn btn-danger delete-btn" style="margin-left: 10px" data-product-id="{{ $product->id }}" data-attribute-id="{{ $attribute->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
    <div id="collapse-{{ $attribute->id }}" class="accordion-collapse collapse" data-bs-parent="#accordion-default">
        <form action="" method="post">
            @csrf
            <div class="accordion-body">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" value="{{ $attribute->name }}" name="attribute_name">
                        <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Type</label>
                        <select name="attribute_type" class="form-control main-type" id="">
                            <option @selected($attribute->type == 'text') value="text">
                                Text</option>
                            <option @selected($attribute->type == 'color') value="color">
                                Color</option>
                        </select>
                    </div>
                </div>
                <table class="table table-bordered section-table mt-3"
                    style="{{ count($attribute->values) ? '' : 'display: none;' }}">
                    <thead>
                        <tr>
                            <th>Label</th>
                            <th class="value-header">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($attribute->type == 'color')
                            @foreach ($attribute->values as $value)
                                <tr>
                                    <td>
                                        <input type="text" name="label[]" id="" class="form-control label-input"
                                            value="{{ $value->value }}">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div id="picker-{{ $value->id }}" class="color-preview"
                                                style="background-color: {{ $value->color }};">
                                            </div>
                                            <input type="hidden" class="color-value" data-picker-id="picker-{{ $value->id }}"
                                                name="color_value[]" value="{{ $value->color }}">
                                            <span class="review-row-btn ms-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
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
                            @endforeach
                        @else
                            @foreach ($attribute->values as $value)
                                <tr>
                                    <td colspan="2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <input type="text" class="form-control label-input" name="label[]"
                                                placeholder="Label" value="{{ $value->value }}">
                                            <span class="review-row-btn ms-2"><i class="ti ti-trash"></i></span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
                <div>
                    <button class="btn btn-sm btn-primary add-row-btn" type="button">Add Row</button>
                    <button class="btn btn-sm btn-success save-btn" type="button">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
