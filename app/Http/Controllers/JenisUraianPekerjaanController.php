<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisUraianPekerjaan;

class JenisUraianPekerjaanController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.jenisuraianpekerjaan.index');
    }

    public function all(Request $request)
    {
        return datatables()->eloquent(JenisUraianPekerjaan::query())->toJson();
    }

    public function findByid(Request $request,$id)
    {
        $data=JenisUraianPekerjaan::where('id',$id)->first();
        if($data){
            return response()->json([
                'success'=>true,
                'data'=>$data,
                'message'=>'Uraian Pekerjaan '.$data->nama.' berhasil ditampilkan'
            ],200);
            
        }

        return response()->json([
            'success'=>false,
            'message'=>'Data tidak tersedia'
        ],400);

    }    

    public function add(Request $request)
    {
        $request->validate(
            [
                'nama'=>['required']
            ]
        );

        $data=JenisUraianPekerjaan::where('nama',$request->nama)->first();
        $nama=$request->nama;

        if(!$data){
            $payload=[
                'nama'=>$request->nama,
                'createdAt'=>date('Y-m-d H:i:d')
            ];
            $data=JenisUraianPekerjaan::create($payload);
            return response()->json([
                'success'=>true,
                'data'=>$data,
                'message'=>'Uraian Pekerjaan baru berhasil ditambahkan'
            ],200);
            
        }

        return response()->json([
            'success'=>false,
            'message'=>'Nama '.$nama.' sudah digunakan'
        ],400);
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'id'=>['required'],
                'nama'=>['required']
            ]
        );

        $id=$request->id;
        $nama=$request->nama;
        $data=JenisUraianPekerjaan::where('id',$id)->first();

        if($data){
            $payload=[
                'nama'=>$request->nama,
            ];
            $data=JenisUraianPekerjaan::where('id',$id)->update($payload);
            return response()->json([
                'success'=>true,
                'data'=>$data,
                'message'=>'Uraian Pekerjaan '.$nama.' berhasil diubah'
            ],200);
            
        }

        return response()->json([
            'success'=>false,
            'message'=>'Data tidak tersedia'
        ],400);
    }
}
