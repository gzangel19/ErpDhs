<?php

use Illuminate\Database\Seeder;
use App\Unidad_Negocio;

class UnidadesNegocioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Unidad_Negocio::create([
          'nombre' => 'DHS Tecnología y Servicios',
          'provincia_id' => '23',
      ]);

      Unidad_Negocio::create([
          'nombre' => 'PuntoDoc Gestión Documental',
          'provincia_id' => '23',
      ]);

      Unidad_Negocio::create([
          'nombre' => 'Sweet Sexshop',
          'provincia_id' => '23',
      ]);
    }
}
