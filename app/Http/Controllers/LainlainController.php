<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobLainnya;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LainlainExport;

class LainlainController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.lainlain.index');
    }

    public function all(Request $request)
    {
        $from=$request->input('tgl-dari')?$request->input('tgl-dari'):date('Y-m-d');
        $to=$request->input('tgl-sampai')?$request->input('tgl-sampai'):date('Y-m-d');

        return datatables()->eloquent(
            JobLainnya::with(['user'])
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
        )->toJson();
    }

    public function laporan(Request $request)
    {
        $from=$request->input('from')?$request->input('from'):date('Y-m-d');
        $to=$request->input('to')?$request->input('to'):date('Y-m-d');
        $filename='Laporan Lainnya - '.$from.'-'.$to.'.xlsx';
        return Excel::download(new LainlainExport($from,$to),$filename);
    }
}
