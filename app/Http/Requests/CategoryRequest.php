<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'tendanhmuc' => ['required', 'min:5'],
        ];
    }

    public function messages()
    {
        return [
            'tendanhmuc.required' => 'Tên danh mục là bắt buộc.',
            'tendanhmuc.min' => 'Tên danh mục phải có ít nhất 5 ký tự.',
        ];
    }
}
