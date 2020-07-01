<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;
use App\Type;
use Validator;
use App\Http\Requests\StoreArticlePost;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article_title=request()->article_title;
        $tid=request()->tid;
        $where=[];
        if($article_title){
            $where[]=['article_title','like',"%$article_title%"];
        }
        if($tid){
            $where[]=['type.tid','=',$tid];
        }
        $pagesize=config('app.pagesize');
        $res=Article::leftJoin('type', 'article.tid', '=', 'type.tid')->where($where)->orderBy('article_id','desc')->paginate($pagesize);
        //dd($res);
        $res1=Type::get();
        return view('admin/article/index',['res'=>$res,'res1'=>$res1,'article_title'=>$article_title,'tid'=>$tid]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res=Type::get();
        //dd($res);
        return view('admin/article/create',['res'=>$res]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(Request $request)
    public function store(Request $request) //第一种表单验证(第三种)
    //public function store(StoreArticlePost $request)  //第二种表单验证
    {
        //dd(646);
        //第三种表单验证
        $validator = Validator::make($request->all(),
            [ 
                'article_title' => 'regex:/[\x{4e00}-\x{9fa5}\w-]{2,15}$/u|unique:article', 
                'tname' => 'required', 
                'article_importance' => 'required', 
                'is_show' => 'required', 
            ],
            [
                'article_title.regex'=>'文章标题必须由中文、字母、数字、下划线，长度2-15位组成',
                'article_title.unique'=>'文章标题已存在',
                'tname.required'=>'文章分类必填',
                'article_importance.required'=>'文章重要性必填',
                'is_show.required'=>'是否显示必填',
            ]
        );
        if ($validator->fails()) { 
            return redirect('article/create') 
            ->withErrors($validator) 
            ->withInput(); 
        }

        // $article=$request->except('_token');
        // dd($article);
        //判断是否有文件上传
        if($request->hasFile('article_img')){
            //有文件上传
            $article_img=upload('article_img');//(ROM操作)
        }
        $article_model=new Article;
        $article_model->article_title=$request->article_title;
        $article_model->tid=$request->tid;
        $article_model->article_importance=$request->article_importance;
        $article_model->is_show=$request->is_show;
        $article_model->article_author=$request->article_author;
        $article_model->article_email=$request->article_email;
        $article_model->article_keyword=$request->article_keyword;
        $article_model->article_desc=$request->article_desc;
        if(isset($article_img)){//判断是否有值
            $article_model->article_img=$article_img;//显示图片
        }
        $article_time=$article_model->article_time=time();
        //dd($article_time);
        $res=$article_model->save();
        //dd($res);
        if($res){
            return redirect('article/index');
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
        $res=Article::find($id);
        //dd($res);
        $res1=Type::get();
        return view('admin/article/edit',['res'=>$res,'res1'=>$res1]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $id)
    public function update(Request $request,$id)//第一种表单验证(第三种)
    //public function update(StoreArticlePost $request,$id)//第二种表单验证
    {
        //第三种表单验证
        $validator = Validator::make($request->all(),
            [ 
                'article_title' => 'regex:/[\x{4e00}-\x{9fa5}\w-]{2,15}$/u|unique:article', 
                'tname' => 'required', 
                'article_importance' => 'required', 
                'is_show' => 'required', 
            ],
            [
                'article_title.regex'=>'文章标题必须由中文、字母、数字、下划线，长度2-15位组成',
                'article_title.unique'=>'文章标题已存在',
                'tname.required'=>'文章分类必填',
                'article_importance.required'=>'文章重要性必填',
                'is_show.required'=>'是否显示必填',
            ]
        );
        if ($validator->fails()) { 
            return redirect('article/edit') 
            ->withErrors($validator) 
            ->withInput(); 
        }

        //dd(6468);
        //判断是否有文件上传
        if($request->hasFile('article_img')){
            //有文件上传
            $article_img=upload('article_img');//(ROM操作)
        }
        $article_model=Article::find($id);
        //dd($article_model);
        $article_title=$article_model->article_title=$request->article_title;
        // $reg="/^([\u4e00-\u9fa5\w]){1,9}$/";
        // if(preg_match($reg,$article_title)<1){
        //     echo "<script>alert('文章标题必须是中文字母数字下划线');history.go(-1);</script>";
        // }
        $tid=$article_model->tid=$request->tid;
        // if(empty($tid)){
        //     echo "<script>alert('文章分类不能为空');history.go(-1);</script>";
        // }
        $article_model->article_importance=$request->article_importance;
        $article_model->is_show=$request->is_show;
        $article_model->article_author=$request->article_author;
        $article_model->article_email=$request->article_email;
        $article_model->article_keyword=$request->article_keyword;
        $article_model->article_desc=$request->article_desc;
        if(isset($article_img)){//判断是否有值
            $article_model->article_img=$article_img;//显示图片
        }
        $article_time=$article_model->article_time=time();
        $res=$article_model->save();
        //dd($res);
        if($res!==false){
            return redirect('article/index');
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
        //dd($id);
        $res=Article::destroy($id);
        if($res){
            if(request()->ajax()){//判断是否是ajax请求
                return json_encode(['code'=>'1','msg'=>'删除成功']);
            }
            return redirect('article/index');
        }
    }
    /*文章标题的唯一性验证*/
    public function checktitle()
    {
        $article_title=request()->article_title;
        $count=Article::where('article_title',$article_title)->count();
        return json_encode(['code'=>'1','count'=>$count]);
    }
}
