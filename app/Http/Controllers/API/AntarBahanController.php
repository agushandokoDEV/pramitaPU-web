<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AntarBahan;
use App\Models\Kegiatan;

class AntarBahanController extends Controller
{
    public function Add(Request $request)
    {

        $antarbahan=AntarBahan::create([
            'user_id'=>Auth::user()->id,
            'lab_id'=>$request->lab_id,
            'penerima'=>$request->penerima,
            'created_at'=>date('Y-m-d H:i:d')
        ]);

        Kegiatan::create([
            'user_id'=>Auth::user()->id,
            'antar_bahan_id'=>$antarbahan->id,
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
