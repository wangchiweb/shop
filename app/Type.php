<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';//指定表
    protected $primaryKey = 'tid';//指定主键
    public $timestamps = false;//表明模型是否应该被打上时间戳
}
