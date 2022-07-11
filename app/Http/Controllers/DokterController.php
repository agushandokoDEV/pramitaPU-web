<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;

class DokterController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.dokter.index');
    }

    public function all(Request $request)
    {
        return datatables()->eloquent(Dokter::query())->toJson();
    }
}
