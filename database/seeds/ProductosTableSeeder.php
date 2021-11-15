<?php

use Illuminate\Database\Seeder;
use App\Producto;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Producto::create([
          'codigo' => 'cod001',
          'nombre' => 'Resma 70gr',
          'descripcion' => 'Resma de papel A4 70gr',
          'costo_p' => '120.00',
          'costo_d' => '1.00',
          'p_flete_p' => '10.00',
          'p_flete_d' => '10.00',
          'p_local_1p' => '10.00',
          'p_local_1d' => '10.00',
          'p_local_2p' => '15.00',
          'p_local_2d' => '15.00',
          'p_ml_p' => '20.00',
          'p_ec_p' => '15.00',
          'unidadnegocio_id' => '1',
      ]);

      Producto::create([
          'codigo' => 'cod002',
          'nombre' => 'Tóner',
          'descripcion' => 'Tóner para impresora Láser',
          'costo_p' => '350.00',
          'costo_d' => '3.00',
          'p_flete_p' => '10.00',
          'p_flete_d' => '10.00',
          'p_local_1p' => '10.00',
          'p_local_1d' => '10.00',
          'p_local_2p' => '15.00',
          'p_local_2d' => '15.00',
          'p_ml_p' => '20.00',
          'p_ec_p' => '15.00',
          'unidadnegocio_id' => '2',
      ]);

      Producto::create([
          'codigo' => 'cod200',
          'nombre' => 'Preservativos Tulipán',
          'descripcion' => 'Preservativos reforzados a prueba de todo',
          'costo_p' => '60.00',
          'costo_d' => '0.50',
          'p_flete_p' => '10.00',
          'p_flete_d' => '10.00',
          'p_local_1p' => '10.00',
          'p_local_1d' => '10.00',
          'p_local_2p' => '15.00',
          'p_local_2d' => '15.00',
          'p_ml_p' => '20.00',
          'p_ec_p' => '15.00',
          'unidadnegocio_id' => '3',
      ]);
    }
}
