<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Instansi;
use App\Models\Kegiatan;

class InstansiController extends Controller
{
    public function Add(Request $request)
    {
        $row=Instansi::create([
            'user_id'=>Auth::user()->id,
            'jenis_keg'=>$request->jenis_keg,
            'tujuan'=>$request->tujuan,
            'ket'=>$request->ket,
            'created_at'=>date('Y-m-d H:i:d')
        ]);

        Kegiatan::create([
            'user_id'=>Auth::user()->id,
            'jenis'=>'instansi',
            'instansi_id'=>$row->id
        ]);
        
        return response()->json([
            'success'=>true,
            'data'=>$row,
            'message'=>'job instansi berhasi ditambahkan'
        ],200);
    }

    public function updStatus(Request $request)
    {
        $id=$request->id;
        $row=Instansi::where('id',$id)->where('user_id',Auth::user()->id);
        if($row->first())
        {
            $row=Instansi::where('id',$id)
                ->where('user_id',Auth::user()->id)
                ->update([
                    'ket'=>$request->ket,
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
