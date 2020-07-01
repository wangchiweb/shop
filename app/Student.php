<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';//指定表
    protected $primaryKey = 'sid';//指定主键
    public $timestamps = false;//表明模型是否应该被打上时间戳
}
