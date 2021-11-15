<?php

use Illuminate\Database\Seeder;
use App\Tipo_Tarea;

class TiposTareasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo_Tarea::create([
            'nombre' => 'Servicio Técnico',
        ]);

        Tipo_Tarea::create([
            'nombre' => 'Reparto',
        ]);

        Tipo_Tarea::create([
            'nombre' => 'Cobranza',
        ]);
    }
}
