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

    public function rules()
    {
        $rules = [
            'tenbaiviet' => ['required', 'min:5'],
            'mota' => ['required', 'min:5'],
            'noidung' => ['required', 'min:5'],
            'idchude' => ['required', 'not_in:capnhat'],
        ];
    
        if ($this->hasFile('hinhanhthem')) {
            $rules['hinhanhthem'] = ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'];
        }
    
        if ($this->hasFile('hinhanhsua')) {
            $rules['hinhanhsua'] = ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'];
        }
    
        return $rules;
    }
    
    public function messages()
    {
        return [
            'tenbaiviet.required' => 'Tên danh mục là bắt buộc.',
            'tenbaiviet.min' => 'Tên danh mục phải có ít nhất 5 ký tự.',

            'mota.required' => 'Mô tả là bắt buộc.',
            'mota.min' => 'Mô tả phải có ít nhất 5 ký tự.',

            'noidung.required' => 'Nội dung là bắt buộc.',
            'noidung.min' => 'Nội dung phải có ít nhất 5 ký tự.',

            'hinhanhthem.required' => $this->hasFile('hinhanhthem') ? 'Hình ảnh chọn.' : '',
            'hinhanhthem.image' => $this->hasFile('hinhanhthem') ? 'Tệp phải là hình ảnh.' : '',
            'hinhanhthem.mimes' => $this->hasFile('hinhanhthem') ? 'Chỉ chấp nhận hình ảnh có định dạng: jpeg, png, jpg, gif.' : '',
            'hinhanhthem.max' => $this->hasFile('hinhanhthem') ? 'Kích thước hình ảnh không được vượt quá 2MB.' : '',
        
            'hinhanhsua.image' => $this->hasFile('hinhanhsua') ? 'Tệp phải là hình ảnh.' : '',
            'hinhanhsua.mimes' => $this->hasFile('hinhanhsua') ? 'Chỉ chấp nhận hình ảnh có định dạng: jpeg, png, jpg, gif.' : '',
            'hinhanhsua.max' => $this->hasFile('hinhanhsua') ? 'Kích thước hình ảnh không được vượt quá 2MB.' : '',        

            'idchude.required' => 'Chủ đề là bắt buộc.',
            'idchude.not_in' => 'Vui lòng chọn một chủ đề khác với giá trị mặc định.',
        ];
    }
}
