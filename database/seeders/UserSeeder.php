<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'username'=>'super.admin',
            'email'=>null,
            'password'=>'admin',
            'namalengkap'=>'Super Admin',
            'role_id'=>null,
            'status'=>1
        ]);

        $admin->assignRole('Super Admin');
    }
}
