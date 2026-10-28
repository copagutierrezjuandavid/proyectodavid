<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserva extends Model
{
    public const ESTADOS = [
        'pendiente' => 'Pendiente',
        'en_proceso' => 'En proceso',
        'completada' => 'Completada',
        'cancelada' => 'Cancelada',
        'no_vino' => 'No vino',
    ];

    public const ACTIVOS = ['pendiente', 'en_proceso'];

    protected $fillable = [
        'cliente_id', 'vehiculo_id', 'servicio_id', 'fecha', 'hora', 'estado',
        'precio', 'comentario', 'observacion', 'origen', 'atendido_por',
    ];

    protected function casts(): array
    {
        return ['fecha' => 'date'];
    }

    // Horarios de 08:00 a 17:30, cada 30 minutos
    public static function horarios(): array
    {
        $horas = [];
        for ($min = 8 * 60; $min <= 17 * 60 + 30; $min += 30) {
            $horas[] = sprintf('%02d:%02d', intdiv($min, 60), $min % 60);
        }
        return $horas;
    }

    public function estadoEtiqueta(): string
    {
        return self::ESTADOS[$this->estado] ?? $this->estado;
    }

    public function cliente(): BelongsTo { return $this->belongsTo(Cliente::class); }
    public function vehiculo(): BelongsTo { return $this->belongsTo(Vehiculo::class); }
    public function servicio(): BelongsTo { return $this->belongsTo(Servicio::class); }
    public function atendidoPor(): BelongsTo { return $this->belongsTo(User::class, 'atendido_por'); }
}