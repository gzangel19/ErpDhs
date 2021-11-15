<?php

use Illuminate\Database\Seeder;
use App\Deposito;

class DepositosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Deposito::create([
            'nombre' => 'Depósito Oscuro',
            'telefonos' => '4361146 / 4364239',
            'direccion' => 'Pellegrini 1531',
            'ciudad' => 'San Miguel de Tucumán',
            'codigo_postal' => '4000',
            'provincia_id' => '23',
        ]);

        Deposito::create([
            'nombre' => 'Depósito Pellegrini',
            'telefonos' => '4361146 / 4364239',
            'direccion' => 'Pellegrini 1531',
            'ciudad' => 'San Miguel de Tucumán',
            'codigo_postal' => '4000',
            'provincia_id' => '23',
        ]);


        Deposito::create([
            'nombre' => 'Depósito Salta',
            'telefonos' => '4361146 / 4364239',
            'direccion' => 'Pellegrini 1531',
            'ciudad' => 'Salta Capital',
            'codigo_postal' => '4400',
            'provincia_id' => '16',
        ]);
    }
}
