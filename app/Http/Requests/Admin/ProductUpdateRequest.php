<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'store_id' => ['required', 'integer', 'exists:stores,id'],
            'brand_id' => ['required', 'integer', 'exists:brands,id'],

            // 'product_type' => ['required', 'in:physical,digital'],

            'name' => ['required', 'string', 'max:255'],


            'description' => ['required', 'string'],
            'short_description' => ['nullable', 'string'],

            'sku' => ['nullable', 'string', 'max:255'],

            'price' => ['required', 'numeric', 'min:0'],

            'special_price' => ['nullable', 'numeric', 'min:0'],
            'special_price_start' => ['nullable', 'date'],
            'special_price_end' => ['nullable', 'date', 'after_or_equal:special_price_start'],

            'manage_stock' => ['boolean'],
            'qty' => ['nullable', 'integer', 'min:0'],
            'in_stock' => ['boolean'],
            'viewed' => ['integer', 'min:0'],

            'status' => ['required', 'in:active,inactive,draft'],

            'approved_status' => ['required', 'in:approved,pending,rejected'],

            'is_featured' => ['boolean'],
            'is_hot' => ['boolean'],
            'is_new' => ['boolean'],

            'categories' => ['required', 'array'],
            'categories.*' => ['required', 'exists:categories,id'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['nullable', 'exists:tags,id'],
        ];
    }
}
