<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tabung;

class TabungController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.tabung.index');
    }

    public function all(Request $request)
    {
        // return datatables()->query(DB::table('users'))->toJson();
        return datatables()->eloquent(Tabung::query())->toJson();
    }
}
