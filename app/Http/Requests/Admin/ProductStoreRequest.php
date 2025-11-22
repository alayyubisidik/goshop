<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'slug' => ['required', 'string', 'max:255'],

            'price' => ['required', 'numeric', 'min:0'],

            'description' => ['required', 'string'],
            'short_description' => ['nullable', 'string'],

            'special_price' => ['nullable', 'numeric', 'min:0'],
            'special_price_start' => ['nullable', 'date'],
            'special_price_end' => ['nullable', 'date', 'after_or_equal:special_price_start'],

            'sku' => ['nullable', 'string', 'max:255'],

            'manage_stock' => ['boolean'],
            'qty' => ['integer', 'min:0'],
            'in_stock' => ['boolean'],
            'viewed' => ['integer', 'min:0'],

            'status' => ['required', 'in:active,inactive,draft'],

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
