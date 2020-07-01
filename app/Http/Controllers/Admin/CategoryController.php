<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\StoreCategoryPost;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res=Category::get();
        //dd($res);
        $res=createTree($res);
        //dd($res);
        return view('admin/category/index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res=Category::all();
        //dd($res);
        //无限极分类
        $res=createTree($res);
        //dd($res);
        return view('admin/category/create',['res'=>$res]);
    }
        

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(Request $request)
    public function store(StoreCategoryPost $request)  //第二种表单验证
    {
        
        $cate_model=new Category;
        $cate_model->cate_name=$request->cate_name;
        $cate_model->pid=$request->pid;
        $cate_model->cate_show=$request->cate_show;
        $cate_model->cate_nav_show=$request->cate_nav_show;
        $res=$cate_model->save();
        //dd($res);
        if($res){
            return redirect('category/index');
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
        $res=Category::find($id);
        //dd($res);
        $res1=Category::all();
        return view('admin/category/edit',['res'=>$res,'res1'=>$res1]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $id)
    public function update(StoreCategoryPost $request, $id)  //第二种表单验证
    {
        $cate_model=Category::find($id);
        $cate_model->cate_name=$request->cate_name;
        $cate_model->pid=$request->pid;
        $cate_model->cate_show=$request->cate_show;
        $cate_model->cate_nav_show=$request->cate_nav_show;
        $res=$cate_model->save();
        //dd($res);
        if($res!==false){
            return redirect('category/index');
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
        //判断此分类下是否有子分类，如果有子分类，禁止删除
        $count=Category::where('pid',$id)->count();//count表示数量
        if($count>0){
            echo "<script>alert('此分类有子分类，禁止删除');history.go(-1);</script>";
        }else{
            $res=Category::destroy($id);
            if($res){
                return redirect('category/index');
            }
        }
            
    }
    /*分类名称的唯一性验证*/
    public function checkname()
    {
        $cate_name=request()->cate_name;
        $count=Category::where('cate_name',$cate_name)->count();
        return json_encode(['code'=>'1','count'=>$count]);
    }
}
