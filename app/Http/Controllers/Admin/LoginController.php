<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function logindo(Request $request){
    	$post=$request->all();
        //dd($post);
    	//先根据账号查询记录
    	$login=Admin::where('admin_account',$post['admin_account'])->first();
    	//dd($login);
    	if(!$login){
    		return redirect('login/login')->with('msg','用户名或密码不正确');
    	}
    	//解密密码跟$post的对比是否一致
    	//dd(decrypt($login->admin_pwd));
    	if(decrypt($login->admin_pwd)!=$post['admin_pwd']){
    		return redirect('login/login')->with('msg','用户名或密码不正确');
    	}
    	request()->session()->put('login',$login);
        if(isset($post['remember'])){
            //七天免登陆
            Cookie::queue('login',serialize($login),60*24*7);//分钟
        }
    	return redirect('brand/index');
    }
}
