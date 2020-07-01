@extends('index.layouts.shop')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('login/doreg')}}" method="post" class="reg-login">
     @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('login/login')}}">登录</a></h3>
      <div class="lrBox">
       <div class="lrList">
        <input type="text" name="name" placeholder="输入手机号码或者邮箱号" />
       </div>
       <div class="lrList2">
        <input type="text" name="code" placeholder="输入短信验证码" /> 
        <button type="button">获取验证码</button>
        <b style="color:red">{{session('msg')}}</b>
       </div>
       <div class="lrList">
        <input type="password" name="password" placeholder="设置新密码（6-18位数字或字母）" />
       </div>
       <div class="lrList">
        <input type="password" name="repassword" placeholder="再次输入密码" />
       </div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" value="立即注册" />
      </div>
     </form><!--reg-login/-->
<script>
    $(document).on('click','button',function(){
      var name=$('input[name="name"]').val();
      //alert(name);
      $.get('send',{name:name},function(res){
        if(res.code=='1'){
          alert(res.msg);
        }  
      },'json')
    });
    $(document).on('click','input[type="button"]',function(){
      //alert(123);
      var name=$('input[name="name"]').val();
      //alert(name);
      if(!name){
        alert('请输入正确的手机号或邮箱');
        return;
      }
      var code=$('input[name="code"]').val();
      if(!code){
        alert('请输入验证码');
        return;
      }
      var password=$('input[name="password"]').val();
      var reg =/^[a-zA-Z\d]{6,18}$/;
      //alert(reg.test(password));return;
      if(!reg.test(password)){
        alert('请输入密码6-18位数字或字母');
        return;
      }
      var repassword=$('input[name="repassword"]').val();
      if(repassword!==password){
        alert('两次密码不一致');
        return;
      }
      $('form').submit();
    })
</script>
     @endsection