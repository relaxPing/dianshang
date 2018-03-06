<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class AddressController extends Controller
{
    //地址列表
    public function index(){
        $addresses = Address::orderBy('seq')->paginate(50);
        $count = Address::count();
        return view('address.index',[
            'addresses' => $addresses,
            'count' => $count
        ]);
    }

    //删除全部地址
    public function delAll(){
        $addresses = Address::get();
        foreach ($addresses as $address){
            $address -> delete();
        }
        Session::flash('success','删除完成');
        return redirect()->back();
    }

    //根据id删除地址（点击按钮删除）
    public function delById($id){
        $address = Address::where('id',$id) -> first();
        if($address -> delete()){
            Session::flash('success','删除成功');
            return redirect() -> back();
        }else{
            Session::flash('error','删除失败');
            return redirect()->back();
        }
    }

    //导入地址
    public function ds_ad_add(Request $request){
        $count = Address::count();
        if($request -> isMethod('post')){
            $file = $request -> file('addresses');
            if($file -> isValid()){
                $tmpPath = $file -> getRealPath();
                if(isset($tmpPath)){
                    $datas = Excel::load($tmpPath,function($reader){}) -> get();
                    foreach ($datas as $data){
                        $address = new Address();
                        $address -> seq = $data -> 序号;
                        $address -> r_name = $data -> 姓名;
                        $address -> r_mobile = $data -> 手机;
                        $address -> r_address = $data -> 地址;
                        $address -> s_name = $data -> 发件人;
                        $address -> s_mobile = $data -> 发件人电话;
                        $address -> s_address = $data -> 发件人地址;
                        $address -> save();
                    }
                    Session::flash('success','导入成功');
                    return redirect()->back();
                }
            }
            Session::flash('error','导入失败，请检查文件格式');
            return redirect()->back();
        }
        return view('address.import',[
            'count' => $count
        ]);
    }
}
