<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Advertisement;
use App\Admin\Customer;
use App\Admin\Packagetype;
use App\Admin\Referer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SearchOptionsController extends Controller
{
    /**电话搜索客户信息
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function phoneSearch(Request $request)
    {
        if (Auth::user()->usertye>2)
        {
            abort(403);
        }
        $customer=Customer::where('phone',$request->input('tel'))->findOrFail(Customer::where('phone',$request->input('tel'))->value('id'));
        return view('admin.customerprofile',compact('customer'));
    }
}
