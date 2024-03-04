<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RolesUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('id'); // Lấy ID hiện tại từ route
        return [
            'tenvaitro' => [
                'required',
                'min:5',
                Rule::unique('roles', 'name')->ignore($id, 'id'),
                
            ],
        ];
    }

    public function messages()
    {
        return [
            'tenvaitro.required' => 'Tên nhóm quyền là bắt buộc.',
            'tenvaitro.min' => 'Tên nhóm quyền phải có ít nhất 5 ký tự.',
            'tenvaitro.unique' => 'Tên nhóm quyền đã tồn tại.',
        ];
    }
}
