<?php

namespace App\Http\Controllers\Admin;

use App\Model\Branddata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandDatasController extends Controller
{
    public function Index($options='')
    {
        if (empty($options))
        {
            $branddatas=Branddata::orderBy('nums','desc')->paginate(100);
            $option='所有品牌';
        }else{
            switch ($options)
            {
                case 'lsd':
                    $option='零食店品牌';
                    break;
                case 'ggd':
                    $option='干果品牌';
                    break;
                case 'chd':
                    $option='炒货品牌';
                    break;
                case 'jklsd':
                    $option='进口零食品牌';
                    break;
                case 'ssd':
                    $option='熟食品牌';
                    break;
            }
            $branddatas=Branddata::where('type',$option)->orderBy('nums','desc')->paginate(100);
        }

        return view('admin.branddata',compact('branddatas','option'));
    }
    public function Status(Request $request)
    {
        Branddata::where('id',$request->id)->update(['status'=>1]);
        return '已使用';
    }
    public function Delete($id)
    {
        Branddata::where('id',$id)->delete();
        return redirect()->back();
    }
}
