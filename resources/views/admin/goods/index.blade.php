<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品列表</title>
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
	<h1>商品列表
	<a href="{{url('goods/create')}}" style="float:right;">
		<button type="button" class="btn btn-success">添加</button>
	</a>
	</h1>
</center>

<form action="">
	<div class="form-group">
		<div class="col-sm-2">
			<input type="text" class="form-control" id="firstname" 
			name="goods_name" placeholder="请输入商品名称关键字" 
			value="{{$goods_name}}">
		</div>
		<input type="submit" class="btn btn-info" value="搜索">
	</div>
</form>

<table class="table table-hover">
	<thead>
		<tr>
			<th>商品id</th>
			<th>商品名称</th>
			<th>商品价格</th>
			<th>商品介绍</th>
			<th>商品库存</th>
			<th>商品积分</th>
			<th>商品图片</th>
			<th>商品相册</th>
			<th>是否新品</th>
			<th>是否热销</th>
			<th>是否精品</th>
			<th>是否上架</th>
			<th>所属品牌</th>
			<th>所属分类</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($res as $v)
		<tr>
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_price}}</td>
			<td>{{$v->goods_desc}}</td>
			<td>{{$v->goods_num}}</td>
			<td>{{$v->goods_score}}</td>
			<td>
				@if($v->goods_img)
				<img src="{{env('UPLOADS_URL')}}/{{$v->goods_img}}"
				width="80px" height="60px">
				@endif
			</td>
			<td>
				{{$v->goods_imgs}}
			</td>
			<td>
				@if($v->is_new==1) 是 @elseif($v->is_new==2) 否 @endif
			</td>
			<td>
				@if($v->is_hot==1) 是 @elseif($v->is_hot==2) 否 @endif
			</td>
			<td>
				@if($v->is_best==1) 是 @elseif($v->is_best==2) 否 @endif
			</td>
			<td>
				@if($v->is_best==1) 是 @elseif($v->is_best==2) 否 @endif
			</td>
			<td>{{$v->brand_id}}</td>
			<td>{{$v->cate_id}}</td>
			<td>
				<a href="{{url('goods/edit/'.$v->goods_id)}}">
					<button type="button" class="btn btn-primary">修改</button>
				</a>
				<a href="{{url('goods/destroy/'.$v->goods_id)}}">
					<button type="button" class="btn btn-danger">删除</button>
				</a>
			</td>
		</tr>
		@endforeach
		<tr>
			<td colspan="6">{{$res->appends(['goods_name'=>$goods_name])->links()}}</td>
		</tr>
	</tbody>
</table>

</body>
</html>