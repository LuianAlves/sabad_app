<?php

namespace App\Http\Controllers\Business\Company;

use App\Http\Controllers\Controller;

use App\Models\Union;
use App\Models\Business\Company\Company;

use App\Http\Requests\Business\Company\StoreCompanyRequest;
use App\Http\Requests\Business\Company\UpdateCompanyRequest;
use Illuminate\Http\Request;


class CompanyController extends Controller
{

    public function index()
    {
        $companies = Company::with('union')->get();

        return view('app.business.company.company_index', compact('companies'));
    }

    public function create()
    {
        $unions = Union::orderBy('name')->get();

        return view('app.business.company.company_create', compact('unions'));
    }

    public function store(StoreCompanyRequest $request)
    {
        $request->validated();

        $company = Company::create([
            'name' => $request->name,
            'union_id' => $request->union_id,
            'cnpj' => $request->cpfCnpj,
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
        $unions = Union::orderBy('name')->get();

        return view('app.business.company.company_edit', compact('company', 'unions'));
    }

    public function update(UpdateCompanyRequest $request, $id)
    {
        $request->validated();

        $company = Company::find($id);

        $company->update([
            'name' => $request->name,
            'union_id' => $request->union_id,
            'cnpj' => $request->cpfCnpj
        ]);

        return redirect()->route('company.index');
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return redirect()->route('company.index');
    }

    // Carrega níveis + faixas
    public function structure(Company $company)
    {
        $company->load([
            'hierarchicalLevels' => fn($q) => $q->orderBy('order'),
            'hierarchicalLevels.tierLevels' => fn($q) => $q->orderBy('order'),
            'hierarchicalLevels.tierLevels.salaryBands' => fn($q) => $q->orderBy('band'),
        ]);

        return view('app.business.company.company_structure.company_structure_index', compact('company'));
    }


// Aplica reajuste (% que está em unions.current_adjustment_percent)
    public function applyAdjustment(Company $company)
    {
        $percent = $company->union->current_adjustment_percent;
        if(!$company->union || $percent <= 0){
            return back()->with('error','Selecione um sindicato válido.');
        }

        foreach($company->hierarchicalLevels as $level){
            foreach($level->tierLevels as $tier){
                foreach($tier->salaryBands as $band){
                    $band->update([
                        'salary' => round($band->salary * (1 + $percent/100), 2),
                    ]);
                }
            }
        }

        return back()->with('success',"Dissídio de {$percent}% aplicado.");
    }

}
