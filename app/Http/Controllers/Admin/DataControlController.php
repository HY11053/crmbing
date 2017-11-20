<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Advertisement;
use App\Admin\Customer;
use App\Admin\Customnote;
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
        $cunstomdatas=Customer::orderBy('id','desc')->Inputer()->paginate(50);
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
        Customer::where('phone',$request->input('phone'))->value('id')?exit('号码已存在'):'';
        $request['inputer']=User::where('id',Auth::id())->value('name');
        Customer::create($request->all());
        return redirect(route('dataimport'));
    }

    /**
     * 客户信息编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function DataEdit($id)
    {
        //Customer::where('id',$id)->value('')
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
        if($request['notes']!=Customer::where('id',$id)->value('notes'))
        {
            $notes=User::where('id',Auth::id())->value('name').'将信息【'.Customer::where('id',$id)->value('notes').'】修改为'.$request['notes'];
            Customnote::create(['cid'=>$id,'notes'=>$notes]);
            Customer::findOrfail($id)->update(['follownum'=>Customer::where('id',$id)->value('follownum')+1]);
        }

        Customer::findOrfail($id)->update($request->all());
        return redirect(route('customerservice'));
    }

    /**
     * 数据删除
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function DataDelete($id)
    {
        if (Auth::id()!=1){
            abort(403);
        }
        Customer::where('id',Customer::findOrfail($id)->id)->delete();
        return redirect(route('dataview'));
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
            $request['notes']='分配给'.User::where('id',Auth::id())->value('name');
            Customnote::create(['cid'=>$request['id'],'notes'=>$request['notes']]);
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
     * 门店接待
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function CustomerVisit()
    {
        $customerVisits=Customer::where('visit_at','>',Carbon::now())->where('operate','<>',null)->where('receptionist',null)->paginate(50);
        return view('admin.datavisit',compact('customerVisits'));

    }

    /**
     * 门店客户领取
     * @param Request $request
     * @return array
     */
    public function dataReceptionStatus(Request $request)
    {
        $status='已接待';
        $receptionistUser=User::where('id',Auth::id())->value('name');
        if(empty(Customer::where('id',$request['id'])->value('receptionist')))
        {
            $request['reception_at']=Carbon::now();
            $request['notes']=User::where('id',Auth::id())->value('name').'领取接待';
            Customnote::create(['cid'=>$request['id'],'notes'=>$request['notes']]);
            Customer::where('id',$request->input('id'))->update(['storestatus'=>$status,'receptionist'=>$receptionistUser,'reception_at'=>$request['reception_at']]);
        }else{
            $status=Customer::where('id',$request['id'])->value('receptionist').'已接待';
            $receptionistUser=Customer::where('id',$request->input('id'))->value('receptionist');
        }

        return [$status,$receptionistUser];
    }

    public function CustomerVisitOwn()
    {
        $customerVisits=Customer::where('visit_at','>',Carbon::now())->where('operate','<>',null)->where('receptionist',User::where('id',Auth::id())->value('name'))->paginate(50);
        return view('admin.datavisitown',compact('customerVisits'));
    }
}
