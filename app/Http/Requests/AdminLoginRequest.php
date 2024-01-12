<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
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
            'adminname' => ['required', 'regex:/^[a-zA-Z0-9]+$/i', 'min:5'],
            'adminpass' => ['required', 'min:3'],
        ];
    }
    public function messages()
    {
        return [
            'adminname.required' => 'Tên quản trị viên là bắt buộc.',
            'adminname.regex' => 'Tên quản trị viên không được chứa ký tự đặc biệt.',
            'adminname.min' => 'Tên quản trị viên phải có ít nhất 5 ký tự.',
            'adminpass.required' => 'Mật khẩu là bắt buộc.',
            'adminpass.min' => 'Mật khẩu phải có ít nhất 3 ký tự.',
        ];
    }
   
}
