<?php

namespace App\Http\Controllers\Business\Company;

use App\Http\Controllers\Controller;
use App\Models\Business\Company\Company;
use App\Http\Requests\Business\Company\StoreCompanyRequest;
use App\Http\Requests\Business\Company\UpdateCompanyRequest;

class CompanyController extends Controller
{
   
    public function index()
    {
        $companies = Company::get();

        return view('app.business.company.company_index', compact('companies'));
    }

    
    public function create()
    {
        $companies = Company::get();

        return view('app.business.company.company_create', compact('companies'));
    }

    
    public function store(StoreCompanyRequest $request)
    {
        $request->validated();

        $company = Company::create([
            'name' => $request->name,
            'cnpj' => $request->cnpj
        ]);

        return redirect()->route('company.index');
    }

    
    public function show($id)
    {
        $company = Company::find($id);

        return view('app.business.company.company_show', compact('company'));
    }

    
    public function edit($id)
    {
        $company = Company::where('id', $id)->first();

        return view('app.business.company.company_edit', compact('company'));
    }

    
    public function update(UpdateCompanyRequest $request, $id)
    {
        $request->validated();

        $company = Company::find($id);

        $company->update([
            'name' => $request->name,
            'cnpj' => $request->cnpj
        ]);

        return redirect()->route('company.index');
    }

    
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return redirect()->route('company.index');
    }
}
