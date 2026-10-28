<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $cliente = Cliente::firstOrCreate(['nombre' => 'Carlos Mamani'], ['telefono' => '71234567']);

        if ($cliente->reservas()->exists()) {
            return;
        }

        $auto = $cliente->vehiculos()->firstOrCreate(['placa' => '1234ABC'], ['tipo' => 'particular', 'marca' => 'Toyota Corolla']);
        $mini = $cliente->vehiculos()->firstOrCreate(['placa' => '5678XYZ'], ['tipo' => 'minibus', 'marca' => 'Toyota Coaster']);

        $basico = Servicio::where('nombre', 'Lavado básico')->firstOrFail();
        $completo = Servicio::where('nombre', 'Lavado completo')->firstOrFail();
        $cajero = User::where('email', 'david@gmail.com')->first();

        for ($i = 1; $i <= 6; $i++) {
            Reserva::create([
                'cliente_id' => $cliente->id,
                'vehiculo_id' => $auto->id,
                'servicio_id' => $basico->id,
                'fecha' => now()->subDays($i * 7)->toDateString(),
                'hora' => '09:00',
                'estado' => 'completada',
                'precio' => $basico->precioPara('particular'),
                'origen' => 'local',
                'atendido_por' => $cajero?->id,
            ]);
        }

        Reserva::create([
            'cliente_id' => $cliente->id,
            'vehiculo_id' => $mini->id,
            'servicio_id' => $completo->id,
            'fecha' => today()->toDateString(),
            'hora' => '17:00',
            'estado' => 'pendiente',
            'precio' => $completo->precioPara('minibus'),
            'origen' => 'web',
        ]);
    }
}