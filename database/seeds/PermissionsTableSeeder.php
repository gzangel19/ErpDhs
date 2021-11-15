<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Illuminate\Support\Facades\Hash;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegrationAssertPostConditions;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $permissions_admin = [];
      array_push($permissions_admin, Permission::create(['name' => 'ventas_list']));
      array_push($permissions_admin, Permission::create(['name' => 'compras_list']));
      array_push($permissions_admin, Permission::create(['name' => 'inventario_list']));
      array_push($permissions_admin, Permission::create(['name' => 'tareas_list']));
      array_push($permissions_admin, Permission::create(['name' => 'ajustes_list']));
      array_push($permissions_admin, Permission::create(['name' => 'ayuda_index']));

      $role_admin = Role::create(['name' => 'administrador']);
      $role_admin->syncPermissions($permissions_admin);


      $userrtorfe = User::create([
          'nombre' => 'Roberto Huallí',
          'apellido' => 'Torfe',
          'username' => 'rtorfe',
          'password' => Hash::make('1234'),
          'email' => 'roberto@torfe.com',

      ]);

      $useragauna = User::create([
          'nombre' => 'Angel',
          'apellido' => 'Gauna',
          'username' => 'agauna',
          'password' => Hash::make('1234'),
          'email' => 'angel@gauna.com',

      ]);

      $userrtorfe->assignRole('administrador');
      $useragauna->assignRole('administrador');



      $permisos_tecnico = Permission::where('name', 'LIKE', 'tareas_list')
                                    ->orWhere('name', 'LIKE', 'ayuda_index');

      $role_tecnico = Role::create(['name' => 'tecnico']);
      $role_tecnico->syncPermissions($permisos_tecnico);


    }
}
