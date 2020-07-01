<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $login=request()->session()->get('login');
        if(!$login){//如果session中没值
            //七天免登陆 从cookie中取值；如果有值，存入session；如果没值，跳转到登录页面
            $res=Cookie::get('login');//取cookie
            if($res){
                request()->session()->put('login',unserialize($res));
            }else{
                return redirect('login/login');
            }     
        }
        return $next($request);
    }
}
