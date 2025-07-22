<?php

namespace App\Http\Controllers;

use App\Models\HierarchicalLevel;
use App\Models\TierLevel;
use Illuminate\Http\JsonResponse;

class HierarchicalLevelController extends Controller
{
    public function getTiers(HierarchicalLevel $level): JsonResponse
    {
        $tiers = $level
            ->tierLevels()
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return response()->json($tiers);
    }

    public function getSalaryBands(TierLevel $tier): JsonResponse
    {
        $bands = $tier
            ->salaryBands()
            ->select('id', 'band')
            ->orderBy('band')
            ->get();

        return response()->json($bands);
    }
}
