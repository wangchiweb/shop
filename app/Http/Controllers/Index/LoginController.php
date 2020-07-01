<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Illuminate\Support\Facades\Mail;
use App\Mail\Sendcode;

class LoginController extends Controller
{

	/*
    用户登录名称   wangchi@1228689869092917.onaliyun.com
	AccessKey ID   LTAI4GKd1WZCCgU9HZhJQ4hp
	SECRET(秘钥)   bbqXlcqEKgR3sEwoNzypvy2jvzuHDO
    */



    /*登录表单*/
    public function login(){
    	return view('index/login');
    }
    /*注册表单*/
    public function reg(){
    	return view('index/reg');
    }
    /*发送验证码*/
    public function send(Request $request){
    	$name=$request->name;
        
    	//echo $name;die;
    	//判断name是手机号还是邮箱
    	$reg_tel='/^1[3|4|5|6|7|8|9]\d{9}$/';
    	$reg_email='/^\w{3,}@([a-z]{2,7}|[0-9]{3})\.(com|cn)$/';
        //dd(preg_match($reg_email,$name));

    	$code=rand(1000,9999);   //在之间随机取一个
        if(preg_match($reg_tel,$name)){
    		//$res=$this->sendtel($name,$code);
            $res['Message']='OK';
            if($res['Message']=='OK'){
                $request->session()->put('code',$code);
                return json_encode(['code'=>'1','msg'=>'发送成功']);
            }
    	}else if(preg_match($reg_email,$name)){
    		$this->sendmail($name,$code);
            $request->session()->put('code',$code);
            return json_encode(['code'=>'1','msg'=>'发送成功']);
    	}else{
    		return json_encode(['code'=>'1','msg'=>'请输入正确的手机号或邮箱']);
    	}
    }

    /*邮箱发送验证码*/
    public function sendmail($mail,$code){
        return Mail::to($mail)->send(new Sendcode($code));
    }

    /*手机号发送验证码*/
    public function sendtel($tel,$code){
        // Download：https://github.com/aliyun/openapi-sdk-php
        // Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

        AlibabaCloud::accessKeyClient('LTAI4GKd1WZCCgU9HZhJQ4hp', 'bbqXlcqEKgR3sEwoNzypvy2jvzuHDO')
                                ->regionId('cn-hangzhou')
                                ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                                  ->product('Dysmsapi')
                                  // ->scheme('https') // https | http
                                  ->version('2017-05-25')
                                  ->action('SendSms')
                                  ->method('POST')
                                  ->host('dysmsapi.aliyuncs.com')
                                  ->options([
                                                'query' => [
                                                  'RegionId' => "cn-hangzhou",
                                                  'PhoneNumbers' => $tel,
                                                  'SignName' => "开心上学",
                                                  'TemplateCode' => "SMS_190720266",
                                                  'TemplateParam' => "{code:$code}",
                                                ],
                                            ])
                                  ->request();
            return $result->toArray();
        } catch (ClientException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        }
    }
    /*执行登录*/
    public function dologin(){

    }
    /*执行注册*/
    public function doreg(Request $request){
        $post=$request->all();
        dump($post);
        $code=$request->session()->get('code');
        //dd($code);
        //判断验证码是否正确
        if($post['code']!=$code){
            return redirect('login/reg')->with('msg','验证码不正确');
        }
        //判断两次密码是否一致
        if($post['password']!=$post['repassword']){
            return redirect('login/reg')->with('msg','两次密码不一致');
        }
        //入库
        
    }
}
