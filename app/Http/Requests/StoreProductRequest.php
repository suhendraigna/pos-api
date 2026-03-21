<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
        return [
            'store_id' => [
                'required',
                Rule::exists('stores', 'id')
            ],

            'category_id' => [
                'required',
                Rule::exists('categories', 'id')
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'sku' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('products', 'sku'),
            ],

            'barcode' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('products', 'barcode'),
            ],

            'price' => [
                'required',
                'numeric',
                'min:0'

            ],

            'cost_price' => [
                'required',
                'numeric',
                'min:0'
            ],

            'stock' => [
                'required',
                'integer',
                'min:0'
            ],

            'is_active' => [
                'sometimes',
                'boolean',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'store_id.required' => 'Store wajib dipilih',
            'store_id.exists' => 'Store tidak ditemukan',

            'category_id.required' => 'Kategori wajin dipilih',
            'category_id.exists' => 'Kategory tidak ditemukan',

            'name.required' => 'Nama produk wajib diisi',

            'sku.unique' => 'SKU sudah digunakan',
            'barcode.unique' => 'Barcode sudah digunakan',

            'price.required' => 'Harga wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',

           'stock.min' => 'Stock tidak boleh minus'
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'name' => $this->name? trim($this->name) : null,
        ]);
    }
}
