<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreGoodsPost extends FormRequest
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
            'goods_name' =>[
                'required', 
                Rule::unique('goods')->ignore(request()->id,'goods_id'),
            ],
            'goods_price' => 'required',
            'goods_desc' => 'required',
            'goods_num' => 'required',
            'goods_score' => 'required',
        ];
    }
    public function messages(){
        return [  
            'goods_name.required'=>'商品名称必填',
            'goods_name.unique'=>'商品名称已存在',
            'goods_price.required'=>'商品价格必填',
            'goods_desc.required'=>'商品介绍必填',
            'goods_num.required'=>'商品库存必填',
            'goods_score.required'=>'商品积分必填',
        ]; 
    }
}
