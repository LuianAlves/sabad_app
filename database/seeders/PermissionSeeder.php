<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $entities = [
            'users', 'companies', 'domains', 'departaments', 'employees',
            'emails', 'services', 'services control', 'certificates',
            'devices', 'licenses', 'device control'
        ];

        $actions = ['view', 'create', 'edit', 'delete'];

        foreach ($entities as $entity) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "$action $entity"]);
            }
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all());
    }
}

