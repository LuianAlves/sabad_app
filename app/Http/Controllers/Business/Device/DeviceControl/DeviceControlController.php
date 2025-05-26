<?php

namespace App\Http\Controllers\Business\Device\DeviceControl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Requests
use App\Http\Requests\Business\Device\DeviceContro\StoreDeviceControlRequest;

// Models
use App\Models\Business\Device\DeviceControl\DeviceControl;
use App\Models\Business\Device\Device;
use App\Models\Business\Employee\Employee;

// Dependences
use Carbon\Carbon;

class DeviceControlController extends Controller
{
    public function index()
    {
        $deviceControls = DeviceControl::all(); 
        return view('app.business.device.device_control.device_control_index', compact('deviceControls'));
    }

    public function create()
    {
        $devices = Device::all();
        $employees = Employee::all();

        return view('app.business.device.device_control.device_control_create', compact('devices', 'employees'));
    }

    public function store(StoreDeviceControlRequest $request)
    {
        $request->validated();

        $device = Device::findOrFail($request->device_id);

        $prefix = strtoupper(substr($device->deviceType->name, 0, 4));

        $lastCode = DeviceControl::where('device_code', 'like', $prefix . '%')
            ->orderBy('device_code', 'desc')
            ->first();

        if ($lastCode) {
            $lastNumber = (int) substr($lastCode->device_code, 4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $deviceCode = $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        dd($request, $deviceCode, $prefix);

        DeviceControl::create([
            'device_id' => $request->device_id,
            'employee_id' => $request->employee_id,
            'device_code' => $deviceCode,
            'delivered_in' => $request->delivered_in,
            'returned_in' => $request->returned_in,
            'estimated_price' => $request->estimated_price,
            'purchased_in' => $request->purchased_in,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('device_control.index');
    }

    public function show() {}
    public function update() {}
    public function destroy() {}
}
