<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Advertisement;
use App\Admin\Customer;
use App\Admin\Customnote;
use App\Admin\Packagetype;
use App\Admin\Referer;
use App\Http\Requests\CustomerDataRequest;
use App\Notifications\ReceivedNotification;
use App\Notifications\ReturnedNotification;
use App\Notifications\VisitedNotification;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notification;
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
    public function postDataAddition(CustomerDataRequest $request)
    {
        Customer::where('phone',$request->input('phone'))->value('id')?exit('号码已存在'):'';
        $request['inputer']=User::where('id',Auth::id())->value('name');
        Customer::create($request->all());
        return redirect(route('dataview'));
    }

    /**
     * 客户信息编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function DataEdit($id)
    {
        Customer::where('id',$id)->value('operate')?abort(403):'';
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
    public function postDataEdit(CustomerDataRequest $request,$id)
    {
        if($request['notes']!=Customer::where('id',$id)->value('notes'))
        {
            $notes=User::where('id',Auth::id())->value('name').'将信息【'.Customer::where('id',$id)->value('notes').'】修改为'.$request['notes'];
            Customnote::create(['cid'=>$id,'notes'=>$notes]);
            //Customer::findOrfail($id)->update(['follownum'=>Customer::where('id',$id)->value('follownum')+1]);
        }
        Customer::findOrfail($id)->update($request->all());
        //return redirect(route('customerservice'));
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
            User::where('id',Auth::id())->first()->notify(new ReceivedNotification(Customer::findOrFail($request->id)));
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

    /**客服接待信息编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ServiceDataEdit($id)
    {
        $packages=Packagetype::pluck('sections','id');
        $advertisements=Advertisement::pluck('sections','id');
        $allreferers=Referer::pluck('sections','id');
        $thiscunstomdata=Customer::findOrfail($id);
        return view('admin.service_edit',compact('thiscunstomdata','packages','advertisements','allreferers'));

    }

    /**客服接待信息编辑处理
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function PostServiceDataEdit(Request $request,$id)
    {
        if($request['notes']!=Customer::where('id',$id)->value('notes'))
        {
            $notes=User::where('id',Auth::id())->value('name').'将信息【'.Customer::where('id',$id)->value('notes').'】修改为'.$request['notes'];
            Customnote::create(['cid'=>$id,'notes'=>$notes]);
            Customer::findOrfail($id)->update(['follownum'=>Customer::where('id',$id)->value('follownum')+1]);
        }
        $dealstatus=Customer::where('id',$id)->value('dealstatus');
        Customer::findOrfail($id)->update($request->all());
        if (Customer::where('id',$id)->value('dealstatus')==2 && $request->input('dealstatus')!=$dealstatus)
        {
            User::where('name',Customer::where('id',$id)->value('inputer'))->first()->notify(new ReturnedNotification(Customer::findOrFail($id)));
            User::where('name',Customer::where('id',$id)->value('inputer'))->first()->notify(new ReturnedNotification(Customer::findOrFail($id)));
            $notes=User::where('id',Auth::id())->value('name').'将信息修改为【已退单】';
            Customnote::create(['cid'=>$id,'notes'=>$notes]);
            Customer::findOrfail($id)->update(['follownum'=>Customer::where('id',$id)->value('follownum')+1]);
        }elseif (Customer::where('id',$id)->value('dealstatus')==1 && $request->input('dealstatus')!=$dealstatus){

            $notes=User::where('id',Auth::id())->value('name').'将信息修改为【已成单】';
            Customnote::create(['cid'=>$id,'notes'=>$notes]);
            Customer::findOrfail($id)->update(['follownum'=>Customer::where('id',$id)->value('follownum')+1]);
        }
        return redirect(route('customerservice'));

    }

    /**
     * 门店接待
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function CustomerVisit()
    {
        $customerVisits=Customer::where('visit_at','>',Carbon::now())->where('dealstatus',0)->where('operate','<>',null)->where('receptionist',null)->paginate(50);
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
            User::where('id',Auth::id())->first()->notify(new VisitedNotification(Customer::findOrFail($request->id)));
        }else{
            $status=Customer::where('id',$request['id'])->value('receptionist').'已接待';
            $receptionistUser=Customer::where('id',$request->input('id'))->value('receptionist');
        }

        return [$status,$receptionistUser];
    }

    /**门店已领取客户
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function CustomerVisitOwn()
    {
        $customerVisits=Customer::where('visit_at','>',Carbon::now())->where('operate','<>',null)->where('receptionist',User::where('id',Auth::id())->value('name'))->paginate(50);
        return view('admin.datavisitown',compact('customerVisits'));
    }

    /**客户来访数据编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function VisitDataEdit($id)
    {
        $packages=Packagetype::pluck('sections','id');
        $advertisements=Advertisement::pluck('sections','id');
        $allreferers=Referer::pluck('sections','id');
        $thiscunstomdata=Customer::findOrfail($id);
        return view('admin.visit_edit',compact('thiscunstomdata','packages','advertisements','allreferers'));
    }

    /**客户来访数据编辑处理
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function PostVisitDataEdit(Request $request,$id)
    {
        if($request['notes']!=Customer::where('id',$id)->value('notes'))
        {
            $notes=User::where('id',Auth::id())->value('name').'将信息【'.Customer::where('id',$id)->value('notes').'】修改为'.$request['notes'];
            Customnote::create(['cid'=>$id,'notes'=>$notes]);
            Customer::findOrfail($id)->update(['follownum'=>Customer::where('id',$id)->value('follownum')+1]);
        }
        $dealstatus=Customer::where('id',$id)->value('dealstatus');
        Customer::findOrfail($id)->update($request->all());
        if (Customer::where('id',$id)->value('dealstatus')==2 && $request->input('dealstatus')!=$dealstatus)
        {
            User::where('name',Customer::where('id',$id)->value('inputer'))->first()->notify(new ReturnedNotification(Customer::findOrFail($id)));
            $notes=User::where('id',Auth::id())->value('name').'将信息修改为【已退单】';
            Customnote::create(['cid'=>$id,'notes'=>$notes]);
        }elseif (Customer::where('id',$id)->value('dealstatus')==1 && $request->input('dealstatus')!=$dealstatus){

            $notes=User::where('id',Auth::id())->value('name').'将信息修改为【已成单】';
            Customnote::create(['cid'=>$id,'notes'=>$notes]);
            Customer::findOrfail($id)->update(['follownum'=>Customer::where('id',$id)->value('follownum')+1]);
        }
        return redirect(route('customervisitown'));
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

}
