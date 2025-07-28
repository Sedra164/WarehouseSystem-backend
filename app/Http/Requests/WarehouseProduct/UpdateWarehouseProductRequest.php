<?php

namespace App\Http\Requests\WarehouseProduct;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWarehouseProductRequest extends FormRequest
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
                    'product_id'  =>'sometimes|exists:product,id',
                    'quantity'    =>'sometimes|integer|min:0',
                    'min_quantity'=>'sometimes|integer|min:0'

        ];
    }
    public function messages(): array
    {
        return [
            'warehouse_id.exists' => 'The selected warehouse does not exist.',
            'product_id.exists'   => 'The selected product does not exist.',
        ];
    }
}
