<?php

namespace App\Http\Requests\Unit;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitRequest extends FormRequest
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
            'name'       =>'sometimes|string|max:255',
            'abbreviation'=>'sometimes|string|max:10|unique:units,abbreviation'
        ];
    }
    public function messages(): array
    {
        return [
            'abbreviation.unique' => 'This abbreviation is already taken.',
        ];
    }
}
