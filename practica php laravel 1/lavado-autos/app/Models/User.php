<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'telefono'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cliente(): HasOne
    {
        return $this->hasOne(Cliente::class);
    }

    public function esGerente(): bool { return $this->role === 'gerente'; }
    public function esCajero(): bool { return $this->role === 'cajero'; }
    public function esCliente(): bool { return $this->role === 'cliente'; }

    public function rolEtiqueta(): string
    {
        return match ($this->role) {
            'gerente' => 'Gerente',
            'cajero' => 'Cajero',
            default => 'Cliente',
        };
    }

    // Ficha de cliente de este usuario (la crea si no existe)
    public function perfilCliente(): Cliente
    {
        return $this->cliente ?: Cliente::create([
            'user_id' => $this->id,
            'nombre' => $this->name,
            'telefono' => $this->telefono,
        ]);
    }
}