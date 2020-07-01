<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Website;
use App\Http\Requests\StoreWebsitePost;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $website_name=request()->website_name;
        //dd($website_name);
        $where=[];
        if($website_name){
            $where[]=['website_name','like',"%$website_name%"];
        }
        $pagesize=config('app.pagesize');
        $res=Website::where($where)->orderBy('website_id','desc')->paginate($pagesize);
        //dd($res);
        return view('admin/website/index',['res'=>$res,'website_name'=>$website_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/website/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(Request $request)
    public function store(StoreWebsitePost $request)  //第二种表单验证
    {
        //判断是否有文件上传
        if($request->hasFile('website_img')){
            //有文件上传
            $website_img=upload('website_img');//(ROM操作)
        }
        $website_model=new Website;
        $website_name=$website_model->website_name=$request->website_name;
        $reg="/^([\u4e00-\u9fa5]|[A-Za-z0-9_]){0,9}$/";
        if(preg_match($reg,$website_name)<1){
            echo "<script>alert('网站名称必须是中文字母数字下划线');history.go(-1);</script>";
        }
        $website_url=$website_model->website_url=$request->website_url;
        $reg="/^$/";
        if(preg_match($reg,$website_url)<1){
            echo "<script>alert('网站网址必须以http://开头');history.go(-1);</script>";
        }
        $website_model->website_type=$request->website_type;
        if(isset($website_img)){//判断是否有值
            $website_model->website_img=$website_img;//显示图片
        }
        $website_model->website_man=$request->website_man;
        $website_model->website_desc=$request->website_desc;
        $website_model->is_show=$request->is_show;
        $res=$website_model->save();
        //dd($res);
        if($res){
            return redirect('website/index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res=Website::find($id);
        //dd($res);
        return view('admin/website/edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $id)
    public function update(StoreWebsitePost $request,$id)//第二种表单验证
    {
        //判断是否有文件上传
        if($request->hasFile('website_img')){
            //有文件上传
            $website_img=upload('website_img');//(ROM操作)
        }
        $website_model=Website::find($id);
        $website_model->website_name=$request->website_name;
        $website_model->website_url=$request->website_url;
        $website_model->website_type=$request->website_type;
        if(isset($website_img)){//判断是否有值
            $website_model->website_img=$website_img;//显示图片
        }
        $website_model->website_man=$request->website_man;
        $website_model->website_desc=$request->website_desc;
        $website_model->is_show=$request->is_show;
        $res=$website_model->save();
        //dd($res);
        if($res!==false){
            return redirect('website/index');
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
        $res=Website::destroy($id);
        if($res){
            return redirect('website/index');
        }
    }
    /*文网站名称的唯一性验证*/
    public function checktitle()
    {
        $website_name=request()->website_name;
        $count=Website::where('website_name',$website_name)->count();
        return json_encode(['code'=>'1','count'=>$count]);
    }
}
