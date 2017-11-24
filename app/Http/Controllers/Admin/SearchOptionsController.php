<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SearchOptionsController extends Controller
{
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
