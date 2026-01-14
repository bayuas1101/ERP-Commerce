<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

//Seeder untuk membuat admin default
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'nama_user' => 'Doni',
            'email'     => 'admin@erp.com',
            'password'  => Hash::make('admin123'),
            'role'      => 'admin',
        ]);

        Admin::create([
            'user_id' => $user->id_user,
            'username' => 'admin',
            'nama_lengkap' => 'Administrator ERP',
        ]);
    }
}
