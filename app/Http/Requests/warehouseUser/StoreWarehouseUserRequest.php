<?php

namespace App\Http\Requests\warehouseUser;

use Illuminate\Foundation\Http\FormRequest;

class StoreWarehouseUserRequest extends FormRequest
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
            'full_name'    => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:8',
            'warehouse_id' => 'required|exists:warehouses,id',
            'type'         => 'required|in:manager,staff',
        ];
    }
}
