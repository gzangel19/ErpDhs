<?php

use Illuminate\Database\Seeder;
use App\Rubro;

class RubrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Rubro::create([
          'nombre' => 'Imprenta',
      ]);

      Rubro::create([
          'nombre' => 'Gráfica',
      ]);

      Rubro::create([
          'nombre' => 'Correo',
      ]);

      Rubro::create([
          'nombre' => 'Librería',
      ]);

      Rubro::create([
          'nombre' => 'Polirubro',
      ]);
    }
}
