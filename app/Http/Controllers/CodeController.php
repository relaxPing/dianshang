<?php

namespace App\Http\Controllers;

use App\Code;
use Illuminate\Http\Request;
use Milon\Barcode\DNS1D;

class CodeController extends Controller
{
    public function addCode(Request $request){
        if($request->isMethod('POST')){
            //表单验证
            $this->validate($request, [
                'Code.start' =>'required',
                'Code.end' => 'required',
            ],[],[
                'Code.start'=>'段号起始',
                'Code.end' => '段号截止',
            ]);


            $data = $request->input('Code');
            $start = $data['start'];
            $end = $data['end'];
            //验证 如果start>end 错误提示
            if($start >$end){
                return redirect()->back()->with('error','起始号码需要大于截止号码！');
            }

            $current = $start;
            for($i = 0;$i < $end-$start+1;$i++ ){
                $code = new Code();
                $code->number = $current;

                /*根据当前的电商号生成条纹码,并存储在public/imgs/下*/
                /*$dns1d = new DNS1D();
                $image=$dns1d->getBarcodePNG($current, "C128",1.8,50);
                $imgName = $current.uniqid().'.png';
                $filePath = 'imgs/barCodes/'.$imgName;
                $r = file_put_contents($filePath, base64_decode($image));*/
                /*将存储的条形码路径存到数据表中*/
                /*$code->barCode = $filePath;*/

                $code->save();
                $current++;
            }
            return redirect('addCode')->with('success','添加成功');
        }
        return view('addCode');
    }
}
