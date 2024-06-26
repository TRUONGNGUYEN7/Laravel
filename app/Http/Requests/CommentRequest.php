<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'content' => ['required', 'min:4'],
            'email' => ['required', 'min:3'],
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Tên là bắt buộc.',
            'content.min' => 'Tên phải có ít nhất 3 ký tự.',

            'email.required' => 'Email là bắt buộc.',
            'email.min' => 'Email phải có ít nhất 5 ký tự.',

        ];
    }
}
