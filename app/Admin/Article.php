<?php

namespace App\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable=['content','type','user_id'];

    public function getCreatedAtAttribute($date)
    {

        if (Carbon::now() > Carbon::parse($date)->addDays(10))
        {
            return date('Y-m-d',strtotime($date));
        }

        return Carbon::parse($date)->diffForHumans();
    }
    protected function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
