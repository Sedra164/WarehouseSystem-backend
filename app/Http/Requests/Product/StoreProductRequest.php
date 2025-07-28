<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'SKU'         => 'required|string|max:100|unique:products,SKU',
            'description' => 'required|string',
            'unit_id'     => 'required|exists:units,id',
            'category_id' => 'required|exists:categories,id',
        ];
    }
    public function messages(): array
    {
        return [
            'SKU.unique'         => 'This SKU already exists.',
            'unit_id.exists'     => 'The selected unit does not exist.',
            'category_id.exists' => 'The selected category does not exist.',
        ];
    }
}
