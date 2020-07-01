<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
	<h1>商品添加
	<a href="{{url('goods/index')}}" style="float:right;">
		<button type="button" class="btn btn-success">列表</button>
	</a>
	</h1>
</center>

<form class="form-horizontal" action="{{url('goods/store')}}" method="post"
 role="form" enctype="multipart/form-data">
	<!--三种生成表单令牌的方法-->
	@csrf
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="firstname" name="goods_name" 
				   placeholder="请输入商品名称">
				   <b style="color:red">{{$errors->first('goods_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="firstname" name="goods_price" 
				   placeholder="请输入商品价格">
				   <b style="color:red">{{$errors->first('goods_price')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品介绍</label>
		<div class="col-sm-9">
			<textarea name="goods_desc" id="lastname" placeholder="请输入商品介绍" class="form-control" rows="5"></textarea>
			<b style="color:red">{{$errors->first('goods_desc')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="firstname" name="goods_num" 
				   placeholder="请输入商品库存">
				   <b style="color:red">{{$errors->first('goods_num')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品积分</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="firstname" name="goods_score" 
				   placeholder="请输入商品积分">
				   <b style="color:red">{{$errors->first('goods_score')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品图片</label>
		<div class="col-sm-2">
			<input type="file" class="form-control" id="lastname" name="goods_img">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-2">
			<input type="file" class="form-control" id="lastname" name="goods_imgs">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-2">
			<input type="radio" id="lastname" name="is_new" value="1" checked>是
			<input type="radio" id="lastname" name="is_new" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否热销</label>
		<div class="col-sm-2">
			<input type="radio" id="lastname" name="is_hot" value="1" checked>是
			<input type="radio" id="lastname" name="is_hot" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-2">
			<input type="radio" id="lastname" name="is_best" value="1" checked>是
			<input type="radio" id="lastname" name="is_best" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否上架</label>
		<div class="col-sm-2">
			<input type="radio" id="lastname" name="is_up" value="1" checked>是
			<input type="radio" id="lastname" name="is_up" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">所属品牌</label>
		<div class="col-sm-1">
			<select name="brand_id" class="form-control">
				<option value="0">-请选择-</option>
	
				<!-- <option value="{$v.pid}">
				{:str_repeat('&nbsp;&nbsp;',$v['level']*4)}
				{$v.cate_name}
				</option> -->
				
			</select>

		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">所属分类</label>
		<div class="col-sm-2">
			<select name="cate_id" class="form-control">
				<option value="0">--请选择--</option>
	
				<!-- <option value="{$v.pid}">
				{:str_repeat('&nbsp;&nbsp;',$v['level']*4)}
				{$v.cate_name}
				</option> -->
				
			</select>

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
	$(document).on('blur','input[name="goods_name"]',function(){
		$(this).next().empty();
		var goods_name=$(this).val();
		var obj=$(this);
		var reg=/^[\u4e00-\u9fa5\w]{2,15}$/;
		if(!reg.test(goods_name)){
			$(this).next().text('商品名称必须由中文、字母、数字、下划线，长度2-15位组成');
			return;
		}

		/*唯一性验证*/
		//第一种
		$.get('/goods/checkname',{goods_name:goods_name},function(res){
			if(res.count){
				obj.next().text('商品名称已存在');
			}
		},'json')
	})
</script>