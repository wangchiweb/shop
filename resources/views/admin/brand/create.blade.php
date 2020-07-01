<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品品牌添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
	<h1>商品品牌添加
	<a href="{{url('brand/index')}}" style="float:right;">
		<button type="button" class="btn btn-success">列表</button>
	</a>
	</h1>
</center>

<!-- @if ($errors->any())
<div class="alert alert-danger">
  	<ul>
  	@foreach ($errors->all() as $error) 
  		<li>{{ $error }}</li> 
  	@endforeach 
    </ul> 
</div> 
@endif -->

<form class="form-horizontal" action="{{url('brand/store')}}" method="post" role="form" enctype="multipart/form-data">
	<!--三种生成表单令牌的方法-->
	@csrf
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="firstname" name="brand_name" 
				   placeholder="请输入品牌名称">
			<b style="color:red">{{$errors->first('brand_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="lastname" name="brand_url" 
				   placeholder="请输入品牌网址">
			<b style="color:red">{{$errors->first('brand_url')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌logo</label>
		<div class="col-sm-2">
			<input type="file" class="form-control" id="lastname" name="brand_logo">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌描述</label>
		<div class="col-sm-9">
			<textarea name="brand_desc" id="lastname" placeholder="请输入品牌描述" class="form-control" rows="5"></textarea> 
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>
<script>
	$(document).on('blur','input[name="brand_name"]',function(){
		$(this).next().empty();
		var brand_name=$(this).val();
		var obj=$(this);
		var reg=/^[\u4e00-\u9fa5\w]{2,15}$/;
		if(!reg.test(brand_name)){
			$(this).next().text('品牌名称必须由中文、字母、数字、下划线，长度2-15位组成');
			return;
		}

		/*唯一性验证*/
		//第一种
		$.get('/brand/checkname',{brand_name:brand_name},function(res){
			if(res.count){
				obj.next().text('品牌名称已存在');
			}
		},'json')
	})
</script>