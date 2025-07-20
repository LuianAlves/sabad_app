<?php
namespace App\Http\Controllers;

use App\Models\HierarchicalLevel;
use App\Models\SalaryBand;
use App\Models\TierLevel;
use Illuminate\Http\Request;

class SalaryBandController extends Controller
{
    public function index(TierLevel $tierLevel)
    {
        $bands = $tierLevel
            ->salaryBands()
            ->orderBy('band')
            ->get();

        return view(
            'app.business.hierarchical_level.salary_band.salary_band_index',
            compact('tierLevel','bands')
        );
    }

    public function create(TierLevel $tierLevel)
    {
        return view(
            'app.business.hierarchical_level.salary_band.salary_band_create',
            compact('tierLevel')
        );
    }

    public function store(Request $r, TierLevel $tierLevel)
    {
        $r->validate([
            'band'   => 'required|string|max:5',
            'salary' => 'required|numeric|min:0',
        ]);

        $tierLevel->salaryBands()->create($r->only('band','salary'));

        return redirect()
            ->route('tier_levels.salary_bands.index', $tierLevel)
            ->with('success','Faixa criada.');
    }

    public function edit(SalaryBand $salaryBand)
    {
        $tierLevel = $salaryBand->tierLevel;
        return view(
            'app.business.hierarchical_level.salary_band.salary_band_edit',
            compact('tierLevel','salaryBand')
        );
    }

    public function update(Request $r, SalaryBand $salaryBand)
    {
        $r->validate([
            'band'   => 'required|string|max:5',
            'salary' => 'required|numeric|min:0',
        ]);

        $salaryBand->update($r->only('band','salary'));
        $tierLevel = $salaryBand->tierLevel;

        return redirect()
            ->route('tier_levels.salary_bands.index', $tierLevel)
            ->with('success','Faixa atualizada.');
    }

    public function destroy(SalaryBand $salaryBand)
    {
        $tierLevel = $salaryBand->tierLevel;
        $salaryBand->delete();

        return redirect()
            ->route('tier_levels.salary_bands.index', $tierLevel)
            ->with('success','Faixa removida.');
    }
}
