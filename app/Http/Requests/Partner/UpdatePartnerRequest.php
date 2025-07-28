<?php

namespace App\Http\Requests\Partner;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartnerRequest extends FormRequest
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
            'name'   =>'sometimes|string|max:255',
            'email'  =>'sometimes|email|unique:partners,email',
            'address'=>'sometimes|string',
            'phone'  =>'sometimes|regex:/^09[0-9]{8}$/',
            'type'   =>'sometimes|in:supplier,customer',
        ];
    }
}
