<?php

namespace App\Http\Controllers\Admin;

use App\Admin\UserGroup;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        if (User::where('id',Auth::id())->value('usertype')>2)
        {
            abort(403);
        }
        $groups=UserGroup::pluck('groupname','id');
        return view('admin.userregister',compact('groups'));
    }
}
