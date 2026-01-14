<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
         User::firstOrCreate(
            ['email' => 'admin@erp.com'],
            [
                'name' => 'Admin ERP',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
    }
}
