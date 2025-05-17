<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Http\Requests\StoreDomainRequest;
use App\Http\Requests\UpdateDomainRequest;

class DomainController extends Controller
{
    
    public function index()
    {
        $domain = Domain::get();

        return view('app.business.domain.domain_index', compact('domain'));
    }

    
    public function create()
    {
        $domains = Domain::get();

        return view('app.business.domain.domain.create', compact('domains'));
    }

    
    public function store(StoreDomainRequest $request)
    {
        $request->validated();

        $domain = Domain::create([
            'company_id' => $request->company_id,
            'name' => $request->name,
            'plan_validity' => $request->plan_validity,
            'last_payment' => $request->last_payment,
            'next_payment' => $request->next_payment,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('domain.index');

    }

    
    public function show($id)
    {
        $domain = Domain::find($id);

        return view('app.business.domain.domain_show', compact('domain'));
    }

    
    public function edit($id)
    {
        $domain = Domain::where('id', $id)->first();

        return view('app.business.domain.domain_edit');
    }

    
    public function update(UpdateDomainRequest $request, $id)
    {
        $request->validated();

        $domain = Domain::find($id);

        $domain = Domain::create([
            'company_id' => $request->company_id,
            'name' => $request->name,
            'plan_validity' => $request->plan_validity,
            'last_payment' => $request->last_payment,
            'next_payment' => $request->next_payment,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('domain.index');
    }

    
    public function destroy($id)
    {
        $domain = Domain::find($id);

        $domain->delete();

        return redirect()->route('domain.index');
    }
}
