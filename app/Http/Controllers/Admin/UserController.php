<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Usergroup;
use App\Http\Requests\UsersRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * 会员用户列表视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userLists()
    {
        $users=User::paginate(50);
        return view('admin.users',compact('users'));
    }

    /**
     * 会员用户编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function UserEdit($id)
    {
        $user=User::where('id',$id)->first();
        if(User::where('id',Auth::id())->value('type')==0){
            return '无权限修改';
        }
        $groups=Usergroup::pluck('groupname','id');
        return view('admin.useredit',compact('user','groups'));
    }

    /**
     * 高级管理员修改
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function adminUserEdit($id)
    {
        if (Auth::id()!=1){
            return '非法操作';
        }
        $user=User::where('id',$id)->first();
        $groups=Usergroup::pluck('groupname','id');
        return view('admin.useredit',compact('user','groups'));
    }

    /**
     * 会员信息更改数据处理
     * @param UsersRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function adminPostUserEdit(UsersRequest $request,$id)
    {
        
        $request['password']=bcrypt($request['password']);
        User::findOrFail($id)->update($request->all());
        return redirect(route('userlist'));
    }

    /**删除会员
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Delete($id)
    {
        User::where('id',$id)->delete();
        return redirect()->back();
    }
}
