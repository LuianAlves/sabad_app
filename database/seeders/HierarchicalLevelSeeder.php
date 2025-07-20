<?php

namespace Database\Seeders;

use App\Models\Business\Company\Company;
use App\Models\HierarchicalLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
    }
}
