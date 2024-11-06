<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabla entrenadores
        Schema::create('entrenadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('especialidad')->nullable();
            $table->string('telefono', 15);
            $table->string('correo')->unique();
            $table->date('fecha_contratacion');
            $table->boolean('estado')->default(true); // Activo/Inactivo
            $table->timestamps();
        });

        // Tabla membresias
        Schema::create('membresias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('duracion_meses');
            $table->decimal('precio', 8, 2);
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });

        // Tabla clases
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->integer('duracion_min'); // Duración en minutos
            $table->integer('max_participantes');
            $table->timestamps();
        });

        // Tabla horarios_clases
        Schema::create('horarios_clases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clase_id')->constrained('clases')->onDelete('cascade');
            $table->foreignId('entrenador_id')->constrained('entrenadores')->onDelete('cascade');
            $table->string('dia_semana', 10); // Ejemplo: Lunes
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->timestamps();
        });

        // Tabla pagos
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('membresia_id')->constrained('membresias')->onDelete('cascade');
            $table->date('fecha_pago');
            $table->decimal('monto', 8, 2);
            $table->string('metodo_pago', 50); // Ejemplo: Tarjeta, Efectivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
        Schema::dropIfExists('horarios_clases');
        Schema::dropIfExists('clases');
        Schema::dropIfExists('membresias');
        Schema::dropIfExists('entrenadores');
    }
};
