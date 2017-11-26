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
    public function customerserviceAnalysis(Request $request)
    {
        if(Auth::user()->usertype>2 || Auth::user()->groupid!=2)
        {
            if(Auth::user()->usertype!=1)
            {
                abort(403);
            }
        }
        $start_at=$request['start_at'];
        $end_at=$request['end_at'];
        $advertisement=$request->input('advertisement');
        $operate=$request->input('operate');
        $referer=$request->input('referer');
        $dealstatus=$request->input('dealstatus');
        $arguments=$request->all();
        $operates=User::where('groupid',2)->pluck('name','id');
        $packages=Packagetype::pluck('sections','id');
        $advertisements=Advertisement::pluck('sections','id');
        $allreferers=Referer::pluck('sections','id');
        $allCustomerserviceDatas=Customer::when($start_at, function ($query) use ($start_at) {
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
            ->when($operate, function ($query) use ($operate) {
                return $query->where('operate',User::where('id',$operate)->value('name'));
            },function ($query){
                return $query->where('operate','<>',null)->where('operate','<>','');
            })
            ->when($dealstatus, function ($query) use ($dealstatus) {
                return $query->where('dealstatus',$dealstatus);
            })->paginate(50);
        return view('admin.customerservice_analysis',compact('allCustomerserviceDatas','operates','packages','advertisements','allreferers','arguments'));
    }

    /**门店接待数据汇总
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customervisitAnalysis(Request $request)
    {
        if(Auth::user()->usertype>2 || Auth::user()->groupid!=3)
        {
            if(Auth::user()->usertype!=1)
            {
                abort(403);
            }
        }
        $start_at=$request['start_at'];
        $end_at=$request['end_at'];
        $advertisement=$request->input('advertisement');
        $reception=$request->input('reception');
        $referer=$request->input('referer');
        $dealstatus=$request->input('dealstatus');
        $arguments=$request->all();
        $receptionist=User::where('groupid',3)->pluck('name','id');
        $packages=Packagetype::pluck('sections','id');
        $advertisements=Advertisement::pluck('sections','id');
        $allreferers=Referer::pluck('sections','id');
        $allCustomervisitDatas=Customer::when($start_at, function ($query) use ($start_at) {
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
            ->when($reception, function ($query) use ($reception) {
                return $query->where('receptionist',User::where('id',$reception)->value('name'));
            },function ($query){
                return $query->where('receptionist','<>',null)->where('receptionist','<>','');
            })
            ->when($dealstatus, function ($query) use ($dealstatus) {
                return $query->where('dealstatus',$dealstatus);
            })->paginate(50);
        return view('admin.customervisit_analysis',compact('allCustomervisitDatas','receptionist','packages','advertisements','allreferers','arguments'));
    }

    /**已成单数据信息
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerSuccessAnalysis(Request $request)
    {
        if(Auth::user()->usertype!=1)
        {
            abort(403);
        }
        $packages=Packagetype::pluck('sections','id');
        $advertisements=Advertisement::pluck('sections','id');
        $allreferers=Referer::pluck('sections','id');
        $start_at=$request['start_at'];
        $end_at=$request['end_at'];
        $advertisement=$request->input('advertisement');
        $referer=$request->input('referer');
        $arguments=$request->all();
        $allCustomersuccessDatas=Customer::when($start_at, function ($query) use ($start_at) {
            return $query->where('created_at', '>',Carbon::parse($start_at));
        })->when($end_at, function ($query) use ($end_at) {
                return $query->where('created_at', '<',Carbon::parse($end_at)->addDay());
            })->when($advertisement, function ($query) use ($advertisement) {

                return $query->where('advertisement',$advertisement);
            })->when($referer, function ($query) use ($referer) {
                return $query->where('referer',$referer);
            })->where('dealstatus',1)->paginate(50);
        return view('admin.customersuccess_analysis',compact('allCustomersuccessDatas','packages','advertisements','allreferers','arguments'));
    }

    /**已退单客户信息
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerUnsuccessAnalysis(Request $request)
    {
        if(Auth::user()->usertype!=1)
        {
            abort(403);
        }
        $start_at=$request['start_at'];
        $end_at=$request['end_at'];
        $advertisement=$request->input('advertisement');
        $referer=$request->input('referer');
        $packages=Packagetype::pluck('sections','id');
        $advertisements=Advertisement::pluck('sections','id');
        $allreferers=Referer::pluck('sections','id');
        $arguments=$request->all();
        $allCustomerunsuccessDatas=Customer::when($start_at, function ($query) use ($start_at) {
            return $query->where('created_at', '>',Carbon::parse($start_at));
        })->when($end_at, function ($query) use ($end_at) {
            return $query->where('created_at', '<',Carbon::parse($end_at)->addDay());
        })->when($advertisement, function ($query) use ($advertisement) {

            return $query->where('advertisement',$advertisement);
        })->when($referer, function ($query) use ($referer) {
            return $query->where('referer',$referer);
        })->where('dealstatus','<>',1)->where('dealstatus','<>',0)->paginate(50);
        return view('admin.customerunsuccess_analysis',compact('allCustomerunsuccessDatas','allreferers','packages','advertisements','arguments'));
    }
}
