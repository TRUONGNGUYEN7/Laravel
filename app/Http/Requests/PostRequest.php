<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'tenbaiviet' => ['required', 'min:5'],
            'mota' => ['required', 'min:5'],
            'noidung' => ['required', 'min:5'],
            'hinhanh' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'idchude' => ['required', 'not_in:capnhat'],
        ];
    }

    public function messages()
    {
        return [
            'tenbaiviet.required' => 'Tên danh mục là bắt buộc.',
            'tenbaiviet.min' => 'Tên danh mục phải có ít nhất 5 ký tự.',

            'mota.required' => 'Mô tả là bắt buộc.',
            'mota.min' => 'Mô tả phải có ít nhất 5 ký tự.',

            'noidung.required' => 'Mô tả là bắt buộc.',
            'noidung.min' => 'Mô tả phải có ít nhất 5 ký tự.',

            'hinhanh.required' => 'Hình ảnh là bắt buộc.',
            'hinhanh.image' => 'Tệp phải là hình ảnh.',
            'hinhanh.mimes' => 'Chỉ chấp nhận hình ảnh có định dạng: jpeg, png, jpg, gif.',
            'hinhanh.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',

            'idchude.required' => 'Chủ đề là bắt buộc.',
            'idchude.not_in' => 'Vui lòng chọn một chủ đề khác với giá trị mặc định.',
        ];
    }
}
