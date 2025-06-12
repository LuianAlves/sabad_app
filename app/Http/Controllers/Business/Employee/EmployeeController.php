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
use App\Models\Business\Device\DeviceControl\DeviceControl;

// Dependences
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::with('employeeUser.user', 'department.company')->get();

        return view('app.business.employee.employee_index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::get();
        $companies = Company::with('departments.employees')->get();
        $licenses = License::get();

        $permissions = Permission::all()->groupBy(function ($permission) {
            // return explode(' ', $permission->name)[1];       
        });

        return view('app.business.employee.employee_create', compact('companies', 'licenses', 'permissions'));
    }


    public function store(StoreEmployeeRequest $request)
    {
        $request->validated();

        $imagemBase64 = null;

        if ($request->hasFile('image')) {
            $userImage = $request->file('image');
            
            $imageData = file_get_contents($userImage->getRealPath());

            $image = imagecreatefromstring($imageData);

            if ($image !== false) {
                $w = 250;
                $h = 250;
                $resizedImage = imagescale($image, $w, $h);

                ob_start();
                imagejpeg($resizedImage);
                $rawImage = ob_get_clean();

                $imagemBase64 = base64_encode($rawImage);

                imagedestroy($resizedImage);
                imagedestroy($image);
            }
        }

        // $arrayName = explode(' ', $request->name);

        // $department = Department::findOrFail($request->department_id);

        // $firstName = $arrayName[0]; // fabio

        // $arrayLastName = array_key_last($arrayName); // 1
        // $lastName = $arrayName[$arrayLastName]; // berges

        // $subFirstName = substr($firstName, 0, 2); // fa
        // $subLastName = substr($lastName, -2); // es

        // $companyCnpj = $department->company->cnpj;

        // $cnpj = substr($companyCnpj, -2); // 

        // $dp = substr($department->name, 0, 3); // Adm
        // $department = strtoupper($dp); // ADM

        // $email = explode('@', $request->email)[0]; //custos

        // $subFirstEmail = substr($email, 0, 2); // cu
        // $subFirstEmail = ucfirst($subFirstEmail); // Cu

        // $subLastEmail = substr($email, -2); // os

        // dd(
        //     $arrayName,
        //     $subFirstName,
        //     $subLastName,
        //     $cnpj,
        //     $dp,
        //     $department,
        //     $firstName,
        //     $lastName,
        //     $email,
        //     $subFirstEmail,
        //     $subLastEmail,
        //     "O departmento $department",
        //     "Padrão 01: #!{$subFirstName}{$cnpj}{$subLastName}#!",
        //     "Padrão 02: #!{$subFirstName}00{$cnpj}{$subLastName}#!",
        //     "Padrão 03: #!{$subFirstName}MISB{$subLastName}#!",
        //     "Padrão 04: #!{$subFirstName}{$department}{$subLastName}#!",
        //     "Padrão 04: #!{$subFirstEmail}{$department}{$subLastEmail}#!",
        // );


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

        Email::create([
            'employee_id' => $employee->id,
            'license_id' => $request->license_id,
            'user' => $request->name,
            'email' => $request->email,
            'created_at' => Carbon::now()
        ]);

        $isAdmin = (bool) $request->is_admin;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'is_active' => 1,
            'image' => $imagemBase64,
            'created_at' => Carbon::now()
        ]);

        if ($isAdmin) {
            $user->assignRole('admin');
        } else {
            $user->assignRole('user');

            if ($request->has('permissions')) {
                $permissions = Permission::whereIn('name', $request->permissions)->get();
                $user->syncPermissions($permissions);
            }
        }

        EmployeeUser::create([
            'employee_id' => $employee->id,
            'user_id' => $user->id,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('employee.index');
    }

    public function show($id)
    {
        $employee = Employee::with('employeeUser.user', 'department.company')->findOrFail($id);
        $teammates = Employee::with('employeeUser.user', 'department.company')->where('department_id', $employee->department_id)->get();
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode(' ', $permission->name)[1];
        });
        $devices = DeviceControl::with('employee', 'device')->where('employee_id', $employee->id)->get();
        $emails = Email::where('id', $employee->id)->get();

        return view('app.business.employee.employee_show', compact(
            'employee',
            'teammates',
            'permissions',
            'devices',
            'emails'
        ));
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
