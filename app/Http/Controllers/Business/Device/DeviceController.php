<?php

namespace App\Http\Controllers\Business\Device;

use App\Models\Business\Device\Device;
use App\Http\Requests\Business\Device\StoreDeviceRequest;
use App\Http\Requests\Business\Device\UpdateDeviceRequest;
use App\Http\Controllers\Controller;
use App\Models\Business\Employee\Employee;

class DeviceController extends Controller
{
    
    public function index()
    {
        $devices = Device::with('employee.department.company')->get();

        return view('app.business.device.device_index', compact('devices'));
    }

   
    public function create()
    {
        $employees = Employee::with('department.company')->get();

        return view('app.business.device.device_create', compact('employees'));
    }

    
    public function store(StoreDeviceRequest $request)
    {
        $request->validated();

        $device = Device::create([
            'employee_id' => $request->employee_id,
            'device_type' => $request->device_type,
            'brand' => $request->brand,
            'model' => $request->model
        ]);

        return redirect()->route('device.index');
    }

    
    public function show($id)
    {
        $device = Device::with('employee.department.company')->find($id);

        return view('app.business.device.device_show', compact('device'));
    }

    
    public function edit($id)
    {
        $device = Device::with('employee.department.company')->findOrFail($id);
        $employees = Employee::with('department.company')->get();

        return view('app.business.device.device_edit', compact('device', 'employees'));
    }

    
    public function update(UpdateDeviceRequest $request, $id)
    {
        $request->validated();

        $device = Device::find($id);

        $device->update([
            'employee_id' => $request->employee_id,
            'device_type' => $request->device_type,
            'brand' => $request->brand,
            'model' => $request->model
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
