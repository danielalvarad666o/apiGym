<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioClase extends Model
{
    use HasFactory;

    protected $fillable = [
        'clase_id',
        'entrenador_id',
        'dia_semana',
        'hora_inicio',
        'hora_fin'
    ];

    /**
     * Relación con Clase.
     */
    public function clase()
    {
        return $this->belongsTo(Clase::class);
    }

    /**
     * Relación con Entrenador.
     */
    public function entrenador()
    {
        return $this->belongsTo(Entrenador::class);
    }
}
