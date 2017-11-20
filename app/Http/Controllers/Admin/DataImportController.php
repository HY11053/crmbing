<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Advertisement;
use App\Admin\Customer;
use App\Admin\Packagetype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        for ($i=0;$i<count($inputerDatas);$i++)
        {
            foreach (explode('@',$inputerDatas[$i]) as $index=>$inputerData)
            {
                $importdatas[$index]=$inputerData;
            }
           if(!Customer::where('phone',$importdatas[4])->value('phone'))
           {
               Customer::insert(
                   [
                       'name' => $importdatas[0],
                       'gender' => $importdatas[1],
                       'referer'=>$importdatas[2],
                       'wechat'=>$importdatas[3],
                       'phone'=>$importdatas[4],
                       'package'=>$importdatas[5],
                       'notes'=>$importdatas[6],
                       'advertisement'=>$importdatas,
                   ]
               );
           }
        }

    }
}
