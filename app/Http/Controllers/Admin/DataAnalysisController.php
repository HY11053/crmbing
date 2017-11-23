<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataAnalysisController extends Controller
{
    /**录入数据汇总
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function inputerAnalysis()
    {
        $allInputerDatas=Customer::orderBy('id','desc')->Inputer()->paginate(50);
        return view('admin.inputer_analysis',compact('allInputerDatas'));
    }


    /**电话客服接待数据汇总
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerserviceAnalysis()
    {
        $allCustomerserviceDatas=Customer::where('operate','<>',null)->orwhere('operate','<>','')->paginate(50);
        return view('admin.customerservice_analysis',compact('allCustomerserviceDatas'));
    }

    /**门店接待数据汇总
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customervisitAnalysis()
    {
        $allCustomervisitDatas=Customer::where('receptionist','<>',null)->orwhere('receptionist','<>','')->paginate(50);
        return view('admin.customervisit_analysis',compact('allCustomervisitDatas'));
    }

    /**已成单数据信息
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerSuccessAnalysis()
    {
        $allCustomersuccessDatas=Customer::where('dealstatus',1)->paginate(50);
        return view('admin.customersuccess_analysis',compact('allCustomersuccessDatas'));
    }

    /**已退单客户信息
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerUnsuccessAnalysis()
    {
        $allCustomerunsuccessDatas=Customer::where('dealstatus','<>',1)->where('dealstatus','<>',0)->paginate(50);
        return view('admin.customerunsuccess_analysis',compact('allCustomerunsuccessDatas'));
    }
}
