<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\SubCategory;

class SubCategoryCreateRequest extends FormRequest
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
            'tenchude' => ['required','unique:tblchude,TenChuDe', 'min:3'],
            'iddanhmuc' => ['required'],
            

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

    public function messages()
    {
        return [
            'tenchude.required' => 'Tên chủ đề là bắt buộc.',
            'tenchude.min' => 'Tên chủ đề phải có ít nhất 5 ký tự.',
            'tenchude.unique' => 'Tên danh mục đã tồn tại.',
            'iddanhmuc.required' => 'Danh mục là bắt buộc.',

        ];
    }
}
