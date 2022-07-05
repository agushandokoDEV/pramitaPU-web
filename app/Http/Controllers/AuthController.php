<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

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
