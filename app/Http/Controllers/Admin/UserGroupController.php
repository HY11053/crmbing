<?php

namespace App\Http\Controllers\Admin;

use App\Admin\UserGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserGroupController extends Controller
{
    /**
     * 用户组列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function groupLists()
    {
        $groups=UserGroup::all();
        return view('admin.grouplist',compact('groups'));
    }

    /**部门分组创建
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function groupCreate()
    {
        return view('admin.groupcreate');
    }

    /**部门分组添加处理
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postGroupCreate(Request $request)
    {
        UserGroup::create($request->all());
        return redirect(route('grouplist'));
    }
    public function groupEdit(Request $request)
    {
        $thisGroupInfo=UserGroup::findOrFail($request->id);
        return view('admin.groupedit',compact('thisGroupInfo'));
    }

    public function postGroupEdit(Request $request)
    {
        UserGroup::findOrfail($request->id)->update($request->all());
        return redirect(route('grouplist'));
    }
}
