<?php

namespace App\Http\Controllers;

use App\Models\Union;
use App\Models\UnionAdjustment;
use Illuminate\Http\Request;

class UnionAdjustmentController extends Controller
{
    public function index(Union $union)
    {
        $adjustments = $union->adjustments()->orderByDesc('year')->get();

        return view('app.business.unions.union_adjustment.union_adjustment_index', compact('union','adjustments'));
    }

    public function create(Union $union)
    {
        return view('app.business.unions.union_adjustment.union_adjustment_create', compact('union'));
    }

    public function store(Request $request, Union $union)
    {
        $request->validate([
            'year'    => 'required|integer|min:2000',
            'percent' => 'required|numeric|min:0'
        ]);

        $adj = $union->adjustments()->create($request->only('year','percent'));

        // atualiza current_adjustment_percent
        $union->update(['current_adjustment_percent' => $adj->percent]);

        return redirect()
            ->route('union.adjustment.index', $union)
            ->with('success','Reajuste cadastrado.');
    }

    public function edit(Union $union, UnionAdjustment $adjustment)
    {
        return view('app.business.unions.union_adjustment.union_adjustment_edit', compact('union','adjustment'));
    }

    public function update(Request $request, Union $union, UnionAdjustment $adjustment)
    {
        $request->validate([
            'year'    => 'required|integer|min:2000',
            'percent' => 'required|numeric|min:0'
        ]);

        $adjustment->update($request->only('year','percent'));
        // se o ajuste editado for o mais recente, atualiza current_adjustment_percent
        if($adjustment->year == $union->adjustments()->max('year')){
            $union->update(['current_adjustment_percent' => $adjustment->percent]);
        }

        return redirect()
            ->route('union.adjustment.index', $union)
            ->with('success','Reajuste atualizado.');
    }

    public function destroy(Union $union, UnionAdjustment $adjustment)
    {
        $adjustment->delete();
        // re-calcula ultimo percentual
        $last = $union->adjustments()->orderByDesc('year')->first();
        $union->update(['current_adjustment_percent' => $last->percent ?? 0]);

        return back()->with('success','Reajuste removido.');
    }
}
