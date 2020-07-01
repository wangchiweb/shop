<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreArticlePost extends FormRequest
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
            'article_title' =>[
                'required', 
                Rule::unique('article')->ignore(request()->id,'article_id'),
            ],
            'tname' => 'required',
            'article_importance' => 'required',
            'is_show' => 'required',
        ];
    }
    public function messages(){
        return [  
            'article_title.required'=>'文章标题必填',
            'article_title.unique'=>'文章标题已存在',
            'tname.required'=>'文章分类必填',
            'article_importance.required'=>'文章重要性必填',
            'is_show.required'=>'是否显示必填',
        ]; 
    }
}
