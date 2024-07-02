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
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Tutor']);
        $role3 = Role::create(['name' => 'Asesor']);
        $role4 = Role::create(['name' => 'Estudiante']);

        //permisos para los temas
        Permission::create(['name' => 'admin.temas'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.tema.show'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.tema.search'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.tema.store'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.tema.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.tema.update'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.tema.destroy'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.form_temas'])->syncRoles([$role1, $role2]);

        //permisos para los usuarios estudiantes
        Permission::create(['name' => 'admin.estudiantes.index'])->syncRoles([$role3]);
        Permission::create(['name' => 'admin.estudiantes.import'])->syncRoles([$role3]);
        Permission::create(['name' => 'admin.estudiantes.store'])->syncRoles([$role3]);
        Permission::create(['name' => 'admin.estudiantes.update'])->syncRoles([$role3]);
        Permission::create(['name' => 'admin.estudiantes.destroy'])->syncRoles([$role3]);

        //permiso para usuarios docentes
        Permission::create(['name' => 'admin.users'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.user.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.user.store'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.user.update'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.user.destroy'])->syncRoles([$role1]);


        //permisos para los reportes
        Permission::create(['name' => 'admin.reportes'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.reportes.Admin'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.reportes.Asesor'])->syncRoles([$role3]);



        
    }
}
