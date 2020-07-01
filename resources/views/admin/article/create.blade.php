<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>文章添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
	<h1>文章添加
	<a href="{{url('article/index')}}" style="float:right;">
		<button type="button" class="btn btn-success">列表</button>
	</a>
	</h1>
</center>

<form class="form-horizontal" action="{{url('article/store')}}" method="post" role="form" enctype="multipart/form-data">
	<!--三种生成表单令牌的方法-->
	@csrf
	
	<div class="form-group">
		<label for="firstname" class="col-sm-4 control-label">文章标题</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="firstname" name="article_title" 
				   placeholder="请输入文章标题">
			<b style="color:red">{{$errors->first('article_title')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-4 control-label">文章分类</label>
		<div class="col-sm-2">
			<select name="tid" class="form-control">
				<option value="0">--请选择--</option>
				@foreach($res as $v)
				<option value="{{$v->tid}}">
				{{$v->tname}}
				</option>
				@endforeach
			</select>
			<b style="color:red">{{$errors->first('tname')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-4 control-label">文章重要性</label>
		<div class="col-sm-3">
			<input type="radio" id="lastname" name="article_importance" value="1" checked>普通
			<input type="radio" id="lastname" name="article_importance" value="2">置顶
			<b style="color:red">{{$errors->first('article_importance')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-4 control-label">是否显示</label>
		<div class="col-sm-3">
			<input type="radio" id="lastname" name="is_show" value="1" checked>显示
			<input type="radio" id="lastname" name="is_show" value="2">不显示
			<b style="color:red">{{$errors->first('is_show')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-4 control-label">文章作者</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="lastname" name="article_author" 
				   placeholder="请输入文章作者">
			<b style="color:red">{{$errors->first('article_author')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-4 control-label">作者email</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="lastname" name="article_email" 
				   placeholder="请输入作者email">
			<b style="color:red">{{$errors->first('article_email')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-4 control-label">关键字</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="lastname" name="article_keyword" 
				   placeholder="请输入关键字">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-4 control-label">网页描述</label>
		<div class="col-sm-4">
			<textarea name="article_desc" id="lastname" placeholder="请输入网页描述" class="form-control" rows="5"></textarea> 
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-4 control-label">文章图片</label>
		<div class="col-sm-2">
			<input type="file" class="form-control" id="lastname" name="article_img">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>
<script>
	$(document).on('blur','input[name="article_title"]',function(){
		$(this).next().empty();
		var article_title=$(this).val();
		var obj=$(this);
		var reg=/^[\u4e00-\u9fa5\w]{2,15}$/;
		if(!reg.test(article_title)){
			$(this).next().text('文章标题必须由中文、字母、数字、下划线，长度2-15位组成');
			return;
		}
		/*唯一性验证*/
		//第一种
		$.get('/article/checktitle',{article_title:article_title},function(res){
			if(res.count){
				obj.next().text('文章标题已存在');
			}
		},'json')
	
		//第二种
		// var flag=false;
		// $.ajax({
		// 	type:"get",
		// 	url:{article_title:,article_title},
		// 	dataType:'json',
		// 	async:false,
		// 	success:function(res){
		// 		if(res.count){
		// 			obj.next().text('文章标题已存在');
		// 			flag=true;
		// 		}	
		// 	}
		// })
		// if(flag){
		// 	return;
		// }
	})
</script>