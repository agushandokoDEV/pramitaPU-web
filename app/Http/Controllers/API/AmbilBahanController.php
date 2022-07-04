<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lab;
use App\Models\Tabung;
use App\Models\AmbilBahan;
use App\Models\TabungAmbilBahan;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;

class AmbilBahanController extends Controller
{
    public function lab()
    {
        $data=Lab::orderBy('nama')->get();

        return response()->json([
            'success'=>true,
            'data'=>$data,
            'message'=>'list lab'
        ],200);
    }

    public function tabung()
    {
        $data=Tabung::orderBy('nama')->get();

        return response()->json([
            'success'=>true,
            'data'=>$data,
            'message'=>'list tabung'
        ],200);
    }

    public function setAmbilbahan(Request $request)
    {

        $ambilbahan=AmbilBahan::create([
            'user_id'=>Auth::user()->id,
            'lab_id'=>$request->lab_id,
            'nama_pasien'=>$request->nama_pasien,
            'yg_menyerahkan'=>$request->yg_menyerahkan,
            'created_at'=>date('Y-m-d H:i:d')
        ]);

        Kegiatan::create([
            'user_id'=>Auth::user()->id,
            'ambil_bahan_id'=>$ambilbahan->id,
            'lab_id'=>$request->lab_id,
            'jenis'=>'ambil_bahan'
        ]);

        $listtabung=[];

        $payload['tabung']=$request->tabung;
        if(count($request->tabung) > 0)
        {
            foreach ($request->tabung as $key => $item) {
                $listtabung[]=array(
                    'ambil_bahan_id'=>$ambilbahan->id,
                    'tabung_id'=>$key,
                    'jumlah'=>$item
                );
            }
        }

        $tabung=TabungAmbilBahan::insert($listtabung);
        $data['bahan']=$ambilbahan;
        $data['tabung']=$listtabung;
        
        return response()->json([
            'success'=>true,
            'data'=>$data,
            'message'=>'ambil bahan / kunjungan berhasi ditambahkan'
        ],200);
    }

    public function setAntarbahan(Request $request)
    {

        $antarbahan=AmbilBahan::create([
            'user_id'=>Auth::user()->id,
            'lab_id'=>$request->lab_id,
            'yg_menerima'=>$request->yg_menerima,
            'created_at'=>date('Y-m-d H:i:d')
        ]);

        Kegiatan::create([
            'user_id'=>Auth::user()->id,
            'ambil_bahan_id'=>$antarbahan->id,
            'lab_id'=>$request->lab_id,
            'jenis'=>'antar_bahan'
        ]);
        
        return response()->json([
            'success'=>true,
            'data'=>$antarbahan,
            'message'=>'antar bahan / rujukan berhasi ditambahkan'
        ],200);
    }
}
