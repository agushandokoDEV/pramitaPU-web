<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Auth::logout();
        // dd(Auth::user()->load(['roles'])->roles->name);
        return view('admin.home.index');
    }

    public function tes()
    {
        // Auth::logout();
        dd(Auth::user());
        // return view('admin.home.index');
    }
}
