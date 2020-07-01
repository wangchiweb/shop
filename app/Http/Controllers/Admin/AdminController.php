<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Http\Requests\StoreAdminPost;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_account=request()->admin_account;
        //dd($admin_account);
        $where=[];
        if($admin_account){
            $where[]=['admin_account','like',"%$admin_account%"];
        }
        //ORM操作
        $pagesize=config('app.pagesize');
        $res=Admin::where($where)->orderBy('admin_id','desc')->paginate($pagesize);
        //dd($res);
        return view('admin/admin/index',['res'=>$res,'admin_account'=>$admin_account]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/admin/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(Request $request)
    public function store(StoreAdminPost $request)  //第二种表单验证
    {
        //判断是否有文件上传
        if($request->hasFile('my_img')){
            //有文件上传
            $my_img=upload('my_img');//(ROM操作)
        }
        $admin_model=new Admin;
        $admin_model->admin_account=$request->admin_account;
        $admin_model->admin_pwd=encrypt($request->admin_pwd);
        //dd($admin_model->admin_pwd);
        if(isset($my_img)){//判断是否有值
            $admin_model->my_img=$my_img;//显示图片
        }
        $res=$admin_model->save();
        //dd($res);
        if($res){
            return redirect('admin/index');
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
        $res=Admin::find($id);
        //dd($res);
        return view('admin/admin/edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $id)
    public function update(StoreAdminPost $request, $id)  //第二种表单验证
    {
        //判断是否有文件上传
        if($request->hasFile('my_img')){
            //有文件上传
            $my_img=upload('my_img');//(ROM操作)
        }
        $admin_model=Admin::find($id);
        $admin_model->admin_account=$request->admin_account;
        $admin_model->admin_pwd=encrypt($request->admin_pwd);
        // dd($admin_model->admin_pwd);
        if(isset($my_img)){//判断是否有值
            $admin_model->my_img=$my_img;//显示图片
        }
        $res=$admin_model->save();
        //dd($res);
        if($res!==false){
            return redirect('admin/index');
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
        //ROM操作
        $res=Admin::destroy($id);
        if($res){
            return redirect('admin/index');
        }
    }
    /*文章标题的唯一性验证*/
    public function checkname()
    {
        $admin_account=request()->admin_account;
        $count=Admin::where('admin_account',$admin_account)->count();
        return json_encode(['code'=>'1','count'=>$count]);
    }
}
