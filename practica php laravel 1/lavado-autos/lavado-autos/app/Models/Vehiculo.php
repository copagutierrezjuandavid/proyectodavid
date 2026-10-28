<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\Rule;

class Vehiculo extends Model
{
    public const TIPOS = [
        'particular' => 'Auto particular',
        'camioneta' => 'Camioneta',
        'minibus' => 'Minibús (semi flota)',
        'bus' => 'Bus (flota)',
    ];

    protected $fillable = ['cliente_id', 'placa', 'tipo', 'marca'];

    public function cliente(): BelongsTo { return $this->belongsTo(Cliente::class); }
    public function reservas(): HasMany { return $this->hasMany(Reserva::class); }

    public function tipoEtiqueta(): string
    {
        return self::TIPOS[$this->tipo] ?? $this->tipo;
    }

    // "1234-abc" -> "1234ABC"
    public static function normalizarPlaca(?string $placa): string
    {
        return strtoupper(preg_replace('/[^A-Za-z0-9]/', '', (string) $placa));
    }

    public static function reglas(): array
    {
        return [
            'placa' => ['required', 'regex:/^[A-Z0-9]{5,8}$/', 'unique:vehiculos,placa'],
            'tipo' => ['required', Rule::in(array_keys(self::TIPOS))],
            'marca' => ['nullable', 'string', 'max:60'],
        ];
    }
}