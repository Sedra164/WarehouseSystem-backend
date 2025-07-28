<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoumentRequest extends FormRequest
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
            'type'                 => 'required|in:purchase,sale,waste',
            'notes'                => 'nullable|string',
            'date'                 => 'required|date',
            'partner_id'           => 'nullable|exists:partners,id',
            'warehouse_user_id'    => 'required|exists:warehouse_users,id',
            'warehouse_product_id' => 'required|exists:warehouse_products,id',
        ];
    }
}
