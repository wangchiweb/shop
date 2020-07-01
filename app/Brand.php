<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';//指定表
    protected $primaryKey = 'brand_id';//指定主键
    public $timestamps = false;//表明模型是否应该被打上时间戳
}
