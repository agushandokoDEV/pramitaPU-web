<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengantaranDokter;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengantaranDokterExport;

class PengantaranDokterController extends Controller
{
    public function index(Request $request)
    {
        $user=User::where('role_id','edd4c20f-1545-4f31-8164-87515feedc0b')
            ->orderBy('namalengkap', 'ASC')
            ->get();

        $data['user']=$user;
        return view('admin.pengantarandokter.index',$data);
    }

    public function all(Request $request)
    {
        $from=$request->input('tgl-dari')?$request->input('tgl-dari'):date('Y-m-d');
        $to=$request->input('tgl-sampai')?$request->input('tgl-sampai'):date('Y-m-d');
        $user=$request->input('user_id');

        $query=PengantaranDokter::with(['user','dokter','uraianterpilih','uraianterpilih.jenis'])
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to);

        if(isset($user) && $user !=''){
            $query->where('user_id',$user);
        }

        return datatables()->eloquent($query)->toJson();
    }

    public function laporan(Request $request)
    {
        $from=$request->input('from')?$request->input('from'):date('Y-m-d');
        $to=$request->input('to')?$request->input('to'):date('Y-m-d');
        $user=$request->input('user_id');

        $filename='Laporan Bacaan Dokter - '.$from.'-'.$to.'.xlsx';
        return Excel::download(new PengantaranDokterExport($from,$to,$user),$filename);
    }
}
