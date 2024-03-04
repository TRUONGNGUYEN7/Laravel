<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolesCreateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'tennhomquyen' => ['required', 'unique:roles,name', 'min:5'],
            // Thêm các quy tắc kiểm tra khác nếu cần
        ];
    }

    public function messages()
    {
        return [
            'tennhomquyen.required' => 'Tên nhóm quyền là bắt buộc.',
            'tennhomquyen.unique' => 'Tên nhóm quyền đã tồn tại.',
            'tennhomquyen.min' => 'Tên nhóm quyền phải có ít nhất 5 ký tự.',
        ];
    }

}
