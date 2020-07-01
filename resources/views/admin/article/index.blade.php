<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>文章列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{csrf_token()}}">
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
	<h1>文章列表
	<a href="{{url('article/create')}}" style="float:right;">
		<button type="button" class="btn btn-success">添加</button>
	</a>
	</h1>
</center>

<form action="">
	<select name="tid">
		<option value="0">--请选择--</option>
		@foreach($res1 as $t)
		<option value="{{$t->tid}}"
		{{$tid==$t->tid?"selected":""}}>
			{{$t->tname}}
		</option>
		@endforeach
	</select>
	<input type="text" name="article_title" placeholder="请输入文章标题关键字" value="{{$article_title}}">
	<input type="submit" class="btn btn-info" value="搜索">
</form>

<table class="table table-hover">
	<thead>
		<tr>
			<th>文章id</th>
			<th>文章标题</th>
			<th>文章分类</th>
			<th>文章重要性</th>
			<th>是否显示</th>
			<th>文章图片</th>
			<th>添加日期</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($res as $v)
		<tr>
			<td>{{$v->article_id}}</td>
			<td>{{$v->article_title}}</td>
			<td>{{$v->tname}}</td>
			<td>{{$v->article_importance==1?'普通':'置顶'}}</td>
			<td>{{$v->is_show==1?'√':'×'}}</td>
			<td>
				@if($v->article_img) 
				<img src="{{env('UPLOADS_URL')}}/{{$v->article_img}}" 
				width="80px" height="60px"> 
				@endif
			</td>
			<td>{{date("Y-m-d H:i:s",$v->article_time)}}</td>
			<td>
				<a href="{{url('article/edit/'.$v->article_id)}}">
					<button type="button" class="btn btn-primary">修改</button>
				</a>
					<button type="button" class="btn btn-danger" 
					article_id="{{$v->article_id}}">删除</button>
			</td>
		</tr>
		@endforeach
		<tr>
			<td colspan="6">{{$res->appends(['article_title'=>$article_title,'tid'=>$tid])->links()}}</td>
		</tr>
		</tr>
	</tbody>
</table>

</body>
</html>
<script>
	$(document).on('click','.btn-danger',function(){
		//alert(646565);
		//获当前点击的这个删除按钮对象
		var _this=$(this);
		//获取id值;   获取自定义属性:对象.attr("属性名");
		var article_id=_this.attr("article_id");
		//alert(article_id);
		// /*第一种ajax删除*/
		// var obj=$(this);
		// if(confirm('您确定要删除吗？')){
		// 	$.get('/article/destroy/'+article_id,function(res){
		//     	if(res.code=='00000'){
		//     		//obj.parents('tr');//效率高，有bug
		//     		location.reload();//效率低，无bug
		//     	}
		//     },'json');
		// }
		    
		/*第二种ajax删除*/
		var obj=$(this);
		$.ajaxSetup({ headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		} });
		if(confirm('您确定要删除吗？')){
			$.post('/article/destroy/'+article_id,function(res){
				if(res.code=='1'){
					//obj.parents('tr');//效率高，有bug
		     		location.reload();//效率低，无bug
				}
			},'json');
		}	
	})
</script>