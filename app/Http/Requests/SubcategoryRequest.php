<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubcategoryRequest extends FormRequest
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
            'tenchude' => ['required', 'min:3'],

        ];
    }

    public function messages()
    {
        return [
            'tenchude.required' => 'Tên chủ đề là bắt buộc.',
            'tenchude.min' => 'Tên chủ đề phải có ít nhất 5 ký tự.',

        ];
    }
}
