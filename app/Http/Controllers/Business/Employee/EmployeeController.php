<?php

namespace App\Http\Controllers\Business\Employee;

use App\Models\Business\Employee\Employee;
use App\Models\Business\Department\Department;
use App\Http\Requests\Business\Employee\StoreEmployeeRequest;
use App\Http\Requests\Business\Employee\UpdateEmployeeRequest;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    
    public function index()
    {
        $employees = Employee::get();

        return view('app.business.employee.employee_index', compact('employees'));
    }

    
    public function create()
    {
        $departments = Department::get();

        return view('app.business.employee.employee_create', compact('departments'));
    }

    
    public function store(StoreEmployeeRequest $request)
    {
        $request->validated();

        $employee = Employee::create([
            'department_id' => $request->department_id,
            'name' => $request->name,
            'hierarchical_level' => $request->hierarchical_level,
            'hired_in' => $request->hired_in,
            'fired_in' => $request->fired_in,
            'status' => $request->status
        ]);

        return redirect()->route('employee.index');
    }

    
    public function show($id)
    {
        $employee = Employee::find($id);

        return view('app.business.employee.employee_show');
    }

    
    public function edit($id)
    {
        $employee = Employee::where('id', $id)->first();

        return view('app.business.employee.employee_edit');
    }

    
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $request->validated();

        $employee = Employee::find($id);

        $employee = Employee::update([
            'department_id' => $request->department_id,
            'name' => $request->name,
            'hierarchical_level' => $request->hierarchical_level,
            'hired_in' => $request->hired_in,
            'fired_in' => $request->fired_in,
            'status' => $request->status
        ]);

        return redirect()->route('employee.index');
    }

    
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return redirect()->route('employee.index');
    }
}
