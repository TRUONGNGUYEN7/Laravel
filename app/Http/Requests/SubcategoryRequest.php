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
            'tenchude' => ['required', 'regex:/^[a-zA-Z0-9]+$/i', 'min:5'],
            'idchude' => ['required', 'not_in:chude'],
        ];
    }

    public function messages()
    {
        return [
            'tenchude.required' => 'Tên danh mục là bắt buộc.',
            'tenchude.regex' => 'Tên danh mục không được chứa ký tự đặc biệt.',
            'tenchude.min' => 'Tên danh mục phải có ít nhất 5 ký tự.',

            'idchude.required' => 'Danh mục là bắt buộc.',
            'idchude.not_in' => 'Vui lòng chọn một danh mục khác với giá trị mặc định.',
        ];
    }
}
