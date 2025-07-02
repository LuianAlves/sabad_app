<?php

namespace App\Http\Controllers\Business\Extension;


use App\Http\Controllers\Controller;
use App\Models\Business\Extension\Extension;
use App\Http\Requests\Business\Extension\StoreExtensionRequest;
use App\Http\Requests\Business\Extension\UpdateExtensionRequest;
use App\Models\Business\Employee\Employee;
use App\Models\User;

class ExtensionController extends Controller
{
    
    public function index()
    {
        $extensions = Extension::with('user.employeeUser.employee.department.company')->get();

        return view('app.business.extension.extension_index', compact('extensions'));
    }

    
    public function create()
    {
        $employees = Employee::with('department.company', 'emails')->get();

        return view('app.business.extension.extension_create', compact('employees'));

    }

    
    public function store(StoreExtensionRequest $request)
    {
        $request->validated();

        $extension = Extension::create([
            'employee_id' => $request->employee_id,
            'number' => $request->number,
            'email_id' => $request->email_id,
            'password' => $request->password,
            'meet' => $request->meet
        ]);

        return redirect()->route('extension.index');
    }

   
    public function show($id)
    {
        $extension = Extension::with('employee.department.company', 'email')->find($id);
       

        return view('app.business.extension.extension_show', compact('extension'));
    }

    
    public function edit($id)
    {
        $extension = Extension::where('id', $id)->first();
        $employees = Employee::with('department.company')->get();

        return view('app.business.extension.extension_edit', compact('extension', 'employees'));
    }

    
    public function update(UpdateExtensionRequest $request, $id)
    {
        $request->validated();

        $extension = Extension::find($id);

        $extension->update([
            'employee_id' => $request->employee_id,
            'number' => $request->number,
            'email_id' => $request->email_id,
            'password' => $request->password,
            'meet' => $request->meet
        ]);

        return redirect()->route('extension.index');
    }

    
    public function destroy($id)
    {
        $extension = Extension::find($id);
        $extension->delete();

        return redirect()->route('extension.index');
    }
}
