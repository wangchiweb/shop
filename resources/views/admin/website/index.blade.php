<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>友情链接列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<nav class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">电商</a>
    </div>
    <div>
        <ul class="nav navbar-nav">
            <li>
            	<a href="{{url('goods/index')}}">商品管理</a>
            </li>
            <li>
            	<a href="{{url('brand/index')}}">品牌管理</a>
            </li>
            <li>
            	<a href="{{url('category/index')}}">分类管理</a>
            </li>
            <li>
            	<a href="{{url('admin/index')}}">管理员管理</a>
            </li>
            <li>
            	<a href="{{url('student/index')}}">学生管理</a>
            </li>
            <li>
            	<a href="{{url('website/index')}}">友情链接管理</a>
            </li>
            <li>
            	<a href="{{url('article/index')}}">文章管理</a>
            </li>
        </ul>
    </div>
	</div>
</nav>

<center>
	<h1>友情链接列表
	<a href="{{url('website/create')}}" style="float:right;">
		<button type="button" class="btn btn-success">添加</button>
	</a>
	</h1>
</center>

<form action="">
	<div class="form-group">
		<div class="col-sm-2">
			<input type="text" class="form-control" id="firstname" 
			name="website_name" placeholder="请输入网站名称关键字" 
			value="{{$website_name}}">
		</div>
		<input type="submit" class="btn btn-info" value="搜索">
	</div>
</form>

<table class="table table-hover">
	<thead>
		<tr>
			<th>网站id</th>
			<th>网站名称</th>
			<th>网站网址</th>
			<th>链接类型</th>
			<th>网站图片</th>
			<th>网站联系人</th>
			<th>网站介绍</th>
			<th>是否显示</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($res as $v)
		<tr>
			<td>{{$v->website_id}}</td>
			<td>{{$v->website_name}}</td>
			<td>{{$v->website_url}}</td>
			<td>{{$v->website_type==1?'LOGO链接':'文字链接'}}</td>
			<td>
				@if($v->website_img) 
				<img src="{{env('UPLOADS_URL')}}/{{$v->website_img}}" 
				width="80px" height="60px"> 
				@endif
			</td>
			<td>{{$v->website_man}}</td>
			<td>{{$v->website_desc}}</td>
			<td>{{$v->is_show==1?'是':'否'}}</td>
			<td>
				<a href="{{url('website/edit/'.$v->website_id)}}">
					<button type="button" class="btn btn-primary">修改</button>
				</a>
				<a href="{{url('website/destroy/'.$v->website_id)}}">
					<button type="button" class="btn btn-danger">删除</button>
				</a>
			</td>
		</tr>
		@endforeach
		<tr>
			<td colspan="6">{{$res->appends(['website_name'=>$website_name])->links()}}</td>
		</tr>
	</tbody>
</table>

</body>
</html>