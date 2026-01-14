<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        User::firstOrCreate(
            ['email' => 'supplier@erp.com'],
            [
                'nama_user' => 'Supplier ERP',
                'password' => Hash::make('supplier123'),
                'role' => 'supplier',
            ]
        );

    }
}
