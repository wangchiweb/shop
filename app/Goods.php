<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'goods';//指定表
    protected $primaryKey = 'goods_id';//指定主键
    public $timestamps = false;//表明模型是否应该被打上时间戳
}
