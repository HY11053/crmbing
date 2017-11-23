<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Advertisement;
use App\Admin\Customer;
use App\Admin\Packagetype;
use App\Admin\Referer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataImportController extends Controller
{
    /**客户数据导入 TXT格式
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dataImportText()
    {
        return view('admin.dataimport_txt');
    }
    public function putDataImportText(Request $request)
    {
        $inputerDatas=explode(PHP_EOL,$request->input('content'));
        $success_info=[];
        $unsuccess_info=[];
        for ($i=0;$i<count($inputerDatas);$i++)
        {
            foreach (explode('@',$inputerDatas[$i]) as $index=>$inputerData)
            {
                $importdatas[$index]=$inputerData;
            }
            $thisInsertData=[
                'name' => $importdatas[0],
                'gender' => $importdatas[1],
                'referer'=>Referer::where('sections',$importdatas[2])->value('id'),
                'wechat'=>$importdatas[3],
                'phone'=>$importdatas[4],
                'package'=>Packagetype::where('sections',$importdatas[5])->value('id'),
                'notes'=>$importdatas[6],
                'advertisement'=>Advertisement::where('sections',$importdatas[7])->value('id'),
                'inputer'=>Auth::user()->name,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ];
           if(!Customer::where('phone',$thisInsertData['phone'])->value('phone') && preg_match('/^1[34578]\d{9}$/', $thisInsertData['phone']))
           {
               Customer::insert($thisInsertData);
               $success_info[] = $thisInsertData;
           }elseif(!preg_match('/^1[34578]\d{9}$/', $thisInsertData['phone'])) {
               $thisInsertData['info']='非手机号码';
               $unsuccess_info[] = $thisInsertData;
           }else{
               $thisInsertData['info']='号码已存在';
               $unsuccess_info[] = $thisInsertData;
           }
        }
        return view('admin.import_success',compact('success_info','unsuccess_info'));
    }

    public function dataImportExcel()
    {
        return view('admin.dataimport_excel');
    }
}
