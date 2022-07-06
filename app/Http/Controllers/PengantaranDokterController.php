<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengantaranDokter;

class PengantaranDokterController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.pengantarandokter.index');
    }

    public function all(Request $request)
    {
        $from=$request->input('tgl-dari')?$request->input('tgl-dari'):date('Y-m-d');
        $to=$request->input('tgl-sampai')?$request->input('tgl-sampai'):date('Y-m-d');

        return datatables()->eloquent(
            PengantaranDokter::with(['user'])
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
        )->toJson();
    }
}
