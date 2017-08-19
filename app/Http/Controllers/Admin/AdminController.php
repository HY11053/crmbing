<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    function Index()
    {
        $articles=Article::latest()->take(10)->get();
        return view('admin.index',compact('articles'));
    }
}
