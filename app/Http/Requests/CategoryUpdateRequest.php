<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $iddm = $this->route('id'); // Lấy ID hiện tại từ route
        return [
            'tendanhmuc' => [
                'required',
                'min:5',
                Rule::unique('tbldanhmuc')->ignore($iddm, 'IDDM'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'tendanhmuc.required' => 'Tên danh mục là bắt buộc.',
            'tendanhmuc.min' => 'Tên danh mục phải có ít nhất 5 ký tự.',
            'tendanhmuc.unique' => 'Tên danh mục đã tồn tại.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isEmpty()) {
                $this->session()->flash('success', 'Sửa danh mục thành công!');
            }
        });
    }

}
