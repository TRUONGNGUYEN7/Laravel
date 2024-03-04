<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('id'); // Lấy ID hiện tại từ route
        return [
            'tenbaiviet' => ['required', 'min:5', Rule::unique('tblbaiviet', 'TenBV')->ignore($id, 'IDBV')],
            'mota' => ['required', 'min:5'],
            'noidung' => ['required', 'min:5'],
            'idchude' => ['required', 'not_in:capnhat'],
            'hinhanhsua' => [
                'image', 
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
            ]
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

    public function messages()
    {
        return [
            'tenbaiviet.required' => 'Tên bài viết là bắt buộc.',
            'tenbaiviet.min' => 'Tên bài viết phải có ít nhất 5 ký tự.',
            'tenbaiviet.unique' => 'Tên bài viết đã tồn tại.',

            'mota.required' => 'Mô tả là bắt buộc.',
            'mota.min' => 'Mô tả phải có ít nhất 5 ký tự.',

            'noidung.required' => 'Nội dung là bắt buộc.',
            'noidung.min' => 'Nội dung phải có ít nhất 5 ký tự.',
        
            'hinhanhsua.image' => $this->hasFile('hinhanhsua') ? 'Tệp phải là hình ảnh.' : '',
            'hinhanhsua.mimes' => $this->hasFile('hinhanhsua') ? 'Chỉ chấp nhận hình ảnh có định dạng: jpeg, png, jpg, gif.' : '',
            'hinhanhsua.max' => $this->hasFile('hinhanhsua') ? 'Kích thước hình ảnh không được vượt quá 2MB.' : '',        

            'idchude.required' => 'Chủ đề là bắt buộc.',
            'idchude.not_in' => 'Vui lòng chọn một chủ đề khác với giá trị mặc định.',
        ];
    }
}
