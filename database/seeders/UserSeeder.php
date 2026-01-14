<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run():void  
    {    
        User::firstOrCreate(
            ['email' => 'user@erp.com'],
            [
                'nama_user' => 'User ERP',
                'password' => Hash::make('user123'),
                'role' => 'customer',
            ]
        );
    }
}