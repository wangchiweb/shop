<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreWebsitePost extends FormRequest
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
            'website_name' =>[
                'required', 
                Rule::unique('website')->ignore(request()->id,'website_id'),
            ],
            'website_url' => 'required',
        ];
    }
    public function messages(){
        return [  
            'website_name.required'=>'网站名称必填',
            'website_name.unique'=>'网站名称已存在',
            'website_url.required'=>'网站网址必填',
        ]; 
    }
}
