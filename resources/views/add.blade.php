<table>
	<form action="{{url('adddo')}}" method="post">
		<!--表单令牌 增加表单数据安全-->
		@csrf
		<tr>
			<td><input type="text"></td>
		</tr>
		<tr>
			<td><button>提交</button></td>
		</tr>
	</form>
</table>