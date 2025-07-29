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
            'entities', 'users', 'unions', 'companies', 'departments', 'employees',
            'infrastructure', 'heritages', 'rooms', 'services', 'devices', 'emails', 'extension', 'chips', 'licenses',
            'operational', 'tickets', 'tasks', 'booking',
            'controls', 'domains', 'certificates', 'maintenances', 'service_controls', 'device_controls', 'chip_controls', 'heritage_controls', 'record_controls',
            'system', 'notifications', 'roles', 'permissions'

        ];

        $actions = ['view', 'create', 'edit', 'delete', 'show'];

        foreach ($entities as $entity) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "$action $entity"]);
            }
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all());

        $userRole = Role::firstOrCreate(['name' => 'user']);

        $userRole->syncPermissions([]);
    }
}

