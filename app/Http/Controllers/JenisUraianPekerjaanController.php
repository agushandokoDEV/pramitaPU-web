<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisUraianPekerjaan;

class JenisUraianPekerjaanController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.jenisuraianpekerjaan.index');
    }

    public function all(Request $request)
    {
        return datatables()->eloquent(JenisUraianPekerjaan::query())->toJson();
    }
}
