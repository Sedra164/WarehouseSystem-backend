<?php

namespace App\Http\Requests\warehouseUser;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWarehouseUserRequest extends FormRequest
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
            'full_name'    =>'sometimes|string|max:255',
            'email'        =>'sometimes|email|max:255',
            'password'     =>'nullable|string|min:8',
            'warehouse_id' =>'sometimes|exists:warehouses,id',
        ];
    }
}
