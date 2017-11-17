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
        return redirect(route('refererlist'));
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

    /**信息来源编辑视图
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function refererEdit($id)
    {
        $thisReferer=Referer::where('id',$id)->findOrFail($id);
        return view('admin.referer_edit',compact('thisReferer'));
    }

    /**信息来源编辑提交数据处理
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postRefererEdit(Request $request)
    {
        Referer::findOrFail($request->id)->update($request->all());
       return redirect(route('refererlist'));
    }

    /**信息来源删除
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function refererDetele(Request $request)
    {
        Referer::findOrFail($request->id)->delete();
        return redirect(route('refererlist'));
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


    /**套餐类型修改
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function packageEdit($id)
    {
        $thisPackage=Packagetype::findOrFail($id);
        return view('admin.package_edit',compact('thisPackage'));
    }

    /**套餐类型修改数据提交
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postPackageEdit(Request $request)
    {
        Packagetype::findOrFail($request->id)->update($request->all());
        return redirect(route('packagelist'));
    }

    /**套餐类型删除
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function packageDelete(Request $request)
    {
        Packagetype::findOrFail($request->id)->delete();
        return redirect(route('packagelist'));
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

    /**广告类型编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function advertisementEdit($id)
    {
        $thisAdvertisement=Advertisement::findOrFail($id);
        return view('admin.advertisementedit',compact('thisAdvertisement'));
    }

    /**广告类型编辑提交处理
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postAdvertisementEdit(Request $request)
    {
        Advertisement::findOrFail($request->id)->update($request->all());
        return redirect(route('advertisementlist'));
    }

    /**广告类型删除
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function advertisementdelete($id)
    {
        Advertisement::findOrFail($id)->delete();
        return redirect(route('advertisementlist'));
    }
}
