<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    protected $fillable = ['user_id', 'nombre', 'telefono'];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function vehiculos(): HasMany { return $this->hasMany(Vehiculo::class); }
    public function reservas(): HasMany { return $this->hasMany(Reserva::class); }

    public static function categoria(int $visitas): string
    {
        return match (true) {
            $visitas >= 5 => 'Frecuente',
            $visitas >= 1 => 'Regular',
            default => 'Nuevo',
        };
    }
}