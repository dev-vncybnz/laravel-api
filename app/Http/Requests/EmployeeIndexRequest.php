<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeIndexRequest extends FormRequest
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
            'page' => [
                'required',
                'integer',
                'min:1'
            ],
            'per_page' => [
                'required',
                'integer',
                'min:1'
            ],
            'keyword' => [
                'nullable',
                'string',
                'max:255'
            ]
        ];
    }
}
