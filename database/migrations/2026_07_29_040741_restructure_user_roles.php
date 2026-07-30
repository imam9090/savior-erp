<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY role VARCHAR(30) NOT NULL DEFAULT 'client'");

        DB::table('users')->where('role', 'superadmin')->update(['role' => 'superadmin']);
        DB::table('users')->where('role', 'admin')->update(['role' => 'admin_client']);
        DB::table('users')->where('role', 'staff')->update(['role' => 'admin_finance']);
        DB::table('users')->where('role', 'customer')->update(['role' => 'client']);
    }

    public function down(): void
    {
        DB::table('users')->where('role', 'superadmin')->update(['role' => 'superadmin']);
        DB::table('users')->where('role', 'admin_client')->update(['role' => 'admin']);
        DB::table('users')->where('role', 'admin_finance')->update(['role' => 'staff']);
        DB::table('users')->where('role', 'client')->update(['role' => 'customer']);

        DB::statement("ALTER TABLE users MODIFY role ENUM('admin','staff','customer','superadmin') NOT NULL DEFAULT 'staff'");
    }
};