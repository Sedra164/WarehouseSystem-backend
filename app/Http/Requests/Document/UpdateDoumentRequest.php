<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoumentRequest extends FormRequest
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
            'type'                 => 'sometimes|string|max:255',
            'notes'                => 'sometimes|nullable|string',
            'date'                 => 'sometimes|date',
            'partner_id'           => 'sometimes|nullable|exists:partners,id',
            'warehouse_user_id'    => 'sometimes|exists:warehouse_users,id',
            'warehouse_product_id' => 'sometimes|exists:warehouse_products,id',
        ];
    }
}
