<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inserta diferentes estados en la tabla 'statuses'
        DB::table('statuses')->insert([
            ['type' => 'Activo', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Inactivo', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Suspendido', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Pendiente de Pago', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Expirado', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

