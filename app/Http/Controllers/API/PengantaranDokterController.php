<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PengantaranDokter;
use App\Models\Kegiatan;

class PengantaranDokterController extends Controller
{
    public function Add(Request $request)
    {
        $row=PengantaranDokter::create([
            'user_id'=>Auth::user()->id,
            'jenis_keg'=>$request->jenis_keg,
            'tujuan'=>$request->tujuan,
            'ket'=>$request->ket,
            'created_at'=>date('Y-m-d H:i:d')
        ]);

        Kegiatan::create([
            'user_id'=>Auth::user()->id,
            'jenis'=>'pengantaran_dokter',
            'pengantaran_dokter_id'=>$row->id
        ]);
        
        return response()->json([
            'success'=>true,
            'data'=>$row,
            'message'=>'pengantaran dokter berhasi ditambahkan'
        ],200);
    }
}
