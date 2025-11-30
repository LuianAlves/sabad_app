<?php

namespace Database\Seeders;

use App\Models\Business\Company\Company;
use App\Models\HierarchicalLevel;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class HierarchicalLevelSeeder extends Seeder
{
    public function run()
    {
        $levels = [
            'Estagiário',
            'Trainee',
            'Assistente',
            'Analista',
            'Supervisor',
            'Coordenador',
            'Gerente',
            'Diretor',
        ];

        foreach (Company::all() as $company) {
            foreach ($levels as $i => $name) {
                HierarchicalLevel::firstOrCreate(
                    [
                        'company_id' => $company->id,
                        'order' => $i + 1,
                    ],
                    [
                        'name' => $name,
                    ]
                );
            }
        }

        foreach ($levels as $i => $name) {
            Role::firstOrCreate([
                'name' => strtolower($name),
                'guard_name' => 'web'
            ]);
        }
    }
}
