<?php

namespace App\Http\Controllers\Business\Department;

use App\Http\Controllers\Controller;
use App\Models\Business\Company\Company;
use App\Models\Business\Department\Department;
use App\Http\Requests\Business\Department\StoreDepartmentRequest;
use App\Http\Requests\Business\Department\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::get();
        $companies = Company::get();

        return view('app.business.department.department_index', compact('departments', 'companies'));
    }

    
    public function create()
    {
        $companies = Company::get();
        
        return view('app.business.department.department_create', compact('companies'));
    }

    
    public function store(StoreDepartmentRequest $request)
    {
        $request->validated();

        $department = Department::create([
            'company_id' => $request->company_id,
            'name' => $request->name
        ]);

        return redirect()->route('department.index');
    }

    
    public function show($id)
    {
        $department = Department::find($id);

        return view('app.business.department.department_show', compact('department'));
    }

    
    public function edit($id)
    {
        $department = Department::where('id', $id)->first();
        $companies = Company::get();

        return view('app.business.department.department_edit', compact('department', 'companies'));
    }

    
    public function update(UpdateDepartmentRequest $request, $id)
    {
        $request->validated();

        $department = Department::find($id);

        $department->update([
            'company_id' => $request->company_id,
            'name' => $request->name
        ]);

        return redirect()->route('department.index');
    }

    
    public function destroy($id)
    {
        $department = Department::find($id);

        $department->delete();

        return redirect()->route('department.index');
    }
}
