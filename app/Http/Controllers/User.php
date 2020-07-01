<?php 
	namespace App\Http\Controllers;
	use Illuminate\Http\Request;
	class User extends Controller{
		public function index(){
			echo "index页面";
			//return view('welcome');
		}

		public function add(){
			return view('add');
		}

		public function adddo(){
			echo "提交成功";
		}
	}
 ?>