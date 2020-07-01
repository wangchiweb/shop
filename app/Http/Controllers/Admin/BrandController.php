<?php 
	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	use DB;
	use App\Brand;
	use App\Http\Requests\StoreBrandPost;
	use Validator;
	use Illuminate\Validation\Rule;
	class BrandController extends Controller
	{
	    /**
	     * Display a listing of the resource.
	     *列表展示
	     * @return \Illuminate\Http\Response
	     */
	    public function index()
	    {	
	    	//showMsg(1,'Hello World!');
	    	$brand_name=request()->brand_name;
	    	//dd($brand_name);
	    	$where=[];
	    	if($brand_name){
	    		$where[]=['brand_name','like',"%$brand_name%"];
	    	}

	    	//DB操作
	    	// $res=DB::table('brand')->orderBy('brand_id','desc')->get();
	    	// dump($res);
	    	//ORM操作
	    	$pagesize=config('app.pagesize');
	    	// DB::connection()->enableQueryLog();
	    	$res=Brand::where($where)->orderBy('brand_id','desc')->paginate($pagesize);
	    	//dd($res);
	    	// $log=DB::getQueryLog();
	    	// dd($log);
	        return view('admin/brand/index',['res'=>$res,'brand_name'=>$brand_name]);
	    }

	    /**
	     * Show the form for creating a new resource.
	     *展示添加
	     * @return \Illuminate\Http\Response
	     */
	    public function create()
	    {
	        return view('admin/brand/create');
	    }

	    /**
	     * Store a newly created resource in storage.
	     *执行添加
	     * @param  \Illuminate\Http\Request  $request
	     * @return \Illuminate\Http\Response
	     */
	    public function store(Request $request) //第一种表单验证(第三种)
	    //public function store(StoreBrandPost $request)  //第二种表单验证
	    {
	    	//第一种表单验证
	    	// $validatedData = $request->validate(
	    	// 	[
	    	// 	 'brand_name' => 'required|unique:brand', 
	    	// 	 'brand_url' => 'required', 
	    	// 	],
	    	// 	[
	    	// 	 'brand_name.required'=>'品牌名称必填',
	    	// 	 'brand_name.unique'=>'品牌名称已存在',
	    	// 	 'brand_url.required'=>'品牌网址必填',
	    	// 	]
	    	// );

	    	//第三种表单验证
	    	$validator = Validator::make($request->all(),
	    		[ 
	    			'brand_name' => 'regex:/[\x{4e00}-\x{9fa5}\w-]{2,15}$/u|unique:brand', 
	    		 	'brand_url' => 'required', 
	    		],
	    		[
	    		 'brand_name.regex'=>'品牌名称必须由中文、字母、数字、下划线，长度2-15位组成',
	    		 'brand_name.unique'=>'品牌名称已存在',
	    		 'brand_url.required'=>'品牌网址必填',
	    		]
	    	);
	    	if ($validator->fails()) { 
	    		return redirect('brand/create') 
	    		->withErrors($validator) 
	    		->withInput(); 
	    	}


	        //$brand=$request->except('_token');
	        //dd($brand);
	        //dd($request->brand_logo);
	        //判断是否有文件上传
	        if($request->hasFile('brand_logo')){
	        	//有文件上传
	        	//$brand['brand_logo']=upload('brand_logo');//(DB操作)
	        	$brand_logo=upload('brand_logo');//(ROM操作)
	        }
	        //DB操作
	        //$res=DB::table('brand')->insert($brand);
	        //ROM操作
	        $brand_model=new Brand;
	        $brand_model->brand_name=$request->brand_name;
	        $brand_model->brand_url=$request->brand_url;
	        if(isset($brand_logo)){//判断是否有值
	        	$brand_model->brand_logo=$brand_logo;//显示图片
	        }
	        $brand_model->brand_desc=$request->brand_desc;
	        $res=$brand_model->save();
	        //dd($res);
	        if($res){
	        	return redirect('brand/index');
	        }
	    }
	    

	    /**
	     * Display the specified resource.
	     *展示详情
	     * @param  int  $id
	     * @return \Illuminate\Http\Response
	     */
	    public function show($id)
	    {
	        //
	    }

	    /**
	     * Show the form for editing the specified resource.
	     *修改页面
	     * @param  int  $id
	     * @return \Illuminate\Http\Response
	     */
	    public function edit($id)
	    {
	        //echo $id;
	        //DB操作
	        //$res=DB::table('brand')->where('brand_id',$id)->first();
	        //ROM操作
	        $res=Brand::find($id);//(第一种)
	        //$res=Brand::where('brand_id',$id)->first();//(第二种)
	        
	        //dd($res);
	        return view('admin/brand/edit',['res'=>$res]);
	    }

	    /**
	     * Update the specified resource in storage.
	     *执行修改
	     * @param  \Illuminate\Http\Request  $request
	     * @param  int  $id
	     * @return \Illuminate\Http\Response
	     */
	    public function update(Request $request,$id)//第一种表单验证(第三种)
	    //public function update(StoreBrandPost $request,$id)//第二种表单验证
	    {
	    	// // 第一种表单验证
	    	// $validatedData = $request->validate(
	    	// 	[
	    	// 	 'brand_name'=>[
	    	// 	 	'required', 
	    	// 	 	Rule::unique('brand')->ignore($id,'brand_id') 
	    	// 	 ],
	    	// 	 'brand_url' => 'required', 
	    	// 	],
	    	// 	[
	    	// 	 'brand_name.required'=>'品牌名称必填',
	    	// 	 'brand_name.unique'=>'品牌名称已存在',
	    	// 	 'brand_url.required'=>'品牌网址必填',
	    	// 	]
	    	// );

	    	//第三种表单验证
	    	$validator = Validator::make($request->all(),
	    		[ 
	    			'brand_name' => 'regex:/[\x{4e00}-\x{9fa5}\w-]{2,15}$/u|unique:brand', 
	    		 	'brand_url' => 'required', 
	    		],
	    		[
	    		 'brand_name.regex'=>'品牌名称必须由中文、字母、数字、下划线，长度2-15位组成',
	    		 'brand_name.unique'=>'品牌名称已存在',
	    		 'brand_url.required'=>'品牌网址必填',
	    		]
	    	);
	    	if ($validator->fails()) { 
	    		return redirect('brand/create') 
	    		->withErrors($validator) 
	    		->withInput(); 
	    	}


	        //echo $id;die;
	        //$brand=$request->except('_token');
	        //dd($brand);
	        //判断是否有文件上传
	        if($request->hasFile('brand_logo')){
	        	//有文件上传
	        	//$brand['brand_logo']=upload('brand_logo');//(DB操作)
	        	$brand_logo=upload('brand_logo');//(ROM操作)
	        }
	        //DB操作
	        //$res=DB::table('brand') ->where('brand_id',$id) ->update($brand);
	        //ROM操作
	        $brand_model=Brand::find($id);
	        $brand_model->brand_name=$request->brand_name;
	        $brand_model->brand_url=$request->brand_url;
	        if(isset($brand_logo)){//判断是否有值
	        	$brand_model->brand_logo=$brand_logo;//显示图片
	        }
	        //$brand_logo??'';等同于if(isset($brand_logo)){$brand_logo;}else{echo '';}
	        $brand_model->brand_desc=$request->brand_desc;
	        $res=$brand_model->save();
	        //dd($res);
	        if($res!==false){
	        	return redirect('brand/index');
	        }
	    }

	    /**
	     * Remove the specified resource from storage.
	     *
	     * @param  int  $id
	     * @return \Illuminate\Http\Response
	     */
	    public function destroy($id)
	    {
	    	//echo $id;
	    	//DB操作
	        //$res=DB::table('brand')->where('brand_id',$id)->delete();
	        //ROM操作
	        $res=Brand::destroy($id);
	        if($res){
	        	return redirect('brand/index');
	        }
	    }
	    /*品牌名称的唯一性验证*/
    	public function checkname()
    	{
        	$brand_name=request()->brand_name;
        	$count=Brand::where('brand_name',$brand_name)->count();
        	return json_encode(['code'=>'1','count'=>$count]);
    	}
	}
 ?>