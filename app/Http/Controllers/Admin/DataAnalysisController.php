<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataAnalysisController extends Controller
{
    /**录入数据汇总
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function inputerAnalysis()
    {
        if(Auth::user()->usertype>2 || Auth::user()->groupid!=1)
        {
            if(Auth::user()->usertype!=1)
            {
                abort(403);
            }
        }
        $allInputerDatas=Customer::orderBy('id','desc')->paginate(50);
        return view('admin.inputer_analysis',compact('allInputerDatas'));
    }


    /**电话客服接待数据汇总
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerserviceAnalysis()
    {
        if(Auth::user()->usertype>2 || Auth::user()->groupid!=2)
        {
            if(Auth::user()->usertype!=1)
            {
                abort(403);
            }
        }
        $allCustomerserviceDatas=Customer::where('operate','<>',null)->orwhere('operate','<>','')->paginate(50);
        return view('admin.customerservice_analysis',compact('allCustomerserviceDatas'));
    }

    /**门店接待数据汇总
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customervisitAnalysis()
    {
        if(Auth::user()->usertype>2 || Auth::user()->groupid!=3)
        {
            if(Auth::user()->usertype!=1)
            {
                abort(403);
            }
        }
        $allCustomervisitDatas=Customer::where('receptionist','<>',null)->orwhere('receptionist','<>','')->paginate(50);
        return view('admin.customervisit_analysis',compact('allCustomervisitDatas'));
    }

    /**已成单数据信息
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerSuccessAnalysis()
    {
        if(Auth::user()->usertype!=1)
        {
            abort(403);
        }
        $allCustomersuccessDatas=Customer::where('dealstatus',1)->paginate(50);
        return view('admin.customersuccess_analysis',compact('allCustomersuccessDatas'));
    }

    /**已退单客户信息
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerUnsuccessAnalysis()
    {
        if(Auth::user()->usertype!=1)
        {
            abort(403);
        }
        $allCustomerunsuccessDatas=Customer::where('dealstatus','<>',1)->where('dealstatus','<>',0)->paginate(50);
        return view('admin.customerunsuccess_analysis',compact('allCustomerunsuccessDatas'));
    }
}
