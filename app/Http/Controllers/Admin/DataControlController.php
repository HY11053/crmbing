<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Advertisement;
use App\Admin\Customer;
use App\Admin\Packagetype;
use App\Admin\Referer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataControlController extends Controller
{
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
        $packages=Packagetype::pluck('sections');
        $advertisements=Advertisement::pluck('sections');
        $allreferers=Referer::pluck('sections');
        return view('admin.dataaddition',compact('allreferers','packages','advertisements'));
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postDataAddition(Request $request)
    {
        $request['inputer']=User::where('id',Auth::id())->value('name');
        Customer::create($request->all());
        return redirect(route('dataimport'));
    }
    public function dataUnclaimed()
    {
        $dataUnclaimeds=Customer::where('operate',null)->paginate(50);
        return view('admin.unclaimed',compact('dataUnclaimeds'));
    }
}
