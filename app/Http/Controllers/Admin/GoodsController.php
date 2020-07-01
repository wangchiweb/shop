<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Http\Requests\StoreGoodsPost;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods_name=request()->goods_name;
        //dd($goods_name);
        $where=[];
        if($goods_name){
            $where[]=['goods_name','like',"%$goods_name%"];
        }
        $pagesize=config('app.pagesize');
        $res=Goods::where($where)->orderBy('goods_id','desc')->paginate($pagesize);
        //dd($res);
        return view('admin/goods/index',['res'=>$res,'goods_name'=>$goods_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/goods/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(Request $request)
    public function store(StoreGoodsPost $request)  //第二种表单验证
    {

        //判断是否有文件上传
        if($request->hasFile('goods_img')){
            //有文件上传
            $goods_img=upload('goods_img');
        }
        $goods_model=new Goods;
        $goods_model->goods_name=$request->goods_name;
        $goods_model->goods_price=$request->goods_price;
        $goods_model->goods_desc=$request->goods_desc;
        $goods_model->goods_num=$request->goods_num;
        $goods_model->goods_score=$request->goods_score;
        if(isset($goods_img)){//判断是否有值
            $goods_model->goods_img=$goods_img;//显示图片
        }
        $goods_model->is_new=$request->is_new;
        $goods_model->is_hot=$request->is_hot;
        $goods_model->is_best=$request->is_best;
        $goods_model->is_up=$request->is_up;
        $res=$goods_model->save();
        //dd($res);
        if($res){
            return redirect('goods/index');
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
        $res=Goods::find($id);
        //dd($res);
        return view('admin/goods/edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $id)
    public function update(StoreGoodsPost $request, $id)  //第二种表单验证
    {
        //判断是否有文件上传
        if($request->hasFile('goods_img')){
            //有文件上传
            $goods_img=upload('goods_img');
        }
        $goods_model=Goods::find($id);
        $goods_model->goods_name=$request->goods_name;
        $goods_model->goods_price=$request->goods_price;
        $goods_model->goods_desc=$request->goods_desc;
        $goods_model->goods_num=$request->goods_num;
        $goods_model->goods_score=$request->goods_score;
        if(isset($goods_img)){//判断是否有值
            $goods_model->goods_img=$goods_img;//显示图片
        }
        $goods_model->is_new=$request->is_new;
        $goods_model->is_hot=$request->is_hot;
        $goods_model->is_best=$request->is_best;
        $goods_model->is_up=$request->is_up;
        $res=$goods_model->save();
        //dd($res);
        if($res!==false){
            return redirect('goods/index');
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
        $res=Goods::destroy($id);
        if($res){
            return redirect('goods/index');
        }
    }
    /*商品名称的唯一性验证*/
    public function checkname()
    {
        $goods_name=request()->goods_name;
        $count=Goods::where('goods_name',$goods_name)->count();
        return json_encode(['code'=>'1','count'=>$count]);
    }
}
