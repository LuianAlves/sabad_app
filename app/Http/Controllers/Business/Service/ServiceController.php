<?php

namespace App\Http\Controllers\Business\Service;

use App\Http\Controllers\Controller;

// Requests
use App\Http\Requests\Business\Service\StoreServiceRequest;
use App\Http\Requests\Business\Service\UpdateServiceRequest;

// Models
use App\Models\Business\Service\Service;
use App\Models\Business\Department\Department;

// Dependeces
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::get();

        return view('app.business.service.service_index', compact('services'));
    }

    public function create()
    {
        $departments = Department::get();

        return view('app.business.service.service_create', compact('departments'));
    }

    public function store(StoreServiceRequest $request)
    {
        $request->validated();
        
        $password = $request->input('password');
        $cryptedPassword = Crypt::encrypt($password);

        $service = Service::create([
            'department_id' => $request->department_id,
            'name' => $request->name,
            'description' => $request->description,
            'url' => $request->url,
            'user' => $request->user,
            'email' => $request->email,
            'password' => $cryptedPassword,
            'contracted_in' => $request->contracted_in,
            'price' => $request->price,
            'recurrence' => $request->recurrence,
            'payment_day' => $request->payment_day,
            'is_active' => (bool) $request->is_active,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('service.index');
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);

        return view('app.business.service.service_show', compact('service'));
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);

        return view('app.business.service.service_edit', compact('service'));
    }

    public function update(UpdateServiceRequest $request, $id)
    {
        $request->validated();

        $service = Service::findOrFail($id);

        $service->update([
            'department_id' => $request->department_id,
            'name' => $request->name,
            'description' => $request->description,
            'url' => $request->url,
            'user' => $request->user,
            'email' => $request->email,
            'password' => $request->password,
            'contracted_in' => $request->contracted_in,
            'price' => $request->price,
            'recurrence' => $request->recurrence,
            'payment_day' => $request->payment_day,
            'is_active' => $request->is_active,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('service.index');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('service.index');
    }
}
