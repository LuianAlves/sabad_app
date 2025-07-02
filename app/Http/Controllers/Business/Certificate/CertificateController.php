<?php

namespace App\Http\Controllers\Business\Certificate;

use App\Http\Controllers\Controller;
use App\Models\Business\Certificate\Certificate;
use App\Models\Business\Company\Company;
use App\Http\Requests\Business\Certificate\StoreCertificateRequest;
use App\Http\Requests\Business\Certificate\UpdateCertificateRequest;
use App\Models\Business\Employee\Employee;

class CertificateController extends Controller
{
    
    public function index()
    {
        $certificates = Certificate::with('employee.department.company')->get();

        return view('app.business.certificate.certificate_index', compact('certificates'));
    }

    
    public function create()
    {
        $employees = Employee::with('department.company')->get();

        return view('app.business.certificate.certificate_create', compact('employees'));
    }

    
    public function store(StoreCertificateRequest $request)
    {
        $request->validated();


        $certificate = Certificate::create([
            
            'employee_id' => $request->employee_id,
            'creation_date' => $request->creation_date,
            'last_renovation' => $request->last_renovation,
            'renewal_date' => $request->renewal_date,
            'status' => $request->status 

        ]);

        return redirect()->route('certificate.index');
    }

    
    public function show($id)
    {
        $certificate = Certificate::with('employee.department.company')->findOrFail($id);

        return view('app.business.certificate.certificate_show', compact('certificate'));
    }

    
    public function edit($id)
    {
        $certificate = Certificate::with('employee.department.company')->findOrFail($id);
        $employees = Employee::with('department.company')->get();

        return view('app.business.certificate.certificate_edit', compact('certificate', 'employees'));
    }

    
    public function update(UpdateCertificateRequest $request, $id)
    {
        $request->validated();

        $certificate = Certificate::find($id);

        $certificate->update([
            
            'employee_id' => $request->employee_id,
            'creation_date' => $request->creation_date,
            'last_renovation' => $request->last_renovation,
            'renewal_date' => $request->renewal_date,
            'status' => $request->status
        ]);

        return redirect()->route('certificate.index');
    }

    
    public function destroy($id)
    {
        $certificate = Certificate::find($id);

        $certificate->delete();

        return redirect()->route('certificate.index');
    }
}
