<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.roles.index');
    }

    public function all(Request $request)
    {
        return datatables()->query(DB::table('roles'))->toJson();
    }
}
