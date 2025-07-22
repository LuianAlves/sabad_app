<?php

namespace App\Http\Controllers;

use App\Models\Business\Company\Company;
use App\Models\Business\Department\Department;
use App\Models\Business\Device\DeviceControl\DeviceControl;
use App\Models\Business\Heritage\HeritageControl\HeritageControl;
use App\Models\Business\Service\Service;
use App\Models\Cost;
use App\Models\SalaryBand;
use App\Models\User;
use Illuminate\Http\Request;

class CostController extends Controller
{

    public function index()
    {
        $costs = Cost::with(['service', 'deviceControl', 'heritageControl', 'salaryBand'])->get();
        return view('app.business.cost.cost_index', compact('costs'));
    }

    public function create()
    {
        $services = Service::all();
        $devices = DeviceControl::all();
        $heritages = HeritageControl::all();
        $salaries = SalaryBand::all();

        return view('app.business.cost.cost_create', compact('services', 'devices', 'heritages', 'salaries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'nullable|exists:services,id',
            'device_control_id' => 'nullable|exists:device_controls,id',
            'heritage_control_id' => 'nullable|exists:heritage_controls,id',
            'salary_band_id' => 'nullable|exists:salary_bands,id',
        ]);

        $servicePrice = Service::find($request->service_id)?->price ?? 0;
        $devicePrice = DeviceControl::find($request->device_control_id)?->estimated_price ?? 0;
        $heritagePrice = HeritageControl::find($request->heritage_control_id)?->estimated_price ?? 0;
        $salary = SalaryBand::find($request->salary_band_id)?->salary ?? 0;

        $total = $servicePrice + $devicePrice + $heritagePrice + $salary;

        Cost::create([
            ...$validated,
            'total' => $total,
        ]);

        return redirect()->route('costs.index')->with('success', 'Custo criado com sucesso!');
    }

    // 🎯 Relatório personalizado
    public function report(Request $request)
    {
        $companies = Company::all();

        $selectedCompany = $request->company_id;
        $selectedDepartment = $request->department_id;

        $departments = $selectedCompany
            ? Department::where('company_id', $selectedCompany)->get()
            : collect();

        $employees = collect();

        if ($selectedCompany && $selectedDepartment) {
            $employees = User::with([
                'employeeUser.employee.department.company',
                'employeeUser.employee.deviceControl',
                'employeeUser.employee.department.heritageControls',
                'employeeUser.employee.salaryBand',
                'employeeUser.employee.department.services' // ✅ necessário para somar os preços
            ])
                ->whereHas('employeeUser.employee.department.company', function ($query) use ($selectedCompany) {
                    $query->where('id', $selectedCompany);
                })
                ->whereHas('employeeUser.employee.department', function ($query) use ($selectedDepartment) {
                    $query->where('id', $selectedDepartment);
                })
                ->get();
        }

        return view('app.business.cost.cost_report', compact(
            'companies', 'departments', 'employees',
            'selectedCompany', 'selectedDepartment'
        ));
    }



    /**
     * Display the specified resource.
     */
    public function show(Cost $cost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cost $cost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCostRequest $request, Cost $cost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cost $cost)
    {
        //
    }
}
