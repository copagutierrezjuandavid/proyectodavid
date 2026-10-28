<?php

namespace App\Http\Controllers;

use App\Models\Servicio;

class PublicoController extends Controller
{
    public function inicio()
    {
        return view('publico.inicio', ['servicios' => Servicio::orderBy('nombre')->get()]);
    }

    public function servicios()
    {
        return view('publico.servicios', ['servicios' => Servicio::orderBy('nombre')->get()]);
    }

    public function contacto()
    {
        return view('publico.contacto');
    }
}