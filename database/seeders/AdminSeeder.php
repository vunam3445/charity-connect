<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'id' => Str::uuid(),
            'username' => 'admin1',
            'password' => Hash::make('123456'), // mã hóa mật khẩu
            'email' => 'admin1@example.com',
            'role' => 'admin',
        ]);
    }
}