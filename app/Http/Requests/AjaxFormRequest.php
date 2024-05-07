<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
//use Illuminate\Validation\ValidationException;
//use Illuminate\Http\Exceptions\HttpResponseException;
use Config;
class AjaxFormRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required'    => ':attribute không được rỗng',
            'in'          => ':attribute không tồn tại',
            'between'     => ':attribute chiều dài phải có ít nhất :min ký tứ nhiều nhất :max ký tự',
            'unique'      => ':attribute đã tồn tại',
            'min'         => ':attribute chiều dài phải có ít nhất :min ký tứ',
            'exists'      => ':attribute phải tồn tại',
            'date_format' => ':attribute không đúng định dạng quy định :format',
            'max'         => ':attribute chiều dài phải có lớn nhất :max ký tứ',
            'confirmed'   => ':attribute không đúng',
            'file'        => ':attribute không đúng định dạng file',
            'mimes'       => ':attribute không đúng định dạng file: :values',
        ];
    }
    public function attributes()
    {
        return [];
    }

    /**
     * @overrride
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public $validator = null;
    protected function failedValidation(Validator $validator): void
    {
        $this->validator = $validator;
    }
}
