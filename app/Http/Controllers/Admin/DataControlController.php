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

class DataControlController extends Controller
{
    /**
     * 数据浏览视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dataView()
    {
        $cunstomdatas=Customer::orderBy('id','desc')->paginate(50);
        return view('admin.dataview',compact('cunstomdatas'));
    }
    /**
     * 数据添加视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dataAddition()
    {
        $packages=Packagetype::pluck('sections','id');
        $advertisements=Advertisement::pluck('sections','id');
        $allreferers=Referer::pluck('sections','id');
        return view('admin.dataaddition',compact('allreferers','packages','advertisements'));
    }

    /**
     *数据添加处理
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postDataAddition(Request $request)
    {
        $request['referer']=Referer::where('id',$request['referer'])->value('sections');
        $request['package']=Packagetype::where('id',$request['package'])->value('sections');
        $request['inputer']=User::where('id',Auth::id())->value('name');
        Customer::create($request->all());
        return redirect(route('dataimport'));
    }

    /**
     * 未领取数据状态
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dataUnclaimed()
    {
        $dataUnclaimeds=Customer::where('operate',null)->orwhere('operate','')->paginate(50);
        return view('admin.unclaimed',compact('dataUnclaimeds'));
    }

    /**
     * 客服领取数据处理
     * @param Request $request
     * @return array
     */
    public function dataUnclaimedStatus(Request $request)
    {
        $status='已领取';
        $operateUser=User::where('id',Auth::id())->value('name');
        if(empty(Customer::where('id',$request['id'])->value('operate')))
        {
            $request['allocated_at']=Carbon::now();
            Customer::where('id',$request->input('id'))->update(['status'=>$status,'operate'=>$operateUser,'allocated_at'=>$request['allocated_at']]);
        }else{
            $status=Customer::where('id',$request['id'])->value('operate').'已领取';
            $operateUser=Customer::where('id',$request->input('id'))->value('operate');
        }

        return [$status,$operateUser];
    }

    /**
     * 客服已接单数据
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerservice()
    {
        $cunstomdatas=Customer::where('operate',User::where('id',Auth::id())->value('name'))->paginate(50);
        return view('admin.customerservice',compact('cunstomdatas'));
    }

    /**
     * 客户信息编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function DataEdit($id)
    {
        $packages=Packagetype::pluck('sections','id');
        $advertisements=Advertisement::pluck('sections','id');
        $allreferers=Referer::pluck('sections','id');
        $thiscunstomdata=Customer::findOrfail($id);
        return view('admin.dataedit',compact('thiscunstomdata','packages','advertisements','allreferers'));
    }

    /**
     * 客户编辑数据处理
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postDataEdit(Request $request,$id)
    {
        Customer::findOrfail($id)->update($request->all());
        return redirect(route('customerservice'));
    }

    /**
     * 门店接待
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function CustomerVisit()
    {
        $customerVisits=Customer::where('visit_at','>',Carbon::now())->paginate(50);
        return view('admin.datavisit',compact('customerVisits'));

    }
}
