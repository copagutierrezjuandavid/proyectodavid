<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = ['nombre', 'precio', 'precio_camioneta', 'precio_minibus', 'precio_bus'];

    // Precio según el tipo de vehículo (si no hay precio propio, usa el de particular)
    public function precioPara(string $tipo): int
    {
        $columna = match ($tipo) {
            'camioneta' => 'precio_camioneta',
            'minibus' => 'precio_minibus',
            'bus' => 'precio_bus',
            default => 'precio',
        };

        return (int) ($this->{$columna} ?? $this->precio);
    }
}