<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRuleStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:minimum_order_amount,flat_amount'],
            'minimum_amount' => ['required_if:type,minimum_order_amount', 'numeric', "nullable"],
            'charge' => ['required', 'numeric'],
            "is_active" => ["nullable", "boolean"]
        ];
    }
}
