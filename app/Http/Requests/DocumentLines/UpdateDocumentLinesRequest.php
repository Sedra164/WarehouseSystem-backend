<?php

namespace App\Http\Requests\DocumentLines;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentLinesRequest extends FormRequest
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
            'quantity'      => 'sometimes|integer|min:1',
            'unit_price'   => 'sometimes|numeric|min:0',
            'document_id'   => 'sometimes|exists:documents,id',
        ];
    }
}
