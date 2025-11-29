<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ProductionPermissionSeeder extends Seeder
{
    public function run()
    {
        // Permissões específicas do departamento PRODUÇÃO
        $permissions = [
            'producao.gerenciar',
            'producao.estoque',
            'producao.producao',
            'producao.painel',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles (departamentos)
        $producao = Role::firstOrCreate(['name' => 'producao']);
        $estoque  = Role::firstOrCreate(['name' => 'estoque']);
        $operador = Role::firstOrCreate(['name' => 'operador']);
        $painel   = Role::firstOrCreate(['name' => 'painel']);

        // Permissões por perfil (flexível)
        $producao->syncPermissions([
            'producao.gerenciar',
            'producao.estoque',
            'producao.producao',
            'producao.painel',
        ]);

        $estoque->syncPermissions([
            'producao.estoque',
        ]);

        $operador->syncPermissions([
            'producao.producao',
        ]);

        $painel->syncPermissions([
            'producao.painel',
        ]);
    }
}
