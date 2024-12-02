<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Entrenador;

class EntrenadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Entrenador::insert([
            [
                'nombre' => 'Carlos',
                'apellido' => 'Gómez',
                'especialidad' => 'Yoga',
                'telefono' => '1234567890',
                'correo' => 'carlos@yoga.com',
                'fecha_contratacion' => '2023-01-15',
                'estado' => 1,
            ],
            [
                'nombre' => 'Laura',
                'apellido' => 'Martínez',
                'especialidad' => 'CrossFit',
                'telefono' => '0987654321',
                'correo' => 'laura@crossfit.com',
                'fecha_contratacion' => '2023-02-10',
                'estado' => 1,
            ],
            [
                'nombre' => 'Ana',
                'apellido' => 'Pérez',
                'especialidad' => 'Zumba',
                'telefono' => '5678901234',
                'correo' => 'ana@zumba.com',
                'fecha_contratacion' => '2023-03-05',
                'estado' => 1,
            ],
        ]);
    }
}
