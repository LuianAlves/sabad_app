<?php

namespace App\Http\Controllers\Business\Domain;

use App\Models\Business\Domain\Domain;
use App\Models\Business\Company\Company;
use App\Http\Requests\Business\Domain\StoreDomainRequest;
use App\Http\Requests\Business\Domain\UpdateDomainRequest;
use App\Http\Controllers\Controller;

class DomainController extends Controller
{
    
    public function index()
    {
        $domains = Domain::get();
        $company = Company::get();

        return view('app.business.domain.domain_index', compact('domains', 'company'));
    }

    
    public function create()
    {
    
        $companies = Company::get();

        return view('app.business.domain.domain_create', compact('companies'));
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
        $companies = Company::get();

        return view('app.business.domain.domain_edit', compact('domain', 'companies'));
    }

    
    public function update(UpdateDomainRequest $request, $id)
    {
        $request->validated();

        $domain = Domain::find($id);

        $domain->update([
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
