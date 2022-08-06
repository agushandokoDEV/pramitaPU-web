<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\User;

class DemoController extends Controller
{
    public function roles(Request $request)
    {
        $per_page=$request->per_page;
        $page=$request->page;
        $data=Roles::orderBy('name')->paginate($per_page);

        return response()->json([
            'success'=>true,
            'data'=>$data,
            'message'=>'list roles user'
        ],200);
    }

    public function users(Request $request)
    {
        $per_page=$request->per_page;
        $page=$request->page;
        $data=User::with(['roles'])->orderBy('namalengkap')->paginate($per_page);

        return response()->json([
            'success'=>true,
            'data'=>$data,
            'message'=>'list user'
        ],200);
    }
}
