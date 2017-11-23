<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Advertisement;
use App\Admin\Customer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    function Index()
    {
        $operateUsers=User::where('groupid',2)->pluck('name');
        $topOperateusers=[];
        $advertisementsInfos=[];
        $latestDatas=Customer::take(10)->latest()->get();
        foreach ($operateUsers as $operateUser)
        {
            $topOperateusers[$operateUser]=Customer::where('operate',$operateUser)->where('follownum','>',0)->where('allocated_at','>',Carbon::today())->count();

        }

        !empty($topOperateusers)?arsort($topOperateusers):$topOperateusers;

        $advertisements=Advertisement::pluck('sections');
        $advertisementid=Advertisement::pluck('id');
        foreach ($advertisementid as $advertisement)
        {
            $advertisementsInfos[$advertisement]=Customer::where('advertisement',$advertisement)->where('created_at','>',Carbon::today())->count();
        }
        !empty($advertisementsInfos)?arsort($advertisementsInfos):$advertisementsInfos;
        $advertisementsInfos=array_slice($advertisementsInfos,0,6,true);
        $colors=['text-red','text-green','text-yellow','text-aqua','text-light-blue','text-gray'];
        $colorfuls=['#f56954','#00a65a','#f39c12','#00c0ef','#3c8dbc','#d2d6de'];
        $i=0;
        $j=0;
       return view('admin.index',compact('advertisements','colors','topOperateusers','advertisementsInfos','i','j','colorfuls','latestDatas'));
    }
}
