<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tabung;

class TabungController extends Controller
{
    public function list()
    {
        $data=Tabung::orderBy('nama')->get();

        return response()->json([
            'success'=>true,
            'data'=>$data,
            'message'=>'list tabung'
        ],200);
    }
}
