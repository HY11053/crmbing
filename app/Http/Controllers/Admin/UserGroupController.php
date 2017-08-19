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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function groupCreate()
    {
        return view('admin.groupcreate');
    }

    public function postGroupCreate(Request $request)
    {
        UserGroup::create($request->all());
    }
}
