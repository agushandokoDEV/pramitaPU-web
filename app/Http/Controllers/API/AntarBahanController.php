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

    public function updStatus(Request $request)
    {
        $id=$request->id;
        $row=AntarBahan::where('id',$id)->where('user_id',Auth::user()->id);
        if($row->first())
        {
            $row=AntarBahan::where('id',$id)
                ->where('user_id',Auth::user()->id)
                ->update([
                    'penerima'=>$request->penerima,
                    'updated_at'=>date('Y-m-d H:i:d')
                ]);

            return response()->json([
                'success'=>true,
                'data'=>$row,
                'message'=>'Status berhasil diubah'
            ],200);
        }

        return response()->json([
            'success'=>false,
            'message'=>'Data tidak tersedia'
        ],400);
    }
}
