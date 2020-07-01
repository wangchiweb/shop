<?php 
	/*单文件上传*/
	    function upload($filename){
	    	$file=request()->file($filename);
	    	if($file->isValid()){
	    		$path=$file->store('uploads');
	    		return $path;
	    	}
	    	die('文件上传过程出错');
	    }
	//要处理的数据，父级分类id，级别(1级最大)
        function createTree($data,$pid=0,$level=0){
            if(!$data) return;
            static $arr=[];
            foreach($data as $v){
                if($v->pid==$pid){
                    $v->level=$level;
                    $arr[]=$v;
                    createTree($data,$v->cate_id,$level+1);
                }
            }
            return $arr;
        }
 ?>