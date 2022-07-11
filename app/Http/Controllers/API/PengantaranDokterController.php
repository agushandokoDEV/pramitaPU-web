<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PengantaranDokter;
use App\Models\Kegiatan;
use App\Models\JenisUraianPekerjaanTerpilih;

class PengantaranDokterController extends Controller
{
    public function Add(Request $request)
    {
        $row=PengantaranDokter::create([
            'user_id'=>Auth::user()->id,
            'ket'=>$request->ket,
            'tujuan'=>$request->tujuan,
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
}
