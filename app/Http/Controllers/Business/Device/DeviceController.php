<?php

namespace App\Http\Controllers\Business\Device;

use App\Http\Controllers\Controller;

// Request
use App\Http\Requests\Business\Device\StoreDeviceRequest;
use App\Http\Requests\Business\Device\UpdateDeviceRequest;

// Models
use App\Models\Business\Device\Device;
use App\Models\Business\Company\Company;
use App\Models\Business\Employee\Employee;
use App\Models\Business\Department\Department;

// Dependences
use Carbon\Carbon;

class DeviceController extends Controller
{

    public function index()
    {
        $devices = Device::get();

        return view('app.business.device.device_index', compact('devices'));
    }

    public function create()
    {
        return view('app.business.device.device_create');
    }

    public function store(StoreDeviceRequest $request)
    {
        $request->validated();

        $device = Device::create([
            'device_type_id' => $request->device_type_id,
            'device_brand_id' => $request->device_brand_id,
            'device_model_id' => $request->device_model_id,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('device.index');
    }


    public function show($id)
    {
        $device = Device::with('employee.department.company')->find($id);
        $employee = Employee::with('department')->find($id);

        return view('app.business.device.device_show', compact('device', 'employee'));
    }


    public function edit($id)
    {
        $device = Device::with('employee.department.company')->findOrFail($id);
        $departments = Department::with('company')->get();
        $companies = Company::get();

        return view('app.business.device.device_edit', compact('device', 'departments', 'companies'));
    }


    public function update(UpdateDeviceRequest $request, $id)
    {
        $request->validated();

        $device = Device::find($id);

        $device->update([
            'department_id' => $request->department_id,
            'device_type' => $request->device_type,
            'brand' => $request->brand,
            'model' => $request->model,
        ]);

        return redirect()->route('device.index');
    }


    public function destroy($id)
    {
        $device = Device::find($id);
        $device->delete();

        return redirect()->route('device.index');
    }
}
