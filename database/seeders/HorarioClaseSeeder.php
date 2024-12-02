<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HorarioClase;


class HorarioClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        HorarioClase::insert([
            [
                'clase_id' => 1,
                'entrenador_id' => 1,
                'dia_semana' => 'Lunes',
                'hora_inicio' => '08:00:00',
                'hora_fin' => '09:00:00',
            ],
            [
                'clase_id' => 2,
                'entrenador_id' => 2,
                'dia_semana' => 'Miércoles',
                'hora_inicio' => '18:00:00',
                'hora_fin' => '19:00:00',
            ],
            [
                'clase_id' => 3,
                'entrenador_id' => 3,
                'dia_semana' => 'Viernes',
                'hora_inicio' => '10:00:00',
                'hora_fin' => '11:00:00',
            ],
        ]);
    }
}
