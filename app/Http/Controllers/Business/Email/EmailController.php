<?php

namespace App\Http\Controllers\Business\Email;

use App\Http\Controllers\Controller;

use App\Models\Business\Email\Email;
use App\Models\Business\Employee\Employee;
use App\Http\Requests\Business\Email\StoreEmailRequest;
use App\Http\Requests\Business\Email\UpdateEmailRequest;
use App\Models\Business\Company\Company;
use App\Models\Business\Department\Department;
use App\Models\Business\License\License;
use Carbon\Carbon;


class EmailController extends Controller
{
    public function index()
    {
        $emails = Email::with('employee.department.company')->get();   

        return view('app.business.email.email_index', compact('emails'));
    }
    
    public function create()
    {
        
        $companies = Company::with('employees.department.company')->get();
        $licenses = License::get();
        

        return view('app.business.email.email_create', compact('companies', 'licenses'));
    }
    
    public function store(StoreEmailRequest $request)
    {
        $request->validated();

        $email = Email::create([
            'employee_id' => $request->employee_id,
            'license_id' => $request->license_id,
            'email' => $request->email,
            'password' => $request->password,
            'alias' => json_encode($request->alias),
            'is_active' => $request->is_active,
            'created_at' => Carbon::now()
        
        ]);

        
        return redirect()->route('email.index');
    }
    
    public function show($id)
    {
        $email = Email::find($id);

        return view('app.business.email.email.show', compact('email'));
    }

    
    public function edit($id)
    {
        $email = Email::where('id', $id)->find($id);
        $companies = Company::with('employees.department.company')->get();
        $licenses = License::get();          

        return view('app.business.email.email_edit', compact('email', 'companies', 'licenses'));
    }

    public function update(UpdateEmailRequest $request, $id)
    {
        $request->validated();

        $email = Email::find($id);

        $email->update([
            'employee_id' => $request->employee_id,
            'email' => $request->email,
            'password' => $request->password,

        ]);

        return redirect()->route('email.index');
    }
    
    public function destroy($id)
    {
        $email = Email::find($id);
        $email->delete();

        return redirect()->route('email.index');
    }
}
