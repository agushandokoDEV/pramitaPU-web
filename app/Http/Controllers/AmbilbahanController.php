<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AmbilBahan;
use App\Models\User;
use App\Models\TabungAmbilBahan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AmbilBahanExport;

class AmbilbahanController extends Controller
{
    public function index(Request $request)
    {
        $user=User::where('role_id','edd4c20f-1545-4f31-8164-87515feedc0b')
            ->orderBy('namalengkap', 'ASC')
            ->get();

        $data['user']=$user;
        return view('admin.ambilbahan.index',$data);
    }

    public function all(Request $request)
    {
        $from=$request->input('tgl-dari')?$request->input('tgl-dari'):date('Y-m-d');
        $to=$request->input('tgl-sampai')?$request->input('tgl-sampai'):date('Y-m-d');
        $user=$request->input('user_id');

        $query=AmbilBahan::with(['user','lab'])
            // ->whereBetween('created_at', array($from, $to))
            // ->where('user_id',)
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to);
        if(isset($user) && $user !=''){
            $query->where('user_id',$user);
        }

        return datatables()->eloquent($query)->toJson();
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
        $from=$request->input('from')?$request->input('from'):date('Y-m-d');
        $to=$request->input('to')?$request->input('to'):date('Y-m-d');
        $user=$request->input('user_id');
        $filename='Laporan Ambil Bahan Kunjungan - '.$from.'-'.$to.'.xlsx';
        return Excel::download(new AmbilBahanExport($from,$to,$user),$filename);
        // return (new AmbilBahanExport($from,$to))->download('ambil_bahan.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    // public function laporan(Request $request,AmbilBahanExport $sheet)
    // {
    //     return Excel::download(new AmbilBahanExport,'ambil_bahan.xlsx');
    //     // return (new AmbilBahanExport)->download('ambil_bahan.xlsx');
    // }
}
