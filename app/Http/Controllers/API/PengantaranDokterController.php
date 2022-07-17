<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PengantaranDokter;
use App\Models\Kegiatan;
use App\Models\JenisUraianPekerjaanTerpilih;
use App\Models\Dokter;

class PengantaranDokterController extends Controller
{

    public function list()
    {
        $data=Dokter::orderBy('nama')->get();

        return response()->json([
            'success'=>true,
            'data'=>$data,
            'message'=>'list dokter'
        ],200);
    }

    public function Add(Request $request)
    {
        $row=PengantaranDokter::create([
            'user_id'=>Auth::user()->id,
            'ket'=>$request->ket,
            'dokter_id'=>$request->tujuan,
            'created_at'=>date('Y-m-d H:i:d')
        ]);

        Kegiatan::create([
            'user_id'=>Auth::user()->id,
            'jenis'=>'pengantaran_dokter',
            'pengantaran_dokter_id'=>$row->id
        ]);

        $listuraianpekerjaan=[];
        if(is_array($request->jenisuraianpekerjaan) && count($request->jenisuraianpekerjaan) > 0)
        {
            foreach ($request->jenisuraianpekerjaan as $item) {
                $listuraianpekerjaan[]=array(
                    'pengantaran_dokter_id'=>$row->id,
                    'jenis_uraian_pekerjaan_id'=>$item
                );
            }

            $jenisuraianpekerjaan=JenisUraianPekerjaanTerpilih::insert($listuraianpekerjaan);
            $data['row']=$row;
            $data['jenisuraianpekerjaan']=$jenisuraianpekerjaan;
            
            return response()->json([
                'success'=>true,
                'data'=>$data,
                'message'=>'Data berhasil ditambahkan'
            ],200);

        }
        else
        {
            return response()->json([
                'success'=>false,
                'message'=>'Tidak ada uraian pekerjaan yang dipilih'
            ],400);
        }
    }

    public function updStatus(Request $request)
    {
        $id=$request->id;
        $row=PengantaranDokter::where('id',$id)->where('user_id',Auth::user()->id);
        if($row->first())
        {
            $row=PengantaranDokter::where('id',$id)
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
