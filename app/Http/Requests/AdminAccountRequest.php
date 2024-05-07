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
            'name' => 'required|string',
            'fullName' => 'required|string',
            'password' => 'required|string',
            'email' => 'required|email',
            'roleID' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên đăng nhập là bắt buộc',
            'fullName.required' => 'Họ tên là bắt buộc',
            'password.required' => 'Mật khẩu là bắt buộc',
            'email.required' => 'email là bắt buộc',
            'email.email' => 'email không hợp lệ',
            'roleID.required' => 'Vai trò là bắt buộc'
        ];
    }
   
}
