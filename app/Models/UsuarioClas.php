<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioClas extends Model
{
    use HasFactory;

    // Tabla asociada
    protected $table = 'usuario_clas';

    // Atributos que pueden ser asignados masivamente
    protected $fillable = [
        'user_id',
        'horario_clase_id',
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con el modelo HorarioClase
    public function horarioClase()
    {
        return $this->belongsTo(HorarioClase::class, 'horario_clase_id');
    }
}
