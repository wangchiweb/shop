@extends('index.layouts.shop')
@section('content')
@section('title','阿里妈妈首页')
<div class="head-top">
      <img src="/static/index/images/head.jpg" />
      <dl>
       <dt><a href="user.html"><img src="/static/index/images/touxiang.jpg" /></a></dt>
       <dd>
        <h1 class="username">三级分销终身荣誉会员</h1>
        <ul>
         <li><a href="prolist.html"><strong>34</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     <ul class="reg-login-click">
      <li><a href="{{url('login/login')}}">登录</a></li>
      <li><a href="{{url('login/reg')}}" class="rlbg">注册</a></li>
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     
     @foreach($res as $v)
     <div id="sliderA" class="slider">
      @if($v->goods_img)
        <img src="{{env('UPLOADS_URL')}}/{{$v->goods_img}}" width="400px" height="240px">
      @endif
     </div><!--sliderA/-->
     <ul class="pronav">
      <li><a href="prolist.html">{{$v->goods_name}}</a></li>
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     @endforeach

     <div class="index-pro1">

      <div class="index-pro1-list">
       <dl>
        <dt><a href="proinfo.html"><img src="/static/index/images/pro1.jpg" /></a></dt>
        <dd class="ip-text"><a href="proinfo.html">这是产品的名称</a><span>已售：488</span></dd>
        <dd class="ip-price"><strong>¥299</strong> <span>¥599</span></dd>
       </dl>
      </div>

      <div class="clearfix"></div>
     </div><!--index-pro1/-->
     <div class="prolist">

      <dl>
       <dt><a href="proinfo.html"><img src="/static/index/images/prolist1.jpg" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="proinfo.html">四叶草</a></h3>
        <div class="prolist-price"><strong>¥299</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>

     </div><!--prolist/-->
     <div class="joins"><a href="fenxiao.html"><img src="/static/index/images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>
     @endsection