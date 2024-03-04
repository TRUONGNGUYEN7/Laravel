<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;

class CategoryCreateRequest extends FormRequest
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
            'tendanhmuc' => ['required', 'unique:tbldanhmuc,TenDanhMuc', 'min:5'],
            // Thêm các quy tắc kiểm tra khác nếu cần
        ];
    }

    public function messages()
    {
        return [
            'tendanhmuc.required' => 'Tên danh mục là bắt buộc.',
            'tendanhmuc.unique' => 'Tên danh mục đã tồn tại.',
            'tendanhmuc.min' => 'Tên danh mục phải có ít nhất 5 ký tự.',
            // Thêm các thông báo lỗi tùy chỉnh khác nếu cần
        ];
    }
    
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isEmpty()) {
                $this->session()->flash('success', 'Thêm danh mục thành công!');
            }
        });
    }

}
