<?php

namespace App\Http\Controllers\Business\Employee;

use App\Http\Controllers\Controller;

// Requests
use App\Http\Requests\Business\Employee\StoreEmployeeRequest;
use App\Http\Requests\Business\Employee\UpdateEmployeeRequest;

// Models
use App\Models\User;
use App\Models\Business\User\EmployeeUser;
use App\Models\Business\Employee\Employee;
use App\Models\Business\Email\Email;
use App\Models\Business\Company\Company;
use App\Models\Business\Department\Department;
use App\Models\Business\License\License;
// Dependences
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::with('department.company')->get();
        // $department = Department::get();

        return view('app.business.employee.employee_index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::get();
        $companies = Company::with('departments.employees')->get();
        $licenses = License::get();

        return view('app.business.employee.employee_create', compact('companies', 'licenses'));
    }


    public function store(StoreEmployeeRequest $request)
    {
        $request->validated();

        $firstName = explode(' ', $request->name)[0];
        $password = ucfirst($firstName) . '@@MISB@@';

        $employee = Employee::create([
            'department_id' => $request->department_id,
            'name' => $request->name,
            'hierarchical_level' => $request->hierarchical_level,
            'hired_in' => $request->hired_in,
            'fired_in' => $request->fired_in,
            'status' => $request->status,
            'created_at' => Carbon::now()
        ]);

        $email = Email::create([
            'employee_id' => $employee->id,
            'license_id' => $request->license_id,
            'user' => $request->name,
            'email' => $request->email,
            'created_at' => Carbon::now()
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'is_active' => 1,
            'created_at' => Carbon::now()
        ])->assignRole('user');

        $employeeUser = EmployeeUser::create([
            'employee_id' => $employee->id,
            'user_id' => $user->id,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('employee.index');
    }


    public function show($id)
    {
        $employee = Employee::with('employeeUser.user', 'department.company')->findOrFail($id);

        return view('app.business.employee.employee_show', compact('employee'));
    }


    public function edit($id)
    {
        $employee = Employee::with('department.company')->findOrFail($id);
        $departments = Department::with('company')->get();

        return view('app.business.employee.employee_edit', compact('employee', 'departments'));
    }


    public function update(UpdateEmployeeRequest $request, $id)
    {
        $request->validated();

        $employee = Employee::find($id);

        $employee->update([
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
