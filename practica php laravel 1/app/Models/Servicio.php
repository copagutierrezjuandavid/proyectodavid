<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    // Columnas que se pueden llenar desde un formulario
    protected $fillable = ['nombre', 'precio'];
}

