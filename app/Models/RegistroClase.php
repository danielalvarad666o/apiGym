<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroClase extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'horario_clase_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function horarioClase()
    {
        return $this->belongsTo(HorarioClase::class);
    }
}
