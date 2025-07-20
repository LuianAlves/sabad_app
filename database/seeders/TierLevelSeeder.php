<?php

namespace Database\Seeders;

use App\Models\HierarchicalLevel;
use App\Models\TierLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TierLevelSeeder extends Seeder
{
    public function run()
    {
        $tiers = ['Junior', 'Pleno', 'Senior'];

        foreach (HierarchicalLevel::all() as $level) {
            foreach ($tiers as $i => $name) {
                TierLevel::firstOrCreate(
                    [
                        'hierarchical_level_id' => $level->id,
                        'order'                 => $i + 1,
                    ],
                    [
                        'name'                  => $name,
                    ]
                );
            }
        }
    }
}
