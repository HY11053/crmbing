<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    function Index()
    {
        return view('admin.index',compact('articles'));
    }
}
