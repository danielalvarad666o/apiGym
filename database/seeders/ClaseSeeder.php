<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clase;

class ClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clase::insert([
            [
                'nombre' => 'Yoga',
                'descripcion' => 'Clase de relajación y meditación.',
                'duracion_min' => 60,
                'max_participantes' => 20,
            ],
            [
                'nombre' => 'CrossFit',
                'descripcion' => 'Entrenamiento de alta intensidad.',
                'duracion_min' => 45,
                'max_participantes' => 15,
            ],
            [
                'nombre' => 'Zumba',
                'descripcion' => 'Baile para mantenerse en forma.',
                'duracion_min' => 50,
                'max_participantes' => 25,
            ],
        ]);
    }
}
