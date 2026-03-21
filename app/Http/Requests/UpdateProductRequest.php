<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $productId = $this->route('product')->id;

        return [
            'store_id' => [
                'sometimes',
                Rule::exists('stores', 'id')
            ],

            'category_id' => [
                'sometimes',
                Rule::exists('categories', 'id')
            ],

            'name' => [
                'sometimes',
                'string',
                'max:255'
            ],

            'sku' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('products', 'sku')->ignore($productId),
            ],

            'barcode' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('products', 'barcode')->ignore($productId),
            ],

            'price' => [
                'sometimes',
                'numeric',
                'min:0'
            ],

            'cost_price' => [
                'sometimes',
                'numeric',
                'min:0'
            ],

            'stock' => [
                'sometimes',
                'integer',
                'min:0'
            ],

            'is_active' => [
                'sometimes',
                'boolean'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'sku.unique' => 'SKU sudah digunakan oleh produk lain',
            'barcode.unique' => 'Barcode sudah digunakan oleh produk lain',
        ];
    }
}
