<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lab;

class LabController extends Controller
{
    public function list()
    {
        $data=Lab::orderBy('nama')->get();

        return response()->json([
            'success'=>true,
            'data'=>$data,
            'message'=>'list lab'
        ],200);
    }
}
