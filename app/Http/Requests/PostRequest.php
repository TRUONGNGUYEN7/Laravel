<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class PostRequest extends AjaxFormRequest
{
    private $table            = 'baiviet';
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

        return [
            'name' => $condName,
            'descride' => 'nullable|string|max:255',
            'content' => 'required|string', 
            'image' => $id ? 'nullable' : 'required', 
            'chudeID' => 'required|exists:chude,id',
            'status' => 'required|in:active,inactive',
        ];
    }
    public function attributes()
    {
        $arrAttr = Config::get('ntg.template.label');
        $arrAttr['name'] = 'Tên bài viết';
        $arrAttr['descride'] = 'Mô tả';
        $arrAttr['content'] = 'Nội dung';
        return $arrAttr;
    }
}
