<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class PersonalSeeder extends Seeder
{
    public function run(): void
    {
        $personal = [
            [
                'name' => 'Mary Apaza',
                'email' => 'mary@gmail.com',
                'role' => 'gerente',
                'password' => 'apaza2026',
            ],
            [
                'name' => 'Juan David Copa',
                'email' => 'juandavid@gmail.com',
                'role' => 'cajero',
                'password' => 'juan2026',
            ],
        ];

        foreach ($personal as $p) {
            // Si ya existe lo corrige (rol y contraseña); si no, lo crea.
            User::updateOrCreate(['email' => $p['email']], $p);
        }
    }
}