<?php

use Illuminate\Database\Seeder;
use App\DepositoProducto;

class DepositoProductoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DepositoProducto::create([
          'stock' => '100',
          'stock_reservado' => '0',
          'stock_critico' => '20',
          'ubicacion' => 'estantería 2',
          'producto_id' => '1',
          'deposito_id' => '3',
      ]);

      DepositoProducto::create([
          'stock' => '200',
          'stock_reservado' => '0',
          'stock_critico' => '50',
          'ubicacion' => 'rack principal',
          'producto_id' => '1',
          'deposito_id' => '2',
      ]);

      DepositoProducto::create([
          'stock' => '30',
          'stock_reservado' => '0',
          'stock_critico' => '5',
          'ubicacion' => 'estantería 1',
          'producto_id' => '2',
          'deposito_id' => '3',
      ]);

      DepositoProducto::create([
          'stock' => '10',
          'stock_reservado' => '0',
          'stock_critico' => '2',
          'ubicacion' => 'estantería del fondo',
          'producto_id' => '2',
          'deposito_id' => '2',
      ]);

      DepositoProducto::create([
          'stock' => '100',
          'stock_reservado' => '0',
          'stock_critico' => '10',
          'ubicacion' => 'mostrador principal',
          'producto_id' => '3',
          'deposito_id' => '3',
      ]);
    }
}
