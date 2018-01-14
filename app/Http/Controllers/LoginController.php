<?php
/**
 * Created by IntelliJ IDEA.
 * User: X.P
 * Date: 1/13/2018
 * Time: 7:43 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{
    //登录页面
    public function loginPage(){
        return view('login.login');
    }
    //登录行为
    public function loginLogic(){
        //验证
        $this->validate(request(),[
            'username'=>'required',
            'password'=>'required'
        ]);
        //逻辑
        $user = request(['username','password']);
        if(\Auth::attempt($user)){
            return redirect('importPici');
        }
        //渲染
        return redirect()->back()->withErrors('用户名或密码不正确');
    }
    //登出行为
    public function logout(){
        \Auth::logout();
        return redirect('login');
    }
}