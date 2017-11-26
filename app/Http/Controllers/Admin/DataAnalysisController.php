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

class DataAnalysisController extends Controller
{
    /**录入数据汇总
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function inputerAnalysis(Request $request)
    {
        if(Auth::user()->usertype>2 || Auth::user()->groupid!=1)
        {
            if(Auth::user()->usertype!=1)
            {
                abort(403);
            }
        }
        $start_at=$request['start_at'];
        $end_at=$request['end_at'];
        $advertisement=$request->input('advertisement');
        $referer=$request->input('referer');
        $inputer=$request->input('inputer');
        $dealstatus=$request->input('dealstatus');
        $arguments=$request->all();
        $inputers=User::where('groupid',1)->pluck('name','id');
        $packages=Packagetype::pluck('sections','id');
        $advertisements=Advertisement::pluck('sections','id');
        $allreferers=Referer::pluck('sections','id');
        $allInputerDatas=Customer::when($start_at, function ($query) use ($start_at) {

            return $query->where('created_at', '>',Carbon::parse($start_at));
        })
            ->when($end_at, function ($query) use ($end_at) {
                return $query->where('created_at', '<',Carbon::parse($end_at)->addDay());
            })
            ->when($advertisement, function ($query) use ($advertisement) {

                return $query->where('advertisement',$advertisement);
            })
            ->when($referer, function ($query) use ($referer) {
                return $query->where('referer',$referer);
            })
            ->when($inputer, function ($query) use ($inputer) {
                return $query->where('inputer',User::where('id',$inputer)->value('name'));
            })
            ->when($dealstatus, function ($query) use ($dealstatus) {
                return $query->where('dealstatus',$dealstatus);
            })
            ->paginate(50);
        return view('admin.inputer_analysis',compact('allInputerDatas','inputers','packages','advertisements','allreferers','arguments'));
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
        $operates=User::where('groupid',2)->pluck('name','id');
        $packages=Packagetype::pluck('sections','id');
        $advertisements=Advertisement::pluck('sections','id');
        $allreferers=Referer::pluck('sections','id');
        $allCustomerserviceDatas=Customer::where('operate','<>',null)->orwhere('operate','<>','')->paginate(50);
        return view('admin.customerservice_analysis',compact('allCustomerserviceDatas','operates','packages','advertisements','allreferers'));
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
        $receptionist=User::where('groupid',3)->pluck('name','id');
        $packages=Packagetype::pluck('sections','id');
        $advertisements=Advertisement::pluck('sections','id');
        $allreferers=Referer::pluck('sections','id');
        $allCustomervisitDatas=Customer::where('receptionist','<>',null)->orwhere('receptionist','<>','')->paginate(50);
        return view('admin.customervisit_analysis',compact('allCustomervisitDatas','receptionist','packages','advertisements','allreferers'));
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
        $packages=Packagetype::pluck('sections','id');
        $advertisements=Advertisement::pluck('sections','id');
        $allreferers=Referer::pluck('sections','id');
        $allCustomersuccessDatas=Customer::where('dealstatus',1)->paginate(50);
        return view('admin.customersuccess_analysis',compact('allCustomersuccessDatas','packages','advertisements','allreferers'));
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
        $packages=Packagetype::pluck('sections','id');
        $advertisements=Advertisement::pluck('sections','id');
        $allreferers=Referer::pluck('sections','id');
        $allCustomerunsuccessDatas=Customer::where('dealstatus','<>',1)->where('dealstatus','<>',0)->paginate(50);
        return view('admin.customerunsuccess_analysis',compact('allCustomerunsuccessDatas','allreferers','packages','advertisements'));
    }
}
