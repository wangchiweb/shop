<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
class TestController extends Controller
{
	/*设置cookie(存cookie)*/
    public function setcookie(){
    	// //第一种
    	// return response('php')->cookie('user','张三',2);
    	// //第二种
    	// Cookie::queue(Cookie::make('user','李四',1));
    	//第三种
    	Cookie::queue('user','月球',1);
    }
    /*取cookie*/
    public function getcookie(Request $request){
    	//第一种
    	dd($request->cookie('user'));
    	// //第二种
    	// dd(Cookie::get('user'));
    }
    /*设置session(存session)*/
    public function setsession(Request $request){
    	//第一种
    	session(['name'=>'张三']);
    	//第二种
    	request()->session()->put('number',999);
    }
    /*取session*/
    public function getsession(Request $request){
    	//第一种
    	echo session('name');
    	// //第二种
    	// dump(request()->session()->get('number'));
    	// //第三种(获取所有的session)
	    // dump(request()->session()->all());

    	// //如果没有，设置默认值
	    // dump(session('place','月球'));
	    // dump(request()->session()->get('sex','男'));
    }
    /*检测session*/
    public function testsession(Request $request){
    	// // session(['city'=>null]);
    	// //检测此下标是否有值
	    // dump(request()->session()->has('city'));
	    // //检测是否有此下标
	    // dump(request()->session()->exists('city'));
    }
    /*删除session*/
    public function delsession(Request $request){
    	// //删除单个
	    // dump(request()->session()->forget('number'));
	    // //获取所有的session
	    // dump(request()->session()->all());
	    // //删除所有
	    // dump(request()->session()->flush());
	    // //获取所有的session
	    // dump(request()->session()->all());
    }
}
