<?php

namespace App\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable=['name','gender','referer','wechat','phone','package','notes','operate','drainreason','inputer','advertisement','status'];
    public function getCreatedAtAttribute($date)
    {

        if (Carbon::now() > Carbon::parse($date)->addDays(10))
        {
            return date('Y-m-d',strtotime($date));
        }

        return Carbon::parse($date)->diffForHumans();
    }
}
