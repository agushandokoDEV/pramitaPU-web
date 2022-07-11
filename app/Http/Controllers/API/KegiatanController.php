<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kegiatan;
use App\Models\TabungAmbilBahan;

class KegiatanController extends Controller
{
    public function bydate(Request $request)
    {
        $from=$request->input('tgl-dari')?$request->input('tgl-dari'):date('Y-m-d');
        $to=$request->input('tgl-sampai')?$request->input('tgl-sampai'):date('Y-m-d');
        
        $data=Kegiatan::with(['ambilbahan','antarbahan','instansi','pengantarandokter','lab','lainnya'])
            ->whereDate('created_at',$from)
            ->where('user_id',Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return response()->json([
            'success'=>true,
            'data'=>$data,
            'message'=>'list kegiatan'
        ],200);
    }


    public function riwayat(Request $request)
    {
        $from=$request->input('tgl-dari');
        $to=$request->input('tgl-sampai');
        if($from || $to){
            $data=Kegiatan::with(['ambilbahan','antarbahan','instansi','pengantarandokter','lab','lainnya'])
                ->whereDate('created_at',$from)
                ->whereDate('created_at',$to)
                ->where('user_id',Auth::user()->id)
                ->orderBy('created_at', 'DESC')
                ->get();
        }else{
            $data=Kegiatan::with(['ambilbahan','antarbahan','instansi','pengantarandokter','lab','lainnya'])
                ->where('user_id',Auth::user()->id)
                ->orderBy('created_at', 'DESC')
                ->get();
        }
        

        return response()->json([
            'success'=>true,
            'data'=>$data,
            'message'=>'list kegiatan'
        ],200);
    }

    public function byid(Request $request,$id)
    {
        $data=[];

        $kegiatan=Kegiatan::with(['ambilbahan','lab','instansi','pengantarandokter','antarbahan','lainnya','pengantarandokter.uraianterpilih','pengantarandokter.uraianterpilih.jenis'])
            ->where('id',$id)
            ->first();
        if($kegiatan){
            $data['kegiatan']=$kegiatan;
            $listtabung=TabungAmbilBahan::with(['tabung'])
                ->where('ambil_bahan_id',$kegiatan->ambil_bahan_id)
                ->get();
            $data['listtabung']=$listtabung;
        }

        return response()->json([
            'success'=>true,
            'data'=>$data,
            'message'=>'kegiatan by ID '.$id
        ],200);
    }
}
