<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table>
		<form action="{{url('create')}}" method="post">
			@csrf
			{{$name}}
			<tr>
				<td>姓名</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td><button>添加</button></td>
				<td></td>
			</tr>
		</form>
	</table>
</body>
</html>

	
