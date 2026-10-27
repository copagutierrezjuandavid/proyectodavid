<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'mary apaza',
            'email'    => 'mary@gmail.com',
            'password' => Hash::make('apaza2026'),
        ]);
    }
}