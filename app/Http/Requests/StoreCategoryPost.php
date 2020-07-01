<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreCategoryPost extends FormRequest
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
        return [
            'cate_name' =>[
                'required', 
                Rule::unique('category')->ignore(request()->id,'cate_id'),
            ]
        ];
    }
    public function messages(){
        return [  
            'cate_name.required'=>'分类名称必填',
            'cate_name.unique'=>'分类名称已存在',
        ]; 
    }
}
