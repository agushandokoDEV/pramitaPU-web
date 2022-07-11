<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate(
            [
                'namalengkap'=>['required'],
                'username'=>['required'],
                'password'=>['required']
            ]
        );

        $cek=User::where('username',$request->username)->first();

        if($cek){
            return response()->json([
                'success'=>false,
                'message'=>'NIK sudah digunakan'
            ],200);
        }
        $user=User::create([
            'username'=>$request->username,
            'password'=>$request->password,
            'namalengkap'=>ucwords($request->namalengkap),
            'role_id'=>'edd4c20f-1545-4f31-8164-87515feedc0b',
            'status'=>1
        ]);

        return response()->json([
            'success'=>true,
            'token'=> $user->createToken('token-name')->plainTextToken,
            'data'=>$user,
            'message'=>'Pendafataran akun berhasil'
        ],200);
    }


    public function authenticate(Request $request)
    {
        $request->validate(
            [
                'username'=>['required'],
                'password'=>['required']
            ]
        );

        $login=User::with(['roles'])
        ->where('username',$request->username)
        ->where('role_id','edd4c20f-1545-4f31-8164-87515feedc0b')
        ->first();
        if(!$login || !Hash::check($request->password, $login->password))
        {
            return response()->json([
                'success'=>false,
                'message'=>'NIK atau password anda salah'
            ],200);
        }

        if($login->status != 1)
        {
            return response()->json([
                'success'=>false,
                'message'=>'Akun anda sudah tidak aktif, silahkan hubungi admin'
            ],200);
        }
        
        return response()->json([
            'success'=>true,
            'message'=>'Login berhasil',
            'token'=> $login->createToken('token-name')->plainTextToken,
            'data'=>$login
        ],200);
    }

    public function account()
    {
        return response()->json([
            'success'=>true,
            'data'=>Auth::user()
        ],200);
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'success'=>true,
            'message'=>'Anda berhasil Logout'
        ],200);
    }
}
