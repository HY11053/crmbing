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
    public function Index()
    {
        $users=User::paginate(50);
        return view('admin.users',compact('users'));
    }
    public function UserEdit($id)
    {
        $user=User::where('id',$id)->first();
        if(User::where('id',Auth::id())->value('type')==0){
            return '无权限修改';
        }
        $groups=Usergroup::all();
        return view('admin.useredit',compact('user','groups'));
    }
    public function AdminUserEdit($id)
    {
        if (Auth::id()!=1){
            return '非法操作';
        }
        $user=User::where('id',$id)->first();
        $groups=Usergroup::all();
        return view('admin.useredit',compact('user','groups'));
    }
    public function PostUserEdit(UsersRequest $request,$id)
    {
        User::where('id',$id)->update(['name'=>$request['name'],'email'=>$request['email'],'password'=>bcrypt($request['password']),'gid'=>$request['gid'],'type'=>$request['type'],'is_create'=>$request['is_create']]);
        return redirect(route('users'));
    }
    public function Delete($id)
    {
        User::where('id',$id)->delete();
        redirect()->back();
    }

    public function UserGroup()
    {
        $groups=Usergroup::where('id','<>',0)->get();
        return view('admin.usergroup',compact('groups'));
    }

    public function UserGroupCreate()
    {
        return view('admin.groupcreate');
    }
    public function UserGroupEdit($id)
    {
        $thisgroup=Usergroup::where('id',$id)->first();
        return view('admin.groupedit',compact('thisgroup'));
    }
    public function PostUserGroupCreate(Request $request)
    {
       Usergroup::create($request->all());
       return redirect(route('usergroup'));
    }

    public function PostUserGroupEdit(Request $request,$id)
    {
        Usergroup::where('id',$id)->update(['groupname'=>$request['groupname']]);
        return redirect(route('usergroup'));
    }
}
