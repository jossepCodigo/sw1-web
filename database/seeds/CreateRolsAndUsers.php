<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRolsAndUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleValet = Role::create(['name' => 'Valet Parking']);
        $roleClient = Role::create(['name' => 'Client']);
        $permissionsAdmin = Permission::create([
            'name' => '*'
        ]);
        $roleAdmin->hasPermissionTo($permissionsAdmin);

        $permissionValet1 = Permission::create(['name' => 'Ver Usuarios']);
        $permissionValet2 = Permission::create(['name' => 'Editar Usuarios']);
        $permissionValet3 = Permission::create(['name' => 'Eliminar Usuarios']);
        $roleValet->hasPermissionTo($permissionValet1);
        $roleValet->hasPermissionTo($permissionValet2);
        $roleValet->hasPermissionTo($permissionValet3);

        factory(App\User::class, 3)->create()->each(function ($user) {
            $user->assignRole('Admin');
        });
        factory(App\User::class, 10)->create()->each(function ($user) {
            $user->assignRole('Valet Parking');
        });
        factory(App\User::class, 20)->create()->each(function ($user) {
            $user->assignRole('Client');
        });
    }
}
