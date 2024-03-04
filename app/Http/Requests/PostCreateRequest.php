<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Post;

class PostCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'tenbaiviet' => ['required', 'unique:tblbaiviet,TenBV', 'min:5'],
            'mota' => ['required', 'min:5'],
            'noidung' => ['required', 'min:5'],
            'idchude' => ['required', 'not_in:capnhat'],
            'hinhanhthem' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isEmpty()) {
                $this->session()->flash('success', 'Thêm thành công!');
            }
        });
    }

    public function messages()
    {
        return [
            'tenbaiviet.required' => 'Tên bài viết là bắt buộc.',
            'tenbaiviet.min' => 'Tên bai viết phải có ít nhất 5 ký tự.',
            'tenbaiviet.unique' => 'Tên bài viết đã tồn tại.',

            'mota.required' => 'Mô tả là bắt buộc.',
            'mota.min' => 'Mô tả phải có ít nhất 5 ký tự.',

            'noidung.required' => 'Nội dung là bắt buộc.',
            'noidung.min' => 'Nội dung phải có ít nhất 5 ký tự.',

            'hinhanhthem.unique' => 'Tên đã tồn tại.',
            'hinhanhthem.required' => $this->hasFile('hinhanhthem') ? 'Hình ảnh chọn.' : '',
            'hinhanhthem.image' => $this->hasFile('hinhanhthem') ? 'Tệp phải là hình ảnh.' : '',
            'hinhanhthem.mimes' => $this->hasFile('hinhanhthem') ? 'Chỉ chấp nhận hình ảnh có định dạng: jpeg, png, jpg, gif.' : '',
            'hinhanhthem.max' => $this->hasFile('hinhanhthem') ? 'Kích thước hình ảnh không được vượt quá 2MB.' : '',
        
            'idchude.required' => 'Chủ đề là bắt buộc.',
            'idchude.not_in' => 'Vui lòng chọn một chủ đề khác với giá trị mặc định.',
        ];
    }
}
