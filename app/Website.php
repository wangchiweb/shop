<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $table = 'website';//指定表
    protected $primaryKey = 'website_id';//指定主键
    public $timestamps = false;//表明模型是否应该被打上时间戳
}
