<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreStudentPost extends FormRequest
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
            'name' =>[
                'required', 
                Rule::unique('student')->ignore(request()->id,'sid'),
            ],
            'age' => 'required',
        ];
    }
    public function messages(){
        return [  
            'name.required'=>'姓名必填',
            'name.unique'=>'姓名已存在',
            'age.required'=>'年龄必填',
        ]; 
    }
}
