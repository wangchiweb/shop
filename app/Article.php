<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';//指定表
    protected $primaryKey = 'article_id';//指定主键
    public $timestamps = false;//表明模型是否应该被打上时间戳
}
