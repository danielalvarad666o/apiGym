<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'duracion_min',
        'max_participantes'
    ];

    /**
     * Relación uno a muchos con HorarioClase.
     */
    public function horariosClases()
    {
        return $this->hasMany(HorarioClase::class);
    }
}
