<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete'
        ];

        $permissions2 = [
            'tipodocumento-list',
            'tipodocumento-create',
            'tipodocumento-edit',
            'tipodocumento-delete'
        ];

        $permissions3 = [
            'usuarios-list',
            'usuarios-create',
            'usuarios-edit',
            'usuarios-delete'
        ];

        $permissions4 = [
            'documento-list',
            'documento-create',
            'documento-edit',
            'documento-delete'
        ];

        $permissions5 = [
            'documentos-usuarios-list',
            'documentos-usuarios-create',
            'documentos-usuarios-edit',
            'documentos-usuarios-delete'
        ];

        $permissions6 = [
            'informacionusuario-list',
            'informacionusuario-create',
            'informacionusuario-edit',
            'informacionusuario-delete'
        ];

        foreach ($permissions6 as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
