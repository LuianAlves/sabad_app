<?php

namespace App\Http\Controllers;

use App\Models\Union;
use Illuminate\Http\Request;

class UnionController extends Controller
{
    public function index()
    {
        $unions = Union::orderBy('name')->get();

        return view('app.business.unions.union.union_index', compact('unions'));
    }

    public function create()
    {
        return view('app.business.unions.union.union_create');
    }

    public function store(Request $r)
    {
        $r->validate([
            'name'=>'required|unique:unions,name',
            'current_adjustment_percent'=>'required|numeric|min:0'
        ]);

        Union::create($r->only('name','current_adjustment_percent'));

        return redirect()->route('union.index');
    }

    public function edit(Union $union)
    {
        return view('app.business.unions.union.union_edit', compact('union'));
    }

    public function update(Request $r, Union $union)
    {
        $r->validate([
            'name'=>"required|unique:unions,name,{$union->id}",
            'current_adjustment_percent'=>'required|numeric|min:0'
        ]);

        $union->update($r->only('name','current_adjustment_percent'));

        return redirect()->route('union.index');
    }

    public function destroy(Union $union)
    {
        $union->delete();
        return back();
    }
}
