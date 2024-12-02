<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrenador extends Model
{
    use HasFactory;
    protected $table = 'entrenadores';
    protected $fillable = [
        'nombre',
        'apellido',
        'especialidad',
        'telefono',
        'correo',
        'fecha_contratacion',
        'estado'
    ];

    /**
     * Relación uno a muchos con HorarioClase.
     */
    public function horariosClases()
    {
        return $this->hasMany(HorarioClase::class);
    }
}
