<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lab;

class LabController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.lab.index');
    }

    public function all(Request $request)
    {
        return datatables()->eloquent(Lab::query())->toJson();
    }

    public function findByid(Request $request,$id)
    {
        $data=Lab::where('id',$id)->first();
        if($data){
            return response()->json([
                'success'=>true,
                'data'=>$data,
                'message'=>'Lab '.$data->nama.' berhasil ditampilkan'
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

        $data=Lab::where('nama',$request->nama)->first();
        $nama=$request->nama;

        if(!$data){
            $payload=[
                'nama'=>$request->nama,
                'createdAt'=>date('Y-m-d H:i:d')
            ];
            $data=Lab::create($payload);
            return response()->json([
                'success'=>true,
                'data'=>$data,
                'message'=>'Lab baru berhasil ditambahkan'
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
        $data=Lab::where('id',$id)->first();

        if($data){
            $payload=[
                'nama'=>$request->nama,
            ];
            $data=Lab::where('id',$id)->update($payload);
            return response()->json([
                'success'=>true,
                'data'=>$data,
                'message'=>'Lab '.$nama.' berhasil diubah'
            ],200);
            
        }

        return response()->json([
            'success'=>false,
            'message'=>'Data tidak tersedia'
        ],400);
    }
}
