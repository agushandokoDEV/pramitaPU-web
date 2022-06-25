<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lab;

class LabController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.lab.index');
    }

    public function all(Request $request)
    {
        // return datatables()->query(DB::table('users'))->toJson();
        return datatables()->eloquent(Lab::query())->toJson();
    }
}
