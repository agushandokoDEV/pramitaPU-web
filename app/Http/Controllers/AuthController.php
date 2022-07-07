<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        // $payload=[
        //     'username'=>'super.admin',
        //     'email'=>'',
        //     'password'=>'admin',
        //     'namalengkap'=>'Super Admin',
        //     'role_id'=>'e2a2aa35-2559-4c0d-ad79-64c94216c30e'
        // ];

        // $user=Users::create($payload);
        // dd($user);
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
            ->first();
        if(!$login || !Hash::check($request->password, $login->password) || $login->role_id == 'edd4c20f-1545-4f31-8164-87515feedc0b')
        {
            return response()->json([
                'success'=>false,
                'message'=>'Username atau password anda salah'
            ],400);
        }

        if($login->status != 1)
        {
            return response()->json([
                'success'=>false,
                'message'=>'Akun anda sudah tidak aktif, silahkan hubungi admin'
            ],400);
        }

        // if($login->role_id == 'edd4c20f-1545-4f31-8164-87515feedc0b')
        // {
        //     return response()->json([
        //         'success'=>false,
        //         'message'=>'Maaf anda bukan'
        //     ],400);
        // }

        Auth::login($login);
        
        return response()->json([
            'success'=>true,
            'message'=>'Login berhasil',
            'data'=>$login
        ],200);
    }

    public function Xauthenticate(Request $request)
    {
        $request->validate(
            [
                'username'=>['required'],
                'password'=>['required']
            ]
        );

        $authenticate=[
            'username'=>$request->username,
            'password'=>$request->password,
            'status'=>1
        ];
        if(Auth::attempt($authenticate))
        {
            return redirect('/home');
        }

        return redirect('/');
        // dd(Auth::username());
    }

    public function authLogout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
