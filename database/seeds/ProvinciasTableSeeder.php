<?php

use Illuminate\Database\Seeder;
use App\Provincia;

class ProvinciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Provincia::create([
          'nombre' => 'Buenos Aires',
      ]);

      Provincia::create([
          'nombre' => 'Catamarca',
      ]);

      Provincia::create([
          'nombre' => 'Chaco',
      ]);

      Provincia::create([
          'nombre' => 'Chubut',
      ]);

      Provincia::create([
          'nombre' => 'Córdoba',
      ]);

      Provincia::create([
          'nombre' => 'Corrientes',
      ]);

      Provincia::create([
          'nombre' => 'Entre Ríos',
      ]);

      Provincia::create([
          'nombre' => 'Formosa',
      ]);

      Provincia::create([
          'nombre' => 'Jujuy',
      ]);

      Provincia::create([
          'nombre' => 'La Pampa',
      ]);

      Provincia::create([
          'nombre' => 'La Rioja',
      ]);

      Provincia::create([
          'nombre' => 'Mendoza',
      ]);

      Provincia::create([
          'nombre' => 'Misiones',
      ]);

      Provincia::create([
          'nombre' => 'Neuquén',
      ]);

      Provincia::create([
          'nombre' => 'Río Negro',
      ]);

      Provincia::create([
          'nombre' => 'Salta',
      ]);

      Provincia::create([
          'nombre' => 'San Juan',
      ]);

      Provincia::create([
          'nombre' => 'San Luis',
      ]);

      Provincia::create([
          'nombre' => 'Santa Cruz',
      ]);

      Provincia::create([
          'nombre' => 'Santa Fe',
      ]);

      Provincia::create([
          'nombre' => 'Santiago del Estero',
      ]);

      Provincia::create([
          'nombre' => 'Tierra del Fuego',
      ]);

      Provincia::create([
          'nombre' => 'Tucumán',
      ]);

    }
}
