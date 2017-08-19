<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Advertisement;
use App\Admin\Packagetype;
use App\Admin\Referer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SysconfControlController extends Controller
{
    /**
     * 信息来源提交视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function refererAdd()
    {
        return view('admin.refereradd');
    }

    /**
     * 信息来源提交处理
     * @param Request $request
     */
    public function postRefererAdd(Request $request)
    {
        Referer::create($request->all());
        redirect(route('refererlist'));
    }

    /**
     * 信息来源列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function refererList()
    {
        $refererlists=Referer::all();
        return view('admin.refererlist',compact('refererlists'));
    }

    /**
     * 套餐类型添加视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function packageAdd()
    {
        return view('admin.packageadd');
    }
    /**
     * 套餐类型添加
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postPackageAdd(Request $request)
    {
        Packagetype::create($request->all());
        return redirect(route('packagelist'));
    }

    /**
     * 套餐类型列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function packageList()
    {
        $packagelists=Packagetype::all();
        return view('admin.packagelist',compact('packagelists'));
    }

    /**
     * 广告类型视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function advertisementAdd()
    {
        return view('admin.advertisementadd');
    }

    /**
     * 广告类型数据添加处理
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postAdvertisementAdd(Request $request)
    {
        Advertisement::create($request->all());
        return redirect(route('advertisementlist'));
    }

    /**
     * 广告类型数据列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function advertisementList()
    {
        $advertisementlists=Advertisement::all();
        return view('admin.advertisementlist',compact('advertisementlists'));

    }
}
