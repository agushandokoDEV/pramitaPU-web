<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $data['roles']=Roles::all();
        return view('admin.users.index',$data);
    }

    public function all(Request $request)
    {
        // return datatables()->query(DB::table('users'))->toJson();
        return datatables()->eloquent(User::with(['roles']))->toJson();
    }

    public function createUpdate(Request $request)
    {
        $user=User::where('username',$request->username)->first();
        $username=$request->username;

        if(!$user){
            $payload=[
                // 'username'=>Str::slug($request->namalengkap, '.'),
                'username'=>$request->username,
                'email'=>$request->email,
                'password'=>'admin',
                'namalengkap'=>$request->namalengkap,
                'role_id'=>$request->role_id,
                'status'=>1
            ];
            $user=User::create($payload);
            return response()->json([
                'success'=>true,
                'data'=>$user,
                'message'=>'Pengguna baru berhasil ditambahkan'
            ],200);
            
        }else{
            return response()->json([
                'success'=>false,
                'data'=>$user,
                'message'=>'NIP '.$username.' sudah digunakan'
            ],400);
        }
        
    }
}
