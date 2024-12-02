<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Membresia;

class MembresiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Membresia::insert([
            [
                'nombre' => 'Básica',
                'duracion_meses' => 1,
                'precio' => 29.99,
                'descripcion' => 'Acceso a clases básicas y gimnasio general.',
            ],
            [
                'nombre' => 'Premium',
                'duracion_meses' => 3,
                'precio' => 79.99,
                'descripcion' => 'Acceso a todas las clases y áreas premium.',
            ],
            [
                'nombre' => 'VIP',
                'duracion_meses' => 12,
                'precio' => 249.99,
                'descripcion' => 'Acceso ilimitado y beneficios exclusivos.',
            ],
        ]);
    }
}
