<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('home',function(){
    return view('home');
});
//增加段号页面
Route::any('addCode',['uses'=>'CodeController@addCode']);
//导入批次页面
Route::get('importPici',['uses'=>'YundanController@importPici']);
//导入批次的逻辑
Route::post('upload',['uses'=>'YundanController@upload']);

//查询 输入批次号页面
Route::get('searchPici',['uses'=>'YundanController@searchPici']);
//查询打印页面 post会展示列表
Route::any('listPrint',['uses'=>'YundanController@listPrint']);
//导出
Route::any('export',['uses'=>'YundanController@export']);

//打印 1.根据a标签链接打印  2.根据submit传过来的参数打印
Route::any('dsPrint/{id}',['uses'=>'YundanController@dsPrint']);
Route::any('submitPrint',['uses'=>'YundanController@submitPrint']);

//注册登录
//1.登录页面
Route::get('login','LoginController@loginPage');
//2.登录逻辑
Route::post('login','LoginController@loginLogic');
//3.登出
Route::get('logout','LoginController@logout');



//地址管理
//1.地址列表展示页
Route::any('ds_addresses',['uses' => 'AddressController@index']);
//2.删除全部地址页
Route::any('ds_ad_delAll',['uses' => 'AddressController@delAll']);
//2.1根据id删除
Route::any('ds_del_id/{id}',['uses' => 'AddressController@delById']);
//3.添加地址
Route::any('ds_ad_add',['uses' => 'AddressController@ds_ad_add']);