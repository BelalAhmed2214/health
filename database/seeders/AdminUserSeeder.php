<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin — sees everything, manages users
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@test.com',
            'password' => Hash::make('12345678'),
            'is_admin' => true,
            'section'  => null,
        ]);

        // Section user — Agamy
        User::create([
            'name'     => 'Agamy',
            'email'    => 'agamy@test.com',
            'password' => Hash::make('12345678'),
            'is_admin' => false,
            'section'  => 'agamy',
        ]);

        // Section user — Dekhila
        User::create([
            'name'     => 'Dekhila',
            'email'    => 'dekhila@test.com',
            'password' => Hash::make('12345678'),
            'is_admin' => false,
            'section'  => 'dekhila',
        ]);
    }
}
