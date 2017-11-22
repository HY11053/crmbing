<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Advertisement;
use App\Admin\Customer;
use App\Admin\Packagetype;
use App\Admin\Referer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function importCunsomerDatas(Request $request)
    {
        if ($request->hasFile('customers') && $request->file('customers')->isValid()) {
            $customers = $request->file('customers');
            $filePath = $customers->storeAs('customers', 'customers.xlsx');
            $filePath = storage_path('app/' . $filePath);
            $success_info=[];
            $unsuccess_info = [];
            Excel::load($filePath, function ($reader) use (&$success_info, &$unsuccess_info) {
                $customerdatas = $reader->all()->toArray();
                foreach ($customerdatas as $customerdata) {
                    foreach ($customerdata as $data) {
                        if(!empty($data['手机号码']))
                        {
                            $custome['name'] = $data['姓名'];
                            $custome['gender'] = $data['性别'];
                            $custome['referer'] = Referer::where('sections', $data['信息来源'])->value('id');
                            $custome['wechat'] = $data['微信'];
                            $custome['phone'] = $data['手机号码'];
                            $custome['package'] = Packagetype::where('sections', $data['套餐类型'])->value('id');
                            $custome['notes'] = $data['备注信息'];
                            $custome['advertisement'] = Advertisement::where('sections', $data['广告来源'])->value('id');
                            $custome['visit_at'] = $data['到店时间'];
                            $custome['payment'] = $data['已交金额'];
                            $custome['inputer'] = User::where('id', Auth::id())->value('name');
                            $custome['created_at'] = Carbon::now();
                            $custome['updated_at'] = Carbon::now();
                            if (preg_match('/^1[34578]\d{9}$/', $data['手机号码']) && empty(Customer::where('phone', $data['手机号码'])->value('phone'))) {
                                Customer::create($custome);
                                $success_info[] = $custome;
                            } elseif(!preg_match('/^1[34578]\d{9}$/', $data['手机号码'])) {
                                $custome['info']='非手机号码';
                                $unsuccess_info[] = $custome;
                            }else{
                                $custome['info']='号码已存在';
                                $unsuccess_info[] = $custome;
                            }
                        }
                    }
                }

            });
            return view('admin.import_success',compact('success_info','unsuccess_info'));
        }
    }
}
