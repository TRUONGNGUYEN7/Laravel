<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class SubCategoryRequest extends AjaxFormRequest
{
    private $table            = 'chude';
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
        $id = $this->id;
        $condName  = "bail|required|between:5,100|unique:$this->table,name";

        if(!empty($id)){ // edit
            $condName  .= ",$id";
        }
        return  [
            'name'        => $condName,
            'danhmucID'      => 'required',
            'status'        => 'in:active,inactive'
        ];
    }
    public function attributes()
    {
        $arrAttr = Config::get('ntg.template.label');
        $arrAttr['name'] = 'Tên chủ đề';
        return $arrAttr;
    }
}
