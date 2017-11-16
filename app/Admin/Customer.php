<?php

namespace App\Admin;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Customer extends Model
{
    protected $fillable=['name','gender','referer','wechat','phone','package','notes','operate','drainreason','inputer','advertisement',
        'status','allocated_at','visit_at','payment','follownum','storestatus','dealstatus','reception_at','receptionist'];
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
        if(!empty($date) && strpos($date,':')==false)
        {
            $this->attributes['visit_at'] = Carbon::createFromFormat('Y-m-d',$date);
        }
    }

    protected function Cnotes()
    {
        return $this->hasMany('App\Admin\Customnote','cid');
    }
    protected function packages()
    {
        return $this->belongsTo('App\Admin\Packagetype','package','id');
    }

    public function scopeInputer($query)
    {
        if(Auth::id()!=1)
        {
            $query->where('inputer','=',User::where('id',Auth::id())->value('name'));
        }
    }
}
