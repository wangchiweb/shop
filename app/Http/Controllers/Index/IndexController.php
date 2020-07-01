<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;

class IndexController extends Controller
{
	/*首页展示*/
    public function index(){
    	$res=Goods::all();
    	//dd($res);
    	return view('index/index',['res'=>$res]);
    }
    /**/
}
