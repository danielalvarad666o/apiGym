<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'membresia_id',
        'fecha_pago',
        'monto',
        'metodo_pago'
    ];

    /**
     * Relación con Usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con Membresia.
     */
    public function membresia()
    {
        return $this->belongsTo(Membresia::class);
    }
}
