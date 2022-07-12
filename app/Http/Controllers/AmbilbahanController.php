<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AmbilBahan;
use App\Models\TabungAmbilBahan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AmbilBahanExport;

class AmbilbahanController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.ambilbahan.index');
    }

    public function all(Request $request)
    {
        $from=$request->input('tgl-dari')?$request->input('tgl-dari'):date('Y-m-d');
        $to=$request->input('tgl-sampai')?$request->input('tgl-sampai'):date('Y-m-d');

        return datatables()->eloquent(
            AmbilBahan::with(['user','lab'])
            // ->whereBetween('created_at', array($from, $to))
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
        )->toJson();
    }

    public function byid(Request $request,$id)
    {
        $data=AmbilBahan::with(['user','lab'])->where('id',$id)->first();
        return response()->json($data);
    }

    public function tabung(Request $request,$id)
    {
        $data=TabungAmbilBahan::with(['tabung'])->where('ambil_bahan_id',$id)->get();
        return response()->json($data);
    }

    public function approved(Request $request,$id)
    {
        $data=AmbilBahan::find($id);
        $data->yg_menerima=ucwords($request->approved_by);
        $data->approved_at=date('Y-m-d H:i:d');
        $data->approved_by=Auth::user()->id;
        $data->save();
        return response()->json($data);
    }

    public function laporan(Request $request)
    {
        return Excel::download(new AmbilBahanExport,'ambil_bahan.xlsx');
        // return (new AmbilBahanExport)->download('ambil_bahan.xlsx');
    }
}
