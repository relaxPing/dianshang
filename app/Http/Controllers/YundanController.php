<?php

namespace App\Http\Controllers;

use App\Address;
use App\Addresses;
use App\Code;
use App\Yundan;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class YundanController extends Controller
{
    //导入批次的excel get方式访问
    public function importPici(){
        $dsCount = Code::where('isUsed',0)->count();
        return view('importPici',[
            'dsCount'=>$dsCount
        ]);
    }

    //导入的逻辑
    /*包括上传excel 存储excel 从excel中取出并加上单号存到数据库 */
    public function upload(Request $request){
        //表单验证
        $this->validate($request, [
            'piciExcel' =>'required',
            'dsNumber' => 'required|min:1|max:3',
        ],[],[
            'piciExcel'=>'上传文件',
            'dsNumber' => '地址号',
        ]);


        //获取表单传来的文件 和 地址分段1（1-154） 2（155-308） 3（309-462）
       $file = $request->file('piciExcel');
       $dsNumber = $request->input('dsNumber');
       if($file->isValid()){
           //获得源文件名
           $originalName =$file->getClientOriginalName();
           //获得源文件类型
           $ext = $file->getClientOriginalExtension();
           //获得临时存放绝对路径
           $tempPath = $file->getRealPath();
           //生成文件名
           //$fileName = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;
           //存储文件
           //$bool = Storage::disk('uploads')->put($fileName,file_get_contents($tempPath));
           //接下来从excel中取数据
           //如果刚才存的文件成功了
           //if($bool){

           if($tempPath){
               //从excel中get到了所有数据
               //直接从临时文件中获取excel数据
               $filePath = $tempPath;
               $datas = Excel::load($filePath, function($reader) {
               })->get();

               //如果运单号在数据库中存在 说明已经导入过了 ,跳回并提示 已经导入过该批次
               if(Yundan::where('ydh',$datas->first()->运单号)->count()){
                   return redirect()->back()->with('error','请勿重复导入 如需查询或再次打印请点击菜单栏->查询');
               }
               if(Code::where('isUsed',0)->count()<$datas->count())
               {
                   return redirect()->back()->with('error','电商号剩余不足，请联系管理员先导入足够电商号');
               }

               //获得没使用的且最小的一个海关电商号 的ID！！注意 因为每批号有可能是不连续的如果直接用号会有bug
               $codeID = Code::where('isUsed',0)->orderBy('id')->first()->id;
               //addressID用于查从第几个开始
               if($dsNumber ==1){
                   $addressID = 1;
               }elseif ($dsNumber == 2){
                   $addressID = 155;
               }elseif ($dsNumber == 3){
                   $addressID = 309;
               }

                //开始对excel传进来的所有运单号进行遍历 加上海关单号(从codeID开始) 加上地址(从addressID开始)
               foreach ($datas as $data){
                   //出自excel里面的数据
                    $yundan = new Yundan();
                    $yundan->ydh = $data->运单号;
                    $yundan->pici_number = $data->批次号;
                    $yundan->weight = $data->净重_实际称重kg;
                    $yundan->r_real_name = $data->收件人姓名;
                    $yundan->r_real_mobile = $data->收件人电话;
                    $yundan->r_real_address = $data->收件人地址;
                    $yundan->goods = $data->货物品名;
                    $yundan->quantity = $data->数量盒;
                    $yundan->goods_value = $data->货物价格;
                    //加上海关单号 出自code表
                    $currentCode = Code::where('id',$codeID)->first();
                    $yundan->ds_number = $currentCode->number;
                    $currentCode->isUsed = 1;

                    //加上地址信息
                        //先查出这个地址id对应的对象
                    $address = Address::where('id',$addressID)->first();
                    $yundan->receiver_name = $address -> r_name;
                    $yundan->receiver_mobile = $address -> r_mobile;
                    $yundan->receiver_address = $address -> r_address;
                    $yundan->senter_name = $address -> s_name;
                    $yundan->senter_mobile = $address -> s_mobile;
                    $yundan->senter_address = $address -> s_address;

                    //对海关单号ID和地址id进行自增
                    $codeID++;
                    $addressID++;
                    //保存运单 保存改变了状态的海关单号
                    $yundan->save();
                    $currentCode->save();
               }
           }
       }
        //根据批次号找出运单传给新视图
        $pici = $datas->first()->批次号;
       $yundans = Yundan::where('pici_number',$pici)->orderBy('id','desc')->paginate(20);
       /*return redirect('listPrint',[
          'yundans'=>$yundan,
           'pici'=>$pici
       ]);*/
        Session::put('pici',$pici);
        Session::save();
       return redirect()->action('YundanController@listPrint',['yundans'=>$yundan]);
    }

    //查询 输入批次号页面
    public function searchPici(){
        return view('searchPici');
    }

    //显示批次下的运单 并对刚刚导入的excel进行分配电商号 并可以打印
    public function listPrint(Request $request){
        /*思路：
         * 1.先看有没有session
         * 2.再看有没有输入，即使上面有session，这步输入会把session替换掉
         * 3.最后不知道还有没有什么其他情况会导致$pici不存在,所以判断含有$pici的再继续执行
         * */
        if(Session::has('pici')){
            $pici = Session::get('pici');
        }
        if($request->isMethod('POST')){
            //顺便validate
            $validator = \Validator::make($request->input(),[
                'pici'=> 'required'
            ],[],[
                'pici'=>'批次号'
            ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            //取出pici
            $pici = $request->input('pici');
            if(!Yundan::where('pici_number',$pici)->orWhere('pici_number',' '.$pici)->count()){
                return redirect()->back()->with('error','不存在，请先导入');
            }
        }

        if($pici){
            $yundans = Yundan::where('pici_number',$pici)->orWhere('pici_number',' '.$pici)->paginate(25);
            $yds = Yundan::where('pici_number',$pici)->orWhere('pici_number',' '.$pici)->get();
            $ydsPrinted = $yds->where('isPrinted',1)->count();
            //$request->session()->put('pi', $pici);
            Session::put('pici',$pici);
            Session::save();

            return view('listPrint',[
                'pici'=>$pici,
                'yundans'=>$yundans,
                'ydsPrinted'=>$ydsPrinted
            ]);
        }

    }

    //导出excel 电商单报表
    public function export(Request $request){
        if($request->isMethod('POST')){
            /*验证逻辑
             * 1.如果没有输入用validate验证 提示错误信息并->back()到输入页面
             * 2.如果输入了 但是没有查到，则进行错误提示‘批次不存在’并->back()回到输入页面
             * 3.如果输入了 且存在 则正常打印excel表格
             * */
            //1.
            $this->validate($request,[
                'piciNumber'=>'required|min:1'
            ],[],[
                'piciNumber'=>'批次号'
            ]);
            //2,3
            $piciNumber = $request->input('piciNumber');
            if(Yundan::where('pici_number',$piciNumber)->orWhere('pici_number',' '.$piciNumber)->count()){
                $piciYundan = Yundan::where('pici_number',$piciNumber)->orWhere('pici_number',' '.$piciNumber)->select('ds_number','ydh',
                    'receiver_name','receiver_mobile','receiver_address',
                    'senter_name','senter_mobile','senter_address','weight','r_real_name','r_real_mobile',
                    'r_real_address','goods','quantity','goods_value')->get();
                Excel::create($piciNumber, function($excel) use($piciYundan) {

                    $excel->sheet('Sheet1', function($sheet) use($piciYundan) {

                        //$sheet->fromArray([['名字','电话1'],$addresses],null,'A1',true,false);
                        $sheet->appendRow(array(
                            '分单号', '运单号','收件人','收件人电话','收件人地址','发件人','发件人电话',
                            '发件人地址','重量','真实收件人姓名','真实收件人电话','真实收件人地址','商品描述',
                            '数量','申报价格'
                        ));
                        $sheet->fromArray($piciYundan,null,'A2',true,false);
                        //$sheet->fromArray($addresses);
                    });

                })->export('xls');
            }else{
                return redirect()->back()->with('error','此批未导入');
            }

        }
        return view('export');
    }

    //运单打印(通过链接按钮打印)
    public function dsPrint($id){
        $yundan = Yundan::find($id);
        $yundan->isPrinted = 1;
        $yundan->save();
        return view('dsPrint',[
            'yundan'=>$yundan
        ]);
    }
    //运单打印(通过submit传过来打印)
    public function submitPrint(Request $request){
            //1.表单验证
            $this->validate($request,[
                'ydh'=>'required'
            ],[],[
                'ydh'=>'运单号'
            ]);
            $ydh = $request->input('ydh');
            $pici = $request->input('pici');
            //2.存在性验证
            /*分两步
             * 第一步：找出该批次下的所有运单
             * 第二步：找该批次中特定的运单 如果不存在进行错误提示
             * */
            //$piciYundans = Yundan::where('pici_number',$pici)->orWhere('pici_number',' '.$pici)->get();
            if(!Yundan::where('ydh',$ydh)->orWhere('ydh',' '.$ydh)->count()){
                return redirect()->back()->withErrors('运单号不存在');
            }
            if(Yundan::where('ydh',$ydh)->orWhere('ydh',' '.$ydh)->first()->isPrinted == 1){
                return redirect()->back()->withErrors('运单已打印');
            }
            //这里以后要改成不用验证空格的
            $yundan = Yundan::where('ydh',$ydh)->orWhere('ydh',' '.$ydh)->first();
            //输入框需要确认是否需要再次打印
            if($yundan->isPrinted ==1){
                /*echo "<script>alert('重复打印！该面单已经打印过')</script>";*/
                /*echo "<script>if(confirm('该面单已经打印 确认再次打印吗？')== false)</script>";*/
                $printedBefore = 1;
            }else{
                $printedBefore = 0;
            }
            $yundan->isPrinted = 1;
            $yundan->save();
            return view('submitPrint',[
                'yundan'=>$yundan,
                'printedBefore'=>$printedBefore
            ]);
    }
}
