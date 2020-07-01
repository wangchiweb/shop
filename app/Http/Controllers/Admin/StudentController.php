<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Student;
use App\Http\Requests\StoreStudentPost;
use Illuminate\Validation\Rule;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name=request()->name;
        //dd($name);
        $where=[];
        if($name){
            $where[]=['name','like',"%$name%"];
        }
        $pagesize=config('app.pagesize');
        $res=Student::where($where)->orderBy('sid','desc')->paginate($pagesize);
        //dd($res);
        return view('admin/student/index',['res'=>$res,'name'=>$name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/student/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(Request $request)
    public function store(StoreStudentPost $request)  //第二种表单验证
    {
        //判断是否有文件上传
        if($request->hasFile('img')){
            //有文件上传
            $img=upload('img');//(ROM操作)
        }
        $student_model=new Student;
        $student_model->name=$request->name;
        $student_model->age=$request->age;
        $student_model->sex=$request->sex;
        $student_model->class=$request->class;
        if(isset($img)){//判断是否有值
            $student_model->img=$img;//显示图片
        }
        //dd($student_model);
        $res=$student_model->save();
        //dd($res);
        if($res){
            return redirect('student/index');
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
        $res=Student::find($id);
        //dd($res);
        return view('admin/student/edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $id)
    public function update(StoreStudentPost $request,$id)//第二种表单验证
    {
        //判断是否有文件上传
        if($request->hasFile('img')){
            //有文件上传
            $img=upload('img');//(ROM操作)
        }
        $student_model=Student::find($id);
        $student_model->name=$request->name;
        $student_model->age=$request->age;
        $student_model->sex=$request->sex;
        $student_model->class=$request->class;
        if(isset($img)){//判断是否有值
            $student_model->img=$img;//显示图片
        }
        $res=$student_model->save();
        //dd($res);
        if($res!==false){
            return redirect('student/index');
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
        $res=Student::destroy($id);
        //dd($res);
        if($res){
            return redirect('student/index');
        }
    }
    /*文姓名的唯一性验证*/
    public function checkname()
    {
        $name=request()->name;
        $count=Student::where('name',$name)->count();
        return json_encode(['code'=>'1','count'=>$count]);
    }
}
