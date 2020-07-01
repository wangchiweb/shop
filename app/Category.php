<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';//指定表
    protected $primaryKey = 'cate_id';//指定主键
    public $timestamps = false;//表明模型是否应该被打上时间戳
}
