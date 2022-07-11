<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisUraianPekerjaan;

class JenisUraianPekerjaanController extends Controller
{
    public function list()
    {
        $data=JenisUraianPekerjaan::orderBy('nama')->get();

        return response()->json([
            'success'=>true,
            'data'=>$data,
            'message'=>'list lab'
        ],200);
    }
}
