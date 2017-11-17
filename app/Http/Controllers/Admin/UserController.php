<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Usergroup;
use App\Helpers\UploadImages;
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
    public function adminUserEdit($id)
    {
        if(Auth::id()!=$id && User::where('id',Auth::id())->value('usertype')>2)
        {
            return abort(403);
        }

        if (User::where('id',Auth::id())->value('groupid') != User::where('id',$id)->value('groupid') && User::where('id',Auth::id())->value('usertype')>1)
        {
            abort(403);
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
        if (isset($request->image))
        {
            $request['avatar']=UploadImages::UploadImage($request);
        }
        User::findOrFail($id)->update($request->all());
        return redirect(route('userlist'));
    }

    /**删除会员
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userDelete($id)
    {
        if (User::where('id',Auth::id())->value('usertype')==1)
        {
            User::where('id',$id)->delete();
            return redirect()->back();
        }
        abort(403);

    }
}
