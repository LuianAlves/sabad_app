<?php
namespace App\Http\Controllers;

use App\Models\HierarchicalLevel;
use App\Models\TierLevel;
use Illuminate\Http\Request;

class TierLevelController extends Controller
{
    public function index(HierarchicalLevel $hierarchicalLevel)
    {
        $tiers = $hierarchicalLevel
            ->tierLevels()
            ->orderBy('order')
            ->get();
        return view('app.business.hierarchical_level.tier_level.tier_level_index', compact('hierarchicalLevel','tiers'));
    }

    public function create(HierarchicalLevel $hierarchicalLevel)
    {
        return view('app.business.hierarchical_level.tier_level.tier_level_create', compact('hierarchicalLevel'));
    }

    public function store(Request $r, HierarchicalLevel $hierarchicalLevel)
    {
        $r->validate([
            'name'  => 'required|string|max:255',
            'order' => 'required|integer|min:1',
        ]);

        $hierarchicalLevel
            ->tierLevels()
            ->create($r->only('name','order'));

        return redirect()
            ->route('hierarchical_levels.tier_levels.index', $hierarchicalLevel);
    }

    public function edit(HierarchicalLevel $hierarchicalLevel, TierLevel $tierLevel)
    {
        return view('app.business.hierarchical_level.tier_level.tier_level_edit', compact('hierarchicalLevel','tierLevel'));
    }

    public function update(Request $r, HierarchicalLevel $hierarchicalLevel, TierLevel $tierLevel)
    {
        $r->validate([
            'name'  => 'required|string|max:255',
            'order' => 'required|integer|min:1',
        ]);

        $tierLevel->update($r->only('name','order'));

        return redirect()
            ->route('hierarchical_levels.tier_levels.index', $hierarchicalLevel);
    }

    public function destroy(HierarchicalLevel $hierarchicalLevel, TierLevel $tierLevel)
    {
        $tierLevel->delete();
        return back();
    }
}
