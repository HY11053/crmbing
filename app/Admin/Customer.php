<?php

namespace App\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable=['name','gender','referer','wechat','phone','package','notes','operate','drainreason','inputer','advertisement','status','allocated_at','visit_at'];
    public function getCreatedAtAttribute($date)
    {

        if (Carbon::now() > Carbon::parse($date)->addDays(30))
        {
            return date('Y-m-d',strtotime($date));
        }

        return Carbon::parse($date)->diffForHumans();
    }

    public function getAllocatedAtAttribute($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }
    public function setVisitAtAttribute($date)
    {
        if(!empty($date) && strpos($date, '/') !== false)
        {
            $newdate=explode('/',$date);
            $this->attributes['visit_at'] = Carbon::createFromFormat('Y-m-d',$newdate[2].'-'.$newdate[0].'-'.$newdate[1]);
        }
    }
}
