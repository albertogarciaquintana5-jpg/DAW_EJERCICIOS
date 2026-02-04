<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Juan García',
            'email' => 'juan@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'María López',
            'email' => 'maria@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
