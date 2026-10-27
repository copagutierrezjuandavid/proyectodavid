<?php

namespace Database\Seeders;

use App\Models\Servicio;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $gerente = User::firstOrCreate(
            ['email' => 'mary@gmail.com'],
            ['name' => 'Mary Apaza', 'password' => 'Apaza#2026']
        );
        $gerente->update(['role' => 'gerente']); // también corrige a la Mary que ya existía

        $cajero = User::firstOrCreate(
            ['email' => 'david@gmail.com'],
            ['name' => 'David', 'password' => 'Caja#2026']
        );
        $cajero->update(['role' => 'cajero']);

        // nombre => [particular, camioneta, minibús, bus]
        $servicios = [
            'Lavado básico'   => [15, 20, 25, 35],
            'Lavado completo' => [30, 35, 40, 50],
            'Lavado de motor' => [20, 25, 30, 40],
            'Encerado'        => [25, 30, 35, 40],
        ];

        foreach ($servicios as $nombre => [$p, $c, $m, $b]) {
            $servicio = Servicio::firstOrCreate(['nombre' => $nombre], ['precio' => $p]);

            // solo rellena si aún no tiene precios por tipo de vehículo
            if ($servicio->precio_camioneta === null) {
                $servicio->update([
                    'precio_camioneta' => $c,
                    'precio_minibus' => $m,
                    'precio_bus' => $b,
                ]);
            }
        }
    }
}