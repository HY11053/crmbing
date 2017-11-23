<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationClearController extends Controller
{
    public function notificationClear()
    {
        Auth::user()->notifications()->delete();
        return back();
    }
}
