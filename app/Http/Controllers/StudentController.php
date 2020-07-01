<?php 
	namespace App\Http\Controllers;
	use Illuminate\Http\Request;
	class StudentController extends Controller{
	    public function list(){
	    	echo "学生列表";
	    }	

	    public function create(){
	    	return view("create",['name'=>'赵云']);
	    }

	    //接收数据
	    public function store(){
	    	$name=$_POST['name'];
	    	echo $name;
	    }

	    //数组
	    public function arr(){
	    	$arr=[1,2,3,4,5];
	    	//第一种
	    	$arr[2]=90;
	    	$arr[3]=3;
	    	$arr[4]=4;
	    	$arr[5]=5;

	    	// //第二种
	    	// $str=implode(',',$arr);
	    	// //dump($str);die;
	    	// $str=substr_replace($str,'90,3',4,1);
	    	// //dump($str);die;
	    	// $arr=explode(',',$str);
	    	print_r($arr);

	    }

	    public function arr1 (){
	    	$arr1=[1,2,3,4,5];
	    	//第一种
	    	unset($arr1[3]);

	    	//第二种
	    	// $str=implode(',',$arr1);
	    	// //dump($str);die;
	    	// $str=substr_replace($str,'',6,2);
	    	// //dump($str);die;
	    	// $arr1=explode(',',$str);
	    	print_r($arr1);

	    }
	}
 ?>

	


