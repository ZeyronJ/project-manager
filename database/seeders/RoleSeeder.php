<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleadmin = Role::create(['name' => 'admin']);
        $rolereader = Role::create(['name' => 'lector']);
        $roleinspect = Role::create(['name' => 'inspector de obra']);

        Permission::create([  'name' =>           'admin.roles_permissions',
                              'description' =>    'Permiso para acceder a roles'])->syncRoles([$roleadmin]);

        Permission::create([  'name' =>           'edit.projects',
                              'description' =>    'Editar Proyectos'])->syncRoles([$roleadmin,$roleinspect]);
        Permission::create([  'name' =>           'view.projects',
                              'description' =>    'Ver Proyectos'])->syncRoles([$roleadmin,$rolereader]);

        //
    }
}

