<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Customnote extends Model
{
    //
    protected $fillable=['notes','cid'];

    protected function custom()
    {
        return $this->belongsTo('App\Admin\Customer','id');
    }
}
