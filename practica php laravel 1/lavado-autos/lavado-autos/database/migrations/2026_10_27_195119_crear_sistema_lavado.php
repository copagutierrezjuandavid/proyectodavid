<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('cliente');
            $table->string('telefono', 20)->nullable();
        });

        // 'servicios' YA existe: solo agregamos las columnas nuevas
        Schema::table('servicios', function (Blueprint $table) {
            $table->unsignedInteger('precio_camioneta')->nullable();
            $table->unsignedInteger('precio_minibus')->nullable();
            $table->unsignedInteger('precio_bus')->nullable();
        });

        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->unique()->constrained('users')->nullOnDelete();
            $table->string('nombre');
            $table->string('telefono', 20)->nullable();
            $table->timestamps();
        });

        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete();
            $table->string('placa', 10)->unique();
            $table->string('tipo', 20)->default('particular');
            $table->string('marca', 60)->nullable();
            $table->timestamps();
        });

        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete();
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->cascadeOnDelete();
            $table->foreignId('servicio_id')->constrained('servicios')->restrictOnDelete();
            $table->date('fecha');
            $table->string('hora', 5);
            $table->string('estado', 20)->default('pendiente');
            $table->unsignedInteger('precio')->default(0);
            $table->text('comentario')->nullable();
            $table->text('observacion')->nullable();
            $table->string('origen', 10)->default('web');
            $table->foreignId('atendido_por')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->index(['fecha', 'hora']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservas');
        Schema::dropIfExists('vehiculos');
        Schema::dropIfExists('clientes');
        Schema::table('servicios', fn (Blueprint $t) => $t->dropColumn(['precio_camioneta', 'precio_minibus', 'precio_bus']));
        Schema::table('users', fn (Blueprint $t) => $t->dropColumn(['role', 'telefono']));
    }
};