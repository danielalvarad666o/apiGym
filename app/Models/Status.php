<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Status extends Model
{
    //
    use HasFactory;

    /**
     * Tabla asociada al modelo.
     */
    protected $table = 'statuses';

    /**
     * Atributos que son asignables masivamente.
     */
    protected $fillable = ['type'];

    /**
     * Relación con los usuarios.
     * Un estado puede tener múltiples usuarios.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
