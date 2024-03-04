<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubCategoryUpdateRequest extends FormRequest
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
        $id = $this->route('id'); // Lấy ID hiện tại từ route
        return [
            'tenchude' => [
                'required',
                'min:5',
                Rule::unique('tblchude')->ignore($id, 'IDCD'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'tenchude.required' => 'Tên danh mục là bắt buộc.',
            'tenchude.unique' => 'Tên danh mục đã tồn tại.',
            'tenchude.min' => 'Tên danh mục phải có ít nhất 5 ký tự.',
            // Thêm các thông báo lỗi tùy chỉnh khác nếu cần
        ];
    }
    
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isEmpty()) {
                $this->session()->flash('success', 'Sửa thành công!');
            }
        });
    }
}
