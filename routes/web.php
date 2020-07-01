<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

	// /*闭包路由*/
	// Route::get('/', function () {
	//     return view('welcome');
	// });
	Route::get('/index', function () {
	    echo 123;
	});

	/*控制器路由*/
	//get方式
	Route::get('test','User@index');
	Route::get('add','User@add');
	Route::get('adddo','User@adddo');

	//post方式
	Route::post('test','User@index');
	Route::post('add','User@add');
	Route::post('adddo','User@adddo');



	//StudentController控制器
	Route::get('list','StudentController@list');

	//Route::any('create','StudentController@create');
	Route::view('create','create',['name'=>'赵云']);
	Route::post('store','StudentController@store');

	Route::get('arr','StudentController@arr');
	Route::get('arr1','StudentController@arr1');

	/*正则约束*/
	//Route::get('user/{id}','StudentController@user')->where('id','/d+');
	//Route::get('user/{id}{name}','StudentController@user')->where('id'=>'/d+','name'=>'[a-zA-Z+]');

Route::domain('admin.shop.com')->group(function(){
	/*BrandController控制器(商品品牌)*/
	//商品品牌模块的增删改查
	Route::prefix('brand')->middleware('islogin')->group(function(){//路由分组
		Route::any('index','Admin\BrandController@index');//列表展示
		Route::any('create','Admin\BrandController@create');//展示添加
		Route::any('store','Admin\BrandController@store');//执行添加
		Route::any('destroy/{id}','Admin\BrandController@destroy');//删除
		Route::any('edit/{id}','Admin\BrandController@edit');//修改页面
		Route::any('update/{id}','Admin\BrandController@update');//执行修改
	});

	/*StudentController控制器(学生)*/
	//学生模块的增删改查
	Route::prefix('student')->group(function(){//路由分组
		Route::any('index','Admin\StudentController@index');//列表展示
		Route::any('create','Admin\StudentController@create');//展示添加
		Route::any('store','Admin\StudentController@store');//执行添加
		Route::any('destroy/{id}','Admin\StudentController@destroy');//删除
		Route::any('edit/{id}','Admin\StudentController@edit');//修改页面
		Route::any('update/{id}','Admin\StudentController@update');//执行修改
	});

	/*CategoryController控制器(商品分类)*/
	//商品分类模块的增删改查
	Route::prefix('category')->middleware('islogin')->group(function(){//路由分组
		Route::any('index','Admin\CategoryController@index');//列表展示
		Route::any('create','Admin\CategoryController@create');//展示添加
		Route::any('store','Admin\CategoryController@store');//执行添加
		Route::any('destroy/{id}','Admin\CategoryController@destroy');//删除
		Route::any('edit/{id}','Admin\CategoryController@edit');//修改页面
		Route::any('update/{id}','Admin\CategoryController@update');//执行修改
	});

	/*GoodsController控制器(商品管理)*/
	//商品管理模块的增删改查
	Route::prefix('goods')->middleware('islogin')->group(function(){//路由分组
		Route::any('index','Admin\GoodsController@index');//列表展示
		Route::any('create','Admin\GoodsController@create');//展示添加
		Route::any('store','Admin\GoodsController@store');//执行添加
		Route::any('destroy/{id}','Admin\GoodsController@destroy');//删除
		Route::any('edit/{id}','Admin\GoodsController@edit');//修改页面
		Route::any('update/{id}','Admin\GoodsController@update');//执行修改
	});

	/*AdminController控制器(管理员管理)*/
	//管理员管理模块的增删改查
	Route::prefix('admin')->middleware('islogin')->group(function(){//路由分组
		Route::any('index','Admin\AdminController@index');//列表展示
		Route::any('create','Admin\AdminController@create');//展示添加
		Route::any('store','Admin\AdminController@store');//执行添加
		Route::any('destroy/{id}','Admin\AdminController@destroy');//删除
		Route::any('edit/{id}','Admin\AdminController@edit');//修改页面
		Route::any('update/{id}','Admin\AdminController@update');//执行修改
	});

	/*WebsiteController控制器(友情链接)*/
	//友情链接模块的增删改查
	Route::prefix('website')->middleware('islogin')->group(function(){//路由分组
		Route::any('index','Admin\WebsiteController@index');//列表展示
		Route::any('create','Admin\WebsiteController@create');//展示添加
		Route::any('store','Admin\WebsiteController@store');//执行添加
		Route::any('destroy/{id}','Admin\WebsiteController@destroy');//删除
		Route::any('edit/{id}','Admin\WebsiteController@edit');//修改页面
		Route::any('update/{id}','Admin\WebsiteController@update');//执行修改
	});	

	/*ArticleController控制器(文章)*/
	//文章模块的增删改查
	Route::prefix('article')->middleware('islogin')->group(function(){//路由分组
		Route::any('index','Admin\ArticleController@index');//列表展示
		Route::any('create','Admin\ArticleController@create');//展示添加
		Route::any('store','Admin\ArticleController@store');//执行添加
		Route::any('destroy/{id}','Admin\ArticleController@destroy');//删除
		Route::any('edit/{id}','Admin\ArticleController@edit');//修改页面
		Route::any('update/{id}','Admin\ArticleController@update');//执行修改
		Route::any('checktitle','Admin\ArticleController@checktitle');//验证唯一性
		
		/*LoginController控制器(登录)*/
		Route::view('login/login','admin/login/login');//登录的表单
		Route::any('login/logindo','Admin\LoginController@logindo');//执行登录
	});
});
	

	

	/*TestController控制器(cookie，session)*/
	Route::get('test/setcookie','TestController@setcookie');//存cookie
	Route::get('test/getcookie','TestController@getcookie');//取cookie

	Route::get('test/setsession','TestController@setsession');//存session
	Route::get('test/getsession','TestController@getsession');//取session
	Route::get('test/testsession','TestController@testsession');//检测session
	Route::get('test/delsession','TestController@delsession');//删除session



Route::domain('www.shop.com')->group(function(){
	/*前台*/
	Route::any('/','Index\IndexController@index');//首页
	Route::any('login/login','Index\LoginController@login');//登录页面
	Route::any('login/reg','Index\LoginController@reg');//注册页面
	Route::any('login/send','Index\LoginController@send');//发送验证码
	Route::any('login/dologin','Index\LoginController@dologin');//执行登录
	Route::any('login/doreg','Index\LoginController@doreg');//执行注册
	
});
	
