<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            ['name' => 'Superadmin Savior', 'email' => 'superadmin@savior.test', 'role' => 'superadmin'],
            ['name' => 'Admin Client Savior', 'email' => 'adminclient@savior.test', 'role' => 'admin_client'],
            ['name' => 'Admin Finance Savior', 'email' => 'adminfinance@savior.test', 'role' => 'admin_finance'],
            ['name' => 'Client Savior', 'email' => 'client@savior.test', 'role' => 'client'],
        ];

        foreach ($accounts as $account) {
            User::updateOrCreate(
                ['email' => $account['email']],
                [
                    'name' => $account['name'],
                    'password' => Hash::make('password'),
                    'role' => $account['role'],
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}