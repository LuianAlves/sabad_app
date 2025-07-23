<?php

namespace App\Http\Controllers\Business\Employee;

use App\Http\Controllers\Controller;

// Requests
use App\Http\Requests\Business\Employee\StoreEmployeeRequest;
use App\Http\Requests\Business\Employee\UpdateEmployeeRequest;

// Models
use App\Models\HierarchicalLevel;
use App\Models\SalaryBand;
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
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('employeeUser.user.roles', 'department.company')->get();

        return view('app.business.employee.employee_index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::get();
        $companies = Company::with('departments.employees')->get();
        $licenses = License::get();
        $levels = HierarchicalLevel::orderBy('order')
            ->with([
                'tierLevels' => fn($q) => $q->orderBy('order')
                    ->with(['salaryBands' => fn($q2) => $q2->orderBy('band')])
            ])
            ->get();

        $roles = Role::with('permissions')->get();

        return view('app.business.employee.employee_create', compact('roles', 'levels', 'companies', 'licenses'));
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

        $firstName = explode(' ', $request->name)[0];
        $password = ucfirst($firstName) . '@@MISB@@';


//        dd($request->all());

        $employee = Employee::create([
            'department_id' => $request->department_id,
            'name' => $request->name,
            'hierarchical_level_id' => $request->level_id,
            'tier_level_id' => $request->tier_id,
            'salary_band_id' => $request->salary_band_id,
            'hired_in' => $request->hired_in,
            'fired_in' => $request->fired_in,
            'status' => $request->status,
            'created_at' => Carbon::now()
        ]);

//        dd($request->all(), $employee);

        Email::create([
            'employee_id' => $employee->id,
            'license_id' => $request->license_id,
            'user' => $request->name,
            'email' => $request->email,
            'created_at' => Carbon::now()
        ]);

        $isAdmin = (bool)$request->is_admin;

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
            $user->assignRole($request->role);
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
            // return explode(' ', $permission->name)[1];
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
        $employee = Employee::with([
            'department.company',
            'employeeUser.user.roles',
        ])->findOrFail($id);

        $departments = Department::with('company')->get();
        $companies = Company::with('departments')->get();
        $licenses = License::all();
        $levels = HierarchicalLevel::orderBy('order')
            ->with([
                'tierLevels' => fn($q) => $q->orderBy('order')
                    ->with(['salaryBands' => fn($q2) => $q2->orderBy('band')])
            ])
            ->get();
        $roles = Role::all();

        return view('app.business.employee.employee_edit', compact(
            'employee',
            'departments',
            'companies',
            'licenses',
            'levels',
            'roles'
        ));
    }


    public function update(UpdateEmployeeRequest $request, $id)
    {
        $request->validated();

        $employee = Employee::with('employeeUser.user')->findOrFail($id);

        // Atualiza imagem se enviada
        $imagemBase64 = $employee->employeeUser->user->image;
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

        // Atualiza o funcionário
        $employee->update([
            'department_id'         => $request->department_id,
            'name'                  => $request->name,
            'hierarchical_level_id' => $request->level_id,
            'tier_level_id'         => $request->tier_id,
            'salary_band_id'        => $request->salary_band_id,
            'hired_in'              => $request->hired_in,
            'fired_in'              => $request->fired_in,
            'status'                => $request->status,
        ]);

        // Atualiza e-mail
        Email::updateOrCreate(
            ['employee_id' => $employee->id],
            [
                'license_id' => $request->license_id,
                'user'       => $request->name,
                'email'      => $request->email,
            ]
        );

        // Atualiza usuário vinculado
        $user = $employee->employeeUser->user;
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'image' => $imagemBase64,
        ]);

        // Atualiza permissões
        $user->syncRoles([]); // Remove tudo

        if ((bool)$request->is_admin) {
            $user->assignRole('admin');
        } elseif ($request->role) {
            $user->assignRole($request->role);
        }

        return redirect()->route('employee.index')->with('success', 'Funcionário atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return redirect()->route('employee.index');
    }

}
