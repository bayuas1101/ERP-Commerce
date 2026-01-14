<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat akun login
        $user = User::firstOrCreate(
            ['email' => 'customer@erp.com'],
            [
                'nama_user' => 'Customer ERP',
                'password' => Hash::make('customer123'),
                'role' => 'customer',
            ]
        );

        // 2. Buat data customer (aktor bisnis)
        Customer::firstOrCreate(
            ['user_id' => $user->id_user],
            [
                'nama_customer' => 'Customer ERP',
                'alamat' => 'Surabaya',
                'telepon' => '081234567890',
            ]
        );
    }
}
