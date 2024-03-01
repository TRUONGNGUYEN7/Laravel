<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminAccountRequest extends FormRequest
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
            'Name' => 'required|string',
            'Hoten' => 'required|string',
            'MatKhau' => 'required|string',
            'Email' => 'required|email',
            'roleID' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'Name.required' => 'Tên đăng nhập là bắt buộc',
            'Hoten.required' => 'Họ tên là bắt buộc',
            'MatKhau.required' => 'Mật khẩu là bắt buộc',
            'Email.required' => 'Email là bắt buộc',
            'Email.email' => 'Email không hợp lệ',
            'roleID.required' => 'Vai trò là bắt buộc'
        ];
    }
   
}
