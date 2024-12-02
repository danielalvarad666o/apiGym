<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
      /**
     * Tabla asociada al modelo.
     */
    protected $table = 'membresias';

    /**
     * Campos que pueden ser asignados de manera masiva.
     */
    protected $fillable = [
        'nombre',
        'duracion_meses',
        'precio',
        'descripcion',
    ];

    /**
     * Relación con otros modelos (si aplica).
     */
    // Ejemplo: si cada membresía pertenece a un usuario
    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
}
