<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lab;
use App\Models\Tabung;
use App\Models\AmbilBahan;
use App\Models\TabungAmbilBahan;
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
        $bodyContent = $request->getContent();

        $ambilbahan=AmbilBahan::create([
            'user_id'=>Auth::user()->id,
            'lab_id'=>$request->lab_id,
            'nama_pasien'=>$request->nama_pasien,
            'yg_menyerahkan'=>$request->yg_menyerahkan,
            'created_at'=>date('Y-m-d H:i:d')
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
            'message'=>'list tabung'
        ],200);
    }
}
