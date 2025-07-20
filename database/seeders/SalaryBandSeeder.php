<?php

namespace Database\Seeders;

use App\Models\HierarchicalLevel;
use App\Models\SalaryBand;
use App\Models\TierLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalaryBandSeeder extends Seeder
{
    public function run()
    {
        $bands = ['I','II','III'];

        foreach (TierLevel::all() as $tier) {
            foreach ($bands as $band) {
                SalaryBand::firstOrCreate(
                    [
                        'tier_level_id' => $tier->id,
                        'band'          => $band,
                    ],
                    [
                        'salary'        => 0.00,
                    ]
                );
            }
        }
    }
}
