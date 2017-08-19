<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $fillable=['groupname','grouptype'];
    protected function user()
    {
        return $this->hasMany('App\User','groupid');
    }
}
