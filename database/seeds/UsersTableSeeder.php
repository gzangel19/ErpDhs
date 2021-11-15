<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nombre' => 'Roberto Huallí',
            'apellido' => 'Torfe',
            'username' => 'rtorfe',
            'password' => Hash::make('1234'),
            'email' => 'roberto@torfe.com',
            'tipo' => 'usuario',

        ]);

        User::create([
            'nombre' => 'Angel',
            'apellido' => 'Gauna',
            'username' => 'agauna',
            'password' => Hash::make('1234'),
            'email' => 'angel@gauna.com',
            'tipo' => 'usuario',

        ]);

    }
}
