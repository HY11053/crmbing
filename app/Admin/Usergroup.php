<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Usergroup extends Model
{
    protected $fillable=['groupname'];

    protected function users()
    {
        return $this->hasMany('App\User','id');
    }
}
