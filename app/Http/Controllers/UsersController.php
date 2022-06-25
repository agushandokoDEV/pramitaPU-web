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
        $payload=[
            'username'=>Str::slug($request->namalengkap, '.'),
            'email'=>$request->email,
            'password'=>'admin',
            'namalengkap'=>$request->namalengkap,
            'role_id'=>$request->role_id,
            'status'=>1
        ];
        $user=User::create($payload);
        return $user;
    }
}
